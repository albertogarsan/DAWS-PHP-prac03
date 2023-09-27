<?php 
declare(strict_types=1);

function checkContactDate(string $date): bool{

    //Convert $date (string) in a timestamp (int) -> string to integer
    $timestamp = strtotime($date);
    // Convert the integer $timestamp to object or associative array -> key & value
    $dateObj = getdate($timestamp);

    // https://www.php.net/manual/es/function.getdate
    // Get the year 1900-2023
    $year = $dateObj["year"];
    // Get the month 1-12
    $month = $dateObj["mon"];
    // Get the day 1-31
    $day = $dateObj["mday"];

    //Check if year is in range
    if ($year<1900 || $year>2100) {
        return false;
    }

    //Check if month is in range
    if ($month<1 || $month>12) {
        return false;
    }

    //Check if the month is  1, 3, 5, 7, 8, 10, 12 and if the day is less than 1 and greater than 31 = error
    if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
        if ($day<1 || $day>31) {
            return false;
        }
    }

    //Check if the month is  4, 6, 9, 11 and if the day is less than 1 and greater than 30 = error
    if ($month == 4 || $month == 6 || $month == 9 || $month == 11){
        if ($day<1 || $day>30) {
            return false;
        }
    }

    //Check if the month is Febrary and the year is a leap year and if the day is less than 1 and greater than 29 = error
    if ($month===2 && leapYear($year)) {
        if ($day<1 || $day>29){
            return false;
        }
    }
    //Check if the month is Febrary and the year is not leap year and if the day is less than 1 and greater than 28 = error
    if ($month===2 && !leapYear($year)) {
        if ($day<1 || $day>28){
            return false;
        }
    }
    
    //If all checkings are false, the date will be true!!
    return true;
};

/**
 * Check true or false if the param is leap year or not
 * 
 * @param int $year 
 * @return bool 
 */
function leapYear(int $year): bool{
    //is leap year
    if ($year%4 === 0) {
        return true;
    } 
    //not leap year
    return false;
}

// Same but with date()
function leapYear2(int $year): bool {
    //Convert int to timestamp
    $yearTS = strtotime("$year-01-01");
    if (date("L", $yearTS) === "1"){
        return true;
    }
    return false;
}


function checkBirthday(string $birthday) : int|null{

    //First, check if the date is valid with the function above
    $checkedBirthday = checkContactDate($birthday);

    // If it is not valid return null
    if (!$checkedBirthday) {
        return null;
    }

    //After checked, we convert $birthday (string) in a timestamp (int) -> string to integer
    $birthayTimestamp = strtotime($birthday);
    $todayDate = strtotime("now");

    //The function date return the number of days since first of january regardless of the year.
    $dayOfYearBirthday = date("z", $birthayTimestamp);
    $dayOfYearToday = date("z", $todayDate);

    //Do the rest of the days
    $differenceOfDays = $dayOfYearToday - $dayOfYearBirthday;

    //Check if the difference of days is less than 0, revert the days until next birthday
    if ($differenceOfDays < 0) {$differenceOfDays += 365;}

    return $differenceOfDays;

}

?>

