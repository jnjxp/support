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
* @package   Traits
* @author    Jake Johns <jake@jakejohns.net>
* @copyright 2015 Jake Johns
* @license   http://www.gnu.org/licenses/agpl-3.0.txt AGPL V3
* @link      http://jakejohns.net
 */


namespace Jnjxp\Support\Traits;

trait HelpersTrait
{

    /**
     * A map of helper factories.
     *
     * @var array
     * @access protected
     */
    protected $helperMap = array();

    /**
     * The helper object instances.
     *
     * @var array
     * @access protected
     */
    protected $helpers = array();

    /**
    * __construct
    *
    * helper name and the value is a callable that returns a helper object.
    *
    * @param array $map An array of key-value pairs where the key is the
    *
    * @return mixed
    *
    * @access public
    */
    public function __construct(array $map = array())
    {
        $this->setHelperMap($map);
    }

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
    public function setHelperMap(array $map)
    {
        $this->helpers = [];
        $this->helperMap = $map;
        return $this;
    }

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
    public function __call($name, $args)
    {
        $instance = $this->getHelper($name);

        switch (count($args)) {
        case 0:
            return $instance();
            break;
        case 1:
            return $instance($args[0]);
            break;
        case 2:
            return $instance($args[0], $args[1]);
            break;
        case 3:
            return $instance($args[0], $args[1], $args[2]);
            break;
        case 4:
            return $instance($args[0], $args[1], $args[2], $args[3]);
            break;
        default:
            return call_user_func_array($instance, $args);
            break;
        }
    }

    /**
     * Sets a helper object factory into the map.
     *
     * @param string   $name     The helper name.
     * @param callable $callable A callable to create the helper object.
     *
     * @return null
     *
     */
    public function setHelperFactory($name, $callable)
    {
        $this->helperMap[$name] = $callable;
        unset($this->helpers[$name]);
        return $this;
    }

    /**
     * Does a named helper exist in the locator?
     *
     * @param string $name The helper name.
     *
     * @return bool
     *
     */
    public function hasHelper($name)
    {
        return isset($this->helperMap[$name]);
    }

    /**
     * Returns a helper object instance, using the map to factory it if needed.
     *
     * @param string $name The helper to retrieve.
     *
     * @throws Exceptions\HelperNotFound If helper not found
     *
     * @return object
     *
     */
    public function getHelper($name)
    {
        if (! $this->hasHelper($name)) {
            throw new Exceptions\HelperNotFound($name);
        }

        if (! isset($this->helpers[$name])) {
            $factory = $this->helperMap[$name];
            $this->helpers[$name] = $factory();
        }

        return $this->helpers[$name];
    }
}

