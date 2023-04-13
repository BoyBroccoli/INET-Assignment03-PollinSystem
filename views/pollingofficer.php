<?php

    $title = "Home | Polling Officer";
    include_once("../config/config.php");
    include_once("../src/inc/headerTemplate.php");
    // will either start a new session or resume and existing one. sent here after login successful
    session_start();

    // checking the session and storing the users info in result set

    if (isset($_SESSION["user_id"])) {

        $conn = CONNECT_MYSQL();

        $sql = "SELECT * FROM user WHERE userID = {$_SESSION["user_id"]}";

        // storing in result obj
        $result = $conn->query($sql);

        $user = $result->fetch_assoc();
    }
    // can store values in session super global
   // print_r($_SESSION);
?>


    
    <?php if (isset($user)) : ?>

        <h1>Polling Officer, You are Logged in!</h1>

        <div class="container">
            <h2>Candidate Operations</h2>
            <div class="row">
                <div class="col">
                    <button type="button" id="showCandidatesBtn"
                        class="btn btn-outline-primary btn-lg">See All Candidates</button>
                </div>
                <div class="col">
                    <button type="button" id="addCandidateBtn"
                        class="btn btn-outline-success btn-lg">Add New Candidate</button>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="button" id="updateCandidateBtn"
                        class="btn btn-outline-warning btn-lg">Update a Candidate</button>
                </div>
                <div class="col">
                    <button type="button" id="deleteCandidateBtn"
                        class="btn btn-outline-danger btn-lg">Delate a Candidate</button>
                </div>
            </div>
        </div>

        <br>

        <div class="container">
            <h2>User Operations</h2>
            <div class="row">
                <div class="col">
                    <button type="button" id="showUsersBtn"
                        class="btn btn-outline-primary btn-lg">See All Users</button>
                </div>
                <div class="col">
                    <button type="button" id="addUserBtn"
                        class="btn btn-outline-success btn-lg">Add New User</button>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="button" id="updateUserBtn"
                        class="btn btn-outline-warning btn-lg">Update a User</button>
                </div>
                <div class="col">
                    <button type="button" id="deleteUserBtn"
                        class="btn btn-outline-danger btn-lg">Delate a User</button>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>
                <a href="../views/logout.php">Logout</a>
            </p>
        </div>




    <?php else:
        header("Location: ./login.php");
        endif;
        exit;
    ?>
</body>
</html>