<?php 
    include_once("../src/inc/loginHeader.php");
    include_once("../config/config.php");
?>

<!-- PROCESSING FORM HERE -->
<?php
    // when page first starts the mothod is 'get' once submit btn click it changes to 'post'
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        
        // connect to db and check if username and pwrd given match records in db
        $conn = CONNECT_MYSQL();

        $sql = sprintf("SELECT * FROM user WHERE userName = '%s",
                        $conn->real_escape_string($_POST["userName"]));

        $result = $conn->query($sql);

        $user = $result->fetch_assoc(); // return as an array

        var_dump($user);
        exit;
    }

?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="card w-50 border-success text-center ">
            <form method="post" class="needs-validation">
                <div class="card-body">
                    <h1 class="card-title">Login</h1>
                    <div class="row mb-3">
                        <label for="userName" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="userName" id="userName" placeholder="Input username" >
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" >
                    </div>

                    <div class="mb-3 text-center">
                        <button class ="btn btn-primary" type="submit">Login</button>
                        <a href="./signup.php">Sign Up</a>
                    </div>
                </div>
            </form>
        </div>
    </div> 
</div>

<?php
    include_once("../src/inc/loginFooter.php");
?>

