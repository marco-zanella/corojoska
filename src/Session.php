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
    /**
     * Initializes a session.
     */
    private static function initialize() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }



    /**
     * Tells whether a user is authenticated.
     * 
     * @return bool True if user is authenticated, false otherwise
     * @api
     */
    public static function isAuthenticated() {
        self::initialize();
        return isset($_SESSION['user_id']);
    }



    /**
     * Tells whether authenticated user has given permission.
     * 
     * Returns false if user is not authenticated.
     * 
     * @param string $permission Permission to check
     * @return bool True if user has given permission, false othwerwise
     * @api
     */
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



    /**
     * Returns authenticated user.
     * 
     * Returns an empty value if user is not correctly authenticated.
     * 
     * @return \Joska\Model\User|null Authenticated user
     * @api
     */
    public static function getAuthenticatedUser() {
        self::initialize();
        
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        $mapper = new \Joska\DataMapper\Sql('User');
        return $mapper->read($_SESSION['user_id']);
    }



    /**
     * Authenticates a user.
     * 
     * Checks whether username and password are correct and, if they are,
     * register user to the session.
     * 
     * Returns authenticated user on success, false othwerise.
     * 
     * @param string $username Username
     * @param string $password Password
     * @return \Joska\Model\User|bool Authenticated user
     * @api
     */
    public static function authenticate($username, $password) {
        self::initialize();

        $mapper = new \Joska\DataMapper\Sql('User');
        $user = $mapper->read(['username' => $username]);

        if (empty($user) || !password_verify($password, $user->password)) {
            return false;
        }

        $_SESSION['user_id'] = $user->id;
        return $user;
    }



    /**
     * Log outs a user.
     * 
     * @api
     */
    public static function logout() {
        self::initialize();
        unset($_SESSION['user_id']);
    }



    /**
     * Throws an exception if user is not authenticated.
     * 
     * @throws \Exception if user is not authenticated
     * @api
     */
    public static function requireAuthentication() {
        self::initialize();

        if (!self::isAuthenticated()) {
            throw new \Exception("Authentication required.");
        }
    }



    /**
     * Throws an exception is user does not have given permission.
     * 
     * @param string $permission Identifier of permission
     * @throws \Exception if user does not have given permission
     * @api
     */
    public static function requirePermission($permission) {
        self::initialize();

        if (!self::hasPermission($permission)) {
            throw new \Exception("Permission required: $permission.");
        }
    }
}
