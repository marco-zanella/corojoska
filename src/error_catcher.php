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
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    echo "Error $errno: $errstr in $errfile: $errline\n";
    die();
});

set_exception_handler(function ($esxception) {
    echo $exception->getMessage();
});
