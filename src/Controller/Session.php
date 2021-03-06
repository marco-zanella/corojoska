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
 * Controller for the session.
 * 
 * This class follows the Model-View-Controller Pattern and exhibits
 * a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017
 * @package Joska\Controller
 */
class Session extends Controller {
    /**
     * Creates a new session.
     * 
     * @param array $binders Associative array of parameters
     * @return $this This controller itself
     * @api
     */
    public function post($binders = []) {
        if (!isset($_POST['username'], $_POST['password'])) {
            throw new \Exception('Missing username or password.');
        }

        $user = \Joska\Session::authenticate($_POST['username'], $_POST['password']);
        if (empty($user)) {
            throw new \Exception('Wrong username or password.');
        }

        if (isset($_POST['redirect_to'])) {
            header('Location: ' . $_POST['redirect_to']);
        }

        header('Location: /account');
    }



    /**
     * Shows login or logout form.
     * 
     * @param array $binders Associative array of binders
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        $post_mapper = new \Joska\DataMapper\Sql('Post');
        $event_mapper = new \Joska\DataMapper\Sql('Event');

        $latest_posts = $post_mapper->search(null, ['created_at' => 'desc'], 3);
        $criteria = new \Joska\DataMapper\MatchCriteria\Sql('date > NOW()', []);
        $upcoming_events = $event_mapper->search($criteria, ['date' => 'asc']);

        $view = !\Joska\Session::isAuthenticated() ? 'frontend/login' : 'frontend/logout';
        return $this->view($view, [
          'upcoming_events' => $upcoming_events,
          'latest_posts' => $latest_posts
        ]);
    }



    /**
     * Deletes the session.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function delete($binders = []) {
        \Joska\Session::logout();

        if (isset($_POST['redirect_to'])) {
            header('Location: ' . $_POST['redirect_to']);
        }

        header('Location: /login');
    }
}
