<?php
namespace FlorianWolters\Mock;

use FlorianWolters\Component\Core\Enum\EnumAbstract;

/**
 * The {@link GenderEnum} enumeration demonstrates the following usage of
 * **FlorianWolters\Component\Core\Enum**:
 *
 * * Simple enumeration *with* magic mode enabled.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.1.0
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
        return self::getInstance();
    }

    /**
     * The male gender.
     *
     * @return GenderEnum The male gender.
     */
    final public static function MALE()
    {
        return self::getInstance();
    }

    // @codingStandardsIgnoreEnd
}
