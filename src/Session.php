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
namespace Joska;

/**
 * Session manager.
 * 
 * Defines methods to handle common operations on sessions, actiong as
 * a proxy.
 * 
 * This class follows the Proxy Design Pattern.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska
 */
class Session {
    private static function initialize() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }


    public static function isAuthenticated() {
        self::initialize();
        return isset($_SESSION['user_id']);
    }


    public static function getAuthenticatedUser() {
        self::initialize();
        
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        $mapper = new \Joska\DataMapper\Sql('User');
        return $mapper->read($_SESSION['user_id']);
    }




    /**
     * @todo To do!!!
     */
    public static function authenticate($username, $password) {
        self::initialize();

        $mapper = new \Joska\DataMapper\Sql('User');
        $user = $mapper->read(6);

        if (empty($user)) {
            return false;
        }

        $_SESSION['user_id'] = $user->id;
        return $user;
    }


    public static function logout() {
        self::initialize();
        unset($_SESSION['user_id']);
    }



    public static function hasPermission($permission) {
        self::initialize();

        $user = self::getAuthenticatedUser();
        if (empty($user)) {
            return false;
        }

        $mapper = new \Joska\DataMapper\Sql('Permission');
        $permission = $mapper->read(['user_id' => $user->id, 'permission_id' => $permission]);

        return !empty($permission);
    }



    public static function requireAuthentication() {
        self::initialize();

        if (!self::isAuthenticated()) {
            throw new \Exception("Authentication required.");
        }
    }


    public static function requirePermission($permission) {
        self::initialize();

        if (!self::hasPermission($permission)) {
            throw new \Exception("Permission required: $permission.");
        }
    }





}
