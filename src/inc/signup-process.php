<?php

include_once("../../config/config.php");
include_once("../libs/helpers.php");

$conn = CONNECT_MYSQL(); // Database obj

// CLIENT SIDE VALIDATION

$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL); // checking to make sure terms returns true if checked

// if not, sending warning
if ( ! $terms) {
    die("Terms must be accepted");
}

if (isset($_POST['userName'])) {

    $userName = $_POST['userName'];
}

if (isset($_POST['email'])) {
    
    $email = $_POST['email'];
}

if (isset($_POST['fName'])) {

    $fName = $_POST['fName'];
}

if (isset($_POST['lName'])) {

    $lName = $_POST['lName'];
}


if (strlen($_POST["password"]) < 5) {
    die("Password must be at least 5 characters.");
}


if (isset($_POST['password'])) {
    
    $password = $_POST['password'];
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
}

if (isset($_POST['password2'])) {

    $password2 = $_POST['password2'];
}

if ($_POST["password"] !== $_POST["password2"]) {

    die("Passowrds must match!");
}

print_r($_POST);

var_dump($password_hash);

/*
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
*/
?>