<?php
/**
 * Created by PhpStorm.
 * User: natz
 * Date: 19. 3. 1
 * Time: 오전 12:13
 */

namespace Korean\Holiday\Property;

use Carbon\Carbon;

/**
 * Class HolidayInfo
 * @package Korean\Holiday\Property
 */
class HolidayInfo
{
    private $name;
    private $date;

    public function __construct($date, string $name)
    {
        $this->date = Carbon::createFromDate($date);
        $this->name = $name;
    }

    public function getDate()
    {
        return $this->date->toDateString();
    }

    public function getMonth()
    {
        return $this->date->month;
    }

    public function getDay()
    {
        return $this->date->day;
    }

    public function getWeekDay()
    {
        return $this->date->weekday();
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Carbon|\Carbon\CarbonInterface
     */
    public function getCarbon()
    {
        return $this->date;
    }
}