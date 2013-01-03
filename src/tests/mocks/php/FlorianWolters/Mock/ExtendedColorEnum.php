<?php
namespace FlorianWolters\Mock;

/**
 * The {@link ExtendedColorEnum} enumeration demonstrates the following usage of
 * **FlorianWolters\Component\Core\Enum**:
 *
 * * Subclassed enumeration *with* performance mode enabled.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.2.0
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
        return self::getInstance();
    }

    /**
     * The color magenta.
     *
     * @return ExtendedColorEnum The color magenta.
     */
    final public static function MAGENTA()
    {
        return self::getInstance();
    }

    /**
     * The color yellow.
     *
     * @return ExtendedColorEnum The color yellow.
     */
    final public static function YELLOW()
    {
        return self::getInstance();
    }

    // @codingStandardsIgnoreEnd
}
