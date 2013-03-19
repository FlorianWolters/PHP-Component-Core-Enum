<?php
namespace FlorianWolters\Component\Core\Enum;

use FlorianWolters\Mock\DayEnum;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * The class {@see DayEnumExample} implements a simple command line application
 * to demonstrate simple enumerations with the component
 * **FlorianWolters\Component\Core\Enum**.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Enum
 * @since     Class available since Release 0.4.0
 */
final class DayEnumExample
{
    /**
     * @var DayEnum
     */
    private $day;

    /**
     * @param DayEnum $day
     */
    public function __construct(DayEnum $day)
    {
        $this->day = $day;
    }

    /**
     * @return void
     */
    public function tellItLikeItIs()
    {
        switch ($this->day) {
            case DayEnum::MONDAY():
                print("Mondays are bad.\n");
                break;
            case DayEnum::FRIDAY():
                print("Fridays are better.\n");
                break;
            case DayEnum::SATURDAY():
            case DayEnum::SUNDAY():
                print("Weekends are best.\n");
                break;
            default:
                print("Midweek days are so-so.\n");
                break;
        }
    }

    /**
     * Runs this {@see DayEnumExample}.
     *
     * @param integer  $argc The number of arguments.
     * @param string[] $argv The arguments.
     *
     * @return integer Always `0`.
     */
    public static function main($argc, array $argv = [])
    {
        $firstDay = new self(DayEnum::MONDAY());
        $firstDay->tellItLikeItIs();
        $thirdDay = new self(DayEnum::WEDNESDAY());
        $thirdDay->tellItLikeItIs();
        $fifthDay = new self(DayEnum::FRIDAY());
        $fifthDay->tellItLikeItIs();
        $sixthDay = new self(DayEnum::SATURDAY());
        $sixthDay->tellItLikeItIs();
        $seventhDay = new self(DayEnum::SUNDAY());
        $seventhDay->tellItLikeItIs();

        return 0;
    }
}

exit(DayEnumExample::main($argc, $argv));
