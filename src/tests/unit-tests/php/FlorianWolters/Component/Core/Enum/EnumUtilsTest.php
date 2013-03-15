<?php
namespace FlorianWolters\Component\Core\Enum;

use \ReflectionClass;
use \ReflectionMethod;

/**
 * Test class for {@see EnumUtils}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.1.0
 *
 * @covers    FlorianWolters\Component\Core\Enum\EnumUtils
 */
class EnumUtilsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @group specification
     * @testdox The definition of the class EnumUtils is correct.
     */
    public function testClassDefinition()
    {
        $reflectedClass = new ReflectionClass(__NAMESPACE__ . '\EnumUtils');
        $this->assertTrue($reflectedClass->inNamespace());
        $this->assertFalse($reflectedClass->isAbstract());
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
     * @testdox The definition of the constructor EnumUtils::__construct is correct.
     * @test
     */
    public function testConstructorDefinition()
    {
        $reflectedConstructor = new ReflectionMethod(
            __NAMESPACE__ . '\EnumUtils',
            '__construct'
        );
        $this->assertFalse($reflectedConstructor->isAbstract());
        $this->assertTrue($reflectedConstructor->isConstructor());
        $this->assertFalse($reflectedConstructor->isFinal());
        $this->assertFalse($reflectedConstructor->isProtected());
    }

    /**
     * @return void
     *
     * @coversClass names
     * @dataProvider FlorianWolters\Component\Core\Enum\EnumTestUtils::providerNames
     * @test
     */
    public function testNames($className, array $expected)
    {
        $actual = EnumUtils::names(
            $className
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversClass names
     * @expectedException \InvalidArgumentException
     * @test
     */
    public function testNamesThrowsInvalidArgumentException()
    {
        EnumUtils::names('UnknownEnum');
    }

    /**
     * @return void
     *
     * @coversClass values
     * @dataProvider FlorianWolters\Component\Core\Enum\EnumTestUtils::providerValuesReturnsCorrectResults
     * @test
     */
    public function testValuesReturnsCorrectResults($className, array $expected)
    {
        $actual = EnumUtils::values($className);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversClass values
     * @dataProvider FlorianWolters\Component\Core\Enum\EnumTestUtils::providerValuesReturnsCorrectInstances
     * @test
     */
    public function testValuesReturnsCorrectInstances($className, $expected)
    {
        $actual = EnumUtils::values($className);

        foreach ($actual as $instance) {
            $this->assertInstanceOf($expected, $instance);
        }
    }

    /**
     * @return void
     *
     * @coversClass values
     * @expectedException \InvalidArgumentException
     * @test
     */
    public function testValuesThrowsInvalidArgumentException()
    {
        EnumUtils::values('UnknownEnum');
    }

    /**
     * @return mixed[][]
     */
    public static function providerIsEnumType()
    {
        return [
            [EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', true],
            [EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', true],
            [EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', true],
            [EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', true],
            [EnumTestUtils::MOCK_NAMESPACE . '\SingletonEnum', true],
            ['\stdClass', false],
            ['\UnknownClass', false]
        ];
    }

    /**
     * @return void
     *
     * @coversClass isEnumType
     * @dataProvider providerIsEnumType
     * @test
     */
    public function testIsEnumType($className, $expected)
    {
        $this->assertEquals(
            $expected,
            EnumUtils::isEnumType($className)
        );
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
        $actual = EnumUtils::valueOf($className, $name);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversClass valueOf
     * @expectedException \InvalidArgumentException
     * @test
     */
    public function testValueOfThrowsInvalidArgumentException()
    {
        EnumUtils::valueOf('UnknownEnum', 'UNKNOWN');
    }

    /**
     * @return mixed[][]
     */
    public static function providerGetNameForOrdinal()
    {
        return [
            // Equivalence class: Positive result.
            ['RED', EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 0],
            ['GREEN', EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 1],
            ['BLUE', EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 2],
            ['RED', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 0],
            ['GREEN', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 1],
            ['BLUE', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 2],
            ['CYAN', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 3],
            ['MAGENTA', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 4],
            ['YELLOW', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 5],
            ['BLACK', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 6],
            ['WHITE', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 7],
            ['INSTANCE', EnumTestUtils::MOCK_NAMESPACE . '\SingletonEnum', 0],
            ['MERCURY', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 0],
            ['VENUS', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 1],
            ['EARTH', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 2],
            ['MARS', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 3],
            ['JUPITER', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 4],
            ['SATURN', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 5],
            ['URANUS', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 6],
            ['NEPTUNE', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 7],
            // Equivalence class: Negative result.
            [null, EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 3],
            [null, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 6],
            [null, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 8],
            [null, EnumTestUtils::MOCK_NAMESPACE . '\SingletonEnum', 1],
            [null, EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 8],
            [null, EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', -1]
        ];
    }

    /**
     * @return void
     *
     * @coversClass getNameForOrdinal
     * @dataProvider providerGetNameForOrdinal
     * @test
     */
    public function testGetNameForOrdinal($expected, $className, $ordinal)
    {
        $actual = EnumUtils::getNameForOrdinal($className, $ordinal);

        $this->assertEquals($actual, $expected);
    }

    /**
     * @return mixed[][]
     */
    public static function providerGetOrdinalForName()
    {
        return [
            // Equivalence class: Positive result.
            ['RED', EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 0],
            ['GREEN', EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 1],
            ['BLUE', EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 2],
            ['RED', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 0],
            ['GREEN', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 1],
            ['BLUE', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 2],
            ['CYAN', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 3],
            ['MAGENTA', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 4],
            ['YELLOW', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 5],
            ['BLACK', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 6],
            ['WHITE', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 7],
            ['INSTANCE', EnumTestUtils::MOCK_NAMESPACE . '\SingletonEnum', 0],
            ['MERCURY', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 0],
            ['VENUS', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 1],
            ['EARTH', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 2],
            // Equivalence class: Negative result.
            ['UNKNOWN', EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', null],
            ['UNKNOWN', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', null],
            ['UNKNOWN', EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', null],
            ['UNKNOWN', EnumTestUtils::MOCK_NAMESPACE . '\SingletonEnum', null],
            ['UNKNOWN', EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', null]
        ];
    }

    /**
     * @return void
     *
     * @coversClass getOrdinalForName
     * @dataProvider providerGetOrdinalForName
     * @test
     */
    public function testGetOrdinalForName($name, $className, $expected)
    {
        $actual = EnumUtils::getOrdinalForName($className, $name);

        $this->assertEquals($actual, $expected);
    }

    /**
     * @return mixed[][]
     */
    public static function providerIsDefinedName()
    {
        return [
            // Equivalence class: Positive result.
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 'RED'],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 'GREEN'],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 'BLUE'],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 'RED'],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 'GREEN'],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 'BLUE'],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 'CYAN'],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 'MAGENTA'],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 'YELLOW'],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 'BLACK'],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 'WHITE'],
            // Equivalence class: Negative result.
            [false, EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 'UNKNOWN'],
            [false, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 'UNKNOWN'],
            [false, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 'UNKNOWN'],
            [false, EnumTestUtils::MOCK_NAMESPACE . '\SingletonEnum', 'UNKNOWN'],
            [false, EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 'UNKNOWN']
        ];
    }

    /**
     * @return void
     *
     * @coversClass isDefinedName
     * @dataProvider providerIsDefinedName
     * @test
     */
    public function testIsDefinedName($expected, $className, $name)
    {
        $actual = EnumUtils::isDefinedName($className, $name);

        $this->assertEquals($actual, $expected);
    }

    /**
     * @return mixed[][]
     */
    public static function providerIsDefinedOrdinal()
    {
        return [
            // Equivalence class: Positive result.
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 0],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 1],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 2],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 0],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 1],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 2],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 3],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 4],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 5],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 0],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 1],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 2],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 3],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 4],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 5],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 6],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 7],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\SingletonEnum', 0],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 0],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 1],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 2],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 3],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 4],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 5],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 6],
            [true, EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 7],
            // Equivalence class: Negative result.
            [false, EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', 3],
            [false, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedColorEnum', 6],
            [false, EnumTestUtils::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', 8],
            [false, EnumTestUtils::MOCK_NAMESPACE . '\SingletonEnum', 1],
            [false, EnumTestUtils::MOCK_NAMESPACE . '\PlanetEnum', 8],
            [false, EnumTestUtils::MOCK_NAMESPACE . '\ColorEnum', -1]
        ];
    }

    /**
     * @return void
     *
     * @coversClass isDefinedOrdinal
     * @dataProvider providerIsDefinedOrdinal
     * @test
     */
    public function testIsDefinedOrdinal($expected, $className, $ordinal)
    {
        $actual = EnumUtils::isDefinedOrdinal($className, $ordinal);

        $this->assertEquals($actual, $expected);
    }
}
