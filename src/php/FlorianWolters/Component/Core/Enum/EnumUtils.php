<?php
namespace FlorianWolters\Component\Core\Enum;

use \InvalidArgumentException;

/**
 * The static class {@see EnumUtils} is an utility class for accessing and
 * manipulating enumerations.
 *
 * @author     Florian Wolters <wolters.fl@gmail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      Class available since Release 0.1.0
 */
class EnumUtils
{
    // @codeCoverageIgnoreStart

    /**
     * {@see EnumUtils} instances can **NOT** be constructed in standard
     * programming.
     *
     * Instead, the class should be used as:
     * /---code php
     * EnumUtils::values('Vendor\Package\ConcreteEnum');
     * \---
     */
    private function __construct()
    {
    }

    // @codeCoverageIgnoreEnd

    /**
     * Returns the names of the enumeration constants of the specified
     * enumeration type.
     *
     * The elements of the return value array are sorted in the order they are
     * declared.
     *
     * This method may be used to iterate over the names of the enumerated
     * constants as follows:
     *
     * /---code php
     * foreach (EnumUtils::names('Vendor\Package\ConcreteEnum') as $name) {
     *     echo $name, \PHP_EOL;
     * }
     * \---
     *
     * @param string $enumType The class name of the enumeration type from which
     *                         to return the names of the enumeration constants.
     *
     * @return string[] An array containing the names of the enumeration
     *                  constants of the specified enumeration type, in the
     *                  order they are declared.
     * @throws InvalidArgumentException If the specified class name does not
     *                                  represent an enumeration type.
     */
    public static function names($enumType = null)
    {
        self::throwInvalidArgumentExceptionIfIsNotEnumType($enumType);

        return $enumType::names();
    }

    /**
     * Returns an array containing the enumeration constants of the specified
     * enumeration type, in the order they are declared.
     *
     * The elements of the return value array are sorted by the values of the
     * enumerated constants. If there are enumerated constants with same values,
     * the order of their corresponding names is unspecified.
     *
     * This method may be used to iterate over the enumerated constants as
     * follows:
     *
     * /---code php
     * foreach (EnumUtils::values('Vendor\Package\ConcreteEnum') as $constant) {
     *     echo $constant . \PHP_EOL;
     * }
     * \---
     *
     * @param string $enumType The class name of the enumeration type from which
     *                         to return the enumeration constants.
     *
     * @return EnumAbstract[] An array containing the enumeration constants of
     *                        the specified enumeration type, in the order they
     *                        are declared.
     * @throws InvalidArgumentException If the specified class name does not
     *                                  represent an enumeration type.
     */
    public static function values($enumType)
    {
        self::throwInvalidArgumentExceptionIfIsNotEnumType($enumType);

        return $enumType::values();
    }

    /**
     * Throws an {@see InvalidArgumentException} if the specified class name
     * does not represent an enumeration type.
     *
     * @param string $className The class name of the class to check.
     *
     * @return void
     * @throws InvalidArgumentException If the specified class name does not
     *                                  represent an enumeration type.
     */
    private static function throwInvalidArgumentExceptionIfIsNotEnumType(
        $className
    ) {
        if (false === self::isEnumType($className)) {
            throw new InvalidArgumentException(
                'The class ' . $className
                . ' does not represent an enumeration type'
            );
        }
    }

    /**
     * Checks whether the specified class name represents an enumeration type.
     *
     * @param string $className The class name of the class to check.
     *
     * @return boolean `true` if the specified class name represents an
     *                 enumeration type; `false` otherwise.
     */
    public static function isEnumType($className)
    {
        return \is_subclass_of($className, __NAMESPACE__ . '\EnumAbstract');
    }

    /**
     * Returns the enumeration constant of the specified enumeration type with
     * the specified name.
     *
     * The name must match exactly an identifier used to declare an enumeration
     * constant in this type. (Extraneous whitespace characters are not
     * permitted.)
     *
     * @param string $enumType The class name of the enumeration type from which
     *                         to return an enumeration constant.
     * @param string $name     The name of the enumeration constant to return.
     *
     * @return EnumAbstract|null The enumeration constant of the specified
     *                           enumeration type with the specified name on
     *                           success; `null` on failure.
     *
     * @throws InvalidArgumentException If the specified enumeration type has
     *                                  no enumeration constant with the
     *                                  specified name, or the specified class
     *                                  name does not represent an enumeration
     *                                  type.
     */
    public static function valueOf($enumType, $name)
    {
        self::throwInvalidArgumentExceptionIfIsNotEnumType($enumType);

        return $enumType::valueOf($name);
    }

    /**
     * Returns the name of the enumeration constant of the specified enumeration
     * type with the specified ordinal.
     *
     * @param string  $enumType The class name of the enumeration type from
     *                          which to return the ordinal of the enumeration
     *                          constant.
     * @param integer $ordinal  The ordinal of the enumeration constant to
     *                          return.
     *
     * @return string|null The name of the enumeration constant of the specified
     *                     enumeration type with the specified ordinal on
     *                     success; `null` on failure.
     */
    public static function getNameForOrdinal($enumType, $ordinal)
    {
        $constants = $enumType::values();
        $result = null;

        foreach ($constants as $constant) {
            if ($constant->getOrdinal() === $ordinal) {
                $result = $constant->getName();
                break;
            }
        }

        return $result;
    }

    /**
     * Returns the ordinal of the enumeration constant of the specified
     * enumeration type with the specified name.
     *
     * @param string $enumType The class name of the enumeration type from which
     *                          to return the name of the enumeration constant.
     * @param string $name     The name of the enumeration constant to return.
     *
     * @return integer|null The ordinal of the enumeration constant of the
     *                      specified enumeration type with the specified
     *                      ordinal on success; `null` on failure.
     */
    public static function getOrdinalForName($enumType, $name)
    {
        $constants = $enumType::values();
        $result = null;

        foreach ($constants as $constant) {
            if ($constant->getName() === $name) {
                $result = $constant->getOrdinal();
                break;
            }
        }

        return $result;
    }

    /**
     * Checks whether an enumeration constant with the specified name exists in
     * the specified enumeration type.
     *
     * @param string $enumType The class name of the enumeration type to check.
     * @param string $name     The name of the enumeration constant to check.
     *
     * @return boolean `true` if the enumeration constant with the specified
     *                 name exists in the specified enumeration type; `false`
     *                 otherwise.
     */
    public static function isDefinedName($enumType, $name)
    {
        $names = $enumType::names();
        $result = false;

        foreach ($names as $item) {
            if ($item === $name) {
                $result = true;
                break;
            }
        }

        return $result;
    }

    /**
     * Checks whether an enumeration constant with the specified ordinal exists
     * in the specified enumeration type.
     *
     * @param string  $enumType The class name of the enumeration type to check.
     * @param integer $ordinal  The ordinal of the enumeration constant to
     *                          check.
     *
     * @return boolean `true` if the enumeration constant with the specified
     *                 ordinal exists in the specified enumeration type; `false`
     *                 otherwise.
     */
    public static function isDefinedOrdinal($enumType, $ordinal)
    {
        $constants = $enumType::values();
        $result = false;

        foreach ($constants as $constant) {
            if ($constant->getOrdinal() === $ordinal) {
                $result = true;
                break;
            }
        }

        return $result;
    }
}
