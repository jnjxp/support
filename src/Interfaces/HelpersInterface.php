<?php
/**
* Jnjxp\Support
*
* PHP version 5
*
* This program is free software: you can redistribute it and/or modify it
* under the terms of the GNU Affero General Public License as published by
* the Free Software Foundation, either version 3 of the License, or (at your
* option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU Affero General Public License for more details.
*
* You should have received a copy of the GNU Affero General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* @category  Support
* @package   Interfaces
* @author    Jake Johns <jake@jakejohns.net>
* @copyright 2015 Jake Johns
* @license   http://www.gnu.org/licenses/agpl-3.0.txt AGPL V3
* @link      http://jakejohns.net
 */


namespace Jnjxp\Support\Interfaces;

/**
 * HelpersInterface
 *
 * @category Support
 * @package  Interfaces
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/agpl-3.0.txt AGPL V3
 * @version  Release: @package_version@
 * @link     http://jakejohns.net
 *
 */
interface HelpersInterface
{


    /**
    * setHelperMap
    * helper name and the value is a callable that returns a helper object.
    *
    * @param array $map An array of key-value pairs where the key is the
    *
    * @return mixed
    *
    * @access public
    */
    public function setHelperMap(array $map);

    /**
     * Magic call to make the helper objects available as methods.
     *
     * @param string $name A helper name.
     *
     * @param array  $args Arguments to pass to the helper.
     *
     * @return mixed
     *
     */
    public function __call($name, $args);

    /**
     * Sets a helper object factory into the map.
     *
     * @param string   $name     The helper name.
     * @param callable $callable A callable to create the helper object.
     *
     * @return null
     *
     */
    public function setHelperFactory($name, $callable);

    /**
     * Does a named helper exist in the locator?
     *
     * @param string $name The helper name.
     *
     * @return bool
     *
     */
    public function hasHelper($name);

    /**
     * Returns a helper object instance, using the map to factory it if needed.
     *
     * @param string $name The helper to retrieve.
     *
     * @return object
     *
     */
    public function getHelper($name);
}

