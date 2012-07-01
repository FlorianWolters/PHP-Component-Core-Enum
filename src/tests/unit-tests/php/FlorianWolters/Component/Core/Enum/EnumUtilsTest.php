<?php
/**
 * `EnumUtilsTest.php`
 *
 * This file is part of fwComponents.
 *
 * fwComponents is free software: you can redistribute it and/or modify it under
 * the terms of the GNU Lesser General Public License as published by the Free
 * Software Foundation, either version 3 of the License, or (at your option) any
 * later version.
 *
 * fwComponents is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with fwComponents.  If not, see http://gnu.org/licenses/lgpl.txt.
 *
 * PHP version 5.4
 *
 * @category   Component
 * @package    Core
 * @subpackage Enum
 * @author     Florian Wolters <wolters.fl@gmail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @version    GIT: $Id$
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      File available since Release 0.1.0
 */

declare(encoding = 'UTF-8');

namespace FlorianWolters\Component\Core\Enum;

require_once 'EnumTestUtils.php';

/**
 * Test class for {@link EnumUtils}.
 *
 * @category   Component
 * @package    Core
 * @subpackage Enum
 * @author     Florian Wolters <wolters.fl@gmail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @version    Release: @package_version@
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      Class available since Release 0.1.0
 *
 * @covers FlorianWolters\Component\Core\Enum\EnumUtils
 */
class EnumUtilsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests the definition of the class (@link EnumUtils).
     *
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
     * Tests {@link EnumUtils::names}.
     *
     * @return void
     *
     * @covers FlorianWolters\Component\Core\Enum\EnumUtils::names
     * @test
     */
    public function testNames()
    {
        $expected = ['FEMALE', 'MALE', 'HYBRID'];
        $actual = EnumUtils::names(__NAMESPACE__ . '\ExtendedGenderEnum');

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests whether {@link EnumUtils::names} throws an {@link
     * \InvalidArgumentException}.
     *
     * @return void
     *
     * @covers FlorianWolters\Component\Core\Enum\EnumUtils::names
     * @expectedException \InvalidArgumentException
     * @test
     */
    public function testNamesThrowsInvalidArgumentException()
    {
        EnumUtils::names('UnknownEnum');
    }

    /**
     * Tests {@link EnumUtils::values}.
     *
     * @return void
     *
     * @covers FlorianWolters\Component\Core\Enum\EnumUtils::values
     * @test
     */
    public function testValues()
    {
        $expected = [
            ExtendedGenderEnum::FEMALE(),
            ExtendedGenderEnum::MALE(),
            ExtendedGenderEnum::HYBRID()
        ];
        $actual = EnumUtils::values(__NAMESPACE__ . '\ExtendedGenderEnum');

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests whether {@link EnumUtils::values} throws an {@link
     * \InvalidArgumentException}.
     *
     * @return void
     *
     * @covers FlorianWolters\Component\Core\Enum\EnumUtils::values
     * @expectedException \InvalidArgumentException
     * @test
     */
    public function testValuesThrowsInvalidArgumentException()
    {
        EnumUtils::values('UnknownEnum');
    }

    /**
     * Tests {@link EnumUtils::isEnumType}.
     *
     * @return void
     *
     * @covers FlorianWolters\Component\Core\Enum\EnumUtils::isEnumType
     * @test
     */
    public function testIsEnumType()
    {
        $this->assertTrue(EnumUtils::isEnumType(__NAMESPACE__ . '\GenderEnum'));
        $this->assertTrue(
            EnumUtils::isEnumType(__NAMESPACE__ . '\ExtendedGenderEnum')
        );
        $this->assertFalse(EnumUtils::isEnumType('UnknownEnum'));
    }

    /**
     * Tests {@link EnumUtils::valueOf}.
     *
     * @return void
     *
     * @covers FlorianWolters\Component\Core\Enum\EnumUtils::valueOf
     * @test
     */
    public function testValueOf()
    {
        $expected = ExtendedGenderEnum::HYBRID();
        $actual = EnumUtils::valueOf(
            __NAMESPACE__ . '\ExtendedGenderEnum', 'HYBRID'
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests whether {@link EnumUtils::valueof} throws an {@link
     * \InvalidArgumentException}.
     *
     * @return void
     *
     * @covers FlorianWolters\Component\Core\Enum\EnumUtils::valueOf
     * @expectedException \InvalidArgumentException
     * @test
     */
    public function testValueOfThrowsInvalidArgumentException()
    {
        EnumUtils::valueOf('UnknownEnum', 'UNKNOWN');
    }

    /**
     * Data provider for {@link testGetNameForOrdinal}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerGetNameForOrdinal()
    {
        return [
            // Equivalence class: Positive result.
            ['FEMALE', 'GenderEnum', 0],
            ['MALE', 'GenderEnum', 1],
            ['FEMALE', 'ExtendedGenderEnum', 0],
            ['MALE', 'ExtendedGenderEnum', 1],
            ['HYBRID', 'ExtendedGenderEnum', 2],
            // Equivalence class: Negative result.
            [null, 'GenderEnum', 2],
            [null, 'ExtendedGenderEnum', -1],
            [null, 'ExtendedGenderEnum', 3]
        ];
    }

    /**
     * Tests {@link EnumUtils::getNameForOrdinal}.
     *
     * @param boolean $expected The expected return value of {@link
     *                          EnumUtils::getNameForOrdinal}.
     * @param string  $enumType The name of an enumeration type.
     * @param integer $ordinal  The ordinal of an enumeration constant.
     *
     * @return void
     *
     * @covers FlorianWolters\Component\Core\Enum\EnumUtils::getNameForOrdinal
     * @dataProvider providerGetNameForOrdinal
     * @test
     */
    public function testGetNameForOrdinal($expected, $enumType, $ordinal)
    {
        $className = EnumTestUtils::buildClassName($enumType);
        $actual = EnumUtils::getNameForOrdinal($className, $ordinal);
        $this->assertEquals($actual, $expected);
    }

    /**
     * Data provider for {@link testGetOrdinalForName}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerGetOrdinalForName()
    {
        return [
            // Equivalence class: Positive result.
            [0, 'GenderEnum', 'FEMALE'],
            [1, 'GenderEnum', 'MALE'],
            [0, 'ExtendedGenderEnum', 'FEMALE'],
            [1, 'ExtendedGenderEnum', 'MALE'],
            [2, 'ExtendedGenderEnum', 'HYBRID'],
            // Equivalence class: Negative result.
            [null, 'GenderEnum', 'HYBRID'],
            [null, 'ExtendedGenderEnum', 'UNKNOWN']
        ];
    }

    /**
     * Tests {@link EnumUtils::getOrdinalForName}.
     *
     * @param boolean $expected The expected return value of {@link
     *                          EnumUtils::getOrdinalForName}.
     * @param string  $enumType The name of an enumeration type.
     * @param string  $name     The name of an enumeration constant.
     *
     * @return void
     *
     * @covers FlorianWolters\Component\Core\Enum\EnumUtils::getOrdinalForName
     * @dataProvider providerGetOrdinalForName
     * @test
     */
    public function testGetOrdinalForName($expected, $enumType, $name)
    {
        $className = EnumTestUtils::buildClassName($enumType);
        $actual = EnumUtils::getOrdinalForName($className, $name);
        $this->assertEquals($actual, $expected);
    }

    /**
     * Data provider for {@link testIsDefinedName}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerIsDefinedName()
    {
        return [
            // Equivalence class: Positive result.
            [true, 'GenderEnum', 'FEMALE'],
            [true, 'GenderEnum', 'MALE'],
            [true, 'ExtendedGenderEnum', 'FEMALE'],
            [true, 'ExtendedGenderEnum', 'MALE'],
            [true, 'ExtendedGenderEnum', 'HYBRID'],
            // Equivalence class: Negative result.
            [false, 'GenderEnum', 'HYBRID'],
            [false, 'ExtendedGenderEnum', 'UNKNOWN']
        ];
    }

    /**
     * Tests {@link EnumUtils::isDefinedName}.
     *
     * @param boolean $expected The expected return value.
     * @param string  $enumType The enumeration type to check.
     * @param string  $name     The name of the enumeration constant to check.
     *
     * @return void
     *
     * @covers FlorianWolters\Component\Core\Enum\EnumUtils::isDefinedName
     * @dataProvider providerIsDefinedName
     * @test
     */
    public function testIsDefinedName($expected, $enumType, $name)
    {
        $className = EnumTestUtils::buildClassName($enumType);
        $actual = EnumUtils::isDefinedName($className, $name);
        $this->assertEquals($actual, $expected);
    }

    /**
     * Data provider for {@link testIsDefinedOrdinal}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerIsDefinedOrdinal()
    {
        return [
            // Equivalence class: Positive result.
            [true, 'GenderEnum', 0],
            [true, 'GenderEnum', 1],
            [true, 'ExtendedGenderEnum', 0],
            [true, 'ExtendedGenderEnum', 1],
            [true, 'ExtendedGenderEnum', 2],
            // Equivalence class: Negative result.
            [false, 'GenderEnum', 2],
            [false, 'ExtendedGenderEnum', -1],
            [false, 'ExtendedGenderEnum', 3]
        ];
    }

    /**
     * Tests {@link EnumUtils::isDefinedOrdinal}.
     *
     * @param boolean $expected The expected return value.
     * @param string  $enumType The enumeration type to check.
     * @param string  $ordinal  The ordinal of the enumeration constant to
     *                          check.
     *
     * @return void
     *
     * @covers FlorianWolters\Component\Core\Enum\EnumUtils::isDefinedOrdinal
     * @dataProvider providerIsDefinedOrdinal
     * @test
     */
    public function testIsDefinedOrdinal($expected, $enumType, $ordinal)
    {
        $className = EnumTestUtils::buildClassName($enumType);
        $actual = EnumUtils::isDefinedOrdinal($className, $ordinal);
        $this->assertEquals($actual, $expected);
    }

}
