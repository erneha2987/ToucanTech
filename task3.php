<?php
// Loop through numbers 1-100
for ($i = 1; $i <= 100; $i++) {
    // Start with an empty string to build the output
    $output = '';

    // If the number is divisible by 3, add 'Toucan' to the output
    $output .= ($i % 3 == 0) ? 'Toucan' : '';

    // If the number is divisible by 5, add 'Tech' to the output
    $output .= ($i % 5 == 0) ? 'Tech' : '';

    // If the output is still empty, use the number instead
    echo ($output == '') ? $i : $output;

    // Add a line break for formatting
    echo "<br>";
}
?>
