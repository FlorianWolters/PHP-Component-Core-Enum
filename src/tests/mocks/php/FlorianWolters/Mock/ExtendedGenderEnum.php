<?php
namespace FlorianWolters\Mock;

/**
 * The {@link ExtendedGenderEnum} enumeration demonstrates the following usage
 * of **FlorianWolters\Component\Core\Enum**:
 *
 * * Subclassed enumeration *with* magic mode enabled.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.2.0
 */
final class ExtendedGenderEnum extends GenderEnum
{
    // @codingStandardsIgnoreStart

    /**
     * The hybrid gender.
     *
     * @return ExtendedGenderEnum The hybrid gender.
     */
    final public static function HYBRID()
    {
        return self::getInstance();
    }

    // @codingStandardsIgnoreEnd
}
