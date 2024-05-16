<!DOCTYPE html>
<html>
<head>
    <title>PHP - Alternate Logic</title>
    <style>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        label, input, button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        button {
            cursor: pointer;
        }
        p {
            color: green;
        }
    </style>
    <script>
        function updateCount() {
            const input = document.getElementById('input');
            const countElement = document.getElementById('count');
            countElement.textContent = 'Character count: ' + input.value.length;
        }
    </script>
</head>
<body>
    <h1 style="text-align: center;">PHP-ReDoS</h1>
    <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES, 'UTF-8') ?>">
        <label for="input">Enter text:</label>
        <input type="text" id="input" name="input" oninput="updateCount()">
        <p id="count">Character count: 0</p>
        <button type="submit">Submit</button>
    </form>

    <?php
    $input = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $email = $_POST["input"];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "<p style='color: green;'>Input is valid.</p>";
        } 
        else {
            echo "<p style='color: red;'>Invalid input.</p>";
            header("HTTP/1.1 400 Bad Request");
        }
    }
    ?>
</body>
</html>