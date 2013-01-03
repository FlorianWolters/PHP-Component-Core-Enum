<?php
/**
 * `ColorEnum.php`
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
 * @since      File available since Release 0.1.0
 */

namespace FlorianWolters\Component\Core\Enum;

/**
 * The {@link ColorEnum} enumeration demonstrates the following usage of
 * **fw\Component\Core\Enum**:
 *
 * * Simple enumeration *with* performance mode enabled.
 *
 * @category   Test
 * @package    Core
 * @subpackage Enum
 * @author     Florian Wolters <wolters.fl@gmail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @version    Release: @package_version@
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      Class available since Release 0.1.0
 */
class ColorEnum extends EnumAbstract
{
    // @codingStandardsIgnoreStart

    /**
     * The color red.
     *
     * @return ColorEnum The color red.
     */
    final public static function RED()
    {
        return self::getConstant(__CLASS__, __FUNCTION__);
    }

    /**
     * The color green.
     *
     * @return ColorEnum The color red.
     */
    final public static function GREEN()
    {
        return self::getConstant(__CLASS__, __FUNCTION__);
    }

    /**
     * The color blue.
     *
     * @return ColorEnum The color red.
     */
    final public static function BLUE()
    {
        return self::getConstant(__CLASS__, __FUNCTION__);
    }

    // @codingStandardsIgnoreEnd
}
