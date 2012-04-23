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
 * PHP version 5.4
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
 * @todo       Analyze and remove redundant test cases.
 * @todo       Merge data providers with the data providers of class {@link
 *             EnumUtilsTest} and place them in a static class called
 *             `EnumTestDataProvider`.
 * @todo       Separate integration tests from unit test by creating separate files
 *             for unit tests (using mock objects) and integration tests (testing the
 *             concrete enumerations in the `res` directory.
 * @todo       Add @testdoc annotation to each test case.
 */

declare(encoding = 'UTF-8');

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
     * @test
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
     * Tests whether an enumeration constant is an *Immutable Object*.
     *
     * @return void
     *
     * @expectedException \BadMethodCallException
     * @test
     */
    public function testIsImmutableObject()
    {
        $constant = UsageExampleEnum::CORRECT_USAGE();
        $constant->newAttribute = null;
    }

    /**
     * Tests whether {@link EnumAbstract::getConstant()} returns an instance of class
     * {@link EnumAbstract}.
     *
     * @return void
     * @deprecated Redundant test case-
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::getConstant
     * @test
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
        return [
            ['UsageExampleEnum', 'INVALID'],
            ['UsageExampleEnum', 'INVALID_TYPE'],
            ['UsageExampleEnum', 'INVALID_NAME']
        ];
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
     * @test
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
     * @test
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
        $expectedGender = ['FEMALE', 'MALE'];
        $expectedExtGender = \array_merge($expectedGender, ['HYBRID']);
        $expectedColor = ['RED', 'GREEN', 'BLUE'];
        $expectedExtColor = \array_merge(
            $expectedColor, ['CYAN', 'MAGENTA', 'YELLOW']
        );
        $expectedExtExtColor = \array_merge(
            $expectedExtColor, ['BLACK', 'WHITE']
        );
        $expectedSingleton = ['INSTANCE'];
        $expectedPlanet = ['MERCURY', 'VENUS', 'EARTH'];

        return [
            ['GenderEnum', $expectedGender],
            ['ExtendedGenderEnum', $expectedExtGender],
            ['ColorEnum', $expectedColor],
            ['ExtendedColorEnum', $expectedExtColor],
            ['ExtendedExtendedColorEnum', $expectedExtExtColor],
            ['SingletonEnum', $expectedSingleton],
            ['PlanetEnum', $expectedPlanet]
        ];
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
     * @test
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
        $expectedGender = [GenderEnum::FEMALE(), GenderEnum::MALE()];
        $expectedExtGender = \array_merge(
            $expectedGender, [ExtendedGenderEnum::HYBRID()]
        );
        $expectedColor = [ColorEnum::RED(), ColorEnum::GREEN(), ColorEnum::BLUE()];
        $expectedExtColor = \array_merge(
            $expectedColor,
            [ExtendedColorEnum::CYAN(),
            ExtendedColorEnum::MAGENTA(),
            ExtendedColorEnum::YELLOW()]
        );
        $expectedExtExtColor = \array_merge(
            $expectedExtColor,
            [ExtendedExtendedColorEnum::BLACK(), ExtendedExtendedColorEnum::WHITE()]
        );
        $expectedSingleton = [SingletonEnum::INSTANCE()];
        $expectedPlanet = \array_merge(
            [PlanetEnum::MERCURY(), PlanetEnum::VENUS(), PlanetEnum::EARTH()]
        );

        return [
            ['GenderEnum', $expectedGender],
            ['ExtendedGenderEnum', $expectedExtGender],
            ['ColorEnum', $expectedColor],
            ['ExtendedColorEnum', $expectedExtColor],
            ['ExtendedExtendedColorEnum', $expectedExtExtColor],
            ['SingletonEnum', $expectedSingleton],
            ['PlanetEnum', $expectedPlanet]
        ];
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
     * @test
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
        return [
            ['FEMALE', GenderEnum::FEMALE()],
            ['MALE', GenderEnum::MALE()],
            ['HYBRID', ExtendedGenderEnum::HYBRID()]
        ];
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
     * @test
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
     * @test
     */
    public function testValueOf($name, EnumAbstract $expected)
    {
        $actual = ExtendedGenderEnum::valueOf($name);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests {@link EnumAbstract::valueOf}.
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::valueOf
     * @test
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
     * @test
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
     * Data provider for {@link testMagicToString}.
     *
     * @return array The parameters for the test method.
     */
    public static function providerMagicToStringMethod()
    {
        return [
            [
                'fw\Component\Core\Enum\GenderEnum[FEMALE]',
                GenderEnum::FEMALE()
            ], [
                'fw\Component\Core\Enum\GenderEnum[MALE]',
                GenderEnum::MALE()
            ], [
                'fw\Component\Core\Enum\GenderEnum[FEMALE]',
                ExtendedGenderEnum::FEMALE()
            ], [
                'fw\Component\Core\Enum\GenderEnum[MALE]',
                ExtendedGenderEnum::MALE()
            ], [
                'fw\Component\Core\Enum\ExtendedGenderEnum[HYBRID]',
                ExtendedGenderEnum::HYBRID()
            ]
        ];
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
     * @test
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
     * @test
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
        return [
            // Simple enumeration type.
            [
                0, GenderEnum::FEMALE(), GenderEnum::FEMALE()
            ], [
                0, GenderEnum::MALE(), GenderEnum::MALE()
            ], [
                -1, GenderEnum::FEMALE(), GenderEnum::MALE()
            ], [
                1, GenderEnum::MALE(), GenderEnum::FEMALE()
            // Subclassed enumeration types.
            ], [
                0, ExtendedGenderEnum::HYBRID(), ExtendedGenderEnum::HYBRID()
            ], [
                0, GenderEnum::FEMALE(), ExtendedGenderEnum::FEMALE()
            ], [
                0, ExtendedGenderEnum::MALE(), GenderEnum::MALE()
            ], [
                -2, GenderEnum::FEMALE(), ExtendedGenderEnum::HYBRID()
            ], [
                -1, GenderEnum::MALE(), ExtendedGenderEnum::HYBRID()
            ], [
                2, ExtendedGenderEnum::HYBRID(), ExtendedGenderEnum::FEMALE()
            ], [
                1, ExtendedGenderEnum::HYBRID(), ExtendedGenderEnum::MALE()
            ], [
                0, SingletonEnum::INSTANCE(), SingletonEnum::INSTANCE()
            ]
        ];
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
     * @test
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
        return [
            // Simple enumeration type.
            [
                true, GenderEnum::FEMALE(), GenderEnum::FEMALE()
            ], [
                true, GenderEnum::MALE(), GenderEnum::MALE()
            ], [
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
                false, ExtendedGenderEnum::HYBRID(), ExtendedGenderEnum::FEMALE()
            ], [
                false, ExtendedGenderEnum::HYBRID(), ExtendedGenderEnum::MALE()
            ]
        ];
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
     * @test
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
     * @test
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
     * @test
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
        return [
            [GenderEnum::FEMALE()],
            [GenderEnum::MALE()],
            [ExtendedGenderEnum::HYBRID()]
        ];
    }

    /**
     * Tests {@link EnumAbstract::hashCode}.
     *
     * @param EnumAbstract $constant TODO
     *
     * @return void
     *
     * @covers fw\Component\Core\Enum\EnumAbstract::hashCode
     * @dataProvider providerHashCodeAndSerialization
     * @test
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
     * @test
     */
    public function testSerialization(EnumAbstract $constant)
    {
        $serialized = \serialize($constant);
        $unserialized = \unserialize($serialized);

        $this->assertEquals($unserialized, $constant);
    }

    /**
     * Tests the correctness of a *Singleton* enumeration.
     *
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
     * Tests the correctness of a simple functional enumeration.
     *
     * @return void
     *
     * @test
     */
    public function testSimpleFunctionalEnum()
    {
        $constant = SingletonEnum::INSTANCE();
        $actual = $constant->__toString();

        $this->assertEquals('fw\Component\Core\Enum\SingletonEnum', $actual);
    }

    /**
     * Tests the correctness of a complex functional enumeration.
     *
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
