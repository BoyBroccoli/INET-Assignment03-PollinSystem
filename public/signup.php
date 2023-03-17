<?php
include_once("../src/inc/signupHeader.php");
include_once("../src/libs/helpers.php");
?>

    <form action = "../src/inc/signup-process.php" method="post" class="needs-validation">
        
        <div class="container">
            <h1 class="text-center">Sign Up Form</h1>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="userName" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="userName" id="userName" placeholder="Input desired username" autocomplete="off" required>
                    <div class="valid-tooltip">
                        Looks Good!
                    </div>
                </div>
                <div class="col">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com" autocomplete="off"  required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label for="fName" class="form-label">First Name:</label>
                    <input type="text" class="form-control" name="fName" id="fName" placeholder="Enter First Name" autocomplete="off"  required>
                    <div class="invalid-tooltip">
                        Please Enter a First Name.
                    </div>
                </div>
                <div class="col">
                    <label for="lName" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" name="lName" id="lName" placeholder="Enter Last Name" autocomplete="off"  required> 
                    <div class="invalid-tooltip">
                        Please Enter a Last Name.
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" autocomplete="off"  required>
                    <div class="invalid-tooltip">
                        Please create a password.
                    </div>
                </div>
                <div class="col">
                    <label for="password2" class="form-label">Password Again:</label>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Enter exact password again" autocomplete="off" required>
                </div>
                
            </div>
            <div class="row text-center mb-3">
                <label for="agree">
                    <input type="checkbox" name="terms" id="terms" required/> I agree with the
                    <a href="#" title="term of services">term of services</a>
                </label>
                <div class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>
            <div class="mb-3 text-center">
                <button class ="btn btn-primary" name="submit_btn" type="submit" value="Submit">Sign Up</button>
            </div>
        </div>
               
    </form>

<?php include_once("../src/inc/signupFooter.php") ?>