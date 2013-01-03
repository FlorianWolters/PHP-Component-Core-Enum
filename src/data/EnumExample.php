<?php
namespace FlorianWolters\Component\Core\Enum;

use FlorianWolters\Mock\PlanetEnum;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * A simple command line application to demonstrate functional enumerations with
 * **FlorianWolters\Component\Core\Enum**.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.4.0
 */
final class EnumExample
{
    /**
     * @param integer $argc
     * @param array   $argv
     *
     * @return integer
     */
    public static function main($argc, array $argv = [])
    {
        if (2 !== $argc) {
            echo "Usage: php EnumExample <earth_weight>" . \PHP_EOL;
            return -1;
        }

        $earthWeight = (float) $argv[1];
        $mass = $earthWeight / PlanetEnum::EARTH()->surfaceGravity();

        $format = "Your weight on %s is %f" . \PHP_EOL;
        foreach (PlanetEnum::values() as $planet) {
            $surfaceWeight = $planet->surfaceWeight($mass);
            \printf($format, $planet, $surfaceWeight);
        }

        return 0;
    }
}

exit(EnumExample::main($argc, $argv));
