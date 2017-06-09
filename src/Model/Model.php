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
 * Abstract class of a model.
 * 
 * Gives a generic implementation of a ModelInterface.
 * 
 * This interface follows the Model-View-Controller Pattern.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Model
 */
abstract class Model implements ModelInterface {
    /**
     * @var array $_id Array of names of field used to represent the identifier
     */
    protected $_id = ['id'];

    /**
     * @var array $_data Associative array containing fields of this model
     */
    private $_data = [];


    /**
     * Tells whether a property of this model is defined.
     * 
     * @param string $name Name of the property
     * @return bool True if and only if given property is defined for this model
     */
    public function __isset($name) {
        return isset($this->_data[$name]);
    }


    /**
     * Returns a property of this model.
     * 
     * Returns null if property is not set.
     * 
     * @param string $name Name of the property to return
     * @return mixed|null Given property, or null
     */
    public function __get($name) {
        return isset($this->_data[$name]) ? $this->_data[$name] : null;
    }


    /**
     * Sets a property of this model.
     * 
     * Overwrites an previously defined property with the same name.
     * 
     * @param string $name Name o the property to set
     * @param mixed $value Value of the property to set
     * @return mixed Result of the assignment
     */
    public function __set($name, $value) {
        return $this->_data[$name] = $value;
    }


    /**
     * Unsets a property of this model.
     * 
     * @param string $name Name of the property to unset
     * @return $this This model itself
     */
    public function __unset($name) {
        unset($this->_data[$name]);

        return $this;
    }


    /**
     * Returns idetifier of this model.
     * 
     * Returns an associative array of data sufficient to identify this
     * model. This usually means an array with and 'id' key.
     * 
     * Identifier is read from this model's data by extracting the
     * properties indicated by $this->_id.
     * 
     * @return array Associative array representing the identifier
     */
    public function getId() {
        $id = [];
        foreach ($this->_id as $attribute) {
            if (!isset($this->$attribute)) {
                return null;
            }
            $id[$attribute] = $this->$attribute;
        }
        return $id;
    }



    /**
     * Returns attributes of this model.
     * 
     * @return array Associative arrays of attributes and values
     */
    public function getAttributes() {
        return $this->_data;
    }
}
