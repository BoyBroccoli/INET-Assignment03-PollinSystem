<?php 

    include_once '../config/config.php';

    // creating connection
    $conn = CONNECT_MYSQL();


    // 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['candidateChoice'])) {
            // restarting session
            session_start();
            session_regenerate_id(); // makes the session less vulnerable

            // storing candidateId
            $candidateId = $_POST['candidateChoice'];

                         
            // calling method to update user candidate vote
            deleteCandidate($conn, $candidateId);
            header("Location: ../views/pollingofficer.php");
            exit;

        } else {
            echo "Choice not set!";
        }
    }
?>