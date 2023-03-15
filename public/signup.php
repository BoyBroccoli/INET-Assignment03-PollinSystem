<?php
include_once("../src/inc/header.php");
include_once("../src/libs/helpers.php");
?>


    <form action = "signup.php" method="post">
        
        <div class="container">
            <h1 class="text-center">Sign Up Form</h1>
            <div class="mb-3">
                <label for="userName">Username:</label>
                <input type="text" class="form-control" name="userName" id="userName" placeholder="Input desired username">
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="fName">First Name:</label>
                    <input type="text" class="form-control" name="fName" id="fName" placeholder="Enter First Name">
                </div>
                <div class="col">
                    <label for="lName">Last Name:</label>
                 <input type="text" class="form-control" name="lName" id="lName" placeholder="Enter Last Name">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="password">Password:</label>
                 <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                </div>
                <div class="col">
                    <label for="password2">Password Again:</label>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Enter exact password again">
                </div>
                
            </div>
            <div class="row text-center mb-3">
                <label for="agree">
                    <input type="checkbox" name="agree" id="agree" value="yes"/> I agree with the
                    <a href="#" title="term of services">term of services</a>
                </label>
            </div>
            <div class="mb-3 text-center">
                <button class ="btn btn-primary" type="submit">Sign Up</button>
            </div>
        </div>
               
    </form>

<?php include_once("../src/inc/footer.php") ?>