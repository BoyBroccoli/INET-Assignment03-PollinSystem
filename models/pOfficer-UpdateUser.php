<?php 

    include_once '../config/config.php';

    // creating connection
    $conn = CONNECT_MYSQL();


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['userChoice'])) {
            // restarting session
            session_start();
            session_regenerate_id(); // makes the session less vulnerable

            // storing userId
            $userId = $_POST['userId'];
            $firstName= mysqli_escape_string($conn, $_POST['fName']);
            $lastName= mysqli_escape_string($conn, $_POST['lName']);
            $email= mysqli_escape_string($conn, $_POST['email']);
            $userName= mysqli_escape_string($conn, $_POST['userName']);

                         
            // calling method to update user candidate vote
            updateUser($conn, $userId, $firstName, $lastName, $email, $userName);
            // header("Location: ../views/pollingofficer.php");
            exit;

        } else {
            echo "Choice not set!";
        }
    }
?>