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
 * Controller for a user.
 * 
 * This class follows the Model-View-Controller Pattern and exhibits
 * a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017
 * @package Joska\Controller
 */
class User extends Controller {
    /**
     * Creates a new user.
     * 
     * @param array $binders Associative array of paramters
     * @return $this This controller itself
     * @api
     */
    public function post($binders = []) {
        $user = new \Joska\Model\User();
        $user->username = $_POST['username'];
        $user->name = $_POST['name'];
        $user->surname = $_POST['surname'];

        $mapper = new \Joska\DataMapper\Sql('User');
        $mapper->create($user);

        return $this->view('user', ['user' => $user]);
    }



    /**
     * Shows an user or user list.
     * 
     * @param array $binders Associative array of binders
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        $mapper = new \Joska\DataMapper\Sql('User');

        // Shows a specific user if id is set...
        if (isset($binders['id'])) {
            $user = $mapper->read($binders['id']);
            return $this->view('user', ['user' => $user]);
        }

        // ... otherwise shows list of users
        $users = $mapper->read([]);

        return $this->view('users', ['users' => $users]);
    }
}
