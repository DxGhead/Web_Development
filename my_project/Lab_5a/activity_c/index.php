<!DOCTYPE html>
<html>
<head>
    <title>Square Calculator</title>
</head>
<body>
    <h2>Enter a number to find its square:</h2>
    <!-- The form sends data to process.php using the POST method -->
    <form action="process.php" method="POST">
        <label for="user_num">Number:</label>
        <input type="number" name="user_num" id="user_num" required>
        <button type="submit">Calculate</button>
    </form>
</body>
</html>
