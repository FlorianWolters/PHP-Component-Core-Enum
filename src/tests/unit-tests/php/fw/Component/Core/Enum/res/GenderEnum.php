<?php
/**
 * `GenderEnum.php`
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
 * @author     Florian Wolters <florian.wolters.85@googlemail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt GNU Lesser General Public License
 * @version    GIT: $Id$
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      File available since Release 0.1.0
 */

declare(encoding = 'UTF-8');

namespace fw\Component\Core\Enum;

/**
 * The {@link GenderEnum} enumeration demonstrates the following usage of
 * **fw\Component\Core\Enum**:
 *
 * * Simple enumeration *with* magic mode enabled.
 *
 * @category   Test
 * @package    Core
 * @subpackage Enum
 * @author     Florian Wolters <florian.wolters.85@googlemail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt GNU Lesser General Public License
 * @version    Release: @package_version@
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      Class available since Release 0.1.0
 */
class GenderEnum extends EnumAbstract
{
    // @codingStandardsIgnoreStart

    /**
     * The female gender.
     *
     * @return GenderEnum The female gender.
     */
    final public static function FEMALE()
    {
        return self::getConstant();
    }

    /**
     * The male gender.
     *
     * @return GenderEnum The male gender.
     */
    final public static function MALE()
    {
        return self::getConstant();
    }

    // @codingStandardsIgnoreEnd
}
