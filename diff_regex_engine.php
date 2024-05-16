<!DOCTYPE html>
<html>
<head>
    <title>Input Validation</title>
</head>
<body>
<?php
    $input = "";

    if (!extension_loaded('re2_extension')) {
            die("Failed to load re2_extension.");
        
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $input = $_POST["input"];
        $pattern = 'A(B|C+)+D';
        if (regex_match($input, $pattern)){
            echo "<p>Input is valid.</p>";
        } 
        else {
            echo "<p>Invalid input.</p>";
            header("HTTP/1.1 400 Bad Request");
        }
    }
?>
    <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES, 'UTF-8') ?>">
        <label for="input">Enter text:</label>
        <input type="text" id="input" name="input">
        <button type="submit">Submit</button>
    </form>
</body>
</html>