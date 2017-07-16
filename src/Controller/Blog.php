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
 * Controller for blog.
 * 
 * This class follows the Model-View-Controller Pattern and exhibits
 * a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Controller
 */
class Blog extends Controller {
    /**
     * Returns a page of the blog or a single post.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        $mapper = new \Joska\DataMapper\Sql('Post');
        $event_mapper = new \Joska\DataMapper\Sql('Event');

        $latest_posts = $mapper->search(null, ['created_at' => 'desc'], 3);
        $criteria = new \Joska\DataMapper\MatchCriteria\Sql('date > NOW()', []);
        $upcoming_events = $event_mapper->search($criteria, ['date' => 'asc']);

        // Shows a single post
        if (isset($binders['id'])) {
            $post = $mapper->read($binders['id']);

            if (empty($post)) {
                return $this->view('frontend/404');
            }
            return $this->view('frontend/post-page', [
                'post' => $post,
                'upcoming_events' => $upcoming_events,
                'latest_posts' => $latest_posts
            ]);
        }

        // Shows a page of posts
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $size = (isset($_GET['page_size'])) ? $_GET['page_size'] : 10;
        $elements = $mapper->count();
        $pages = ceil($elements / $size);
        $offset = ($page - 1) * $size;

        $previous_page = ($page == 1) ? 1 : $page - 1;
        $next_page = ($page == $pages) ? $page : $page + 1;

        $posts = $mapper->search(null, ['created_at' => 'desc'], $size, $offset);
        return $this->view('frontend/posts-page', [
            'posts' => $posts, 'page' => $page, 'page_size' => $size,
            'post_number' => $elements, 'pages' => $pages,
            'previous_page' => $previous_page, 'next_page' => $next_page,
            'upcoming_events' => $upcoming_events,
            'latest_posts' => $latest_posts
        ]);
    }
}
