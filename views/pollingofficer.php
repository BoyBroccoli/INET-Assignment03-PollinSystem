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
            <form action="" method="post">
                <div class="row">
                    <div class="col">
                        <input type="submit" id="showCandidatesBtn" name="showCandidatesBtn"
                            value="Show All Candidates" />
                    </div>
                    <div class="col">
                        <input type="submit" id="addCandidateBtn" name="addCandidateBtn"
                            value="Add New Candidate" />
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" id="updateCandidateBtn" name="updateCandidateBtn"
                            value="Update a Candidate" />
                    </div>
                    <div class="col">
                        <input type="submit" id="deleteCandidateBtn" name="deleteCandidateBtn"
                            value="Delate a Candidate" />
                    </div>
                </div>
            </form>
            
        </div>


        <br>

        <div class="container">
            <h2>User Operations</h2>
            
                <form id="userOperations" method="post">
                    <div class="row">
                        <div class="col">
                            <input type="submit" id="showUsersBtn" name="showUsersBtn"
                                value="See All Users" />
                        </div>
                        <div class="col">
                            <input type="submit" id="addUserBtn" name="addUserBtn"
                                value="Add New User" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" id="updateUserBtn" name="updateUserBtn"
                                value="Update a User" />
                        </div>
                        <div class="col">
                            <input type="submit" id="deleteUserBtn" name="deleteUserBtn"
                                value="Delate a User" />
                        </div>
                    </div>
                </form>
                
        </div>

        <!-- for candidate operations -->
        <?php

            // functionality for show CandidatesBtn
            if (isset($_POST['showCandidatesBtn'])) {

                showCandidatesBtn($conn);
            }

            // functionality for addCandidateBtn
            if (isset($_POST['addCandidateBtn'])) {
                addNewCandidateBtnForm();
            }

            // functionality for updateCandidateBtn
            if (isset($_POST['updateCandidateBtn'])) {

            }

            // functionality for deleteCandidateBtn
            if (isset($_POST['deleteCandidateBtn'])) {

            }
        ?>

        <!-- for user operations -->
        <?php

                // functionality for showUsersBtn
                if (isset($_POST['showUsersBtn'])) {

                    showUsersBtn($conn);
                }

                // functionality for addUserBtn
                if (isset($_POST['addUserBtn'])) {

                    echo addNewUserBtnForm();
                }

                // functionality for updateUserBtn
                if (isset($_POST['updateUserBtn'])) {

                }

                // functionality for deleteUserBtn
                if (isset($_POST['deleteUserBtn'])) {

                }
        ?>

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
