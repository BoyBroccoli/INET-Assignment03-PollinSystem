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
    include 'config/config.php';

    // creating database object and connecting to pollingDB
    $conn = CONNECT_MYSQL();

    $sql = "SELECT * FROM candidate";

    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        // output data for each row
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["candidateId"] . " Name: " . $row["fName"] . " " . $row["lName"] . "<br>";
        }
    } else {
        echo "0 results";
    }
    // closing connection
    $conn->close();
?>

</body>
</html>

