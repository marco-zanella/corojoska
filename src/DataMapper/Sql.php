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
 * An SQL-based data mapper.
 * 
 * Internally uses PDO.
 * 
 * This class follows the Data Mapper Design Pattern and exhibits
 * a CRUD and a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\DataMapper
 * @todo This class has not been tested
 */
class Sql implements DataMapperInterface {
    use SqlTrait;

    /**
     * @var string $model_name Name of the mapped model
     * @var \PDO $dbh Connection to the SQL database
     */
    protected $model_name, $dbh;



    /**
     * Constructor.
     * 
     * @param string $model_name Name of the mapped model
     * @param string $db_name Name of the database
     * @param string $db_host Host of the database
     * @param string $db_user Database user
     * @param string $db_pass Password of the database user
     */
    public function __construct(
        $model_name,
        $db_name,
        $db_host = 'localhost',
        $db_user = null,
        $db_pass = null
    ) {
        $this->model_name = $model_name;
        $dsn = 'mysql:dbname=' . $db_name . ';host=' . $db_host;
        $this->dbh = new \PDO($dsn, $db_user, $db_pass);
        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }



    /**
     * Creates a new model.
     * 
     * @param \Joska\Model\ModelInterface $model Model to create
     * @return $this This data mapper itself
     * @throws \Exception If query fails
     * @api
     */
    public function create(\Joska\Model\ModelInterface $model) {
        // Reads parameters
        $params = $this->modelToFields($model);
        $query = $this->prepareInsert($this->model_name, $params);
        $binders = $this->getBinders($params);

        // Prepares statement
        $stm = $this->dbh->prepare($query);

        // Executes
        $result = $stm->execute($binders);
        $this->checkResult($result);
        $model->id = $this->dbh->lastInsertId();

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
     * @throws \Exception If query fails
     * @api
     */
    public function read($key) {
        // Reads parameters
        if (is_scalar($key)) {
            $key = ['id' => $key];
        }

        $query = $this->prepareSelect(
            strtolower($this->model_name),
            '*',
            $this->getBindersList($key, 'where_')
        );
        $binders = $this->getBinders($key, 'where_');

        // Prepares statement
        $stm = $this->dbh->prepare($query);

        // Executes
        $result = $stm->execute($binders);
        $this->checkResult($result, $query);

        // Creates model
        $model_class = '\\Joska\Model\\' . $this->model_name;
        $model = $stm->fetchObject($model_class);
        return ($model !== false) ? $model : null;
    }



    /**
     * Updates a model.
     * 
     * @param \Joska\Model\ModelInterface $model Model to update
     * @return $this This data mapper itself
     * @throws \Exception If query fails
     * @api
     */
    public function update(\Joska\Model\ModelInterface $model) {
        // Reads parameters
        $params = $this->modelToFields($model);
        $key = $model->getId();

        $query = $this->prepareUpdate(
            strtolower($this->model_name),
            $this->getBindersList($params, 'set_'),
            $this->getBindersList($key, 'where_')
        );
        $binders = $this->getBinders($params, 'set_');
        $binders = array_merge($binders, $this->getBinders($key, 'where_'));

        // Prepares statement
        $stm = $this->dbh->prepare($query);

        // Executes
        $result = $stm->execute($binders);
        $this->checkResult($result);

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
     * @throws \Exception If query fails
     * @api
     */
    public function delete($key) {
        // Reads parameters
        if (is_scalar($key)) {
            $key = ['id' => $key];
        }

        $query = $this->prepareDelete(
            strtolower($this->model_name),
            $this->getBindersList($key, 'where_')
        );
        $binders = $this->getBinders($key, 'where_');

        // Prepares statement
        $stm = $this->dbh->prepare($query);

        // Executes
        $result = $stm->execute($binders);
        $this->checkResult($result);

        return $this;
    }



    /**
     * Checks result of an SQLite3 prepare, query or excec.
     * 
     * Throws an exception in case of error.
     * 
     * @param mixed $result Result of the operation
     * @param string $query Query
     * @return bool True if there were no errors
     * @throws \Exception If there were errors
     */
    protected function checkResult($result, $query = '') {
        if ($result !== false) {
            return true;
        }

        $message = 'Error';
        if (!empty($query)) {
            $message .= ' while executing query "' . $query . '"';
        }
        throw new \Exception($message);
    }
}
