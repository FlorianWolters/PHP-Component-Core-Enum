<?php
namespace FlorianWolters\Component\Core\Enum;

use FlorianWolters\Mock\ExtendedGenderEnum;

/**
 * Test class for {@link EnumUtils}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.1.0
 *
 * @covers FlorianWolters\Component\Core\Enum\EnumUtils
 */
class EnumUtilsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private static $mockNamespace = 'FlorianWolters\Mock';

    /**
     * @return void
     *
     * @group specification
     * @testdox The definition of the class EnumUtils is correct.
     */
    public function testClassDefinition()
    {
        // Get the class via Reflection and test its signature.
        $reflectedClass = new \ReflectionClass(__NAMESPACE__ . '\EnumUtils');
        $this->assertTrue($reflectedClass->inNamespace());
        $this->assertFalse($reflectedClass->isAbstract());
        $this->assertFalse($reflectedClass->isFinal());
        $this->assertFalse($reflectedClass->isInstantiable());
        $this->assertFalse($reflectedClass->isInterface());
        $this->assertFalse($reflectedClass->isInternal());
        $this->assertFalse($reflectedClass->isIterateable());
        $this->assertTrue($reflectedClass->isUserDefined());

        // Get the constructor via Reflection and test its signature.
        $reflectedConstructor = $reflectedClass->getMethod('__construct');
        $this->assertFalse($reflectedConstructor->isAbstract());
        $this->assertTrue($reflectedConstructor->isConstructor());
        $this->assertFalse($reflectedConstructor->isFinal());
        $this->assertFalse($reflectedConstructor->isProtected());
    }

    /**
     * @return void
     *
     * @coversClass names
     * @test
     */
    public function testNames()
    {
        $expected = ['FEMALE', 'MALE', 'HYBRID'];
        $actual = EnumUtils::names(
            self::$mockNamespace . '\ExtendedGenderEnum'
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
     * @test
     */
    public function testValues()
    {
        $expected = [
            ExtendedGenderEnum::FEMALE(),
            ExtendedGenderEnum::MALE(),
            ExtendedGenderEnum::HYBRID()
        ];
        $actual = EnumUtils::values(
            self::$mockNamespace . '\ExtendedGenderEnum'
        );

        $this->assertEquals($expected, $actual);
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
     * @return void
     *
     * @coversClass isEnumType
     * @test
     */
    public function testIsEnumType()
    {
        $this->assertTrue(
            EnumUtils::isEnumType(self::$mockNamespace . '\GenderEnum')
        );
        $this->assertTrue(
            EnumUtils::isEnumType(self::$mockNamespace . '\ExtendedGenderEnum')
        );
        $this->assertFalse(EnumUtils::isEnumType('UnknownEnum'));
    }

    /**
     * @return void
     *
     * @coversClass valueOf
     * @test
     */
    public function testValueOf()
    {
        $expected = ExtendedGenderEnum::HYBRID();
        $actual = EnumUtils::valueOf(
            self::$mockNamespace . '\ExtendedGenderEnum',
            'HYBRID'
        );

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
     * @return array
     */
    public static function providerGetNameForOrdinal()
    {
        return [
            // Equivalence class: Positive result.
            ['FEMALE', self::$mockNamespace . '\GenderEnum', 0],
            ['MALE', self::$mockNamespace . '\GenderEnum', 1],
            ['FEMALE', self::$mockNamespace . '\ExtendedGenderEnum', 0],
            ['MALE', self::$mockNamespace . '\ExtendedGenderEnum', 1],
            ['HYBRID', self::$mockNamespace . '\ExtendedGenderEnum', 2],
            // Equivalence class: Negative result.
            [null, self::$mockNamespace . '\GenderEnum', 2],
            [null, self::$mockNamespace . '\ExtendedGenderEnum', -1],
            [null, self::$mockNamespace . '\ExtendedGenderEnum', 3]
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
     * @return array
     */
    public static function providerGetOrdinalForName()
    {
        return [
            // Equivalence class: Positive result.
            [0, self::$mockNamespace . '\GenderEnum', 'FEMALE'],
            [1, self::$mockNamespace . '\GenderEnum', 'MALE'],
            [0, self::$mockNamespace . '\ExtendedGenderEnum', 'FEMALE'],
            [1, self::$mockNamespace . '\ExtendedGenderEnum', 'MALE'],
            [2, self::$mockNamespace . '\ExtendedGenderEnum', 'HYBRID'],
            // Equivalence class: Negative result.
            [null, self::$mockNamespace . '\GenderEnum', 'HYBRID'],
            [null, self::$mockNamespace . '\ExtendedGenderEnum', 'UNKNOWN']
        ];
    }

    /**
     * @return void
     *
     * @coversClass getOrdinalForName
     * @dataProvider providerGetOrdinalForName
     * @test
     */
    public function testGetOrdinalForName($expected, $className, $name)
    {
        $actual = EnumUtils::getOrdinalForName($className, $name);
        $this->assertEquals($actual, $expected);
    }

    /**
     * @return array
     */
    public static function providerIsDefinedName()
    {
        return [
            // Equivalence class: Positive result.
            [true, self::$mockNamespace . '\GenderEnum', 'FEMALE'],
            [true, self::$mockNamespace . '\GenderEnum', 'MALE'],
            [true, self::$mockNamespace . '\ExtendedGenderEnum', 'FEMALE'],
            [true, self::$mockNamespace . '\ExtendedGenderEnum', 'MALE'],
            [true, self::$mockNamespace . '\ExtendedGenderEnum', 'HYBRID'],
            // Equivalence class: Negative result.
            [false, self::$mockNamespace . '\GenderEnum', 'HYBRID'],
            [false, self::$mockNamespace . '\ExtendedGenderEnum', 'UNKNOWN']
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
     * @return array
     */
    public static function providerIsDefinedOrdinal()
    {
        return [
            // Equivalence class: Positive result.
            [true, self::$mockNamespace . '\GenderEnum', 0],
            [true, self::$mockNamespace . '\GenderEnum', 1],
            [true, self::$mockNamespace . '\ExtendedGenderEnum', 0],
            [true, self::$mockNamespace . '\ExtendedGenderEnum', 1],
            [true, self::$mockNamespace . '\ExtendedGenderEnum', 2],
            // Equivalence class: Negative result.
            [false, self::$mockNamespace . '\GenderEnum', 2],
            [false, self::$mockNamespace . '\ExtendedGenderEnum', -1],
            [false, self::$mockNamespace . '\ExtendedGenderEnum', 3]
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
