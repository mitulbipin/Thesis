<?php
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);

    $pattern = '/A(B|C+)+D/';

    if (preg_match($pattern, $input["input"])) {
        echo json_encode(array("valid" => true));
    } else {
        echo json_encode(array("valid" => false));
        header("HTTP/1.1 400 Bad Request");
    }

?>
