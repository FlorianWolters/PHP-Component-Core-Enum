<?php
namespace FlorianWolters\Mock;

/**
 * The enumeration class {@see ExtendedExtendedColorEnum} demonstrates the
 * following usage of **FlorianWolters\Component\Core\Enum**:
 *
 * * Subclassed (two-times) enumeration.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.2.0
 */
final class ExtendedExtendedColorEnum extends ExtendedColorEnum
{
    // @codingStandardsIgnoreStart

    /**
     * The color black.
     *
     * @return ColorEnum The color black.
     */
    final public static function BLACK()
    {
        return self::getInstance();
    }

    /**
     * The color white.
     *
     * @return ColorEnum The color white.
     */
    final public static function WHITE()
    {
        return self::getInstance();
    }

    // @codingStandardsIgnoreEnd
}
