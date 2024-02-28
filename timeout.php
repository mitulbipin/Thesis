<!DOCTYPE html>
<html>
<head>
    <title>Input Validation</title>
</head>
<body>
<?php

ini_set('pcre.backtrack_limit',10000000);
$input = isset($_POST["input"]) ? $_POST["input"] : "";

$pattern = '/A(B|C+)+D/';
$result = preg_match($pattern, $input);

if ($result === false) {
    
    if (preg_last_error() == PREG_BACKTRACK_LIMIT_ERROR) {
        http_response_code(500); 
        exit("Internal Server Error: Backtrack limit reached."); 
    }
}

if ($result) {
    echo "<p>Input is valid: $input</p>";
} else {
    echo "<p>Invalid input.</p>";
    header("HTTP/1.1 400 Bad Request");
}
?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="input">Enter text:</label>
        <input type="text" id="input" name="input">
        <button type="submit">Submit</button>
    </form>
</body>
</html>