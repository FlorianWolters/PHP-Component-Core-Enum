<?php
namespace FlorianWolters\Component\Core\Enum;

use \ReflectionClass;
use \ReflectionMethod;

use FlorianWolters\Mock\ColorEnum;
use FlorianWolters\Mock\ExtendedColorEnum;
use FlorianWolters\Mock\ExtendedExtendedColorEnum;
use FlorianWolters\Mock\ExtendedGenderEnum;
use FlorianWolters\Mock\GenderEnum;
use FlorianWolters\Mock\PlanetEnum;
use FlorianWolters\Mock\SingletonEnum;

/**
 * Test class for {@link EnumAbstract}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.1.0
 *
 * @covers FlorianWolters\Component\Core\Enum\EnumAbstract
 * @todo       Analyze and remove redundant test cases.
 * @todo       Merge data providers with the data providers of class {@link
 *             EnumUtilsTest} and place them in a static class called
 *             `EnumTestDataProvider`.
 * @todo       Separate integration tests from unit test by creating separate
 *             files for unit tests (using mock objects) and integration tests.
 * @todo       Add @testdoc annotation to each test case.
 */
class EnumAbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private static $mockNamespace = 'FlorianWolters\Mock';

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
        $this->assertFalse($reflectedConstructor->isFinal());
        $this->assertTrue($reflectedConstructor->isPrivate());
    }

    /**
     * @return void
     *
     * @expectedException \BadMethodCallException
     * @test
     */
    public function testIsImmutableObject()
    {
        $constant = ColorEnum::RED();
        $constant->newAttribute = null;
    }

    /**
     * @return void
     * @deprecated Redundant test case.
     *
     * @coversClass getConstant
     * @test
     */
    public function testGetConstantReturnsInstanceOfEnumAbstract()
    {
        $this->assertInstanceOf(
            __NAMESPACE__ . '\EnumAbstract',
            ColorEnum::RED()
        );
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
     * @return array
     */
    public static function providerNames()
    {
        $expectedGender = ['FEMALE', 'MALE'];
        $expectedExtGender = \array_merge($expectedGender, ['HYBRID']);
        $expectedColor = ['RED', 'GREEN', 'BLUE'];
        $expectedExtColor = \array_merge(
            $expectedColor,
            array('CYAN', 'MAGENTA', 'YELLOW')
        );
        $expectedExtExtColor = \array_merge(
            $expectedExtColor,
            array('BLACK', 'WHITE')
        );
        $expectedSingleton = array('INSTANCE');
        $expectedPlanet = array('MERCURY', 'VENUS', 'EARTH');

        return [
            [self::$mockNamespace . '\GenderEnum', $expectedGender],
            [self::$mockNamespace . '\ExtendedGenderEnum', $expectedExtGender],
            [self::$mockNamespace . '\ColorEnum', $expectedColor],
            [self::$mockNamespace . '\ExtendedColorEnum', $expectedExtColor],
            [self::$mockNamespace . '\ExtendedExtendedColorEnum', $expectedExtExtColor],
            [self::$mockNamespace . '\SingletonEnum', $expectedSingleton],
            [self::$mockNamespace . '\PlanetEnum', $expectedPlanet]
        ];
    }

    /**
     * @return void
     *
     * @coversClass names
     * @dataProvider providerNames
     * @test
     */
    public function testNames($className, array $expected)
    {
        $actual = $className::names();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public static function providerValues()
    {
        $expectedGender = array(GenderEnum::FEMALE(), GenderEnum::MALE());
        $expectedExtGender = \array_merge(
            $expectedGender,
            array(ExtendedGenderEnum::HYBRID())
        );
        $expectedColor = array(
            ColorEnum::RED(),
            ColorEnum::GREEN(),
            ColorEnum::BLUE()
        );
        $expectedExtColor = \array_merge(
            $expectedColor,
            array(
                ExtendedColorEnum::CYAN(),
                ExtendedColorEnum::MAGENTA(),
                ExtendedColorEnum::YELLOW()
            )
        );
        $expectedExtExtColor = \array_merge(
            $expectedExtColor,
            array(
                ExtendedExtendedColorEnum::BLACK(),
                ExtendedExtendedColorEnum::WHITE()
            )
        );
        $expectedSingleton = array(SingletonEnum::INSTANCE());
        $expectedPlanet = \array_merge(
            array(
                PlanetEnum::MERCURY(), PlanetEnum::VENUS(), PlanetEnum::EARTH()
            )
        );

        return [
            [self::$mockNamespace . '\GenderEnum', $expectedGender],
            [self::$mockNamespace . '\ExtendedGenderEnum', $expectedExtGender],
            [self::$mockNamespace . '\ColorEnum', $expectedColor],
            [self::$mockNamespace . '\ExtendedColorEnum', $expectedExtColor],
            [self::$mockNamespace . '\ExtendedExtendedColorEnum', $expectedExtExtColor],
            [self::$mockNamespace . '\SingletonEnum', $expectedSingleton],
            [self::$mockNamespace . '\PlanetEnum', $expectedPlanet]
        ];
    }

    /**
     * @return void
     *
     * @coversClass values
     * @dataProvider providerValues
     * @test
     */
    public function testValues($className, array $expected)
    {
        $actual = $className::values();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public static function providerGetNameAndValueOf()
    {
        return [
            ['FEMALE', GenderEnum::FEMALE()],
            ['MALE', GenderEnum::MALE()],
            ['HYBRID', ExtendedGenderEnum::HYBRID()]
        ];
    }

    /**
     * @return void
     *
     * @coversClass getName
     * @dataProvider providerGetNameAndValueOf
     * @test
     */
    public function testGetName($expected, EnumAbstract $constant)
    {
        $actual = $constant->getName();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversClass valueOf
     * @dataProvider providerGetNameAndValueOf
     * @test
     */
    public function testValueOf($name, EnumAbstract $expected)
    {
        $actual = ExtendedGenderEnum::valueOf($name);
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
     * @return array
     */
    public static function providerGetOrdinalAndMagicInvokeMethod()
    {
        return [
            [2, ExtendedGenderEnum::HYBRID()],
            [1, GenderEnum::MALE()],
            [0, GenderEnum::FEMALE()],
            [0, ColorEnum::RED()],
            [1, ColorEnum::GREEN()],
            [2, ColorEnum::BLUE()],
            [3, ExtendedColorEnum::CYAN()],
            [4, ExtendedColorEnum::MAGENTA()],
            [5, ExtendedColorEnum::YELLOW()],
            [6, ExtendedExtendedColorEnum::BLACK()],
            [7, ExtendedExtendedColorEnum::WHITE()],
            [0, SingletonEnum::INSTANCE()],
            [2, PlanetEnum::EARTH()],
            [0, PlanetEnum::MERCURY()],
            [1, PlanetEnum::VENUS()]
        ];
    }

    /**
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
     * @return void
     *
     * @coversClass __toString
     * @dataProvider providerGetNameAndValueOf
     * @test
     */
    public function testMagicToStringMethod($expected, EnumAbstract $constant)
    {
        // Explicit call.
        $this->assertEquals($expected, $constant->__toString());
    }

    /**
     * @return void
     * @todo The code is not covered with the data provider above. Find out why.
     *
     * @coversClass __toString
     * @test
     */
    public function testMagicToStringMethodCodeCoverage()
    {
        $this->assertEquals(
            'RED',
            ColorEnum::RED()->__toString()
        );
    }

    /**
     * @return array
     */
    public static function providerCompareTo()
    {
        return [
            // Simple enumeration type.
            [0, GenderEnum::FEMALE(), GenderEnum::FEMALE()],
            [0, GenderEnum::MALE(), GenderEnum::MALE()],
            [-1, GenderEnum::FEMALE(), GenderEnum::MALE()],
            [1, GenderEnum::MALE(), GenderEnum::FEMALE()],
            // Subclassed enumeration types.
            [0, ExtendedGenderEnum::HYBRID(), ExtendedGenderEnum::HYBRID()],
            [0, GenderEnum::FEMALE(), ExtendedGenderEnum::FEMALE()],
            [ 0, ExtendedGenderEnum::MALE(), GenderEnum::MALE()],
            [-2, GenderEnum::FEMALE(), ExtendedGenderEnum::HYBRID()],
            [-1, GenderEnum::MALE(), ExtendedGenderEnum::HYBRID()],
            [2, ExtendedGenderEnum::HYBRID(), ExtendedGenderEnum::FEMALE()],
            [1, ExtendedGenderEnum::HYBRID(), ExtendedGenderEnum::MALE()],
            [0, SingletonEnum::INSTANCE(), SingletonEnum::INSTANCE()]
        ];
    }

    /**
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
     * @return array
     */
    public static function providerComparisonOperators()
    {
        return [
            // Simple enumeration type.
            [true, GenderEnum::FEMALE(), GenderEnum::FEMALE()],
            [true, GenderEnum::MALE(), GenderEnum::MALE()], [
                false, GenderEnum::FEMALE(), GenderEnum::MALE()
            ], [
                false, GenderEnum::MALE(), GenderEnum::FEMALE()
            // Subclassed enumeration types.
            ], [
                true, ExtendedGenderEnum::HYBRID(), ExtendedGenderEnum::HYBRID()
            ], [
                true, GenderEnum::FEMALE(), ExtendedGenderEnum::FEMALE()
            ], [
                true, ExtendedGenderEnum::MALE(), GenderEnum::MALE()
            ], [
                false, GenderEnum::FEMALE(), ExtendedGenderEnum::HYBRID()
            ], [
                false, GenderEnum::MALE(), ExtendedGenderEnum::HYBRID()
            ], [
                false,
                ExtendedGenderEnum::HYBRID(),
                ExtendedGenderEnum::FEMALE()
            ], [
                false, ExtendedGenderEnum::HYBRID(), ExtendedGenderEnum::MALE()
            ]
        ];
    }

    /**
     * Tests the equality (`==`) of enumeration constants.
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
     * @return array
     */
    public static function providerHashCodeAndSerialization()
    {
        return [
            [GenderEnum::FEMALE()],
            [GenderEnum::MALE()],
            [ExtendedGenderEnum::HYBRID()]
        ];
    }

    /**
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
