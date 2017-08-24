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
 * Controller for blog posts.
 * 
 * This class follows the Model-View-Controller Pattern and exhibits
 * a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Controller
 */
class ManagePosts extends Controller {
    /**
     * Returns list of posts or edit form.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        \Joska\Session::requirePermission('manage-posts');

        $mapper = new \Joska\DataMapper\Sql('Post');

        // Edit form
        if (isset($binders['id'], $binders['mode']) && $binders['mode'] === 'edit') {
            $id = $binders['id'];
            $post = $mapper->read($id);

            if (empty($post)) {
                return $this->view('backend/404');
            }

            return $this->view('backend/manage-posts-edit', ['post' => $post]);
        }

        // List of events
        $posts = $mapper->search(null, ['created_at' => 'desc']);
        return $this->view('backend/manage-posts', ['posts' => $posts]);
    }



    /**
     * Updates a post.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function put($binders = []) {
        \Joska\Session::requirePermission('manage-posts');

        if (!isset($binders['id'])) {
            throw new \Exception("Missing post identifier.");
        }

        $id = $binders['id'];
        $mapper = new \Joska\DataMapper\Sql('Post');
        $post = $mapper->read($id);

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

        return $this->view('backend/manage-posts-edit', ['post' => $post]);
    }



    /**
     * Deletes a post.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function delete($binders = []) {
        \Joska\Session::requirePermission('manage-posts');

        if (!isset($binders['id'])) {
            throw new \Exception("Missing post identifier.");
        }

        $id = $binders['id'];
        $mapper = new \Joska\DataMapper\Sql('Post');
        $post = $mapper->read($id);

        $mapper->delete($id);
        if (file_exists($post->image)) {
            unlink($post->image);
        }

        header('Location: /manage-posts');
    }
}
