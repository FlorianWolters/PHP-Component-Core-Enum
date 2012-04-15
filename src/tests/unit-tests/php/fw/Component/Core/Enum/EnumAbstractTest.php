<?php
/**
 * `EnumAbstractTest.php`
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
 * @category   Test
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
 * Test class for {@link EnumAbstract}.
 *
 * @category   Test
 * @package    Core
 * @subpackage Enum
 * @author     Florian Wolters <florian.wolters.85@googlemail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt GNU Lesser General Public License
 * @version    Release: @package_version@
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      Class available since Release 0.1.0
 *
 * @covers fw\Component\Core\Enum\EnumAbstract
 */
class EnumAbstractTest extends \PHPUnit_Framework_TestCase
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
        $reflectedClass = new \ReflectionClass(__NAMESPACE__ . '\EnumAbstract');
        $this->assertTrue($reflectedClass->inNamespace());
        $this->assertTrue($reflectedClass->isAbstract());
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
     * Tests whether {@link EnumAbstract::getConstant()} returns an instance of class
     * {@link EnumAbstract}.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::getConstant
     */
    public function testGetConstantReturnsInstanceOfEnumAbstract()
    {
        $this->assertInstanceOf(
            __NAMESPACE__ . '\EnumAbstract', UsageExampleEnum::CORRECT_USAGE()
        );
    }

    /**
     * Data provider for {@link testGetConstantThrowsInvalidArgumentException}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerGetConstantThrowsInvalidArgumentException()
    {
        return array(
            array('UsageExampleEnum', 'INVALID'),
            array('UsageExampleEnum', 'INVALID_TYPE'),
            array('UsageExampleEnum', 'INVALID_NAME')
        );
    }

    /**
     * Tests whether an {@link \InvalidArgumentException} if both parameters, the
     * first parameter and the second parameter of {@link EnumAbstract::getConstant}
     * are incorrect.
     *
     * @param string $enumType The name of a enumeration type.
     * @param string $name     The name of a enumeration constant in the specified
     *                         enumeration type.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::getConstant
     * @dataProvider providerGetConstantThrowsInvalidArgumentException
     * @expectedException \InvalidArgumentException
     */
    public function testGetConstantThrowsInvalidArgumentException($enumType, $name)
    {
        $className = EnumTestUtils::buildClassName($enumType);
        $className::$name();
    }

    /**
     * Tests whether {@link EnumAbstract::__callStatic} throws an {@link
     * \UnexpectedValueException}.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::__callStatic
     * @expectedException \UnexpectedValueException
     */
    public function testThrowsUnexpectedValueExceptionIfConstantIsNotDefined()
    {
        UsageExampleEnum::UNEXPECTED();
    }

    /**
     * Data provider for {@link testNames}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerNames()
    {
        $expectedGender = array('FEMALE', 'MALE');
        $expectedExtraGender = \array_merge($expectedGender, array('MIXED'));
        $expectedColor = array('RED', 'GREEN', 'BLUE');
        $expectedExtraColor = \array_merge(
            $expectedColor, array('CYAN', 'MAGENTA', 'YELLOW')
        );
        $expExtraExtraColor = \array_merge(
            $expectedExtraColor, array('BLACK', 'WHITE')
        );

        return array(
            array('GenderEnum', $expectedGender),
            array('ExtraGenderEnum', $expectedExtraGender),
            array('ColorEnum', $expectedColor),
            array('ExtraColorEnum', $expectedExtraColor),
            array('ExtraExtraColorEnum', $expExtraExtraColor)
        );
    }

    /**
     * Tests {@link EnumAbstract::names}.
     *
     * @param string $enumType The name of a enumeration type.
     * @param array  $expected The expected return value.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::names
     * @dataProvider providerNames
     */
    public function testNames($enumType, array $expected)
    {
        $className = EnumTestUtils::buildClassName($enumType);
        $actual = $className::names();
        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for {@link testValues}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerValues()
    {
        $expectedGender = array(GenderEnum::FEMALE(),GenderEnum::MALE());
        $expectedExtraGender = \array_merge(
            $expectedGender, array(ExtraGenderEnum::MIXED())
        );
        $expectedColor = array(
            ColorEnum::RED(), ColorEnum::GREEN(), ColorEnum::BLUE()
        );
        $expectedExtraColor = \array_merge(
            $expectedColor,
            array(
                ExtraColorEnum::CYAN(),
                ExtraColorEnum::MAGENTA(),
                ExtraColorEnum::YELLOW()
            )
        );
        $expectedExtraExtraColor = \array_merge(
            $expectedExtraColor,
            array(ExtraExtraColorEnum::BLACK(), ExtraExtraColorEnum::WHITE())
        );

        return array(
            array('GenderEnum', $expectedGender),
            array('ExtraGenderEnum', $expectedExtraGender),
            array('ColorEnum', $expectedColor),
            array('ExtraColorEnum', $expectedExtraColor),
            array('ExtraExtraColorEnum', $expectedExtraExtraColor)
        );
    }

    /**
     * Tests {@link EnumAbstract::values}.
     *
     * @param string $enumType The name of a enumeration type.
     * @param array  $expected The expected return value.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::values
     * @dataProvider providerValues
     */
    public function testValues($enumType, array $expected)
    {
        $className = EnumTestUtils::buildClassName($enumType);
        $actual = $className::values();
        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for {@link testValueOf} and {@link testGetName}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerGetNameAndValueOf()
    {
        return array(
            array('FEMALE', GenderEnum::FEMALE()),
            array('MALE', GenderEnum::MALE()),
            array('MIXED', ExtraGenderEnum::MIXED())
        );
    }

    /**
     * Tests {@link EnumAbstract::getName}.
     *
     * @param string       $expected The expected name of the specified enumeration
     *                               constant.
     * @param EnumAbstract $constant The enumeration constant under test.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::getName
     * @dataProvider providerGetNameAndValueOf
     */
    public function testGetName($expected, EnumAbstract $constant)
    {
        $actual = $constant->getName();
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests {@link EnumAbstract::valueOf}.
     *
     * @param string       $name     The name of a enumeration constant.
     * @param EnumAbstract $expected The expected enumeration constant for the
     *                               specified name.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::valueOf
     * @dataProvider providerGetNameAndValueOf
     */
    public function testValueOf($name, EnumAbstract $expected)
    {
        $actual = ExtraGenderEnum::valueOf($name);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests {@link EnumAbstract::valueOf}.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::valueOf
     */
    public function testValueOfReturnsNullIfNameDoesNotExist()
    {
        $this->assertNull(UsageExampleEnum::valueOf('UNKNOWN'));
    }

    /**
     * Data provider for {@link testGetOrdinal}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerGetOrdinalAndMagicInvokeMethod()
    {
        return array(
            array(2, ExtraGenderEnum::MIXED()),
            array(1, GenderEnum::MALE()),
            array(0, GenderEnum::FEMALE()),
            array(0, ColorEnum::RED()),
            array(1, ColorEnum::GREEN()),
            array(2, ColorEnum::BLUE()),
            array(3, ExtraColorEnum::CYAN()),
            array(4, ExtraColorEnum::MAGENTA()),
            array(5, ExtraColorEnum::YELLOW()),
            array(6, ExtraExtraColorEnum::BLACK()),
            array(7, ExtraExtraColorEnum::WHITE())
        );
    }

    /**
     * Tests {@link EnumAbstract::getOrdinal}.
     *
     * @param string       $expected The expected ordinal of the enumeration
     *                               constant.
     * @param EnumAbstract $constant The enumeration constant under test.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::getOrdinal
     * @dataProvider providerGetOrdinalAndMagicInvokeMethod
     */
    public function testGetOrdinal($expected, EnumAbstract $constant)
    {
        $actual = $constant->getOrdinal();
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests {@link EnumAbstract::__invoke}.
     *
     * @param string       $expected The expected string representation of the
     *                               enumeration constant.
     * @param EnumAbstract $constant The enumeration constant under test.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::__invoke
     * @dataProvider providerGetOrdinalAndMagicInvokeMethod
     */
    public function testMagicInvokeMethod($expected, EnumAbstract $constant)
    {
        // Explicit method call.
        $this->assertEquals($expected, $constant->__invoke());
        // Implicit ("magic") method call.
        $this->assertEquals($expected, $constant());
    }

    /**
     * Data provider for {@link testMagicToString}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerMagicToStringMethod()
    {
        return array(
            array(
                'fw\Component\Core\Enum\GenderEnum[FEMALE]',
                GenderEnum::FEMALE()
            ), array(
                'fw\Component\Core\Enum\GenderEnum[MALE]',
                GenderEnum::MALE()
            ), array(
                'fw\Component\Core\Enum\GenderEnum[FEMALE]',
                ExtraGenderEnum::FEMALE()
            ), array(
                'fw\Component\Core\Enum\GenderEnum[MALE]',
                ExtraGenderEnum::MALE()
            ), array(
                'fw\Component\Core\Enum\ExtraGenderEnum[MIXED]',
                ExtraGenderEnum::MIXED()
            )
        );
    }

    /**
     * Tests {@link EnumAbstract::__toString}.
     *
     * @param string       $expected The expected string representation of the
     *                               enumeration constant.
     * @param EnumAbstract $constant The enumeration constant under test.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::__toString
     * @dataProvider providerMagicToStringMethod
     */
    public function testMagicToStringMethod($expected, EnumAbstract $constant)
    {
        // Explicit call.
        $this->assertEquals($expected, $constant->__toString());
    }

    /**
     * Tests {@link EnumAbstract::__toString}.
     *
     * @return void
     * @todo The code is not covered with the data provider above. Find out why.
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::__toString
     */
    public function testMagicToStringMethodCodeCoverage()
    {
        $this->assertEquals(
            'fw\Component\Core\Enum\UsageExampleEnum[CORRECT_USAGE]',
            UsageExampleEnum::CORRECT_USAGE()->__toString()
        );
    }

    /**
     * Data provider for {@link testCompareTo}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerCompareTo()
    {
        return array(
            // Simple enumeration type.
            array(
                0, GenderEnum::FEMALE(), GenderEnum::FEMALE()
            ), array(
                0, GenderEnum::MALE(), GenderEnum::MALE()
            ), array(
                -1, GenderEnum::FEMALE(), GenderEnum::MALE()
            ), array(
                1, GenderEnum::MALE(), GenderEnum::FEMALE()
            // Subclassed enumeration types.
            ), array(
                0, ExtraGenderEnum::MIXED(), ExtraGenderEnum::MIXED()
            ), array(
                0, GenderEnum::FEMALE(), ExtraGenderEnum::FEMALE()
            ), array(
                0, ExtraGenderEnum::MALE(), GenderEnum::MALE()
            ), array(
                -2, GenderEnum::FEMALE(), ExtraGenderEnum::MIXED()
            ), array(
                -1, GenderEnum::MALE(), ExtraGenderEnum::MIXED()
            ), array(
                2, ExtraGenderEnum::MIXED(), ExtraGenderEnum::FEMALE()
            ), array(
                1, ExtraGenderEnum::MIXED(), ExtraGenderEnum::MALE()
            )
        );
    }

    /**
     * Tests {@link EnumAbstract::compareTo}.
     *
     * @param integer      $expected The expected return value of {@link
     *                               EnumAbstract::compareTo}.
     * @param EnumAbstract $first    The first enumeration constant to compare.
     * @param EnumAbstract $second   The second enumeration constant to compare.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::compareTo
     * @covers fw\Component\Core\Enum\EnumAbstract::compare
     * @dataProvider providerCompareTo
     */
    public function testCompareTo(
        $expected, EnumAbstract $first, EnumAbstract $second
    ) {
        $actual = $first->compareTo($second);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for {@link testEqualityOperator} and {@link
     * testIdentityOperator}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerComparisonOperators()
    {
        return array(
            // Simple enumeration type.
            array(
                true, GenderEnum::FEMALE(), GenderEnum::FEMALE()
            ), array(
                true, GenderEnum::MALE(), GenderEnum::MALE()
            ), array(
                false, GenderEnum::FEMALE(), GenderEnum::MALE()
            ), array(
                false, GenderEnum::MALE(), GenderEnum::FEMALE()
            // Subclassed enumeration types.
            ), array(
                true, ExtraGenderEnum::MIXED(), ExtraGenderEnum::MIXED()
            ), array(
                true, GenderEnum::FEMALE(), ExtraGenderEnum::FEMALE()
            ), array(
                true, ExtraGenderEnum::MALE(), GenderEnum::MALE()
            ), array(
                false, GenderEnum::FEMALE(), ExtraGenderEnum::MIXED()
            ), array(
                false, GenderEnum::MALE(), ExtraGenderEnum::MIXED()
            ), array(
                false, ExtraGenderEnum::MIXED(), ExtraGenderEnum::FEMALE()
            ), array(
                false, ExtraGenderEnum::MIXED(), ExtraGenderEnum::MALE()
            )
        );
    }

    /**
     * Tests the equality (`==`) of enumeration constants.
     *
     * @param boolean      $expected The expected return value of the comparison.
     * @param EnumAbstract $first    The first enumeration constant to compare.
     * @param EnumAbstract $second   The second enumeration constant to compare.
     *
     * @return void
     *
     * @dataProvider providerComparisonOperators
     */
    public function testEqualityOperator(
        $expected, EnumAbstract $first, EnumAbstract $second
    ) {
        $actual = ($first == $second);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests the identity (`===`) of enumeration constants.
     *
     * @param boolean      $expected The expected return value of the comparison.
     * @param EnumAbstract $first    The first enumeration constant to compare.
     * @param EnumAbstract $second   The second enumeration constant to compare.
     *
     * @return void
     *
     * @dataProvider providerComparisonOperators
     */
    public function testIdentityOperator(
        $expected, EnumAbstract $first, EnumAbstract $second
    ) {
        $actual = ($first === $second);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests {@link EnumAbstract::equals}.
     *
     * @param boolean      $expected The expected return value of {@link
     *                               EnumAbstract::equals}.
     * @param EnumAbstract $first    The first enumeration constant to compare.
     * @param EnumAbstract $second   The second enumeration constant to compare.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::equals
     * @covers fw\Component\Core\Enum\EnumAbstract::isEqual
     * @dataProvider providerComparisonOperators

     */
    public function testEquals($expected, EnumAbstract $first, EnumAbstract $second)
    {
        $actual = $first->equals($second);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for {@link testHashCode} and {@link testSerialization}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerHashCodeAndSerialization()
    {
        return array(
            array(GenderEnum::FEMALE()),
            array(GenderEnum::MALE()),
            array(ExtraGenderEnum::MIXED())
        );
    }

    /**
     * Tests {@link EnumAbstract::hashCode}.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::hashCode
     * @dataProvider providerHashCodeAndSerialization
     */
    public function testHashCode(EnumAbstract $constant)
    {
        // The expected return value must:
        // - be of data type string
        // - have a length of 32 characters
        // - only consist of lowercase alphabetical (a-z) or digest (0-9) characters
        $pattern = '/^([0-9a-z]){32}$/';

        $this->assertRegExp($pattern, $constant->hashCode());
    }

    /**
     * Tests the serialization of an enumeration constant.
     *
     * @param EnumAbstract $constant An enumeration constant.
     *
     * @return void
     *
     * @dataProvider providerHashCodeAndSerialization
     */
    public function testSerialization(EnumAbstract $constant)
    {
        $serialized = \serialize($constant);
        $unserialized = \unserialize($serialized);

        $this->assertEquals($unserialized, $constant);
    }

}
