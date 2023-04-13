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

            // storing current userId
            $userId = $_SESSION["user_id"];
             
            // calling method to update user candidate vote
            voteForCandidate($conn, $userId, $candidateId);

        } else {
            echo "Vote not set!";
        }
    }
?>