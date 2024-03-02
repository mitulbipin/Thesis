<!DOCTYPE html>
<html>
<head>
    <title>Input Validation</title>
</head>
<body>
    <?php
    $input = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $input = $_POST["input"];
        //$pattern = '/A(B|C+)+D/';
        $pattern = '/A((?:(?:(?!.).)|(?:(?:[BC])+)))D/';
        if (preg_match($pattern, $input)){
            echo "<p>Input is valid: $input</p>";
        } 
        else {
            echo "<p>Invalid input.</p>";
            header("HTTP/1.1 400 Bad Request");
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