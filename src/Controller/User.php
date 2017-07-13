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
     * @param array $binders Associative array of parameters
     * @return $this This controller itself
     * @api
     */
    public function post($binders = []) {
        \Joska\Session::requirePermission('manage-users');

        $user = new \Joska\Model\User();
        $user->username = $_POST['username'];
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->name = $_POST['name'];
        $user->surname = $_POST['surname'];

        $mapper = new \Joska\DataMapper\Sql('User');
        $mapper->create($user);

        return $this->view('backend/user', ['user' => $user, 'permissions' => []]);
    }



    /**
     * Shows a user, user list or user edit page.
     * 
     * @param array $binders Associative array of binders
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        \Joska\Session::requirePermission('manage-users');

        $mapper = new \Joska\DataMapper\Sql('User');
        $permission_mapper = new \Joska\DataMapper\Sql('Permission');

        // Shows the user edit page
        if (isset($binders['id'], $binders['mode']) && $binders['mode'] === 'edit') {
            $user = $mapper->read($binders['id']);
            $criteria = new \Joska\DataMapper\SqlCriteria('user_id=:user', ['user' => $user->id]);
            $permissions = $permission_mapper->search($criteria);
            return $this->view('backend/user-edit', ['user' => $user, 'permissions' => $permissions]);
        }

        // Shows a specific user if id is set...
        elseif (isset($binders['id'])) {
            $user = $mapper->read($binders['id']);
            $criteria = new \Joska\DataMapper\SqlCriteria('user_id=:user', ['user' => $user->id]);
            $permissions = $permission_mapper->search($criteria);
            return $this->view('backend/user', ['user' => $user, 'permissions' => $permissions]);
        }

        // ... otherwise shows list of users
        $users = $mapper->search();
        return $this->view('backend/users', ['users' => $users]);
    }



    /**
     * Updates a user.
     * 
     * @param array $binders Associative array of binders
     * @return $this This controller itself
     * @api
     */
    public function put($binders = []) {
        \Joska\Session::requirePermission('manage-users');

        if (!isset($binders['id'])) {
            throw new \Exception("Missing user identifier.");
        }
        

        $mapper = new \Joska\DataMapper\Sql('User');
        $permission_mapper = new \Joska\DataMapper\Sql('Permission');

        $user = $mapper->read($binders['id']);
        $user->username = $_POST['username'];
        if (isset($_POST['password'])) {
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }
        $user->name = $_POST['name'];
        $user->surname = $_POST['surname'];
        $user->updated_at = null;
        $mapper->update($user);

        $permission_mapper->delete(['user_id' => $user->id]);
        $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];
        $new_permissions = [];
        foreach ($permissions as $permission_id) {
          $permission = new \Joska\Model\Permission();
          $permission->user_id = $user->id;
          $permission->permission_id = $permission_id;
          $new_permissions[] = $permission;
          $permission_mapper->create($permission);
        }

        return $this->view('backend/user', ['user' => $user, 'permissions' => $new_permissions]);
    }



    /**
     * Deletes a user.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function delete($binders = []) {
        \Joska\Session::requirePermission('manage-users');

        if (!isset($binders['id'])) {
            throw new \Exception("Missing user identifier.");
        }

        $id = $binders['id'];

        $mapper = new \Joska\DataMapper\Sql('User');
        $mapper->delete($id);

        $permission_mapper = new \Joska\DataMapper\Sql('Permission');
        $permission_mapper->delete(['user_id' => $id]);

        $users = $mapper->search();
        return $this->view('backend/users', ['users' => $users]);
    }
}
