<?php

namespace Korean\Holiday;

use Carbon\Carbon;
use Korean\Holiday\Exceptions\NotFoundYearDataException;
use Korean\Holiday\Property\HolidayInfo;
use Symfony\Component\Yaml\Yaml;

class KoreanHolidays
{
    private $date;
    private $holidays;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->date = Carbon::now();
        $this->holidays = [];
    }

    /**
     * @param string|null $date
     * @return bool
     * @throws NotFoundYearDataException
     */
    public function isHoliday(string $date = null): bool
    {
        $this->setDate($date);
        $this->getHolidayForYear($this->date->year);

        return array_key_exists($this->date->format('Y-m-d'), $this->holidays[$this->date->year]) ? true : false;
    }

    /**
     * @param string $date
     */
    private function setDate(string $date = null)
    {
        if ($date !== null) {
            $date = strtotime($date);
            $this->date = Carbon::createFromTimestamp($date);
        }
    }

    /**
     * @param string|null $date
     * @return HolidayInfo|null
     * @throws NotFoundYearDataException
     */
    public function getHoliday(string $date = null)
    {
        return $this->isHoliday($date) ? $this->holidays[$this->date->year][$this->date->format('Y-m-d')] : null;
    }

    /**
     * @param int $year
     * @return HolidayInfo[]
     * @throws NotFoundYearDataException
     */
    public function getHolidayForYear(int $year = null)
    {
        $this->storeHolidayForYear($year);
        return $this->holidays[$this->date->year];

    }

    /**
     * @param int|null $year
     * @throws NotFoundYearDataException
     */
    private function storeHolidayForYear(int $year = null)
    {
        if ($year === null) {
            $year = $this->date->year;
        } else {
            $year = Carbon::createFromDate($year)->year;
        }

        if (file_exists(__DIR__ . '/date/' . $year . '.yml') === false) {
            throw new NotFoundYearDataException();
        }

        $holidays = file_get_contents(__DIR__ . '/date/' . $year . '.yml');
        $holidays = Yaml::parse($holidays);

        foreach ($holidays as $date => $row) {
            $this->holidays[$year][$date] = new HolidayInfo($date, $row['name']);
        }
    }
}