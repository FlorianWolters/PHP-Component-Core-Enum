<?php
namespace FlorianWolters\Mock;

use FlorianWolters\Component\Core\Enum\EnumAbstract;

/**
 * The {@link PlanetEnum} enumeration demonstrates the following usage of
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
     * The universal gravitational constant (m3 kg-1 s-2).
     *
     * @var float
     */
    const G = 6.67300E-11;

    /**
     * The mass of this Planet in kilograms.
     *
     * @var float
     */
    private $mass;

    /**
     * The radius of this Planet in meters.
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
        $self = self::getInstance();
        $self->mass = 3.303e+23;
        $self->radius = 2.4397e6;

        return $self;
    }

    /**
     * The planet venus.
     *
     * @return PlanetEnum The planet venus.
     */
    final public static function VENUS()
    {
        $self = self::getInstance();
        $self->mass = 4.869e+24;
        $self->radius = 6.0518e6;

        return $self;
    }

    /**
     * The planet earth.
     *
     * @return PlanetEnum The planet earth.
     */
    final public static function EARTH()
    {
        $self = self::getInstance();
        $self->mass = 5.976e+24;
        $self->radius = 6.37814e6;

        return $self;
    }

    // @codingStandardsIgnoreEnd

    /**
     * Calculates and returns the surface gravity of this planet.
     *
     * @return float The surface gravity.
     */
    public function surfaceGravity()
    {
        return self::G * $this->mass / ($this->radius ^ 2);
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
        return $otherMass * $this->surfaceGravity();
    }
}
