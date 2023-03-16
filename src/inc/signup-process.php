<?php

include_once("../../config/config.php");
include_once("../libs/helpers.php");

$conn = CONNECT_MYSQL();

if (isset($_POST['email'])) {
    if (empty($_POST['email'])) {
       // $email = null;
        echo "Error setting email.";
    } else {
        $email = $_POST['email'];
    }
}

if (isset($_POST['fName'])) {
    if (empty($_POST['fName'])) {
        //$fName = null;
        echo "Error setting First Name.";
    } else {
        $fName = $_POST['fName'];
    }
}

if (isset($_POST['lName'])) {
    if (empty($_POST['lName'])) {
       // $lName = null;
        echo "Error setting Last Name.";
    } else {
        $lName = $_POST['lName'];
    }
}

if (isset($_POST['password'])) {
    if (empty($_POST['password'])) {
        echo "Error with password";
    } else {
        $password = $_POST['password'];
    }
}


if (isset($_POST['password2'])) {
    if (empty($_POST['password2'])) {
        echo "Error with password2";
    } else {
        $password2 = $_POST['password2'];
    }
}

$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL);

if ( ! $terms) {
    die("Terms must be accepted");
}

/*
if (isset($_POST['userName']) && $userName !== "") {
    clean_data($userName);
    $userName = mysqli_real_escape_string($conn, $_POST['userName']);

} else {
    echo "Error: Username is not set.";
}


$password = mysqli_real_escape_string($conn, $_POST['password']);
$password2 = mysqli_real_escape_string($conn, $_POST['password2']);
$fName = mysqli_real_escape_string($conn, $_POST['fName']);
$lName = mysqli_real_escape_string($conn, $_POST['lName']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

$values = array($userName, $password, $password2, $fName, $lName, $email);

foreach ($values as $postVal) {
    echo $postVal;
    new_line();

}
    // print_r($_POST);


*/

$values = array($userName, $password, $password2, $fName, $lName, $email);

foreach ($values as $postVal) {
    echo $postVal;
    new_line();

}

?>