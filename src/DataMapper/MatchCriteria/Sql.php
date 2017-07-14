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
namespace Joska\DataMapper\MatchCriteria;

/**
 * A raw SQL criteria.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\DataMapper
 */
class Sql implements MatchCriteriaInterface {
    /**
     * @var string $query Raw query string
     * @var arrya $binders Associative array of binders
     */
    protected $query, $binders;


    /**
     * Constructor.
     * 
     * @param string $query Query string
     * @param array $binders Associative array of binders
     */
    public function __construct($query, $binders = []) {
        $this->query = $query;
        $this->binders = $binders;
    }



    /**
     * Returns this criteria as an SQL prepared statement string.
     * 
     * @return string SQL prepared statement string
     */
    public function asPreparedSql() {
        return $this->query;
    }



    /**
     * Returns list of binders.
     * 
     * @return array Associative array of binders
     */
    public function getBinders() {
        return $this->binders;
    }
}
