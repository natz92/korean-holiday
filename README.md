# Korean-Holiday
Simple korean holiday data.

## Setup
```bash
composer require natz92/korean-holiday
```

## Manual
```php
use Korean\Holiday\KoreanHolidays;

$holiday = new KoreanHolidays();
$holiday->isHoliday('2019-05-05'); // return true
$holiday->getHoliday('2019-06-06'); // return Holiday Data
$holiday->getHolidayForYear(2019); // return all Holidays in 2019
```

## Note
- Support : 2015 ~ 2019 (before 2014, coming soon!)
