<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assignment</title>
</head>
<body>

<?php
    include("../../config/config.php");

    // creating database object and connecting to pollingDB
    $conn = CONNECT_MYSQL();

    // calling function
        echo SELECT_EVERYTHING_FROM_CANDIDATE($conn);

    // calling function to insert
        $name = "john";
        $lname = "doe";

        // retrieving
        echo SELECT_EVERYTHING_FROM_CANDIDATE($conn);


    // closing connection
    $conn->close();
?>

</body>
</html>

