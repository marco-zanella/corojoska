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
 * Abstract class of a controller.
 * 
 * Gives a basic implementation of a ControllerInterface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Controller
 */
abstract class Controller implements ControllerInterface {
    /**
     * Method to call on POST requests.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @throws \Exception Method not available
     * @api
     */
    public function post($binders = []) {
        throw new \Exception(__CLASS__ . " does not accept POST requests.\n");
    }



    /**
     * Method to call on GET requests.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @throws \Exception Method not available
     * @api
     */
    public function get($binders = []) {
        throw new \Exception(__CLASS__ . " does not accept GET requests.\n");
    }



    /**
     * Method to call on PUT requests.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @throws \Exception Method not available
     * @api
     */
    public function put($binders = []) {
        throw new \Exception(__CLASS__ . " does not accept PUT requests.\n");
    }



    /**
     * Method to call on DELETE requests.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @throws \Exception Method not available
     * @api
     */
    public function delete($binders = []) {
        throw new \Exception(__CLASS__ . " does not accept DELETE requests.\n");
    }



    /**
     * Calls a view from this controller.
     * 
     * @param string $name Name of the view
     * @param array $_variables Associative array of variables to inject
     * @return $this This controller itself
     */
    protected function view($name, $_variables = []) {
        $_path = 'src/View/' . $name . '.php'; 
        foreach ($_variables as $name => $value) {
            $$name = $value;
        }

        if (is_readable($_path)) {
            include $_path;
        }

        return $this;
    }
}
