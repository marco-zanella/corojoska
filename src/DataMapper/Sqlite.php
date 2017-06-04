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
 * An SQLite-based data mapper.
 * 
 * This class follows the Data Mapper Design Pattern and exhibits
 * a CRUD and a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\DataMapper
 */
class Sqlite implements DataMapperInterface {
    use SqlTrait;

    /**
     * @var string $model_name Name of the mapped model
     * @var \SQLite3 $db Connection to the SQLite database
     */
    protected $model_name, $db;



    /**
     * Constructor.
     * 
     * @param string $model_name Name of the mapped model
     * @todo Use name of the database as parameter
     */
    public function __construct($model_name) {
        $this->model_name = $model_name;

        $this->db = new \SQLite3('/home/picci/Scrivania/cj.db');
    }



    /**
     * Creates a new model.
     * 
     * @param \Joska\Model\ModelInterface $model Model to create
     * @return $this This data mapper itself
     * @api
     */
    public function create(\Joska\Model\ModelInterface $model) {
        $params = $this->modelToFields($model);
        $query = $this->prepareInsert($this->model_name, $params);
        $binders = $this->getBinders($params);

        $stm = $this->db->prepare($query);
        foreach ($binders as $key => $value) {
            $stm->bindValue($key, $value);
        }
        $stm->execute();

        $model->id = $this->db->lastInsertRowId();

        return $this;
    }



    /**
     * Reads a model.
     * 
     * Returns the model identified by given key from the data
     * persistence layer, or false is no mathces are found.
     * 
     * @param string|array $key Identifier of the object to read
     * @return \Joska\Model\ModelInterface|bool Read model, or false
     * @api
     */
    public function read($key) {
        if (is_scalar($key)) {
            $key = ['id' => $key];
        }

        $query = $this->prepareSelect(
            strtolower($this->model_name),
            '*',
            $this->getBindersList($key, 'where_')
        );
        $binders = $this->getBinders($key, 'where_');

        $stm = $this->db->prepare($query);
        foreach ($binders as $key => $value) {
            $stm->bindValue($key, $value);
        }
        $result = $stm->execute();
        if ($result === false) {
// error
        }

       $model_class = '\\Joska\Model\\' . $this->model_name;
       $model = new $model_class();
       $row = $result->fetchArray(SQLITE3_ASSOC);
       if ($row === false) {
           return null;
       }
       foreach ($row as $key => $value) {
           $model->$key = $value;
       }

       return $model;
    }



    /**
     * Updates a model.
     * 
     * @param \Joska\Model\ModelInterface $model Model to update
     * @return $this This data mapper itself
     * @api
     */
    public function update(\Joska\Model\ModelInterface $model) {
        $params = $this->modelToFields($model);
        $key = $model->getId();


        $query = $this->prepareUpdate(
            strtolower($this->model_name),
            $this->getBindersList($params, 'set_'),
            $this->getBindersList($key, 'where_')
        );
        $binders = $this->getBinders($params, 'set_');
        $binders = array_merge($binders, $this->getBinders($key, 'where_'));

        $stm = $this->db->prepare($query);
        foreach ($binders as $key => $value) {
            $stm->bindValue($key, $value);
        }
        $result = $stm->execute();

        if ($result === false) {
// error
        }
        return $this;
    }



    /**
     * Deletes a model.
     * 
     * Deletes the model identified by given key from the data
     * persistence layer. Has no effect if no matches are found.
     * 
     * @param string|array $key Identifier of the object to delete
     * @return $this This data mapper itself
     * @api
     */
    public function delete($key) {
        if (is_scalar($key)) {
            $key = ['id' => $key];
        }

        $query = $this->prepareDelete(
            strtolower($this->model_name),
            $this->getBindersList($key, 'where_')
        );
        $binders = $this->getBinders($key, 'where_');

        $stm = $this->db->prepare($query);
        foreach ($binders as $key => $value) {
            $stm->bindValue($key, $value);
        }
        $result = $stm->execute();
        if ($result === false) {
// error
        }
        return $this;
    }
}
