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

    if (strlen($input) > 20) {
        $descriptorspec = array(
            0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
            1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
            2 => array("file", "/tmp/error-output.txt", "a") // stderr is a file to write to
        );

        $process = proc_open('php', $descriptorspec, $pipes);

        if (is_resource($process)) {
            fwrite($pipes[0], '<?php echo preg_match("' . addslashes($pattern) . '", "' . addslashes($input) . '"); ?>');
            fclose($pipes[0]);

            $start = time();
            $timeout = 1; // Timeout in seconds

            do {
                $status = proc_get_status($process);

                if (time() - $start >= $timeout) {
                    proc_terminate($process, 9);
                    echo "<p>Regex took too long</p>";
                    break;
                }
                usleep(100000); // Sleep for 100ms to reduce CPU usage
            } while (TRUE);

            $output = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            $return_value = proc_close($process);

            if ($output === "1") {
                echo "<p>Input is valid: $input</p>";
            } else {
                echo "<p>Invalid input.</p>";
                header("HTTP/1.1 400 Bad Request");
            }
        }
    } else {
    


    if (preg_match($pattern, $input)) {
        echo "<p>Input is valid: $input</p>";
    } else {
        echo "<p>Invalid input.</p>";
        header("HTTP/1.1 400 Bad Request");
    }
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