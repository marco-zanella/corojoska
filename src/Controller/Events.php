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
 * Controller for events page.
 * 
 * This class follows the Model-View-Controller Pattern and exhibits
 * a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Controller
 */
class Events extends Controller {
    /**
     * Returns list of events or a single event's page.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        $mapper = new \Joska\DataMapper\Sql('Event');

        // Shows a single event
        if (isset($binders['id'])) {
            $event = $mapper->read($binders['id']);

            if (empty($event)) {
                return $this->view('frontend/404.php');
            }
            return $this->view('frontend/event-page', ['event' => $event]);
        }

        // Shows events list
        $events = $mapper->search(null, ['date' => 'desc']);
        return $this->view('frontend/events-page', ['events' => $events]);
    }
}
