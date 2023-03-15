<!-- View function loads the code from a php file and passes data to it -->
<?php
    include_once("../../config/config.php");
?>
<?php
function view(string $filename, array $data = []): void
{

    // create variables from the associative array
    foreach ($data as $key => $value) {
        $$key = $value;
        
    }

    require_once(__DIR__ . "/../src/inc/" . $filename . '.php');
}

function is_post_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}

function is_get_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
}

function new_line()
{
    echo "<br>";
}


// Sanitize Function
function sanitize(array $inputs, array $fields) : array
{
    
}

?>