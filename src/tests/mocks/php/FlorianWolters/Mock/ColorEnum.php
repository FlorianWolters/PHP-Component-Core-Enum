<?php
namespace FlorianWolters\Mock;

use FlorianWolters\Component\Core\Enum\EnumAbstract;

/**
 * The {@link ColorEnum} enumeration demonstrates the following usage of
 * **FlorianWolters\Component\Core\Enum**:
 *
 * * Simple enumeration *with* performance mode enabled.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.1.0
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
        return self::getInstance(__CLASS__, __FUNCTION__);
    }

    /**
     * The color green.
     *
     * @return ColorEnum The color red.
     */
    final public static function GREEN()
    {
        return self::getInstance(__CLASS__, __FUNCTION__);
    }

    /**
     * The color blue.
     *
     * @return ColorEnum The color red.
     */
    final public static function BLUE()
    {
        return self::getInstance(__CLASS__, __FUNCTION__);
    }

    // @codingStandardsIgnoreEnd
}
