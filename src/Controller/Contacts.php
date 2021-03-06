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
 * Controller for contact and link static page.
 * 
 * This class follows the Model-View-Controller Pattern and exhibits
 * a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Controller
 */
class Contacts extends Controller {
    /**
     * Returns the contact and link page.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        $post_mapper = new \Joska\DataMapper\Sql('Post');
        $event_mapper = new \Joska\DataMapper\Sql('Event');

        $posts = $post_mapper->search(null, ['created_at' => 'desc'], 10);
        $latest_posts = $post_mapper->search(null, ['created_at' => 'desc'], 3);

        $criteria = new \Joska\DataMapper\MatchCriteria\Sql('date > NOW()', []);
        $upcoming_events = $event_mapper->search($criteria, ['date' => 'asc']);

        return $this->view('frontend/contacts-page', [
          'upcoming_events' => $upcoming_events,
          'latest_posts' => $latest_posts
        ]);
    }
}
