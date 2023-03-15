<!-- This file will store the database obj method -->

<?php

// FUNCTION TO CREATE MYSQLI DATABASE OBJ
    function CONNECT_MYSQL()
    {

        $serverName = "localhost";
        $username = "adminPollingOfficer";
        $password = "p@ssw0rd";
        $dbname = "finalproject-pollingsystem";

        try {
            // Creating Connection
            $conn = new mysqli($serverName,$username,$password,$dbname);

            // Checking Connection
            if ($conn->connect_error){
                die("Connection Failed: " .$conn->connect_error);
            } else {
                echo "Connection Success";
                return $conn;
            }

        } catch (mysqli_sql_exception $exception) {
            // If there is an error with the connection
            die("Connection Failed: " . $conn->connect_error); // Exit connection and print error strin
        }

    }

?>

