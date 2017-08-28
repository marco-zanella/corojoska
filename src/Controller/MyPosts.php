<?php
/**
 * This file is part of Corojoska.
 *
 * Corojoska is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Corojoska is distributed under the hope it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Corojoska. If not, see <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 *
 * @author    Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @license   GNU General Public License, version 3
 */
namespace Joska\Controller;

/**
 * Controller for a blog post.
 * 
 * This class follows the Model-View-Controller Pattern and exhibits
 * a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Controller
 */
class MyPosts extends Controller {
    /**
     * Creates a new post.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function post($binders = []) {
        \Joska\Session::requirePermission('publish');

        $data_mapper = new \Joska\DataMapper\Sql('Post');

        $post = new \Joska\Model\Post();
        $post->title = $_POST['title'];
        $post->summary = $_POST['summary'];
        $post->content = $_POST['content'];

        $image_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = preg_replace("/[^[:alnum:]]/u", "", strtolower(str_replace(" ", "-", $_POST['title']))) . '-header.' . $image_extension;
        $image_path = 'public/images/' . $image_name;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            throw new \Exception("Cannot upload image.");
        }
        $post->image = $image_path;

        $post->author = \Joska\Session::getAuthenticatedUser();
        $post->created_at = date('Y-m-d H:i:s', time());
        $post->updated_at = date('Y-m-d H:i:s', time());
        $data_mapper->create($post);
        
        // Indexes post for searching purposes
        $search_engine = new \Joska\SearchEngine\Simple();
        $search_engine->load();
        $search_engine->index([
            'id' => 'post-' . $post->id,
            'title' => $post->title,
            'summary' => $post->summary,
            'content' => $post->content
        ]);
        $search_engine->save();

        return $this->view('backend/my-posts-publish', ['post' => $post]);
    }



    /**
     * Returns list of posts or edit form.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        \Joska\Session::requirePermission('publish');

        $mapper = new \Joska\DataMapper\Sql('Post');

        // Edit post form
        if (isset($binders['id'], $binders['mode']) && $binders['mode'] === 'edit') {
            $post_id = $binders['id'];
            $post = $mapper->read($post_id);

            if (empty($post)) {
                return $this->view('backend/404');
            }

            return $this->view('backend/my-posts-edit', ['post' => $post]);
        }

        // List of posts
        $user = \Joska\Session::getAuthenticatedUser();
        $criteria = new \Joska\DataMapper\MatchCriteria\Sql('author_id=:author_id', [':author_id' => $user->id]);
        $posts = $mapper->search($criteria, ['created_at' => 'desc']);
        return $this->view('backend/my-posts', ['posts' => $posts]);
    }



    /**
     * Updates a post.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function put($binders = []) {
        \Joska\Session::requirePermission('publish');

        if (!isset($binders['id'])) {
            throw new \Exception("Missing post identifier.");
        }

        $post_id = $binders['id'];
        $mapper = new \Joska\DataMapper\Sql('Post');
        $post = $mapper->read($post_id);

        if ($post->author_id != \Joska\Session::getAuthenticatedUser()->id) {
            throw new \Exception("You are not the author of this post.");
        }

        $post->title = $_POST['title'];
        $post->summary = $_POST['summary'];
        $post->content = $_POST['content'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $image_name = preg_replace("/[^[:alnum:]]/u", "", strtolower(str_replace(" ", "-", $_POST['title']))) . '-header.' . $image_extension;
            $image_path = 'public/images/' . $image_name;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                throw new \Exception("Cannot upload image.");
            }

            if (file_exists($post->image)) {
                unlink($post->image);
            }
            $post->image = $image_path;
        }

        $post->updated_at = date('Y-m-d H:i:s', time());
        $mapper->update($post);
        
        // Indexes post for searching purposes
        $search_engine = new \Joska\SearchEngine\Simple();
        $search_engine->load();
        $search_engine->index([
            'id' => 'post-' . $post->id,
            'title' => $post->title,
            'summary' => $post->summary,
            'content' => $post->content
        ]);
        $search_engine->save();

        return $this->view('backend/my-posts-edit', ['post' => $post]);
    }



    /**
     * Deletes a post.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function delete($binders = []) {
        \Joska\Session::requirePermission('publish');

        if (!isset($binders['id'])) {
            throw new \Exception("Missing post identifier.");
        }

        $post_id = $binders['id'];
        $mapper = new \Joska\DataMapper\Sql('Post');
        $post = $mapper->read($post_id);

        if ($post->author_id != \Joska\Session::getAuthenticatedUser()->id) {
            throw new \Exception("You are not the author of this post.");
        }

        $mapper->delete($post_id);
        if (file_exists($post->image)) {
            unlink($post->image);
        }
        
        // Deletes post from search index
        $search_engine = new \Joska\SearchEngine\Simple();
        $search_engine->load()->remove('post-' . $id);

        header('Location: /my-posts');
    }
}
