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
 * Interface of a data mapper.
 * 
 * This interface follows the Data Mapper Design Pattern and exhibits
 * a CRUD and a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\DataMapper
 */
interface DataMapperInterface {
    /**
     * Creates a new model.
     * 
     * @param \Joska\Model\ModelInterface $model Model to create
     * @return $this This data mapper itself
     * @api
     */
    public function create(\Joska\Model\ModelInterface $model);


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
    public function read($key);


    /**
     * Updates a model.
     * 
     * @param \Joska\Model\ModelInterface $model Model to update
     * @return $this This data mapper itself
     * @api
     */
    public function update(\Joska\Model\ModelInterface $model);


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
    public function delete($key);


    /**
     * Searches models.
     * 
     * Returns an array of models satisfying given criteria, or an empty
     * array if no matches are found.
     * 
     * @param MatchCriteria\MatchCriteriaInterface|null $criteria Criteria to match
     * @param array $order Ordering information
     * @param int|null $limit Maximum number of results to return
     * @param int|null $offset Records to skip (only if $limit is specified)
     * @return array Array of models
     */
    public function search(
        MatchCriteria\MatchCriteriaInterface $criteria = null,
        $order = [],
        $limit = null,
        $offset = null
    );
}
