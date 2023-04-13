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

?>