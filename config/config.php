<?php
// This file will store the database obj method

// FUNCTION TO CREATE MYSQLI DATABASE OBJ
    function CONNECT_MYSQL()
    {

        $serverName = "localhost";
        $username = "adminPollingOfficer";
        $password = "p@ssw0rd";
        $dbname = "finalproject-pollingsystem";

        try {
            // Creating Connection
            $conn = new mysqli($serverName, $username, $password, $dbname);

            // Checking Connection
            if ($conn->connect_error) {
                die("Connection Failed: " .$conn->connect_error);
            } else {

                return $conn;
            }

        } catch (mysqli_sql_exception $exception) {
            // If there is an error with the connection
            die("Connection Failed: " . $conn->connect_error); // Exit connection and print error strin
        }

    }

    // function that takes in a mySQL obj, returns * from candidate table
    function SELECT_EVERYTHING_FROM_CANDIDATE(&$conn)
    {
        $tableName = 'candidate';

        $sql = "SELECT * FROM " . $tableName;

        $result = $conn->query($sql);

        ?>
        <form action="../models/voteForCandidate.php" method="post">

        
        <?php

        if ($result->num_rows > 0) {
            // for each to show each applicant
            foreach ($result as $candidate)
            {
                // closing php and echoing inside html table data
                ?>
                <tr>
                    <td><?= $candidate['fName'] ." ". $candidate['lName']?></td>
                    <td><?= $candidate['slogan']?></td>
                    <td><!-- radio buttons for candidates storing candidateid-->
                        <input type="radio" id="candidateChoice"  name="candidateChoice"
                          value="<?= $candidate['candidateId']?>" required>
                    </td>                    
                </tr>
                <?php              
            }

            ?>
            <input type="submit" value="Vote!" id="submitBtn">
            </form>
            <?php
            
        } else {
            echo "0 results";
        }

        $conn->close();
    }

    // function that takes in a mysql obj, returns * from user table
    function SELECT_EVERYTHING_FROM_USER(&$conn)
    {
        $tableName = 'user';

        $sql = "SELECT * FROM " . $tableName;

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data for each row
            while ($row = $result->fetch_assoc()) {
                echo "id: " . $row["userID"] . " Name: " . $row["fName"] . " "
                . $row["lName"] . " " . "userName: " . $row["userName"] . "pwordHash: " . $row["password_hash"]."<br>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
    }

    // function that updates the users voted for candidate
    function voteForCandidate(&$conn, $userId, $candidateId)
    {
        $sql = "UPDATE user SET candidateId ='" . $candidateId . "' ,hasVoted = '1' WHERE userID =" . $userId;

        if ($conn->query($sql) === TRUE) {

            // redirect to a new page
            header("Location: ../views/hasVotedPage.php");
        } else {
            
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();

    }

    function showCandidatesBtn(&$conn)
    {
        $tableName = 'candidate';

        $sql = "SELECT * FROM " . $tableName;

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            ?>

            <table class="table table-bordered table-striped table-hover">
                <!-- table head -->
                <thead>
                    <!-- table row -->
                    <tr>
                        <!-- table column headings -->
                        <th id="candidateName">Candidate Name</th>
                        <th id="candidateSlogan">Candidate Slogan</th>                        
                    </tr>
                </thead>

            <?php
            // for each to show each applicant

            foreach ($result as $candidate)
            {

                ?>
                
                <!-- table body -->
                <tbody>
                    <td><?= $candidate['fName'] ." ". $candidate['lName']?></td>
                    <td><?= $candidate['slogan']?></td>
                </tbody>
 
            <?php
            }

            ?>
            </table>
            <?php
        } else {
            echo "0 results";
        }

        $conn->close();
    }


    function showUsersBtn(&$conn)
    {
        
        $sql = "SELECT user.userName, candidate.candidateId, candidate.fName, candidate.lName
                    FROM user
                    INNER JOIN candidate on candidate.candidateId = user.candidateId";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            ?>

            <table class="table table-bordered table-striped table-hover">
                <!-- table head -->
                <thead>
                    <!-- table row -->
                    <tr>
                        <!-- table column headings -->
                        <th id="userName">User Name</th>
                        <th id="userVote">User Voted For</th>
                        
                    </tr>
                </thead>

            <?php
            // for each to show each applicant

            foreach ($result as $user)
            {

                ?>
                
                <!-- table body -->
                <tbody>
                    <td><?= $user['userName']?></td>
                    <td><?= $user['fName'] . " " . $user['lName']?></td>
                    
                </tbody>
 
            <?php
            
            }
            
            ?>
            </table>
            <?php
        } else {
            echo "0 results";
        }

        $conn->close();
    }

    function addNewUserBtnForm()
    {
        ?>
        <form action="../models/pOfficer-AddUser.php" method="post" id="addUser" novalidate>
            <div class="container">
                <h1 class="text-center">Add a New User</h1>
                <div class="row mb-3">
                    <div class="col-6">
                        <!-- User Name Entry for Form -->
                        <label for="userName" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="userName" id="userName"
                        placeholder="Input desired username" autocomplete="off">
                    </div>
                        <!-- Email Entry for Form -->
                    <div class="col">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email"
                    placeholder="email@example.com" autocomplete="off">
                    </div>
                </div>
                        <!-- First Name Entry for Form -->
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="fName" class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="fName" id="fName"
                        placeholder="Enter First Name" autocomplete="off">
                    </div>
                    <!-- Last Name Entry for Form -->
                    <div class="col">
                        <label for="lName" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="lName" id="lName"
                        placeholder="Enter Last Name" autocomplete="off">
                    </div>
                </div>
                <!-- Password Entry for Form -->
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" id="password"
                        placeholder="Enter password" autocomplete="off">
                    </div>
                    <!-- Password Confirmation for Form -->
                    <div class="col">
                        <label for="password2" class="form-label">Password Again:</label>
                        <input type="password" class="form-control" name="password2" id="password2"
                        placeholder="Enter exact password again" autocomplete="off">
                    </div>
                </div>
                <!-- Terms Agreement Button -->
                <div class="row text-center mb-3">
                    <label for="agree">
                        <input type="checkbox" name="terms" id="terms" required/> I agree with the
                        <a href="#" title="term of services">term of services</a>
                    </label>
                </div>
                <!-- Submit Button -->
                <div class="mb-3 text-center">
                    <button class ="btn btn-primary" name="submit_btn" type="submit" value="Submit">Add User</button>
                </div>
            </div>
        </form>
        <?php
    }

    function addNewCandidateBtnForm()
    {
        ?>
            <form action="../models/pOfficer-AddCandidate.php" method="post" id="addUser" novalidate>
            <div class="container">
                <h1 class="text-center">Add a New Candidate</h1>
                
                        <!-- First Name Entry for Form -->
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="fName" class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="fName" id="fName"
                        placeholder="Enter First Name" autocomplete="off">
                    </div>
                    <!-- Last Name Entry for Form -->
                    <div class="col">
                        <label for="lName" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="lName" id="lName"
                        placeholder="Enter Last Name" autocomplete="off">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <!-- User Name Entry for Form -->
                        <label for="slogan" class="form-label">Slogan:</label>
                        <input type="text" class="form-control" name="slogan" id="slogan"
                        placeholder="Input Candidates Slogan" autocomplete="off">
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="mb-3 text-center">
                    <button class ="btn btn-primary" name="submit_btn" type="submit" value="Submit">Add Candidate</button>
                </div>
            </div>
        <?php
    }
    


    function updateCandidateBtn(&$conn)
    {
        ?>
            <div class="table-responsive">
                <table id="tAppUpdateDbTable" class="table table-bordered table-striped table-hover">
                    <!-- table head -->
                    <thead>
                        <!-- table row -->
                        <tr>
                            <!-- table column headings -->
                            <th id="appIdHeading">Candidate ID</th>
                            <th id="appQHeading">Candidate Full Name</th>
                            <th id="appOrigAnsHeading">Candidate Slogan</th>
                                
                        </tr>
                    </thead>
                    <!-- table body -->
                    <tbody>
                        
                    </tbody>

                </table>
            </div>
        <?php
    }

    function deleteCandidateBtnForm(&$conn)
    {
        $tableName = 'candidate';

        $sql = "SELECT * FROM " . $tableName;

        $result = $conn->query($sql);

        ?>
        <form action="../models/pOfficer-DeleteCandidate.php" method="post">
            <table id="candidateTable" class="table table-bordered table-striped table-hover">
                <!-- table head -->
                <thead>
                    <!-- table row -->
                    <tr>
                        <!-- table column headings -->
                        <th id="candidateName">Candidate Name</th>
                        <th id="candidateSlogan">Candidate Slogan</th>
                        <th id="candidateButton">Delete</th>
                    </tr>
                </thead>
        
        <?php

        if ($result->num_rows > 0) {
            // for each to show each applicant
            foreach ($result as $candidate)
            {
                // closing php and echoing inside html table data
                ?>
                <tr>
                    <td><?= $candidate['fName'] ." ". $candidate['lName']?></td>
                    <td><?= $candidate['slogan']?></td>
                    <td>
                        <input type="radio" id="candidateChoice"  name="candidateChoice"
                          value="<?= $candidate['candidateId']?>" required>
                    </td>                    
                </tr>
                <?php              
            }

            ?>
            <input type="submit" value="Delete!" id="submitBtn">
            </form>
            <?php
            
        } else {
            echo "0 results";
        }

        $conn->close();    
    }

    function deleteCandidate(&$conn, $candID)
    {
        $sql = 'DELETE FROM candidate WHERE candidateId = ' . $candID;

        if ($conn->query($sql) === TRUE) {
            echo "Candidate deleted successfully";
            header("Location: ../views/pollingofficer.php");
            $conn->close();
            exit;
        } else {
            echo "Error deleting record: " . $conn->error;
        }

    }

    function deleteUser(&$conn, $userId)
    {
        $sql = 'DELETE FROM user WHERE userId = ' . $userId;

        if ($conn->query($sql) === TRUE) {
            echo "User deleted successfully";
            header("Location: ../views/pollingofficer.php");
            $conn->close();
            exit;
        } else {
            echo "Error deleting record: " . $conn->error;
        } 
    }

    function deleteUserBtnForm(&$conn)
    {
        $tableName = 'user';

        $sql = "SELECT * FROM " . $tableName;

        $result = $conn->query($sql);

        ?>
        <form action="../models/pOfficer-DeleteUser.php" method="post">
            <table id="userTable" class="table table-bordered table-striped table-hover">
                <!-- table head -->
                <thead>
                    <!-- table row -->
                    <tr>
                        <!-- table column headings -->
                        <th id="userName">User Full Name</th>
                        <th id="userEmail">User Email</th>
                        <th id="userId">Delete</th>
                    </tr>
                </thead>
        
        <?php

        if ($result->num_rows > 0) {
            // for each to show each applicant
            foreach ($result as $user)
            {
                // closing php and echoing inside html table data
                ?>
                <tr>
                    <td><?= $user['fName'] ." ". $user['lName']?></td>
                    <td><?= $user['email']?></td>
                    <td>
                        <input type="radio" id="userChoice"  name="userChoice"
                          value="<?= $user['userID']?>" required>
                    </td>                    
                </tr>
                <?php              
            }

            ?>
            <input type="submit" value="Delete!" id="submitBtn">
            </form>
            <?php
            
        } else {
            echo "0 results";
        }

        $conn->close();    
    }
?>