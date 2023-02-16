<?php

// tasks with time

echo "Tasks with time </br>";
echo time() . "</br>";

echo strtotime('01-03-2025') . "</br>";
echo strtotime("01 March 2025") . "</br>";

echo mktime(0, 0, 0, 12, 31, date('Y')) . "</br>";

echo time() - mktime(13, 12, 59, 03, 15, 2000) . "</br>";

function countHours()
{
    return (int) abs((mktime(7, 23, 48, date('m'), date('d'), date('Y')) - time()) / 3600);
}

echo countHours() . "</br>";

// tasks with date

echo "</br>";
echo "Tasks with date </br>";

// 1

echo date('Y-m-d h:i:s') . "</br>";
echo date('Y-m-d') . "</br>";
echo date('d.m.Y') . "</br>";
echo date('d.m.y') . "</br>";
echo date('h:i:s') . "</br>";

// 2

echo date('d.m.Y', mktime(0, 0, 0, 2, 12, 2025)) . "</br>";

// 3

$week = array(
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday',
    7 => 'Sunday',
);

echo $week[date('w')] . "</br>";

function getNumberWeekDay($date)
{
    return date('w', strtotime($date));
}

$num = getNumberWeekDay('2006-06-06');
echo $week[$num] . "</br>";

$num = getNumberWeekDay('1981-10-28');
echo $week[$num] . "</br>";

// 4

$months = array(
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December',
);

echo $months[idate('m')] . "</br>";

// 5

echo date('t') . "</br>";

// 6

function changeDateFormat($str)
{
    return date('d-m-Y', strtotime($str));
}

echo changeDateFormat('2025-12-31') . "</br>";

// 7

$dateStr = '2025-12-31';

$date = date_create($dateStr);
date_modify($date, '+2 days');
date_modify($date, '+1 month 3 days');
date_modify($date, '+1 year');
date_modify($date, '-3 days');

echo date_format($date, 'Y-m-d') . "</br>";

// 8

function countDaysToNewYear()
{
    $newYear = mktime(0, 0, 0, 12, 31, date('Y'));
    $today = time();
    $diff = $newYear - $today;
    if ($diff < 0) {
      $diff = 0;
    }
    return floor($diff / 60 / 60 / 24) . " days left until New Year";
}

echo countDaysToNewYear() . "</br>";

// 9

function getWeekDay100DaysAgo() {
  $date = strtotime("-100 day");
  return date('l', $date);
}

echo getWeekDay100DaysAgo() . "</br>";
