<?php
    include_once("../../config/config.php");
?>

<?php
    extract($_POST);
    $conn = CONNECT_MYSQL();
    $sql = "SELECT * FROM user WHERE userName ='$userName'";








?>