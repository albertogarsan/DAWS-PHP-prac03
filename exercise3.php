<?php
require("functions.php");

    $students = array(
        array("id" => 101, "name" => "Mike Molina", "grade" => 5),
        array("id" => 102, "name" => "Mery Jane Smith", "grade" => 8),
        array("id" => 104, "name" => "Arthur McFly", "grade" => 4),
        array("id" => 112, "name" => "Lory Grimes", "grade" => 1),
        array("id" => 120, "name" => "Carla Fontana", "grade" => 6),
        array("id" => 121, "name" => "Abdul Bahar", "grade" => 10)
    );
 
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 3</title>
    <link rel="stylesheet" href="<?php echo "style.css"; ?>">
</head>

<body>
    <section>
        <!-- Call the function to execute the code-->
        <?php showStudentsTable($students); ?>
    </section>


</body>

</html>