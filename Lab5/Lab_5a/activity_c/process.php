<?php
// 1. Retrieve the data from the global $_POST array
$number = $_POST['user_num'];

// 2. Perform the calculation (Expression)
// Squaring a number is multiplying it by itself
$result = $number * $number;

// 3. Output the result back to the browser
echo "<h1>Calculation Result</h1>";
echo "<p>The square of $number is: <b>$result</b></p>";
echo '<br><a href="index.php">Go Back</a>';
?>
