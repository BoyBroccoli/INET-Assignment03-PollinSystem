<?php 

    $title = "Already Voted Page";
    include_once("../config/config.php");
    include_once("../src/inc/headerTemplate.php");

?>

<?php
    // will either start a new session or resume and existing one. sent here after login successful
    session_start();

    // checking the session and storing the users info in result set

    if (isset($_SESSION["user_id"])) {

        $conn = CONNECT_MYSQL();
        $userID = $_SESSION["user_id"];

        $sql = "SELECT * FROM user WHERE userID = '$userID'";

        // storing in result obj
        $result = $conn->query($sql);

        $user = $result->fetch_assoc();
    }

?>


<div class="container">
    <div class="row">
        <h1>Thank You for Already Voting!</h1>
    </div>
</div>

</body>
<div class="footer">
        <p><a href="./logout.php">Log out</a></p>
    </div>
</html>