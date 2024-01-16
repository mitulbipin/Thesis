<?php
// Input string to be matched
$input = "ACCCCCCCCCCCCCCCCCCCCCCCCCCCCCCX";

// Regular expression pattern
$pattern = '/A(B|C+)+D/';

// Measure start time
$start = microtime(true);

// Perform the regex match
$matches = [];
$result = preg_match($pattern, $input, $matches);

// Measure end time
$end = microtime(true);

// Calculate matching time
$matchingTime = ($end - $start) * 1000; // Convert to milliseconds

if ($result === false) {
    echo "Regex matching failed.";
} elseif ($result === 1) {
    echo "Pattern matched. Time taken: " . $matchingTime . " ms";
} else {
    echo "Pattern not found. Time taken: " . $matchingTime . " ms";
}
?>
