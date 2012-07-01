<?php
/**
 * `ExtendedColorEnum.php`
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
 * @category   Test
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

require_once 'ColorEnum.php';

/**
 * The {@link ExtendedColorEnum} enumeration demonstrates the following usage of
 * **fw\Component\Core\Enum**:
 *
 * * Subclassed enumeration *with* performance mode enabled.
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
class ExtendedColorEnum extends ColorEnum
{
    // @codingStandardsIgnoreStart

    /**
     * The color cyan.
     *
     * @return ExtendedColorEnum The color cyan.
     */
    final public static function CYAN()
    {
        return self::getConstant(__CLASS__, __FUNCTION__);
    }

    /**
     * The color magenta.
     *
     * @return ExtendedColorEnum The color magenta.
     */
    final public static function MAGENTA()
    {
        return self::getConstant(__CLASS__, __FUNCTION__);
    }

    /**
     * The color yellow.
     *
     * @return ExtendedColorEnum The color yellow.
     */
    final public static function YELLOW()
    {
        return self::getConstant(__CLASS__, __FUNCTION__);
    }

    // @codingStandardsIgnoreEnd
}
