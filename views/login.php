<?php 
    include_once("../src/inc/loginHeader.php");
    include_once("../config/config.php");
?>

<!-- PROCESSING FORM HERE -->
<?php
    $is_invalid = false;

    // when page first starts the mothod is 'get' once submit btn click it changes to 'post'
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        
        // connect to db and check if username and pwrd given match records in db
        $conn = CONNECT_MYSQL();
        $userName = $conn->real_escape_string($_POST["userName"]);
        $sql = "SELECT * FROM user WHERE userName = '$userName'";

        $result = $conn->query($sql);

        $user = $result->fetch_assoc(); // return as an array

        if ($user) { // if record found, will check password

            // checking plaintext password matches password_hash in db
            if (password_verify($_POST["password"], $user["password_hash"])) {// will return true or false
                
                // starting session for user once logged in successful

                session_start();
                session_regenerate_id(); // makes the session less vulnerable
                
                // storing userId in session super global
                $_SESSION["user_id"] = $user["userID"];

                // redirect to index page and end script
                if ($user["isAdmin"] == false) {
                    header("Location: ./votepage.php");
                    exit;
                } else {
                    header("Location: ./pollingofficer.php");
                    exit;
                }
            }
        }

        $is_invalid = true;
    }

?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="card w-50 border-success text-center ">
            <?php if ($is_invalid) : ?> <!-- if is_invalid returns true after post-->
                <em>Invalid login</em>
            <?php endif; ?>

            <form method="post" class="needs-validation">
                <div class="card-body">
                    <h1 class="card-title">Login</h1>
                    <div class="row mb-3">
                        <label for="userName" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="userName" id="userName"
                        placeholder="Input username" autocomplete="off" required>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" id="password"
                        placeholder="Enter password" autocomplete="off" required>
                    </div>

                    <div class="mb-3 text-center">
                        <button class ="btn btn-primary" type="submit">Login</button>
                        <a href="./signup.php">Sign Up</a>
                </div>
            </form>
        </div>
    </div> 
</div>

<footer class="text-center">
    <p>&copy; 2023 Boy Broccoli Productions</p>
</footer>

</body>
</html>

