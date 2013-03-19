<?php
namespace FlorianWolters\Mock;

use FlorianWolters\Component\Core\Enum\EnumAbstract;

/**
 * The enumeration class {@see PlanetEnum} demonstrates the following usage of
 * **FlorianWolters\Component\Core\Enum**:
 *
 * * Functional enumeration.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.2.0
 */
final class PlanetEnum extends EnumAbstract
{
    /**
     * The universal gravitational constant.
     *
     * @var float
     */
    const G = 6.67300e-11;

    /**
     * The mass of this planet in kilograms.
     *
     * @var float
     */
    private $mass;

    /**
     * The radius of this planet in meters.
     *
     * @var float
     */
    private $radius;

    // @codingStandardsIgnoreStart

    /**
     * The planet mercury.
     *
     * @return PlanetEnum The planet mercury.
     */
    final public static function MERCURY()
    {
        return self::getInstance(3.303e23, 2.4397e6);
    }

    /**
     * The planet venus.
     *
     * @return PlanetEnum The planet venus.
     */
    final public static function VENUS()
    {
        return self::getInstance(4.869e24, 6.0518e6);
    }

    /**
     * The planet earth.
     *
     * @return PlanetEnum The planet earth.
     */
    final public static function EARTH()
    {
        return self::getInstance(5.976e24, 6.37814e6);
    }

    /**
     * The planet mars.
     *
     * @return PlanetEnum The planet mars.
     */
    final public static function MARS()
    {
        return self::getInstance(6.421e23, 3.3972e6);
    }

    /**
     * The planet jupiter.
     *
     * @return PlanetEnum The planet jupiter.
     */
    final public static function JUPITER()
    {
        return self::getInstance(1.9e27, 7.1492e7);
    }

    /**
     * The planet saturn.
     *
     * @return PlanetEnum The planet saturn.
     */
    final public static function SATURN()
    {
        return self::getInstance(5.688e26, 6.0268e7);
    }

    /**
     * The planet uranus.
     *
     * @return PlanetEnum The planet uranus.
     */
    final public static function URANUS()
    {
        return self::getInstance(8.686e25, 2.5559e7);
    }

    /**
     * The planet neptune.
     *
     * @return PlanetEnum The planet neptune.
     */
    final public static function NEPTUNE()
    {
        return self::getInstance(1.024e26, 2.4746e7);
    }

    // @codingStandardsIgnoreEnd

    /**
     * Constructs a new planet with the specified mass and the specified radius.
     *
     * The name of the constructor of a functional enumeration is `construct` by
     * convention and must have the visibility `protected` or `private`.
     *
     * @param float $mass   The mass in kilograms.
     * @param float $radius The radius in meters.
     */
    protected function construct($mass, $radius)
    {
        $this->mass = $mass;
        $this->radius = $radius;
    }

    /**
     * Returns the mass of this planet.
     *
     * @return float The mass in kilograms.
     */
    public function getMass()
    {
        return $this->mass;
    }

    /**
     * Returns the radius of this planet.
     *
     * @return float The radius in meters.
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Calculates and returns the surface gravity of this planet.
     *
     * @return float The surface gravity.
     */
    public function surfaceGravity()
    {
        return ((self::G * $this->mass) / ($this->radius * $this->radius));
    }

    /**
     * Calculates and returns the surface weight of this planet.
     *
     * @param float $otherMass Another mass in kilograms.
     *
     * @return float The surface weight.
     */
    public function surfaceWeight($otherMass)
    {
        return ($this->surfaceGravity() * $otherMass);
    }
}
