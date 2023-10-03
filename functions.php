<?php 
declare(strict_types=1);

function checkContactDate(string $date): bool{

    //Check if the param is a valid date
    // With explode we can split the input user date in a array of strings
    $date_array = explode("-", $date); //Output expected: ["2023", "09", "29"]

    // Check if the array has 3 elements
    if (sizeof($date_array) !== 3){
        return false;
    }

    //Assign each position value to a variable. Remember they are strings.
    $strYear = $date_array[0];
    $strMonth = $date_array[1];
    $strDay = $date_array[2];

    //Check if any of them is not numeric.
    if (!is_numeric($strYear) || !is_numeric($strMonth) || !is_numeric($strDay)){
        return false;
    }

    //Convert $date (string) in a timestamp (int) -> string to integer
    //$timestamp = strtotime($date);
    // Convert the integer $timestamp to object or associative array -> key & value
    //$dateObj = getdate($timestamp);

    // https://www.php.net/manual/es/function.getdate
    // Get the year casting string to int
    $year = (int)$strYear;
    // Get the month casting string to int
    $month = (int)$strMonth;
    // Get the day casting string to int
    $day = (int)$strDay;

    //Check if year is in range 1900-2100
    if ($year<1900 || $year>2100) {
        return false;
    }

    //Check if month is in range 1-12
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
    //is leap year. Take into account that a year divisible by 100 is not a leap year unless it is divisible by 400
    if ($year%4 === 0 && $year%100 !== 0 || $year%400 === 0) {
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
    $differenceOfDays = $dayOfYearBirthday - $dayOfYearToday;

    //Check if the difference of days is less than 0, revert the days until next birthday
    if ($differenceOfDays < 0) {$differenceOfDays += 365;}

    return $differenceOfDays;

}

// In order to make optional ?array $header we must asign default null value
function showStudentsTable(array $data, ?array $header = null){
    //Through echo tag build html structure as we want.
     echo "<table>";
     echo "<thead>";
     echo "<tr>";
     //Check if the number of args we put into the function is one or two
     if (func_num_args() === 2){
         echo "<th>".$header[0]."</th>";
         echo "<th>".$header[1]."</th>";
         echo "<th>".$header[2]."</th>";
     } else {
         echo "<th>ID</th>";
         echo "<th>Name</th>";
         echo "<th>Grade</th>";
     }
     echo "</tr>";
     echo "</thead>";
     echo "<tbody>";
     //Per each student row we print their data into html string tags
     foreach ($data as $student) {
         echo "<tr>";
         echo "<td>" . $student["id"] . "</td>";
         echo "<td>" . $student["name"] . "</td>";
         if ($student["grade"] < 5) {
             echo "<td class='grade-ko'>" . $student["grade"] . "</td>";
         } else {
             echo "<td class='grade-ok'>" . $student["grade"] . "</td>";
         }
         echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
 }

 function showTable(array $data, ?array $header = null){
    //Through echo tag build html structure as we want.
     echo "<table>";
     echo "<thead>";
     echo "<tr>";
     //Check if the number of args we put into the function is one or two
     if (func_num_args() === 2){
        foreach ($header as $value){
            echo "<th>".$value."</th>";
        }
     } else {
        //Accessing an interior element of the array
        $firstItem = $data[0];
        foreach ($firstItem as $key => $value){
            echo "<th>".$key."</th>";
        }
     }
     echo "</tr>";
     echo "</thead>";
     echo "<tbody>";


     //Per each student row we print their data into html string tags
     foreach ($data as $item) {
        //Transform associative array to a indexed array
        $values = array_values($item);
        echo "<tr>";
        //Iterate over indexed array to get the value for each cell of the row
        foreach ($values as $value){
            echo "<td>".$value."</td>";
        }
        echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
 }

?>

