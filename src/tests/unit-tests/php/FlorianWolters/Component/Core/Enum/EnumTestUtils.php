<?php
/**
 * `EnumTestUtils.php`
 *
 * This file is part of fwComponents.
 *
 * fwComponents is free software: you can redistribute it and/or modify it under
 * the terms of the GNU Lesser General Public License as published by the Free
 * Software Foundation, either version 3 of the License, or (at your option) any
 * later version.
 *
 * fwComponents is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with fwComponents.  If not, see http://gnu.org/licenses/lgpl.txt.
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

declare(encoding = 'UTF-8');

namespace FlorianWolters\Component\Core\Enum;

require_once 'res/UsageExampleEnum.php';

require_once 'res/GenderEnum.php';
require_once 'res/ExtendedGenderEnum.php';

require_once 'res/ColorEnum.php';
require_once 'res/ExtendedColorEnum.php';
require_once 'res/ExtendedExtendedColorEnum.php';

require_once 'res/SingletonEnum.php';
require_once 'res/PlanetEnum.php';

/**
 * The {@link EnumTestUtils} class is an utility class for the test classes of
 * the namespace `fw\Component\Core\Enum`.
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
final class EnumTestUtils
{

    /**
     * Returns the class name for the specified enumeration type.
     *
     * @param string $enumType The enumeration type.
     *
     * @return string The class name for the enumeration type.
     */
    public static function buildClassName($enumType)
    {
        return __NAMESPACE__ . '\\' . $enumType;
    }

    /**
     * Private default constructor.
     *
     * This guarantees that this "static" class is never instantiated.
     */
    private function __construct()
    {
    }

}
