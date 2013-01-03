<?php
namespace FlorianWolters\Mock;

use FlorianWolters\Component\Core\Enum\EnumAbstract;

/**
 * The {@link SingletonEnum} enumeration demonstrates the following usage of
 * **FlorianWolters\Component\Core\Enum**:
 *
 * * Singleton enumeration.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.2.0
 */
final class SingletonEnum extends EnumAbstract
{
    // @codingStandardsIgnoreStart

    /**
     * The *Singleton* instance of this class.
     *
     * @return SingletonEnum The *Singleton* instance.
     */
    final public static function INSTANCE()
    {
        return self::getInstance();
    }

    /**
     * Returns the string representation of this instance.
     *
     * This method implements the *Debug Print Method* implementation pattern.
     *
     * @return string The string representation.
     */
    public function __toString()
    {
        return __CLASS__;
    }

    // @codingStandardsIgnoreEnd
}
