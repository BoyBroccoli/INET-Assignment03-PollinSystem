<?php 
    include_once("../src/inc/loginHeader.php");
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="card w-50 border-success text-center ">
            <form action="login.php" method="post">
                <div class="card-body">
                    <h1 class="card-title">Login</h1>
                    <div class="row mb-3">
                        <label for="userName" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="userName" id="userName" placeholder="Input username">
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
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

