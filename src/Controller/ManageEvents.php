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
 * Controller for events.
 * 
 * This class follows the Model-View-Controller Pattern and exhibits
 * a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Controller
 */
class ManageEvents extends Controller {
    /**
     * Creates a new post.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function post($binders = []) {
        \Joska\Session::requirePermission('manage-events');

        $mapper = new \Joska\DataMapper\Sql('Event');

        $event = new \Joska\Model\Event();
        $event->name = $_POST['name'];
        $event->place = $_POST['place'];
        $event->date = $_POST['date'];
        $event->description = $_POST['event_description'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $image_name = strtolower(str_replace(" ", "-", $_POST['name'])) . '-event.' . $image_extension;
            $image_path = 'public/images/' . $image_name;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                throw new \Exception("Cannot upload image.");
            }
            $event->image = $image_path;
        }

        $mapper->create($event);

        header('Location: /manage-events');
    }



    /**
     * Returns list of events or edit form.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        \Joska\Session::requirePermission('manage-events');

        $mapper = new \Joska\DataMapper\Sql('Event');

        // Edit form
        if (isset($binders['id'], $binders['mode']) && $binders['mode'] === 'edit') {
            $id = $binders['id'];
            $event = $mapper->read($id);

            if (empty($event)) {
                return $this->view('backend/404');
            }

            return $this->view('backend/manage-events-edit', ['event' => $event]);
        }

        // List of events
        $events = $mapper->search(null, ['created_at' => 'desc']);
        return $this->view('backend/manage-events', ['events' => $events]);
    }



    /**
     * Updates an event.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function put($binders = []) {
        \Joska\Session::requirePermission('manage-events');

        if (!isset($binders['id'])) {
            throw new \Exception("Missing events identifier.");
        }

        $event_id = $binders['id'];
        $mapper = new \Joska\DataMapper\Sql('Event');
        $event = $mapper->read($event_id);

        $event->name = $_POST['name'];
        $event->place = $_POST['place'];
        $event->date = $_POST['date'];
        $event->description = $_POST['event_description'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $image_name = strtolower(str_replace(" ", "-", $_POST['name'])) . '-event.' . $image_extension;
            $image_path = 'public/images/' . $image_name;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                throw new \Exception("Cannot upload image.");
            }

            if (file_exists($event->image)) {
                unlink($event->image);
            }
            $event->image = $image_path;
        }

        $event->updated_at = null;
        $mapper->update($event);

        return $this->view('backend/manage-events-edit', ['event' => $event]);
    }



    /**
     * Deletes an event.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function delete($binders = []) {
        \Joska\Session::requirePermission('manage-events');

        if (!isset($binders['id'])) {
            throw new \Exception("Missing event identifier.");
        }

        $id = $binders['id'];
        $mapper = new \Joska\DataMapper\Sql('Event');
        $event = $mapper->read($id);

        $mapper->delete($id);
        if (file_exists($event->image)) {
            unlink($event->image);
        }

        header('Location: /manage-events');
    }
}
