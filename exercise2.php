<?php
    require("functions.php");

    $differenceOfDays = checkBirthday("1995-10-02");

    if ($differenceOfDays >= 0 && $differenceOfDays < 1) {
        //if today's day is equal to birthdate then you have your b-day! :)
        echo "<p>Today is your birthday 🎂</p>";
    }
    elseif ($differenceOfDays >= 1 && $differenceOfDays <= 7) {
        echo "<p>There are $differenceOfDays days left for your birthday</p>";
    } 
    else {
        echo "<p>There are $differenceOfDays days left for your birthday</p>";
    }
?>