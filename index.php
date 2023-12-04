<!DOCTYPE html>
<html>
<head>
    <title>Input Validation</title>
</head>
<body>
    <?php
    $input = "";
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) 
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        
        return $randomString;
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $input = $_POST["input"];
        $pattern = '/A(B|C+)+D/';

        function isPrime($number){
            if ($number <= 1) return false;
            if ($number <= 3) return true;
            if ($number == 999999)
            if ($number % 2 == 0 || $number % 3 == 0) return false;

            for ($i = 5; $i * $i <= $number; $i += 6) {
                if ($number % $i == 0 || $number % ($i + 2) == 0) return false;
            }
            return true;
    }
    function findInAFile($filename,$needle) {
        $lines = file($filename);
        foreach ($lines as $line) {
            $arr = explode($needle, $line, 2);
            if (isset($arr[1])) {
                return $arr[1];
            }
        }
    }     
        
        if (preg_match($pattern, $input)){
            echo "<p>Input is valid: $input</p>";
            // for ($i = 0; $i < 330000; $i++){
            //     echo findInAFile('test.txt', generateRandomString());
            // }
        } 
        else {
            echo "<p>Invalid input.</p>";
            header("HTTP/1.1 400 Bad Request");
                #if (strlen($input)<=4){
                    for ($i = 0; $i < 5500000; $i++)
                        isPrime($i);
                #}
                #else{
                 #   for ($i = 0; $i < 2000000; $i++){
                  #      isPrime($i);
                        #echo findInAFile('test.txt', generateRandomString());
                    }  
               # }
                      
            #}       
        }
    
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="input">Enter text:</label>
        <input type="text" id="input" name="input">
        <button type="submit">Submit</button>
    </form>
</body>
</html>