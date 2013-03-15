<?php
namespace FlorianWolters\Component\Core\Enum;

use FlorianWolters\Mock\ColorEnum;
use FlorianWolters\Mock\ExtendedColorEnum;
use FlorianWolters\Mock\ExtendedExtendedColorEnum;
use FlorianWolters\Mock\PlanetEnum;
use FlorianWolters\Mock\SingletonEnum;

/**
 * TODO
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.4.0
 */
class EnumTestUtils
{
    /**
     * @var string
     */
    const MOCK_NAMESPACE = 'FlorianWolters\Mock';

    /**
     * @return string[][]
     */
    public static function providerNames()
    {
        $expectedColor = ['RED', 'GREEN', 'BLUE'];
        $expectedExtColor = \array_merge(
            $expectedColor,
            ['CYAN', 'MAGENTA', 'YELLOW']
        );
        $expectedExtExtColor = \array_merge(
            $expectedExtColor,
            ['BLACK', 'WHITE']
        );
        $expectedSingleton = ['INSTANCE'];
        $expectedPlanet = [
            'MERCURY',
            'VENUS',
            'EARTH',
            'MARS',
            'JUPITER',
            'SATURN',
            'URANUS',
            'NEPTUNE'
        ];

        return [
            [self::MOCK_NAMESPACE . '\ColorEnum', $expectedColor],
            [self::MOCK_NAMESPACE . '\ExtendedColorEnum', $expectedExtColor],
            [self::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', $expectedExtExtColor],
            [self::MOCK_NAMESPACE . '\SingletonEnum', $expectedSingleton],
            [self::MOCK_NAMESPACE . '\PlanetEnum', $expectedPlanet]
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function providerValuesReturnsCorrectResults()
    {
        $expectedColor = [
            ColorEnum::RED(),
            ColorEnum::GREEN(),
            ColorEnum::BLUE()
        ];
        $expectedExtColor = \array_merge(
            $expectedColor,
            [
                ExtendedColorEnum::CYAN(),
                ExtendedColorEnum::MAGENTA(),
                ExtendedColorEnum::YELLOW()
            ]
        );
        $expectedExtExtColor = \array_merge(
            $expectedExtColor,
            [
                ExtendedExtendedColorEnum::BLACK(),
                ExtendedExtendedColorEnum::WHITE()
            ]
        );
        $expectedSingleton = [SingletonEnum::INSTANCE()];
        $expectedPlanet = [
            PlanetEnum::MERCURY(),
            PlanetEnum::VENUS(),
            PlanetEnum::EARTH(),
            PlanetEnum::MARS(),
            PlanetEnum::JUPITER(),
            PlanetEnum::SATURN(),
            PlanetEnum::URANUS(),
            PlanetEnum::NEPTUNE()
        ];

        return [
            [self::MOCK_NAMESPACE . '\ColorEnum', $expectedColor],
            [self::MOCK_NAMESPACE . '\ExtendedColorEnum', $expectedExtColor],
            [self::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', $expectedExtExtColor],
            [self::MOCK_NAMESPACE . '\SingletonEnum', $expectedSingleton],
            [self::MOCK_NAMESPACE . '\PlanetEnum', $expectedPlanet]
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function providerValuesReturnsCorrectInstances()
    {
        return [
            [self::MOCK_NAMESPACE . '\ColorEnum', self::MOCK_NAMESPACE . '\ColorEnum'],
            [self::MOCK_NAMESPACE . '\ExtendedColorEnum', self::MOCK_NAMESPACE . '\ColorEnum'],
            [self::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', self::MOCK_NAMESPACE . '\ColorEnum'],
            [self::MOCK_NAMESPACE . '\SingletonEnum', self::MOCK_NAMESPACE . '\SingletonEnum'],
            [self::MOCK_NAMESPACE . '\PlanetEnum', self::MOCK_NAMESPACE . '\PlanetEnum'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function providerGetName()
    {
        return [
            ['RED', ColorEnum::RED()],
            ['GREEN',ColorEnum::GREEN()],
            ['BLUE', ColorEnum::BLUE()],
            ['CYAN', ExtendedColorEnum::CYAN()],
            ['MAGENTA', ExtendedColorEnum::MAGENTA()],
            ['YELLOW', ExtendedColorEnum::YELLOW()],
            ['BLACK', ExtendedExtendedColorEnum::BLACK()],
            ['WHITE', ExtendedExtendedColorEnum::WHITE()],
            ['MERCURY', PlanetEnum::MERCURY()],
            ['VENUS', PlanetEnum::VENUS()],
            ['EARTH', PlanetEnum::EARTH()],
            ['MARS', PlanetEnum::MARS()],
            ['JUPITER', PlanetEnum::JUPITER()],
            ['SATURN', PlanetEnum::SATURN()],
            ['URANUS', PlanetEnum::URANUS()],
            ['NEPTUNE', PlanetEnum::NEPTUNE()]
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function providerValueOf()
    {
        return [
            ['RED', self::MOCK_NAMESPACE . '\ColorEnum', ColorEnum::RED()],
            ['GREEN', self::MOCK_NAMESPACE . '\ColorEnum', ColorEnum::GREEN()],
            ['BLUE', self::MOCK_NAMESPACE . '\ColorEnum', ColorEnum::BLUE()],
            ['CYAN', self::MOCK_NAMESPACE . '\ExtendedColorEnum', ExtendedColorEnum::CYAN()],
            ['MAGENTA', self::MOCK_NAMESPACE . '\ExtendedColorEnum', ExtendedColorEnum::MAGENTA()],
            ['YELLOW', self::MOCK_NAMESPACE . '\ExtendedColorEnum', ExtendedColorEnum::YELLOW()],
            ['BLACK', self::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', ExtendedExtendedColorEnum::BLACK()],
            ['WHITE', self::MOCK_NAMESPACE . '\ExtendedExtendedColorEnum', ExtendedExtendedColorEnum::WHITE()],
            ['INSTANCE', self::MOCK_NAMESPACE . '\SingletonEnum', SingletonEnum::INSTANCE()],
            ['MERCURY', self::MOCK_NAMESPACE . '\PlanetEnum', PlanetEnum::MERCURY()],
            ['VENUS', self::MOCK_NAMESPACE . '\PlanetEnum', PlanetEnum::VENUS()],
            ['EARTH', self::MOCK_NAMESPACE . '\PlanetEnum', PlanetEnum::EARTH()],
            ['MARS', self::MOCK_NAMESPACE . '\PlanetEnum', PlanetEnum::MARS()],
            ['JUPITER', self::MOCK_NAMESPACE . '\PlanetEnum', PlanetEnum::JUPITER()],
            ['SATURN', self::MOCK_NAMESPACE . '\PlanetEnum', PlanetEnum::SATURN()],
            ['URANUS', self::MOCK_NAMESPACE . '\PlanetEnum', PlanetEnum::URANUS()],
            ['NEPTUNE', self::MOCK_NAMESPACE . '\PlanetEnum', PlanetEnum::NEPTUNE()]
        ];
    }
}
