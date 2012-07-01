<?php
/**
 * `PlanetEnum.php`
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
 * @author     Florian Wolters <wolters.fl@gmail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @version    GIT: $Id$
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      File available since Release 0.2.0
 */

declare(encoding = 'UTF-8');

namespace FlorianWolters\Component\Core\Enum;

/**
 * The {@link PlanetEnum} enumeration demonstrates the following usage of
 * **fw\Component\Core\Enum**:
 *
 * * Functional enumeration.
 *
 * @category   Test
 * @package    Core
 * @subpackage Enum
 * @author     Florian Wolters <wolters.fl@gmail.com>
 * @copyright  2011-2012 Florian Wolters
 * @license    http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @version    Release: @package_version@
 * @link       http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since      Class available since Release 0.2.0
 */
final class PlanetEnum extends EnumAbstract
{
    // @codingStandardsIgnoreStart

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
    private $_mass;

    /**
     * The radius of this Planet in meters.
     *
     * @var float
     */
    private $_radius;

    /**
     * The planet mercury.
     *
     * @return PlanetEnum The planet mercury.
     */
    final public static function MERCURY()
    {
        $self = self::getConstant();
        $self->_mass = 3.303e+23;
        $self->_radius = 2.4397e6;

        return $self;
    }

    /**
     * The planet venus.
     *
     * @return PlanetEnum The planet venus.
     */
    final public static function VENUS()
    {
        $self = self::getConstant();
        $self->_mass = 4.869e+24;
        $self->_radius = 6.0518e6;

        return $self;
    }

    /**
     * The planet earth.
     *
     * @return PlanetEnum The planet earth.
     */
    final public static function EARTH()
    {
        $self = self::getConstant();
        $self->_mass = 5.976e+24;
        $self->_radius = 6.37814e6;

        return $self;
    }

    /**
     * Calculates and returns the surface gravity of this planet.
     *
     * @return float The surface gravity.
     */
    public function surfaceGravity()
    {
        return self::G * $this->_mass / ($this->_radius ^ 2);
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

    // @codingStandardsIgnoreEnd
}
