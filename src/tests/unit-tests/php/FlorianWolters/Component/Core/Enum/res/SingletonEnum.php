<?php
/**
 * `SingletonEnum.php`
 *
 * This file is part of fwComponents.
 *
 * fwComponents is free software: you can redistribute it and/or modify it under the
 * terms of the GNU Lesser General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 *
 * fwComponents is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE.  See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with fwComponents.  If not, see http://gnu.org/licenses/lgpl.txt.
 *
 * PHP version 5.4
 *
 * @category   Component
 * @package    Core
 * @subpackage Enum
 * @author     Florian Wolters <wolters.fl@gmail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @version    GIT: $Id$
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      File available since Release 0.2.0
 */

declare(encoding = 'UTF-8');

namespace FlorianWolters\Component\Core\Enum;

declare(encoding = 'UTF-8');

namespace FlorianWolters\Component\Core\Enum;

/**
 * The {@link SingletonEnum} enumeration demonstrates the following usage of
 * **fw\Component\Core\Enum**:
 *
 * * Singleton enumeration.
 *
 * @category   Test
 * @package    Core
 * @subpackage Enum
 * @author     Florian Wolters <wolters.fl@gmail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @version    Release: @package_version@
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      Class available since Release 0.2.0
 */
final class SingletonEnum extends EnumAbstract
{
    // @codingStandardsIgnoreStart

    /**
     * The *Singleton* instance of this class.
     *
     * @return SingletonEnum The *Singleton* instance.
     */
    final public static function INSTANCE()
    {
        return self::getConstant();
    }

    /**
     * Returns the string representation of this instance.
     *
     * This method implements the *Debug Print Method* implementation pattern.
     *
     * @return string The string representation.
     */
    public function __toString()
    {
        return __CLASS__;
    }

    // @codingStandardsIgnoreEnd
}
