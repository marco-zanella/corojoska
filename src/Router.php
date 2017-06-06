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
 * Router.
 * 
 * This class exhibits a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska
 */
class Router {
    /**
     * Declares a route.
     *
     * Patterns may use paramters or optional parameters, in the form of:
     * /path/{parameter}/{optional_parameter?}/other_path.
     * 
     * @param string $pattern Pattern to match
     * @param string $controller_name Fully qualified name of controller to use
     * @return $this This router itself
     * @api
     * @note This method expects global arrays such as $_SERVER to be set
     */
    public function declareRoute($pattern, $controller_name) {
        $binders = $this->routeMatch($pattern, $_SERVER['REQUEST_URI']);

echo "Testing..." . $pattern . "<br>";
        // Returns if route does not match
        if ($binders === false) {
            return $this;
        }

echo "match";
        $controller = new $controller_name();
        $method = $this->getMethod();

        $controller->$method($binders);

        return $this;
    }



    /**
     * Checks whether given URI matches a pattern.
     * 
     * Returns an associative array of parameters and values, or false
     * if the URI does not match.
     * 
     * @param string $pattern Pattern to check
     * @param string $requested_uri URi to check
     * @return array|bool Array of buond parameters or false
     */
    protected function routeMatch($pattern, $requested_uri) {
        // Converts a piece of pattern into a piece of regular expression
        $string_to_regexp = function ($string) {
            if (preg_match('/\{([^\?}]*)(\?)?\}/', $string, $matches)) {
                $label = $matches[1];
                $optional = isset($matches[2]) ? '?' : '';
                return [$label => '(\/([^\/]*))' . $optional];
            }
            return [$string => '\/' . $string];
        };

        // Converts the pattern into a regular expression
        $pieces = explode('/', $pattern);
        $pieces = array_filter($pieces, 'strlen');
        $pieces = array_map($string_to_regexp, $pieces);
        $pieces = array_reduce($pieces, 'array_merge', []);
        $regexp = '/' . implode('', array_values($pieces)) . '$/';

        // Returns false if the URI does not match
        if (preg_match($regexp, $requested_uri, $matches) === 0) {
            return false;
        }

        // Matches and reads parameters
        $binders = [];
        $i = 0;
        foreach ($pieces as $label => $regexp) {
            if (strpos($regexp, '(\/([^\/]*))') !== 0) {
                continue;
            }

            $offset = 2 + 2 * $i;
            $binders[$label] = isset($matches[$offset]) ? $matches[$offset] : null;
            ++$i;
        }

        return $binders;
    }



    /**
     * Returns name of request method.
     * 
     * Returns 'get' if method could not be detected.
     * 
     * @return string Name of request method.
     */
    protected function getMethod() {
        if (!isset($_SERVER['REQUEST_METHOD'])) {
            return 'get';
        }
        elseif (isset($_POST['_method'])) {
            return strtolower($_POST['_method']);
        }
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
