<?php
    include_once("../../config/config.php");
    $conn = CONNECT_MYSQL();

    // selecting everything from user where the userName equals the one given
    $sql = sprintf("SELECT * FROM user
                    WHERE userName = '%s'",
                    $conn->real_escape_string($_GET["userName"]));
    
    // running the qquery
    $result = $conn->query($sql);

    // checking num of rows given. if 0 then username doesnt exist returns boolean
    $is_available = $result->num_rows === 0;

    // will output in json
    header("Content-Type: application/json");

    // outputting its available as json
    echo json_encode(["available" => $is_available]);

?>