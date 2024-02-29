<!DOCTYPE html>
<html>
<head>
    <title>Input Validation</title>
</head>
<body>
<?php
// Set the maximum execution time to 1 second
set_time_limit(1);

$input = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $input = $_POST["input"];
    $pattern = '/A(B|C+)+D/';

    try {
        if (preg_match($pattern, $input)){
            echo "<p>Input is valid: $input</p>";
        } 
        else {
            echo "<p>Invalid input.</p>";
            header("HTTP/1.1 400 Bad Request");
        }
    } catch (Exception $e) {
        echo "<p>Regex took too long</p>";
        header("HTTP/1.1 408 Request Timeout");
    }
}
?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="input">Enter text:</label>
        <input type="text" id="input" name="input">
        <button type="submit">Submit</button>
    </form>
</body>
</html>