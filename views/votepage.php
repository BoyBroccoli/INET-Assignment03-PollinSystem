<?php include_once("../config/config.php"); ?>

<?php
    // will either start a new session or resume and existing one. sent here after login successful
    session_start();

    // checking the session and storing the users info in result set

    if (isset($_SESSION["user_id"])) {

        $conn = CONNECT_MYSQL();
        $userID = $_SESSION["user_id"];

        $sql = "SELECT * FROM user WHERE userID = '$userID'";

        // storing in result obj
        $result = $conn->query($sql);

        $user = $result->fetch_assoc();
    }

    // can store values in session super global
   // print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Home | Vote for Candidate</title>
</head>
<body>    
    <?php if (isset($user)) : ?>

        <h1>Hello <?= htmlspecialchars($user["fName"]) ?>, Vote Today!</h1>
            <!-- container for displaying candidate table and data results -->
            <div class="container">
                <div class="row">
                    <div class="col">
                        <!-- card header -->
                        <div class="card-header">
                            <h3>
                                Current Candidates!
                                <!-- button for voting for a candidate -->
                                <button type="button" id="voteTodayBtn"class="btn btn-primary float-end"
                                    data-bs-toggle="modal" data-bs-target="#voteForCandidateModal">
                                    Vote Today!
                                </button>
                            </h3>
                        </div>

                        <!-- card body to fetch data from candidate table -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="candidateTable" class="table table-bordered table-striped table-hover">
                                    <!-- table head -->
                                    <thead>
                                        <!-- table row -->
                                        <tr>
                                            <!-- table column headings -->
                                            <th id="candidateName">Candidate Name</th>
                                            <th id="candidateSlogan">Candidate Slogan</th>
                                        </tr>
                                    </thead>
                                    <!-- table body -->
                                    <tbody>
                                        <?php
                                            $conn = CONNECT_MYSQL();
                                            SELECT_EVERYTHING_FROM_CANDIDATE($conn);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- container for holding radio buttons -->
            <div class="container">
                <h2>Choose Your Candidate</h2>
                <div class="row">
                    <form id="candidateForm" action="../models/voteForCandidate.php" >
                        <!-- radio buttons for candidates -->
                        <input type="radio" id="candidateChoice1"  name="candidateChoices" value="Boy Broccoli">
                        <label for="boyBroc">Boy Broccoli</label><br>

                        <input type="radio" id="candidateChoice2"  name="candidateChoices" value="Barrack Obama">
                        <label for="barackObama">Barrack Obama</label><br>

                        <input type="radio" id="candidateChoice3"  name="candidateChoices" value="Mo Kamalian">
                        <label for="moKamalian">Mo Kamalian</label><br>

                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>

    <?php else: ?>
        <p><a href="./login.php">Log in</a> or <a href="./signup.php">Sign up</a></p>
    <?php endif; ?>

</body>

    <div class="footer">
        <p><a href="./logout.php">Log out</a></p>
    </div>
</html>

    <!-- jquery script -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- JavaScript for alertify-->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- Custom ajax script event listener -->
    <script>

        var user_id = $(this).val();

        // for update users candidate vote on form voteForCandidateForm
        $(document).on('click', '.voteTodayBtn', function () {
            $.ajax({
                type: "GET",
                url: "models/voteForCandidateModal.php?" + user_id,
                success: function(response) {

                    var res= $.parseJSON(response);

                    if (res.status == 422) { // if input errors

                        alert.console.error(res.message);

                    } else if (res.status == 200) { // when succesful
                        
                        // storing data fetched from response
                    }
                }
            });
            
            
        });



    </script>