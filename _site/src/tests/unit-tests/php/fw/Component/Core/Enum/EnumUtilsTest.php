<?php
/**
 * `EnumUtilsTest.php`
 *
 * This file is part of fwComponents.
 *
 * fwComponents is free software: you can redistribute it and/or modify it under the
 * terms of the GNU Lesser General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 *
 * fwComponents is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE.  See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with fwComponents.  If not, see http://gnu.org/licenses/lgpl.txt.
 *
 * PHP version 5.3
 *
 * @category   Component
 * @package    Core
 * @subpackage Enum
 * @author     Florian Wolters <florian.wolters.85@googlemail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt GNU Lesser General Public License
 * @version    GIT: $Id$
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      File available since Release 0.1.0
 */

declare(encoding = 'utf-8');

namespace fw\Component\Core\Enum;

require_once 'EnumTestUtils.php';

/**
 * Test class for {@link EnumUtils}.
 *
 * @category   Component
 * @package    Core
 * @subpackage Enum
 * @author     Florian Wolters <florian.wolters.85@googlemail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt GNU Lesser General Public License
 * @version    Release: @package_version@
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      Class available since Release 0.1.0
 * @todo       Merge data providers with the data providers of class {@link
 *             EnumAbstractTest} and place them in a static class called
 *             `EnumTestDataProvider`.
 *
 * @covers fw\Component\Core\Enum\EnumUtils
 */
class EnumUtilsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests the definition of the class (@link EnumAbstract).
     *
     * @return void
     *
     * @group specification
     * @testdox The definition of the class EnumAbstract is correct.
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
     * @covers fw\Component\Core\Enum\EnumUtils::names
     */
    public function testNames()
    {
        $expected = array('FEMALE', 'MALE', 'MIXED');
        $actual = EnumUtils::names(__NAMESPACE__ . '\ExtraGenderEnum');

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests whether {@link EnumUtils::names} throws an {@link
     * \InvalidArgumentException}.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumUtils::names
     * @expectedException \InvalidArgumentException
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
     * @covers fw\Component\Core\Enum\EnumUtils::values
     */
    public function testValues()
    {
        $expected = array(
            ExtraGenderEnum::FEMALE(),
            ExtraGenderEnum::MALE(),
            ExtraGenderEnum::MIXED()
        );
        $actual = EnumUtils::values(__NAMESPACE__ . '\ExtraGenderEnum');

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests whether {@link EnumUtils::values} throws an {@link
     * \InvalidArgumentException}.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumUtils::values
     * @expectedException \InvalidArgumentException
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
     * @covers fw\Component\Core\Enum\EnumUtils::isEnumType
     */
    public function testIsEnumType()
    {
        $this->assertTrue(EnumUtils::isEnumType(__NAMESPACE__ . '\GenderEnum'));
        $this->assertTrue(EnumUtils::isEnumType(__NAMESPACE__ . '\ExtraGenderEnum'));
        $this->assertFalse(EnumUtils::isEnumType('UnknownEnum'));
    }

    /**
     * Tests {@link EnumUtils::valueOf}.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumUtils::valueOf
     */
    public function testValueOf()
    {
        $expected = ExtraGenderEnum::MIXED();
        $actual = EnumUtils::valueOf(__NAMESPACE__ . '\ExtraGenderEnum', 'MIXED');

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests whether {@link EnumUtils::valueof} throws an {@link
     * \InvalidArgumentException}.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumUtils::valueOf
     * @expectedException \InvalidArgumentException
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
        return array(
            // Equivalence class: Positive result.
            array('FEMALE', 'GenderEnum', 0),
            array('MALE', 'GenderEnum', 1),
            array('FEMALE', 'ExtraGenderEnum', 0),
            array('MALE', 'ExtraGenderEnum', 1),
            array('MIXED', 'ExtraGenderEnum', 2),
            // Equivalence class: Negative result.
            array(null, 'GenderEnum', 2),
            array(null, 'ExtraGenderEnum', -1),
            array(null, 'ExtraGenderEnum', 3)
        );
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
     * @covers fw\Component\Core\Enum\EnumUtils::getNameForOrdinal
     * @dataProvider providerGetNameForOrdinal
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
        return array(
            // Equivalence class: Positive result.
            array(0, 'GenderEnum', 'FEMALE'),
            array(1, 'GenderEnum', 'MALE'),
            array(0, 'ExtraGenderEnum', 'FEMALE'),
            array(1, 'ExtraGenderEnum', 'MALE'),
            array(2, 'ExtraGenderEnum', 'MIXED'),
            // Equivalence class: Negative result.
            array(null, 'GenderEnum', 'MIXED'),
            array(null, 'ExtraGenderEnum', 'UNKNOWN')
        );
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
     * @covers fw\Component\Core\Enum\EnumUtils::getOrdinalForName
     * @dataProvider providerGetOrdinalForName
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
        return array(
            // Equivalence class: Positive result.
            array(true, 'GenderEnum', 'FEMALE'),
            array(true, 'GenderEnum', 'MALE'),
            array(true, 'ExtraGenderEnum', 'FEMALE'),
            array(true, 'ExtraGenderEnum', 'MALE'),
            array(true, 'ExtraGenderEnum', 'MIXED'),
            // Equivalence class: Negative result.
            array(false, 'GenderEnum', 'MIXED'),
            array(false, 'ExtraGenderEnum', 'UNKNOWN')
        );
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
     * @covers fw\Component\Core\Enum\EnumUtils::isDefinedName
     * @dataProvider providerIsDefinedName
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
        return array(
            // Equivalence class: Positive result.
            array(true, 'GenderEnum', 0),
            array(true, 'GenderEnum', 1),
            array(true, 'ExtraGenderEnum', 0),
            array(true, 'ExtraGenderEnum', 1),
            array(true, 'ExtraGenderEnum', 2),
            // Equivalence class: Negative result.
            array(false, 'GenderEnum', 2),
            array(false, 'ExtraGenderEnum', -1),
            array(false, 'ExtraGenderEnum', 3)
        );
    }

    /**
     * Tests {@link EnumUtils::isDefinedOrdinal}.
     *
     * @param boolean $expected The expected return value.
     * @param string  $enumType The enumeration type to check.
     * @param string  $ordinal  The ordinal of the enumeration constant to check.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumUtils::isDefinedOrdinal
     * @dataProvider providerIsDefinedOrdinal
     */
    public function testIsDefinedOrdinal($expected, $enumType, $ordinal)
    {
        $className = EnumTestUtils::buildClassName($enumType);
        $actual = EnumUtils::isDefinedOrdinal($className, $ordinal);
        $this->assertEquals($actual, $expected);
    }

}
