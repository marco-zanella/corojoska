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
class Post extends Controller {
    /**
     * Method to call on POST requests.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function post($binders = []) {
        $data_mapper = new \Joska\DataMapper\Sqlite('Post');

        $post = new \Joska\Model\Post();
        $post->content = $_POST['content'];
        $data_mapper->create($post);

        return $this;
    }



    /**
     * Method to call on GET requests.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        $post_id = $binders['id'];

        $data_mapper = new \Joska\DataMapper\Sqlite('Post');
        $model = $data_mapper->read($post_id);

        return $this;
    }



    /**
     * Method to call on PUT requests.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function put($binders = []) {
        $post_id = $binders['id'];

        $data_mapper = new \Joska\DataMapper\Sqlite('Post');
        $model = $data_mapper->read($post_id);

        $model->content = '<h3>Updated content</h3>';
        $data_mapper->update($model);

        return $this;
    }



    /**
     * Method to call on DELETE requests.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function delete($binders = []) {
        $post_id = $binders['id'];

        $data_mapper = new \Joska\DataMapper\Sqlite('Post');
        $model = $data_mapper->delete($post_id);

        return $this;
    }
}
