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
namespace Joska\DataMapper;

/**
 * Common database operations for an SQL-based data mapper.
 *
 * This trait defined methods commonly used in SQL-based data mappers,
 * such as function to build queries.
 *
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\DataMapper
 */
trait SqlTrait {
    /**
     * Extracts information from a model.
     * 
     * Reads attributes of a model and stores them into an associative
     * array in the form 'field-name' => value.
     * 
     * When a model is encoutered as an attribute, it is treated as an
     * 1-to-1 relation, its id is read and used to generate keys. For
     * instance the model of a Post with information about its
     * author (User), identified by an id will get an 'user_id' field.
     * 
     * @param \Joska\Model\ModelInterface $model Model to use
     * @return array Associative array of fields
     */
    protected function modelToFields(\Joska\Model\ModelInterface $model) {
        $fields = [];
        foreach ($model->getAttributes() as $key => $value) {
            // Simple, scalar value
            if (is_scalar($value)) {
                $fields[$key] = $value;
            }
            // 1-to-1 reference
            elseif ($value instanceof \Joska\Model\ModelInterface) {
                foreach ($value->getId() as $id_key => $id_value) {
                    $fields[$key . '_' . $id_key] = $id_value;
                }
            }
        }
        return $fields;
    }



    /**
     * Converts an associative array into a list of binders.
     * 
     * Accepts an associative array in the form 'key' => value and
     * converts it into the form ':<prefix><key>' => value, which is
     * suitable to be used to bind values in prepared statements.
     * 
     * @param array $data Associative array to convert
     * @param string $prefix Prefix to prepend before field names
     * @return array Associative array of binders-values
     */
    protected function getBinders($data, $prefix = '') {
        $binders = [];
        foreach ($data as $key => $value) {
            $binders[':' . $prefix . $key] = $value;
        }
        return $binders;
    }



    /**
     * Converts an associative array into a list of binder keys.
     * 
     * Accepts an asssociative array in the form 'key' => value and
     * converts it into the form 'key' => ':<prefix><key>', which is
     * suitable to build prepared statements.
     * 
     * @param array $data Associative array to convert
     * @param string $prefix Prefix to prepend before field names
     * @param array Associative array of keys-binders
     */
    protected function getBindersList($data, $prefix = '') {
        $binders = [];
        foreach ($data as $key => $value) {
            $binders[$key] = ':' . $prefix . $key;
        }
        return $binders;
    }



    /**
     * Builds a prepared INSERT INTO query.
     * 
     * @param string $table_name Name of the table to insert data into
     * @param array $data Associative array of data to insert ('field' => value)
     * @return string Query string to be used in a prepared statement
     */
    protected function prepareInsert($table_name, $data) {
        $prepend_colon = function ($string) { return ':' . $string; };

        $query = 'INSERT INTO ' . $table_name
               . ' (' . implode(', ', array_keys($data)) . ')'
               . ' VALUES('
               . implode(', ', array_map($prepend_colon, array_keys($data)))
               . ')';


        return $query;
    }



    /**
     * Builds a prepared SELECT query.
     * 
     * @param string $table_name Name of the table to select data from
     * @param string|array $fields Fields to extract
     * @param string|array $where Matching condition
     * @param string|array $order Ordering information
     * @param int|null $limit Maximum number of results to return
     * @param int|null $offset Records to skip (has effect only if limit is specified)
     * @return string Query string to be used in a prepared statement
     */
    protected function prepareSelect(
        $table_name,
        $fields = '*',
        $where = '',
        $order = [],
        $limit = null,
        $offset = null
    ) {
        // Converts parameters into more suitable data types (i.e.
        // arrays to strings)
        if (is_array($fields)) {
            $fields = implode(', ', $fields);
        }

        if (is_array($where)) {
            $clauses = [];
            foreach ($where as $key => $value) {
                $clauses[] = $key . '=' . $value;
            }
            $where = implode(' AND ', $clauses);
        }

        if (!empty($order) && is_array($order)) {
            $clauses = [];
            foreach ($order as $key => $value) {
                $clauses[] = $key . ' ' . $value;
            }
            $order = implode(', ', $clauses);
        }


        // Builds the query
        $query = 'SELECT ' . $fields . ' FROM ' . $table_name;

        if (!empty($where)) {
            $query .= ' WHERE ' . $where;
        }

        if (!empty($order)) {
            $query .= ' ORDER BY ' . $order;
        }

        if (!empty($limit)) {
            $query .= ' LIMIT ' . $limit;
            if (!empty($offset)) {
                $query .= ', ' . $offset;
            }
        }

        return $query;
    }



    /**
     * Builds a prepared UPDATE query.
     * 
     * @param string $table_name Name of the table to select data from
     * @param string|array $set Associative array of values to set ('field' => value)
     * @param string|array $where Matching condition
     * @return string Query string to be used in a prepared statement
     */
    protected function prepareUpdate($table_name, $set, $where = '') {
        // Converts parameters into more suitable data types (i.e.
        // arrays to strings)
        if (is_array($set)) {
            $clauses = [];
            foreach ($set as $key => $value) {
                $clauses[] = $key . '=' . $value;
            }
            $set = implode(', ', $clauses);
        }


        if (is_array($where)) {
            $clauses = [];
            foreach ($where as $key => $value) {
                $clauses[] = $key . '=' . $value;
            }
            $where = implode(' AND ', $clauses);
        }


        // Builds the query
        $query = 'UPDATE ' . $table_name . ' SET ' . $set;
        if (!empty($where)) {
            $query .= ' WHERE ' . $where;
        }

        return $query;
    }



    /**
     * Builds a prepared DELETE query.
     * 
     * @param string $table_name Name of the table to select data from
     * @param string|array $where Matching condition
     * @return string Query string to be used in a prepared statement
     */
    protected function prepareDelete($table_name, $where = '') {
        // Converts parameters into more suitable data types (i.e.
        // arrays to strings)
        if (is_array($where)) {
            $clauses = [];
            foreach ($where as $key => $value) {
                $clauses[] = $key . '=' . $value;
            }
            $where = implode(' AND ', $clauses);
        }


        // Builds the query
        $query = 'DELETE FROM ' . $table_name;
        if (!empty($where)) {
            $query .= ' WHERE ' . $where;
        }

        return $query;
    }
}
