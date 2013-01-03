<?php
/**
 * `UsageExampleEnum.php`
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
 * The {@link SingletonEnum} enumeration demonstrates the following usage of
 * **fw\Component\Core\Enum**:
 *
 * * Simple valid and invalid usage.
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
final class UsageExampleEnum extends EnumAbstract
{
    // @codingStandardsIgnoreStart

    /**
     * Invalid usage of the first and second parameter of {@link
     * EnumAbstract::getConstant}.
     *
     * @return UsageExampleEnum The enumeration constant.
     */
    final public static function INVALID()
    {
        return self::getConstant('INVALID', 'INVALID');
    }

    /**
     * Invalid usage of the first parameter of {@link EnumAbstract::getConstant}.
     *
     * @return UsageExampleEnum The enumeration constant.
     */
    final public static function INVALID_TYPE()
    {
        return self::getConstant('WRONG', __FUNCTION__);
    }

    /**
     * Invalid usage of the second parameter of {@link EnumAbstract::getConstant}.
     *
     * @return UsageExampleEnum The enumeration constant.
     */
    final public static function INVALID_NAME()
    {
        return self::getConstant(__CLASS__, 'WRONG');
    }

    /**
     * Correct usage of {@link EnumAbstract::getConstant}.
     *
     * @return UsageExampleEnum The enumeration constant.
     */
    final public static function CORRECT_USAGE()
    {
        return self::getConstant();
    }

    /**
     * Correct usage of {@link EnumAbstract::getConstant}.
     *
     * @return UsageExampleEnum The enumeration constant.
     */
    final public static function CORRECT_USAGE_2()
    {
        return self::getConstant(__CLASS__, __FUNCTION__);
    }

    // @codingStandardsIgnoreEnd
}
