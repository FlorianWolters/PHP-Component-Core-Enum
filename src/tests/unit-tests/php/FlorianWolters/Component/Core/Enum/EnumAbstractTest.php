<?php
namespace FlorianWolters\Component\Core\Enum;

use \ReflectionClass;
use \ReflectionMethod;

use FlorianWolters\Mock\ColorEnum;
use FlorianWolters\Mock\ExtendedColorEnum;
use FlorianWolters\Mock\ExtendedExtendedColorEnum;
use FlorianWolters\Mock\PlanetEnum;
use FlorianWolters\Mock\SingletonEnum;

/**
 * Test class for {@see EnumAbstract}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.1.0
 *
 * @covers    FlorianWolters\Component\Core\Enum\EnumAbstract
 */
class EnumAbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EnumAbstract
     */
    private $simpleConstant;

    // TODO
    public function setUp()
    {
        $this->simpleConstant = ColorEnum::RED();
    }

    /**
     * @return void
     *
     * @group specification
     * @testdox The definition of the class EnumAbstract is correct.
     * @test
     */
    public function testClassDefinition()
    {
        $reflectedClass = new ReflectionClass(__NAMESPACE__ . '\EnumAbstract');
        $this->assertTrue($reflectedClass->inNamespace());
        $this->assertTrue($reflectedClass->isAbstract());
        $this->assertFalse($reflectedClass->isFinal());
        $this->assertFalse($reflectedClass->isInstantiable());
        $this->assertFalse($reflectedClass->isInterface());
        $this->assertFalse($reflectedClass->isInternal());
        $this->assertFalse($reflectedClass->isIterateable());
        $this->assertTrue($reflectedClass->isUserDefined());
    }

    /**
     * @return void
     *
     * @group specification
     * @testdox The definition of the constructor EnumAbstract::__construct is correct.
     * @test
     */
    public function testConstructorDefinition()
    {
        $reflectedConstructor = new ReflectionMethod(
            __NAMESPACE__ . '\EnumAbstract',
            '__construct'
        );
        $this->assertFalse($reflectedConstructor->isAbstract());
        $this->assertTrue($reflectedConstructor->isConstructor());
        $this->assertTrue($reflectedConstructor->isFinal());
        $this->assertTrue($reflectedConstructor->isPrivate());
    }

    /**
     * @return void
     *
     * @coversClass getInstance
     * @expectedException FlorianWolters\Component\Core\ImmutableException
     * @test
     */
    public function testConstantIsImmutable()
    {
        $this->simpleConstant->newProperty = null;
    }

    /**
     * @return void
     *
     * @coversClass getInstance
     * @test
     */
    public function testConstantIsInstanceOfEnumAbstract()
    {
        $expected = __NAMESPACE__ . '\EnumAbstract';
        $actual = $this->simpleConstant;

        $this->assertInstanceOf($expected, $actual);
    }

    /**
     * @return mixed[][]
     */
    public static function providerConstantIsInstanceOfSuperclass()
    {
        return [
            [
                ColorEnum::RED(),
                EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum'
            ], [
                ExtendedColorEnum::RED(),
                EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum'
            ], [
                ExtendedExtendedColorEnum::RED(),
                EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum'
            ], [
                SingletonEnum::INSTANCE(),
                EnumTestUtils::MOCK_NAMESPACE . '\SingletonEnum'
            ], [
                PlanetEnum::MERCURY(),
                EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum'
            ]
        ];
    }

    /**
     * @param EnumAbstract $constant
     * @param string       $expected
     *
     * @return void
     *
     * @coversClass getInstance
     * @dataProvider providerConstantIsInstanceOfSuperclass
     * @test
     */
    public function testConstantIsInstanceOfSuperclass(
        EnumAbstract $constant,
        $expected
    ) {
        $this->assertInstanceOf($expected, $constant);
    }

    /**
     * @return mixed[][]
     */
    public static function providerConstantIsNotInstanceOfSubclass()
    {
        return [
            [
                ExtendedColorEnum::RED(),
                EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum'
            ], [
                ExtendedColorEnum::RED(),
                EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum'
            ], [
                ExtendedExtendedColorEnum::RED(),
                EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum'
            ], [
                ExtendedExtendedColorEnum::RED(),
                EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum'
            ]
        ];
    }

    /**
     * @param EnumAbstract $constant
     * @param string       $expected
     *
     * @return void
     *
     * @coversClass getInstance
     * @dataProvider providerConstantIsNotInstanceOfSubclass
     * @test
     */
    public function testConstantIsNotInstanceOfSubclass(
        EnumAbstract $constant,
        $expected
    ) {
        $this->assertNotInstanceOf($expected, $constant);
    }

    /**
     * @return void
     *
     * @coversClass __callStatic
     * @expectedException \UnexpectedValueException
     * @test
     */
    public function testThrowsUnexpectedValueExceptionIfConstantIsNotDefined()
    {
        ColorEnum::UNKNOWN();
    }

    /**
     * @param string   $className
     * @param string[] $expected
     *
     * @return void
     *
     * @coversClass names
     * @dataProvider FlorianWolters\Component\Core\Enum\EnumTestUtils::providerNames
     * @test
     */
    public function testNames($className, array $expected)
    {
        $actual = $className::names();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @param string         $className
     * @param EnumAbstract[] $expected
     *
     * @return void
     *
     * @coversClass values
     * @dataProvider FlorianWolters\Component\Core\Enum\EnumTestUtils::providerValuesReturnsCorrectResults
     * @test
     */
    public function testValuesReturnsCorrectResults($className, array $expected)
    {
        $actual = $className::values();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @param string         $className
     * @param EnumAbstract[] $expected
     *
     * @return void
     *
     * @coversClass values
     * @dataProvider FlorianWolters\Component\Core\Enum\EnumTestUtils::providerValuesReturnsCorrectInstances
     * @test
     */
    public function testValuesReturnsCorrectInstances($className, $expected)
    {
        $actual = $className::values();

        foreach ($actual as $instance) {
            $this->assertInstanceOf($expected, $instance);
        }
    }

    /**
     * @param string       $expected
     * @param EnumAbstract $constant
     *
     * @return void
     *
     * @coversClass getName
     * @dataProvider FlorianWolters\Component\Core\Enum\EnumTestUtils::providerGetName
     * @test
     */
    public function testGetName($expected, EnumAbstract $constant)
    {
        $actual = $constant->getName();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @param string       $name
     * @param string       $className
     * @param EnumAbstract $expected
     *
     * @return void
     *
     * @coversClass valueOf
     * @dataProvider FlorianWolters\Component\Core\Enum\EnumTestUtils::providerValueOf
     * @test
     */
    public function testValueOf($name, $className, EnumAbstract $expected)
    {
        $actual = $className::valueOf($name);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversClass valueOf
     * @test
     */
    public function testValueOfReturnsNullIfNameDoesNotExist()
    {
        $this->assertNull(ColorEnum::valueOf('UNKNOWN'));
    }

    /**
     * @return mixed[][]
     */
    public static function providerGetOrdinalAndMagicInvokeMethod()
    {
        return [
            [0, ColorEnum::RED()],
            [1, ColorEnum::GREEN()],
            [2, ColorEnum::BLUE()],
            [0, ExtendedColorEnum::RED()],
            [1, ExtendedColorEnum::GREEN()],
            [2, ExtendedColorEnum::BLUE()],
            [3, ExtendedColorEnum::CYAN()],
            [4, ExtendedColorEnum::MAGENTA()],
            [5, ExtendedColorEnum::YELLOW()],
            [0, ExtendedExtendedColorEnum::RED()],
            [1, ExtendedExtendedColorEnum::GREEN()],
            [2, ExtendedExtendedColorEnum::BLUE()],
            [3, ExtendedExtendedColorEnum::CYAN()],
            [4, ExtendedExtendedColorEnum::MAGENTA()],
            [5, ExtendedExtendedColorEnum::YELLOW()],
            [6, ExtendedExtendedColorEnum::BLACK()],
            [7, ExtendedExtendedColorEnum::WHITE()],
            [0, SingletonEnum::INSTANCE()],
            [0, PlanetEnum::MERCURY()],
            [1, PlanetEnum::VENUS()],
            [2, PlanetEnum::EARTH()]
        ];
    }

    /**
     * @param integer      $expected
     * @param EnumAbstract $constant
     *
     * @return void
     *
     * @coversClass getOrdinal
     * @dataProvider providerGetOrdinalAndMagicInvokeMethod
     * @test
     */
    public function testGetOrdinal($expected, EnumAbstract $constant)
    {
        $actual = $constant->getOrdinal();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @param integer      $expected
     * @param EnumAbstract $constant
     *
     * @return void
     *
     * @coversClass __invoke
     * @dataProvider providerGetOrdinalAndMagicInvokeMethod
     * @test
     */
    public function testMagicInvokeMethod($expected, EnumAbstract $constant)
    {
        // Explicit method call.
        $this->assertEquals($expected, $constant->__invoke());
        // Implicit ("magic") method call.
        $this->assertEquals($expected, $constant());
    }

    /**
     * @param string       $expected
     * @param EnumAbstract $constant
     *
     * @return void
     *
     * @coversClass __toString
     * @dataProvider FlorianWolters\Component\Core\Enum\EnumTestUtils::providerGetName
     * @test
     */
    public function testMagicToStringMethod($expected, EnumAbstract $constant)
    {
        // Explicit method call.
        $this->assertEquals($expected, $constant->__toString());
        // Implicit ("magic") method call.
        $this->assertEquals($expected, $constant);
    }

    /**
     * @return mixed[][]
     */
    public static function providerCompareTo()
    {
        return [
            // Simple enumeration type.
            [0, ColorEnum::RED(), ColorEnum::RED()],
            [-1, ColorEnum::RED(), ColorEnum::GREEN()],
            [-2, ColorEnum::RED(), ColorEnum::BLUE()],
            [0, ColorEnum::GREEN(), ColorEnum::GREEN()],
            [1, ColorEnum::GREEN(), ColorEnum::RED()],
            [-1, ColorEnum::GREEN(), ColorEnum::BLUE()],
            [0, ColorEnum::BLUE(), ColorEnum::BLUE()],
            [2, ColorEnum::BLUE(), ColorEnum::RED()],
            [1, ColorEnum::BLUE(), ColorEnum::GREEN()],
            // Subclassed enumeration type.
            [0, ExtendedColorEnum::CYAN(), ExtendedColorEnum::CYAN()],
            [3, ExtendedColorEnum::CYAN(), ColorEnum::RED()],
            [2, ExtendedColorEnum::CYAN(), ColorEnum::GREEN()],
            [1, ExtendedColorEnum::CYAN(), ColorEnum::BLUE()],
            [0, ColorEnum::RED(), ExtendedColorEnum::RED()],
            [0, ColorEnum::RED(), ExtendedExtendedColorEnum::RED()],
            [0, ExtendedColorEnum::RED(), ColorEnum::RED()],
            [0, ExtendedColorEnum::RED(), ExtendedExtendedColorEnum::RED()],
            [0, ExtendedExtendedColorEnum::RED(), ColorEnum::RED()],
            [0, ExtendedExtendedColorEnum::RED(), ExtendedColorEnum::RED()],
            [-1, ExtendedColorEnum::CYAN(), ExtendedColorEnum::MAGENTA()],
            [-2, ExtendedColorEnum::CYAN(), ExtendedColorEnum::YELLOW()],
            // Singleton enumeration type.
            [0, SingletonEnum::INSTANCE(), SingletonEnum::INSTANCE()]
        ];
    }

    /**
     * @param boolean      $expected
     * @param EnumAbstract $first
     * @param EnumAbstract $second
     *
     * @return void
     *
     * @coversClass compareTo
     * @dataProvider providerCompareTo
     * @test
     */
    public function testCompareTo(
        $expected,
        EnumAbstract $first,
        EnumAbstract $second
    ) {
        $actual = $first->compareTo($second);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[][]
     */
    public static function providerCompareToThrowsException()
    {
        return [
            [ColorEnum::RED(), SingletonEnum::INSTANCE()],
            [SingletonEnum::INSTANCE(), ColorEnum::RED()]
        ];
    }

    /**
     * @param EnumAbstract $first
     * @param EnumAbstract $second
     *
     * @return void
     *
     * @coversClass compareTo
     * @dataProvider providerCompareToThrowsException
     * @expectedException FlorianWolters\Component\Core\ClassCastException
     * @test
     */
    public function testCompareToThrowsException(
        EnumAbstract $first,
        EnumAbstract $second
    ) {
        $first->compareTo($second);
    }

    /**
     * @return mixed[][]
     */
    public static function providerComparisonOperators()
    {
        return [
            // Simple enumeration type.
            [true, ColorEnum::RED(), ColorEnum::RED()],
            [true, ColorEnum::GREEN(), ColorEnum::GREEN()], [
                false, ColorEnum::RED(), ColorEnum::GREEN()
            ], [
                false, ColorEnum::GREEN(), ColorEnum::RED()
            // Subclassed enumeration types.
            ], [
                true, ExtendedColorEnum::CYAN(), ExtendedColorEnum::CYAN()
            ], [
                true, ColorEnum::RED(), ExtendedColorEnum::RED()
            ], [
                true, ExtendedColorEnum::GREEN(), ColorEnum::GREEN()
            ], [
                false, ColorEnum::RED(), ExtendedColorEnum::CYAN()
            ], [
                false, ColorEnum::GREEN(), ExtendedColorEnum::CYAN()
            ], [
                false,
                ExtendedColorEnum::CYAN(),
                ExtendedColorEnum::RED()
            ], [
                false, ExtendedColorEnum::CYAN(), ExtendedColorEnum::GREEN()
            ]
        ];
    }

    /**
     * Tests the equality (`==`) of enumeration constants.
     *
     * @param boolean      $expected
     * @param EnumAbstract $first
     * @param EnumAbstract $second
     *
     * @return void
     *
     * @dataProvider providerComparisonOperators
     * @test
     */
    public function testEqualityOperator(
        $expected,
        EnumAbstract $first,
        EnumAbstract $second
    ) {
        $actual = ($first == $second);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests the identity (`===`) of enumeration constants.
     *
     * @param boolean      $expected
     * @param EnumAbstract $first
     * @param EnumAbstract $second
     *
     * @return void
     *
     * @dataProvider providerComparisonOperators
     * @test
     */
    public function testIdentityOperator(
        $expected,
        EnumAbstract $first,
        EnumAbstract $second
    ) {
        $actual = ($first === $second);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @param boolean      $expected
     * @param EnumAbstract $first
     * @param EnumAbstract $second
     *
     * @coversClass equals
     * @dataProvider providerComparisonOperators
     * @test
     */
    public function testEquals(
        $expected,
        EnumAbstract $first,
        EnumAbstract $second
    ) {
        $actual = $first->equals($second);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return EnumAbstract[][]
     */
    public static function providerHashCodeAndSerialization()
    {
        return [
            [ColorEnum::RED()],
            [ColorEnum::GREEN()],
            [ExtendedColorEnum::CYAN()]
        ];
    }

    /**
     * @param EnumAbstract $constant
     *
     * @return void
     *
     * @coversClass hashCode
     * @dataProvider providerHashCodeAndSerialization
     * @test
     */
    public function testHashCode(EnumAbstract $constant)
    {
        // The expected return value must:
        // - be of data type string
        // - have a length of 32 characters
        // - only consist of lowercase alphabetical (a-z) or digest (0-9)
        //   characters
        $pattern = '/^([0-9a-z]){32}$/';

        $this->assertRegExp($pattern, $constant->hashCode());
    }

    /**
     * @param EnumAbstract $constant
     *
     * @return void
     *
     * @dataProvider providerHashCodeAndSerialization
     * @test
     */
    public function testSerialization(EnumAbstract $constant)
    {
        $serialized = \serialize($constant);
        $unserialized = \unserialize($serialized);

        $this->assertEquals($unserialized, $constant);
    }

    /**
     * @return void
     *
     * @test
     */
    public function testSingletonEnum()
    {
        $firstInstance = SingletonEnum::INSTANCE();
        $secondInstance = SingletonEnum::INSTANCE();

        $this->assertEquals($firstInstance, $secondInstance);
    }

    /**
     * @return void
     *
     * @test
     */
    public function testSimpleFunctionalEnum()
    {
        $constant = SingletonEnum::INSTANCE();
        $actual = $constant->__toString();

        $this->assertEquals('FlorianWolters\Mock\SingletonEnum', $actual);
    }

    /**
     * @return void
     *
     * @test
     */
    public function testComplexFunctionalEnum()
    {
        $earth = PlanetEnum::EARTH();
        $gravity = $earth->surfaceGravity();
        $weigth = $earth->surfaceWeight(1000.0);

        $this->assertEquals(62522671.963089, $gravity, null, .0000001);
        $this->assertEquals(62522671963.089, $weigth, null, .001);
    }
}
