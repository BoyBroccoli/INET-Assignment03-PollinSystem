<?php

include_once("../../config/config.php");
include_once("../libs/helpers.php");

$conn = CONNECT_MYSQL();

$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL);


if ( ! $terms) {
    die("Terms must be accepted");
}

if (isset($_POST['userName'])) {

    if (empty($_POST['userName'])) {
        echo "Error setting username.";
        $userName = null;
    } else {
        $userName = $_POST['userName'];
    }
}

if (isset($_POST['email'])) {
    if (empty($_POST['email'])) {
       $email = null;
        echo "Error setting email.";
    } else {
        $email = $_POST['email'];
    }
}

if (isset($_POST['fName'])) {
    if (empty($_POST['fName'])) {
        $fName = null;
        echo "Error setting First Name.";
    } else {
        $fName = $_POST['fName'];
    }
}

if (isset($_POST['lName'])) {
    if (empty($_POST['lName'])) {
       $lName = null;
        echo "Error setting Last Name.";
    } else {
        $lName = $_POST['lName'];
    }
}

if (isset($_POST['password'])) {
    if (empty($_POST['password'])) {
        echo "Error with password";
        $password = null;
    } else {
        $password = $_POST['password'];
    }
}

if (isset($_POST['password2'])) {
    if (empty($_POST['password2'])) {
        echo "Error with password2";
        $password2 = null;
    } else {
        $password2 = $_POST['password2'];
    }
}


$sql = "INSERT INTO user (fName, lName, userName, email, password)
        VALUES (?, ?, ?, ?, ?)";

// Creating a statement object
$stmt = mysqli_stmt_init($conn);

// returns a boolean success value
if (! mysqli_stmt_prepare($stmt, $sql)) { // if false

    die(mysqli_error($conn));
}

// binding. connect values to placeholders in sql string
mysqli_stmt_bind_param($stmt, "sssss", // stmt first, then value types, then values
                        $fName,
                        $lName,
                        $userName,
                        $email,
                        $password);

// executing statement
mysqli_stmt_execute($stmt);

echo "Record has been inserted into user database";

?>