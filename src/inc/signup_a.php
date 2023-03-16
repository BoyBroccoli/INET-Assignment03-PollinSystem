<?php
    include_once("../../config/config.php");
?>

<?php
    extract($_POST);
    $conn = CONNECT_MYSQL();

    if (isset($_POST['submit_btn'])) {
        // Escaping special characters in a string for insert
        $userName = mysqli_real_escape_string($conn, $_POST['userName']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
        $fName = mysqli_real_escape_string($conn, $_POST['fName']);
        $lName = mysqli_real_escape_string($conn, $_POST['lName']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        // Checking if username and password is empty or not
        if ($userName != "" && $password != "" && $password == $password2) {
            $sql = "SELECT * FROM user WHERE userName='$userName'";
            $result = mysqli_query($conn, $sql);
            $UserData = mysqli_fetch_array($result);

            // Check UserData is empty or not, if empty then create new user
            if (empty($UserData)){
                // insert Query
                $insert_query = "INSERT INTO user (fName, lName, userName, email, password) VALUES ( '$fName',  '$lName', '$userName', '$email',  '$password')";

                $result = mysqli_query($conn, $insert_query);
                $success_mesg = "User Created.";
            } else {
                // set error messages
                $error_msg = "User Already Exists.";
                
            }
        } else {
            echo "Passswords must match. And Values cannot be empty";
        }
    }
    

?>