<?php
namespace FlorianWolters\Mock;

use FlorianWolters\Component\Core\Enum\EnumAbstract;

/**
 * The enumeration class {@see DayEnum} demonstrates the following usage of
 * **FlorianWolters\Component\Core\Enum**:
 *
 * * Simple enumeration.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.4.0
 */
final class DayEnum extends EnumAbstract
{
    // @codingStandardsIgnoreStart

    /**
     * The day *sunday*.
     *
     * @return DayEnum The day *sunday*.
     */
    final public static function SUNDAY()
    {
        return self::getInstance();
    }

    /**
     * The day *monday*.
     *
     * @return DayEnum The day *monday*.
     */
    final public static function MONDAY()
    {
        return self::getInstance();
    }

    /**
     * The day *tuesday*.
     *
     * @return DayEnum The day *tuesday*.
     */
    final public static function TUESDAY()
    {
        return self::getInstance();
    }

    /**
     * The day *wednesday*.
     *
     * @return DayEnum The day *wednesday*.
     */
    final public static function WEDNESDAY()
    {
        return self::getInstance();
    }

    /**
     * The day *thursday*.
     *
     * @return DayEnum The day *thursday*.
     */
    final public static function THURSDAY()
    {
        return self::getInstance();
    }

    /**
     * The day *friday*.
     *
     * @return DayEnum The day *friday*.
     */
    final public static function FRIDAY()
    {
        return self::getInstance();
    }

    /**
     * The day *saturday*.
     *
     * @return DayEnum The day *saturday*.
     */
    final public static function SATURDAY()
    {
        return self::getInstance();
    }

    // @codingStandardsIgnoreEnd
}
