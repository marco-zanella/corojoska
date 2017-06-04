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
 * Assets manager.
 * 
 * Manages loading and storing of additional files and assets.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska
 */
class Asset {
    /**
     * Returns URL of an asset of a certain type.
     * 
     * Type of the asset is given by the method name, for instance
     * Asset::image returns a path within the public/image subfolder.
     * 
     * @param string $name Name of the asset type
     * @param array $arguments Array containing at least the name of the asset
     * @return string Absolute path of the asset
     */
    public static function __callStatic($name, $arguments) {
        if (empty($arguments)) {
            return '';
        }

        return self::url($name . '/' . $arguments[0]);
    }



    /**
     * Returns URL of an asset.
     * 
     * @param string $path Path of the file in the public folder
     * @return string Absolute path to the asset
     */
    public static function url($path) {
        return __DIR__ . '/../public/' . $path;
    }
}
