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
namespace Joska\Model;

/**
 * Interface of a model.
 * 
 * This interface follows the Model-View-Controller Pattern.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Model
 */
interface ModelInterface {
    /**
     * Returns idetifier of this model.
     * 
     * Returns an associative array of data sufficient to identify this
     * model. This usually means an array with and 'id' key.
     * 
     * @return array Associative array representing the identifier
     */
    public function getId();


    /**
     * Returns attributes of this model.
     * 
     * @return array Associative arrays of attributes and values
     */
    public function getAttributes();
}
