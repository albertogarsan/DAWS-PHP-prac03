
<?php
    require("functions.php");

    //Call the function
    $result1 = checkContactDate("2022-04-23");
    $result2 = checkContactDate("2700-02-10");

    //Do ternari operator to print the boolean variable $result
    echo "Result 1: " . ($result1 ? "True" : "False")."<br>";
    echo "Result 2: ".($result2 ? "True" : "False");
?>