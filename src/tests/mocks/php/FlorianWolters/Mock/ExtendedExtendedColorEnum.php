<?php
/**
 * `ExtendedExtendedColorEnum.php`
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

namespace FlorianWolters\Component\Core\Enum;

require_once 'ExtendedColorEnum.php';

/**
 * The {@link ExtendedExtendedColorEnum} enumeration demonstrates the following usage
 * of **fw\Component\Core\Enum**:
 *
 * * Subclassed (two-times) enumeration *with* performance mode enabled.
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
final class ExtendedExtendedColorEnum extends ExtendedColorEnum
{
    // @codingStandardsIgnoreStart

    /**
     * The color black.
     *
     * @return ExtendedExtendedColorEnum The color black.
     */
    final public static function BLACK()
    {
        return self::getConstant(__CLASS__, __FUNCTION__);
    }

    /**
     * The color white.
     *
     * @return ExtendedExtendedColorEnum The color black.
     */
    final public static function WHITE()
    {
        return self::getConstant(__CLASS__, __FUNCTION__);
    }

    // @codingStandardsIgnoreEnd
}
