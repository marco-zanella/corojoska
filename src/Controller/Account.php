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
 * Account of currently logged user.
 * 
 * This class follows the Model-View-Controller Pattern and exhibits
 * a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017
 * @package Joska\Controller
 */
class Account extends Controller {
    /**
     * Shows personal account page or edit form.
     * 
     * @param array $binders Associative array of binders
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        \Joska\Session::requireAuthentication();

        $user = \Joska\Session::getAuthenticatedUser();

        // Shows edit page
        if (isset($binders['mode']) && $binders['mode'] === 'edit') {
            return $this->view('backend/account-edit', ['user' => $user]);
        }

        // Shows info page
        return $this->view('backend/account', ['user' => $user]);
    }



    /**
     * Updates account information.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function put($binders = []) {
        \Joska\Session::requireAuthentication();

        $mapper = new \Joska\DataMapper\Sql('User');
        $user = \Joska\Session::getAuthenticatedUser();
        $user->name = $_POST['name'];
        $user->surname = $_POST['surname'];
        if (isset($_POST['password'], $_POST['confirm-password']) && $_POST['password'] === $_POST['confirm-password']) {
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }
        $user->updated_at = null;
        $mapper->update($user);

        return $this->view('backend/account', ['user' => $user]);
    }
}
