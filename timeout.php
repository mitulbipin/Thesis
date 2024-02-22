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
        $pattern = '/A(B|C+)+D/';

        set_time_limit(1);

        $startTime = microtime(true);
        $result = preg_match($pattern, $input);
        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;

        if ($result) {
            echo "<p>Input is valid: $input</p>";
        } else {
            echo "<p>Invalid input.</p>";
            header("HTTP/1.1 400 Bad Request");
        }

        if ($executionTime > 1000) {
            echo "<p>Regex matching exceeded 1000ms timeout.</p>";
            header("HTTP/1.1 500 Internal Server Error");
            exit(); 
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
