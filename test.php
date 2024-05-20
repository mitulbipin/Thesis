<?php
$input = "ACCCCCCCCCCCCCCCCCCCCCCCCCCCCCCX";
$pattern = '/A(B|C+)+D/';


$start = microtime(true);

$matches = [];
$result = preg_match($pattern, $input, $matches);

$end = microtime(true);

$matchingTime = ($end - $start) * 1000;

if ($result === false) {
    echo "Regex matching failed.";
} elseif ($result === 1) {
    echo "Pattern matched. Time taken: " . $matchingTime . " ms";
} else {
    echo "Pattern not found. Time taken: " . $matchingTime . " ms";
}
?>
