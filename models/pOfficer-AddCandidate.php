<?php

include_once("../config/config.php");
include_once("../src/libs/helpers.php");

$conn = CONNECT_MYSQL(); // Database obj



// userName varification
if (isset($_POST['slogan'])) {

    $candidateSlogan = mysqli_escape_string($conn, $_POST['slogan']);
}



// First Name Varification
if (isset($_POST['fName'])) {

    $fName = mysqli_escape_string($conn, $_POST['fName']);
}

// Last Name Varification
if (isset($_POST['lName'])) {

    $lName = mysqli_escape_string($conn, $_POST['lName']);
}

// inserting data into database
$sql = "INSERT INTO candidate (fName, lName, slogan)
        VALUES (?, ?, ?)";


// Creating a statement object
$stmt =  mysqli_stmt_init($conn);

// returns a boolean success value
if (! mysqli_stmt_prepare($stmt, $sql)) { // if false

    die("SQL Error: " . mysqli_error($conn));
}

// binding. connect values to placeholders in sql string
mysqli_stmt_bind_param($stmt, "sss", // stmt first, then value types, then values
                        $fName,
                        $lName,
                        $candidateSlogan);

// executing statement
if (mysqli_stmt_execute($stmt)) {

    echo "Record has been inserted into candidate database";

    // once entered successful, will redirect to login page
    header("Location: ../views/pollingofficer.php");
    // exiting the script
    exit;

} else {

    if (mysqli_errno($conn) === 1062) {
        die("Error: Candidate Name: '$fName' already exists.");
    } else {
        die("SQL Error: " . mysqli_error($conn) . " " . mysqli_errno($conn));
    }
    
}

?>