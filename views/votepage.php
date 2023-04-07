<?php include_once("../config/config.php"); ?>

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

    // can store values in session super global
   // print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Vote for Candidate</title>
</head>
<body>
    <h1>Vote Today!</h1>
    
    <?php if (isset($user)) : ?>
        <p>Hello <?= htmlspecialchars($user["fName"]) ?> Vote Today!</p>
        <p><a href="./logout.php">Log out</a></p>

    <?php else: ?>
        <p><a href="./login.php">Log in</a> or <a href="./signup.php">Sign up</a></p>
    
    <?php endif; ?>
</body>
</html>