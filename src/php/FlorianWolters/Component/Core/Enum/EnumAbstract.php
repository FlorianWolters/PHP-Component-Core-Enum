<?php
namespace FlorianWolters\Component\Core\Enum;

use \InvalidArgumentException;
use \ReflectionClass;
use \ReflectionException;
use \ReflectionMethod;
use \RuntimeException;
use \UnexpectedValueException;

use FlorianWolters\Component\Core\ClassCastException;
use FlorianWolters\Component\Core\ComparableInterface;
use FlorianWolters\Component\Core\DebugPrintInterface;
use FlorianWolters\Component\Core\EqualityInterface;
use FlorianWolters\Component\Core\EqualityTrait;
use FlorianWolters\Component\Core\HashCodeInterface;
use FlorianWolters\Component\Core\HashCodeTrait;
use FlorianWolters\Component\Core\ImmutableInterface;
use FlorianWolters\Component\Core\ImmutableTrait;
use FlorianWolters\Component\Util\ReflectionUtils;
use FlorianWolters\Component\Util\Singleton\MultitonTrait;

/**
 * The abstract class {@see EnumAbstract} is the superclass for type-safe
 * enumerations (enums) in {@link http://php.net PHP}.
 *
 * One feature of the C programming language lacking in PHP are enumerations.
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
 * final class ColorEnum extends FlorianWolters\Component\Core\Enum\EnumAbstract
 * {
 *     /** @return ColorEnum {@*}
 *     final public static function RED() { return self::getInstance(); }
 *
 *     /** @return ColorEnum {@*}
 *     final public static function GREEN() { return self::getInstance(); }
 *
 *     /** @return ColorEnum {@*}
 *     final public static function BLUE() { return self::getInstance(); }
 * }
 * \---
 *
 * Each enumeration constant has a name and an ordinal. These can be accessed
 * using the {@see getName}, respectively the {@see getOrdinal} method.
 *
 * The {@see valueOf} and {@see values} methods can be used to access the
 * enumeration constants dynamically.
 *
 * **Subclassed enumerations**
 *
 * A hierarchy of enumeration classes can be built. In this case, the superclass
 * is unaffected by the addition of subclasses (as per normal PHP). The
 * subclasses may add additional enumeration constants *of the type of the
 * superclass*. The query methods on the subclass will return all of the
 * enumeration constants from the superclass and the subclass.
 *
 * /---code php
 * // NOTE: The class ColorEnum declared above is final, change that to get this
 * // example to run.
 * final class ExtraColorEnum extends ColorEnum
 * {
 *     /** @return ColorEnum {@*}
 *     final public static function YELLOW() { return self::getInstance(); }
 * }
 * \---
 *
 * This example will return RED, GREEN, BLUE, YELLOW from the {@see values}
 * method in that order. The RED, GREEN and BLUE instances will be the identical
 * (`===`) as those from the superclass `ColorEnum`. Note that YELLOW is an
 * instance of `ColorEnum` and not an instance of `ExtraColorEnum`.
 *
 * **Functional enumerations**
 *
 * The enumeration classes can have functionality by defining subclasses and
 * implementing the `initInstance` method:
 *
 * /---code php
 * final class PlanetEnum extends
 *     FlorianWolters\Component\Core\Enum\EnumAbstract
 * {
 *     /**
 *      * The universal gravitational constant.
 *      *
 *      * @var float
 *     {@*}
 *     const G = 6.67300E-11;
 *
 *     /**
 *      * The mass of this planet in kilograms.
 *      *
 *      * @var float
 *     {@*}
 *     private $mass;
 *
 *     /**
 *      * The radius of this planet in meters.
 *      *
 *      * @var float
 *     {@*}
 *     private $radius;
 *
 *     /**
 *      * The planet mercury.
 *      *
 *      * @return PlanetEnum The planet mercury.
 *     {@*}
 *     final public static function MERCURY()
 *     {
 *         return self::getInstance(3.303e23, 2.4397e6);
 *     }
 *
 *     /**
 *      * The planet venus.
 *      *
 *      * @return PlanetEnum The planet venus.
 *     {@*}
 *     final public static function VENUS()
 *     {
 *         return self::getInstance(4.869e24, 6.0518e6);
 *     }
 *
 *     /**
 *      * The planet earth.
 *      *
 *      * @return PlanetEnum The planet earth.
 *     {@*}
 *     final public static function EARTH()
 *     {
 *         return self::getInstance(5.976e24, 6.37814e6);
 *     }
 *
 *     /**
 *      * The planet mars.
 *      *
 *      * @return PlanetEnum The planet mars.
 *     {@*}
 *     final public static function MARS()
 *     {
 *         return self::getInstance(6.4191e23, 3.3972e6);
 *     }
 *
 *     /**
 *      * The planet jupiter.
 *      *
 *      * @return PlanetEnum The planet jupiter.
 *     {@*}
 *     final public static function JUPITER()
 *     {
 *         return self::getInstance(1.8987e27, 7.1492e7);
 *     }
 *
 *     /**
 *      * The planet saturn.
 *      *
 *      * @return PlanetEnum The planet saturn.
 *     {@*}
 *     final public static function SATURN()
 *     {
 *         return self::getInstance(5.6851e26, 6.0268e7);
 *     }
 *
 *     /**
 *      * The planet uranus.
 *      *
 *      * @return PlanetEnum The planet uranus.
 *     {@*}
 *     final public static function URANUS()
 *     {
 *         return self::getInstance(8.6849e25, 2.5559e7);
 *     }
 *
 *     /**
 *      * The planet neptune.
 *      *
 *      * @return PlanetEnum The planet neptune.
 *     {@*}
 *     final public static function NEPTUNE()
 *     {
 *         return self::getInstance(1.0244e26, 2.4764e7);
 *     }
 *
 *     /**
 *      * Constructs a new planet with the specified mass and the specified
 *      * radius.
 *      *
 *      * The name of the constructor of a functional enumeration is `construct`
 *      * by convention and must have the visibility `protected` or `private`.
 *      *
 *      * @param float $mass   The mass in kilograms.
 *      * @param float $radius The radius in meters.
 *     {@*}
 *     protected function construct($mass, $radius)
 *     {
 *         $this->mass = $mass;
 *         $this->radius = $radius;
 *     }
 *
 *     /**
 *      * Calculates and returns the surface gravity of this planet.
 *      *
 *      * @return float The surface gravity.
 *     {@*}
 *     public function surfaceGravity()
 *     {
 *         return ((self::G  * $this->mass) / ($this->radius ^ 2));
 *     }
 *
 *     /**
 *      * Calculates and returns the surface weight of this planet.
 *      *
 *      * @param float $otherMass Another mass in kilograms.
 *      *
 *      * @return float The surface weight.
 *     {@*}
 *     public function surfaceWeight($otherMass)
 *     {
 *         return ($this->surfaceGravity() * $otherMass);
 *     }
 * \---
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.1.0
 */
abstract class EnumAbstract implements
     ComparableInterface,
     DebugPrintInterface,
     EqualityInterface,
     HashCodeInterface,
     ImmutableInterface
{
    // @codingStandardsIgnoreStart
    use EqualityTrait, HashCodeTrait, ImmutableTrait, MultitonTrait {
        MultitonTrait::getInstance as private getMultitonInstance;
        ImmutableTrait::__clone insteadof MultitonTrait;
        __wakeup as public;
    }
    // @codingStandardsIgnoreEnd

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
     * The string representation of this enumeration constant.
     *
     * The string representation is set in the {@see __toString} method via the
     * *Lazy Initialization* implementation pattern.
     *
     * @var string
     * @see __toString
     */
    private $toString;

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
     * @return string[] An array containing the names of the constants of this
     *                  enumeration type, in the order they are declared.
     */
    final public static function names()
    {
        $result = [];
        $classes = self::hierarchy(\get_called_class());

        /* @var $class ReflectionClass */
        foreach ($classes as $class) {
            $result = \array_merge(self::namesFor($class->name), $result);
        }

        return $result;
    }

    /**
     * @param string $enumType
     *
     * @return ReflectionClass[]
     */
    private static function hierarchy($enumType)
    {
        $child = new ReflectionClass($enumType);
        $result = ReflectionUtils::parentClassesForClass($enumType);
        // Delete this abstract base class from the array of parent classes.
        \array_pop($result);
        \array_unshift($result, $child);

        return $result;
    }

    /**
     * Returns an array containing the names of the enumeration constants of
     * the specified enumeration type.
     *
     * The returned array does **not** contain enumeration constant names from
     * the subclasses of the specified enumeration type.
     *
     * @param string $enumType The enumeration type
     *
     * @return string[] An array containing the names of the constants of this
     *                  enumeration type, in the order they are declared.
     */
    private static function namesFor($enumType)
    {
        $result = [];

        $methods = ReflectionUtils::methodsForClassWithoutInheritedMethods(
            $enumType,
            [
                ReflectionMethod::IS_FINAL,
                ReflectionMethod::IS_STATIC,
                ReflectionMethod::IS_PUBLIC
            ]
        );

        /* @var $method ReflectionMethod */
        foreach ($methods as $method) {
            if ($method->name === \strtoupper($method->name)) {
                $result[] = $method->name;
            }
        }

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
     * @return EnumAbstract[] An array containing the enumeration constants of
     *                        this enumeration type, in the order they are
     *                        declared.
     */
    final public static function values()
    {
        $names = self::names();
        $result = [];

        foreach ($names as $name) {
            $result[] = static::$name();
        }

        return $result;
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
    final public static function valueOf($name)
    {
        $result = null;

        try {
            /* @var $constant EnumAbstract */
            foreach (self::values() as $constant) {
                if ($constant->name === $name) {
                    $result = $constant;
                    break;
                }
            }
        } catch (InvalidArgumentException $ex) {
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
     *         return self::getInstance();
     *     }
     * }
     * \---
     *
     * @return EnumAbstract The enumeration constant of the specified
     *                      enumeration type with the specified name.
     * @throws InvalidArgumentException If the specified enumeration type has no
     *                                  enumeration constant with the specified
     *                                  name, or the specified class name does
     *                                  not represent an enumeration type.
     */
    final protected static function getInstance()
    {
        $backtrace = \debug_backtrace(\DEBUG_BACKTRACE_IGNORE_ARGS);
        $className = self::retrieveNameOfSuperclassFor(
            $backtrace[1]['class']
        );
        $constantName = $backtrace[1]['function'];
        $constantOrdinal = self::retrieveOrdinalFor($constantName);
        $constructorArguments = \func_get_args();

        return $className::getMultitonInstance(
            $constantName,
            $constantOrdinal,
            $constructorArguments
        );
    }

    /**
     * Returns the superclass name for the specified classname.
     *
     * @param string $className The name of the class, which superclass name to
     *                          return.
     *
     * @return string The name of the superclass.
     */
    private static function retrieveNameOfSuperclassFor($className)
    {
        $parents = self::hierarchy($className);

        return (true === empty($parents))
            ? $className
            : $parents[count($parents) - 1]->name;
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
        $result = null;

        foreach (self::names() as $key => $value) {
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
     * @param string  $name      The name of the enumeration constant, which is
     *                           the identifier used to declare it.
     * @param integer $ordinal   The ordinal of the enumeration constant (its
     *                           position in the enumeration declaration, where
     *                           the initial enumeration constant is assigned an
     *                           ordinal of zero).
     */
    final private function __construct($name, $ordinal, array $arguments)
    {
        $this->name = $name;
        $this->ordinal = $ordinal;
        // The _toString field cannot be set within the constructor since the
        // subclass can overwrite the __toString() method.

        $this->invokeConstructorIfDeclared($arguments);
    }

    /**
     * Invokes the constructor of this enumeration constant with the specified
     * arguments.
     *
     * @param mixed[] $arguments The constructor arguments.
     *
     * @return void
     */
    private function invokeConstructorIfDeclared(array $arguments)
    {
        $methodName = 'construct';

        try {
            $method = new ReflectionMethod($this, $methodName);

            if (true === $method->isPublic()) {
                throw new RuntimeException(
                    'The constructor of an enumeration type may not be public.'
                );
            }

            $method->setAccessible(true);
            $method->invokeArgs($this, $arguments);
        } catch (ReflectionException $ex) {
            // empty block.
        }
    }

    /**
     * Throws an {@see UnexpectedValueException}.
     *
     * `__callStatic()` is triggered when invoking inaccessible methods in a
     * static context.
     *
     * @param string  $name The name of the enumeration constant, which is the
     *                      identifier used to declare it.
     * @param mixed[] $args Not used.
     *
     * @return void
     *
     * @throws UnexpectedValueException If this method is called.
     * @link http://php.net/language.oop5.overloading#object.callstatic
     * @ignore
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    final public static function __callStatic($name, array $args = [])
    {
        throw new UnexpectedValueException(
            'The enumeration constant ' . $name
            . ' does not exist in the enumeration type.'
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
     * Returns the name of this enumeration constant, exactly as declared in its
     * enumeration declaration.
     *
     * **Most programmers should use the {@see __toString} method in preference
     * to this one, as the {@see __toString} method may return a more
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
     * @param ComparableInterface $other The other enumeration constant to
     *                                   compare this enumeration constant to.
     *
     * @return integer A negative integer, zero, or a positive integer as this
     *                 enumeration constant is less than, equal to, or greater
     *                 than the specified enumeration constant.
     * @throws ClassCastException If `$other` is not an enumeration type.
     * @throws ClassCastException If `$other` is not an enumeration constant of
     *                            the same enumeration type.
     */
    final public function compareTo(ComparableInterface $other)
    {
        if (false === ($other instanceof self)) {
            throw new ClassCastException(
                'The specified object\'s type is not an instance of '
                . __CLASS__ . '.'
            );
        }

        if (false === ($this instanceof $other)) {
            throw new ClassCastException(
                'The specified object\'s type is not an instance of '
                . \get_class($this) . '.'
            );
        }

        return ($this->ordinal - $other->ordinal);
    }

    /**
     * Returns the name of this enumeration constant, in the format
     * `<enumeration_type>[<enumeration_constant_name>]`.
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
}
