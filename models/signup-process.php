<?php

include_once("../config/config.php");

$conn = CONNECT_MYSQL(); // Database obj

// CLIENT SIDE VALIDATION

$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL); // checking to make sure terms returns true if checked

// terms varification
if (! $terms) {
    die("Terms must be accepted");
}

// userName varification
if (isset($_POST['userName'])) {

    $userName = mysqli_escape_string($conn, $_POST['userName']);
}

// Email Verification
if (isset($_POST['email'])) {
    
    $email = mysqli_escape_string($conn, $_POST['email']);
}

// First Name Varification
if (isset($_POST['fName'])) {

    $fName = mysqli_escape_string($conn, $_POST['fName']);
}

// Last Name Varification
if (isset($_POST['lName'])) {

    $lName = mysqli_escape_string($conn, $_POST['lName']);
}

// Checking Password is set Varification
if (isset($_POST['password'])) {
    
    $password = mysqli_escape_string($conn, $_POST['password']);
    // Storing Password in a hash
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
}

// Checking Password2 Varification
if (isset($_POST['password2'])) {

    $password2 = mysqli_escape_string($conn, $_POST['password2']);
}

// Checking if passwords don't match
if ($_POST["password"] !== $_POST["password2"]) {

    die("Passowrds must match!");
}

// inserting data into database
$sql = "INSERT INTO user (fName, lName, userName, email, password_hash)
        VALUES (?, ?, ?, ?, ?)";


// Creating a statement object
$stmt =  mysqli_stmt_init($conn);

// returns a boolean success value
if (! mysqli_stmt_prepare($stmt, $sql)) { // if false

    die("SQL Error: " . mysqli_error($conn));
}

// binding. connect values to placeholders in sql string
mysqli_stmt_bind_param($stmt, "sssss", // stmt first, then value types, then values
                        $fName,
                        $lName,
                        $userName,
                        $email,
                        $password_hash);

// executing statement
if (mysqli_stmt_execute($stmt)) {

    echo "Record has been inserted into user database";

    // once entered successful, will redirect to login page
    header("Location: ../views/login.php");
    // exiting the script
    exit;

} else {

    if (mysqli_errno($conn) === 1062) {
        die("Error: User Name: '$userName' already exists.");
    } else {
        die("SQL Error: " . mysqli_error($conn) . " " . mysqli_errno($conn));
    }
    
}

?>