<?php
namespace FlorianWolters\Component\Core\Enum;

/**
 * The abstract class {@link EnumAbstract} is the base class of all PHP language
 * type-safe enumerations.
 *
 * One feature of the C programming language lacking in PHP is enumerations.
 * Using an implementation based on integers is poor and open to abuse. This
 * class implements the *{@link
 * http://java.sun.com/developer/Books/shiftintojava/page1.html#replaceenums
 * Typesafe Enum}* pattern. The pattern has been adapted and abstracted for PHP.
 *
 * **Simple enumerations**
 *
 * To use this class, it must be subclassed. For example:
 *
 * /---code php
 * final class ColorEnum
 *     extends FlorianWolters\Component\Core\Enum\EnumAbstract
 * {
 *     /** @return ColorEnum {@*}
 *     final public static function RED() { return self::getConstant(); }
 *     /** @return ColorEnum {@*}
 *     final public static function GREEN() { return self::getConstant(); }
 *     /** @return ColorEnum {@*}
 *     final public static function BLUE() { return self::getConstant(); }
 * }
 * \---
 *
 * Each enumeration constant has a name and an ordinal. These can be accessed
 * using the {@link getName}, respectively the {@link getOrdinal} method.
 *
 * The {@link valueOf} and {@link values} methods can be used to access the
 * enumeration constants dynamically.
 *
 * **Subclassed enumerations**
 *
 * A hierarchy of enumeration classes can be built. In this case, the superclass
 * is unaffected by the addition of subclasses (as per normal PHP). The query
 * methods on the subclass will return all of the enumeration constants from the
 * superclass and the subclass.
 *
 * /---code php
 * // NOTE: The class ColorEnum declared above is final, change that to get this
 * // example to run.
 * final class ExtraColorEnum extends ColorEnum
 * {
 *     /** @return ExtraColorEnum {@*}
 *     final public static function YELLOW() { return self::getConstant(); }
 * }
 * \---
 *
 * **Functional enumerations**
 *
 * The enumeration classes can have functionality:
 *
 * /---code php
 * abstract class ArithmeticOperationEnum
 *     extends FlorianWolters\Component\Core\Enum\EnumAbstract
 * {
 *     /** @return ArithmeticOperationEnum {@*}
 *     final public static function PLUS() {
 *         return static::getConstant(
 *             'PlusOperationEnum', __FUNCTION__
 *         );
 *     }
 *     /** @return ArithmeticOperationEnum {@*}
 *     final public static function MINUS() {
 *         return static::getConstant(
 *             'MinusOperationEnum', __FUNCTION__
 *         );
 *     }
 *     /** @return integer|float {@*}
 *     abstract public function evaluate($first, $second);
 * }
 *
 * final class PlusOperationEnum extends ArithmeticOperationEnum
 * {
 *     /** @return integer|float {@*}
 *     public function evaluate($first, $second) {
 *         return $first + $second;
 *     }
 * }
 *
 * final class MinusOperationEnum extends ArithmeticOperationEnum
 * {
 *     /** @return integer|float {@*}
 *     public function evaluate($first, $second) {
 *         return $first - $second;
 *     }
 * }
 * \---
 *
 * Polymorphism is used to calculate the result of the artihmetic operation.
 *
 * /---code php
 * $operations = [
 *     ArithmeticOperationEnum::PLUS(), ArithmeticOperationEnum::MINUS()
 * ];
 *
 * foreach ($operations as $operation) {
 *     echo $operation->evaluate(1, 1), \PHP_EOL;
 * }
 * \---
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2012 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.1.0
 */
abstract class EnumAbstract
{
    /**
     * The created enumeration constants.
     *
     * This is a two dimensional array containing all enumeration constants by
     * the class name of the enumeration type and the name of the enumeration
     * constant.
     *
     * @var array
     */
    private static $constants = [];

    /**
     * The name of this enumeration constant.
     *
     * The name is the identifier which is used to declare the enumeration
     * constant.
     *
     * @var string
     * @see getName, __construct
     */
    private $name;

    /**
     * The ordinal of this enumeration constant.
     *
     * The ordinal is the position in the enumeration declaration, where the
     * initial constant is assigned an ordinal of zero.
     *
     * @var integer
     * @see getOrdinal, __construct
     */
    private $ordinal;

    /**
     * The class name of this enumeration constant.
     *
     * @var string
     * @see __construct
     */
    private $className;

    /**
     * The string representation of this enumeration constant.
     *
     * The string representation is set in the {@link __toString} method via the
     * *Lazy Initialization* implementation pattern.
     *
     * @var string
     * @see __toString
     */
    private $toString;

    /**
     * The hashcode representation of this enumeration constant.
     *
     * The hashcode is set in {@link __construct} and returned by the {@link
     * hashCode} method.
     *
     * @var integer
     * @see hashCode, __construct
     */
    private $hashCode;

    /**
     * Returns an array containing the names of the enumeration constants of
     * this enumeration type, in the order they are declared.
     *
     * This method may be used to iterate over the names of the enumerated
     * constants as follows:
     *
     * /---code php
     * foreach (ConcreteEnum::names() as $name) {
     *     echo $name, \PHP_EOL;
     * }
     * \---
     *
     * @return array An array containing the names of the constants of this
     *               enumeration type, in the order they are declared.
     */
    public static function names()
    {
        $enumType = \get_called_class();
        $parentEnumType = \get_parent_class($enumType);
        $parentMethods = [];

        if ((false !== $parentEnumType) && (__CLASS__ !== $parentEnumType)) {
            $parentMethods = $parentEnumType::names();
        }

        $reflectedClass = new \ReflectionClass($enumType);

        // The argument $filter of the method getMethods uses a logical OR.
        // Therefore we have to return all methods for each filter and calculate
        // the intersect.

        $finalMethods = $reflectedClass->getMethods(
            \ReflectionMethod::IS_FINAL
        );
        $staticMethods = $reflectedClass->getMethods(
            \ReflectionMethod::IS_STATIC
        );
        $publicMethods = $reflectedClass->getMethods(
            \ReflectionMethod::IS_PUBLIC
        );
        $reflectedMethods = \array_intersect(
            $finalMethods,
            $staticMethods,
            $publicMethods
        );

        $currentMethods = [];

        /* @var $method \ReflectionMethod */
        foreach ($reflectedMethods as $method) {
            if ($method->class === $enumType) {
                $currentMethods[] = $method->name;
            }
        }

        $mergedMethods = \array_merge($parentMethods, $currentMethods);
        $result = \array_unique($mergedMethods);

        return $result;
    }

    /**
     * Returns an array containing the enumeration constants of this enumeration
     * type, in the order they are declared.
     *
     * This method may be used to iterate over the enumeration constants as
     * follows:
     *
     * /---code php
     * foreach (ConcreteEnum::values() as $constant) {
     *     // Same as "echo $constant->__toString(), \PHP_EOL";
     *     echo $constant, \PHP_EOL;
     * }
     * \---
     *
     * @return array An array containing the enumeration constants of this
     *               enumeration type, in the order they are declared.
     */
    public static function values()
    {
        $names = self::names();
        $results = [];

        foreach ($names as $name) {
            $results[] = static::$name();
        }

        return $results;
    }

    /**
     * Returns the enumeration constant with the specified name from this
     * enumeration type.
     *
     * The string must match exactly an identifier used to declare an
     * enumeration constant in this enumeration type. (Extraneous whitespace
     * characters are not permitted.)
     *
     * @param string $name The name of the enumeration constant to return.
     *
     * @return EnumAbstract|null The enumeration constant with the specified
     *                           name on success; `null` on failure.
     */
    public static function valueOf($name)
    {
        $result = null;

        try {
            $enumConst = self::values();
            foreach ($enumConst as $const) {
                if ($const->name === $name) {
                    $result = $const;
                    break;
                }
            }
        } catch (\InvalidArgumentException $ex) {
            // Empty block.
        }

        return $result;
    }

    /**
     * Creates and returns an enumeration constant for the specified enumeration
     * type with the specified name.
     *
     * This method implements the *Lazy Load* implementation pattern.
     *
     * Use this method as follows in a subclass of this class:
     *
     * /---code php
     * final class ConcreteEnum
     *     extends FlorianWolters\Component\Core\Enum\EnumAbstract
     * {
     *     /** @return ConcreteEnum {@*}
     *     final public static function CONSTANT()
     *     {
     *         return self::getConstant();
     *     }
     * }
     * \---
     *
     * @param string $enumType The name of the enumeration type.
     * @param string $name     The name of the enumeration constant, which is
     *                         the identifier used to declare it.
     *
     * @return EnumAbstract The enumeration constant of the specified
     *                      enumeration type with the specified name.
     * @throws \InvalidArgumentException If the specified enumeration type has
     *                                   no enumeration constant with the
     *                                   specified name, or the specified class
     *                                   name does not represent an enumeration
     *                                   type.
     */
    final protected static function getConstant($enumType = null, $name = null)
    {
        if ((null === $enumType) || (null === $name)) {
            // TODO Is there a faster solution to retrieve the calling class and
            // calling method?
            // TODO This does not allow late-static binding.
            $backtrace = \debug_backtrace(\DEBUG_BACKTRACE_IGNORE_ARGS);
            $enumType = $backtrace[1]['class'];
            $name = $backtrace[1]['function'];
        } else {
            // TODO Check the plausability of the specified parameters? Or leave
            // it as it is as a "performance mode"?
            $enumType = (string) $enumType;
            $name = (string) $name;
            self::exists($enumType, $name);
        }

        if (false === isset(self::$constants[$enumType][$name])) {
            $ordinal = self::retrieveOrdinalFor($name);
            $newInstance = new $enumType($name, $ordinal);

            self::$constants[$enumType][$name] = $newInstance;
        }

        return self::$constants[$enumType][$name];
    }

    /**
     * Checks whether the enumeration constant with the specified name exists in
     * the specified enumeration type.
     *
     * @param string $enumType The name of the enumeration type.
     * @param string $name     The name of the enumeration constant, which is
     *                         the identifier used to declare it.
     *
     * @return void
     * @throws \InvalidArgumentException If the specified enumeration type has
     *                                   no enumeration constant with the
     *                                   specified name.
     */
    private static function exists($enumType, $name)
    {
        // TODO This is not 100% exact as the client can swap the name of two
        // enumeration constants without raising an exception. Should be fixed
        // in 1.0.0. Possible fix would be using the backtrace and comparing the
        // caller with the specified name.
        if (false === \method_exists($enumType, $name)) {
            throw new \InvalidArgumentException(
                'No enumeration constant ' . $enumType . '::' .  $name . '()'
            );
        }
    }

    /**
     * Returns the ordinal of the enumeration constant with the specified name
     * in this enumeration type.
     *
     * @param string $name The name of the enumeration constant, which is the
     *                     identifier used to declare it.
     *
     * @return integer The ordinal of the enumeration constant (its position in
     *                 the enumeration declaration, where the initial
     *                 enumeration constant is assigned an ordinal of zero).
     */
    private static function retrieveOrdinalFor($name)
    {
        $names = self::names();
        $result = null;

        foreach ($names as $key => $value) {
            if ($name === $value) {
                $result = $key;
                break;
            }
        }

        return $result;
    }

    /**
     * Constructs an enumeration constant.
     *
     * @param string  $name    The name of the enumeration constant, which is
     *                         the identifier used to declare it.
     * @param integer $ordinal The ordinal of the enumeration constant (its
     *                         position in the enumeration declaration, where
     *                         the initial enumeration constant is assigned an
     *                         ordinal of zero).
     */
    private function __construct($name, $ordinal)
    {
        $this->className = \get_called_class();
        $this->name = $name;
        $this->ordinal = (int) $ordinal;
        $this->hashCode = \spl_object_hash($this);
        // The _toString field cannot be set within the constructor since the
        // subclass can overwrite the __toString() method.
    }

    /**
     * Throws an {@link UnexpectedValueException}.
     *
     * `__callStatic()` is triggered when invoking inaccessible methods in a
     * static context.
     *
     * @param string $name The name of the enumeration constant, which is the
     *                     identifier used to declare it.
     * @param array  $args Not used.
     *
     * @return void
     *
     * @throws \UnexpectedValueException If this method is called.
     * @link http://php.net/language.oop5.overloading#object.callstatic
     * @ignore
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    final public static function __callStatic($name, array $args = [])
    {
        throw new \UnexpectedValueException(
            'The enumeration constant ' . $name
            . ' does not exist in the enumeration type ' . \get_called_class()
        );
    }

    // @codeCoverageIgnoreStart

    /**
     * Clone method which is private.
     *
     * This guarantees that enumeration constants are never cloned, which is
     * necessary to preserve their *Singleton* status.
     *
     * @return void
     */
    private function __clone()
    {
    }
    // @codeCoverageIgnoreEnd

    /**
     * Throws a {@link BadMethodCallException}.
     *
     * `__set()` is run when writing data to inaccessible properties.
     *
     * This method implements the *Immutable Object* pattern.
     *
     * @param string $name  The name of the property to set.
     * @param mixed  $value The value to assign to the specified property.
     *
     * @return void
     * @throws \BadMethodCallException If this method is called.
     * @link http://php.net/language.oop5.overloading#object.set
     * @ignore
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    final public function __set($name, $value)
    {
        throw new \BadMethodCallException(
            'An enumeration constant is immutable'
        );
    }

    /**
     * Returns the ordinal of this enumeration constant (its position in its
     * enumeration declaration, where the initial constant is assigned an
     * ordinal of zero).
     *
     * @return integer The ordinal of this enumeration constant.
     * @see getOrdinal
     * @see http://php.net/language.oop5.magic#language.oop5.magic.invoke
     */
    final public function __invoke()
    {
        return $this->ordinal;
    }

    /**
     * Returns the name of this enumeration constant, in the format
     * <tt><enumeration_type>[<enumeration_constant_name>]</tt>.
     *
     * This method may be overridden, though it typically isn't necessary or
     * desirable. An enumeration type should override this method when a more
     * "programmer-friendly" string form exists.
     *
     * @return string The name of this enumeration constant.
     * @see http://php.net/language.oop5.magic#language.oop5.magic.tostring
     */
    public function __toString()
    {
        if (null === $this->toString) {
            $this->toString = $this->name;
        }

        return $this->toString;
    }

    /**
     * Returns the name of this enumeration constant, exactly as declared in its
     * enumeration declaration.
     *
     * **Most programmers should use the {@link __toString} method in preference
     * to this one, as the {@link __toString} method may return a more
     * user-friendly name.**
     *
     * This method is designed primarily for use in specialized situations where
     * correctness depends on getting the exact name which will not vary from
     * release to release.
     *
     * @return string The name of this enumeration constant.
     */
    final public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the ordinal of this enumeration constant (its position in its
     * enumeration declaration, where the initial constant is assigned an
     * ordinal of zero).
     *
     * @return integer The ordinal of this enumeration constant.
     * @see __invoke
     */
    final public function getOrdinal()
    {
        return $this->ordinal;
    }

    /**
     * Compares this enumeration constant with the specified enumeration
     * constant for order.
     *
     * Enumeration constants are only comparable to other enumeration constants
     * of the same enumeration type. The natural order implemented by this
     * method is the order in which the enumeration constants are declared.
     *
     * @param EnumAbstract $other The other enumeration constant to compare this
     *                            enumeration constant to.
     *
     * @return integer A negative integer, zero, or a positive integer as this
     *                 enumeration constant is less than, equal to, or greater
     *                 than the specified enumeration constant.
     */
    public function compareTo(self $other)
    {
        return static::compare($this, $other);
    }

    /**
     * Compares an enumeration constant with another enumeration constant for
     * order.
     *
     * Enumeration constants are only comparable to other enumeration constants
     * of the same enumeration type. The natural order implemented by this
     * method is the order in which the enumeration constants are declared.
     *
     * @param EnumAbstract $first  The first enumeration constant to compare.
     * @param EnumAbstract $second The second enumeration constant to compare.
     *
     * @return integer A negative integer, zero, or a positive integer as the
     *                 first enumeration constant is less than, equal to, or
     *                 greater than the second enumeration constant.
     */
    final public static function compare(self $first, self $second)
    {
        return ($first->ordinal - $second->ordinal);
    }

    /**
     * Determines whether this enumeration constants is equal to the specified
     * enumeration constant.
     *
     * Two enumeration constants are considered equal if they have the same
     * class names, the same names and the same ordinals.
     *
     * **Most programmers should use the *identical comparison operator* (`===`)
     * in preference to this method, as the comparison operator is faster.**
     *
     * /---code php
     * ConcreteEnum::FIRST_CONSTANT() === ConcreteEnum::SECOND_CONSTANT()
     * \---
     *
     * @param EnumAbstract $other The enumeration constant to compare with this
     *                            enumeration constant.
     *
     * @return boolean `true` if this enumeration constant is equal to the
     *                 specified enumeration constant; `false` otherwise.
     * @deprecated Use the *identical comparison operator* (`===`) instead.
     */
    final public function equals(self $other)
    {
        return self::isEqual($this, $other);
    }

    /**
     * Determines whether the specified enumeration constants are equal.
     *
     * Two enumeration constants are considered equal if they have the same
     * class names, the same names and the same ordinals.
     *
     * **Most programmers should use the *identical comparison operator* (`===`)
     * in preference to this method, as the comparison operator is faster.**
     *
     * /---code php
     * ConcreteEnum::FIRST_CONSTANT() === ConcreteEnum::SECOND_CONSTANT()
     * \---
     *
     * @param EnumAbstract $first  The first enumeration constant to compare.
     * @param EnumAbstract $second The second enumeration constant to compare.
     *
     * @return boolean `true` if the enumeration constants are equal; `false`
     *                 otherwise.
     * @deprecated Use the *identical comparison operator* (`===`) instead.
     */
    final public static function isEqual(self $first, self $second)
    {
        return ($first->className === $second->className)
            && ($first->name === $second->name)
            && ($first->ordinal === $second->ordinal);
    }

    /**
     * Returns a hash code for this enumeration constant.
     *
     * @return string The hash code.
     */
    final public function hashCode()
    {
        return $this->hashCode;
    }
}
