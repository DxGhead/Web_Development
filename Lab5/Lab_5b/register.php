<?php
require_once 'config.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = mysqli_real_escape_string($conn, $_POST['matric']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = md5($_POST['password']);
    $accessLevel = mysqli_real_escape_string($conn, $_POST['accessLevel']);

    $check_sql = "SELECT matric FROM users WHERE matric = '$matric'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $error = "Matric number already exists!";
    } else {
        $sql = "INSERT INTO users (matric, name, password, accessLevel) 
                VALUES ('$matric', '$name', '$password', '$accessLevel')";

        if ($conn->query($sql) === TRUE) {
            $message = "Registration successful! You can now login.";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Registration</h2>
            
            <?php if ($message): ?>
                <div class="success"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="input-group">
                    <label>Matric:</label>
                    <input type="text" name="matric" required>
                </div>

                <div class="input-group">
                    <label>Name:</label>
                    <input type="text" name="name" required>
                </div>

                <div class="input-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>

                <div class="input-group">
                    <label>Role:</label>
                    <select name="accessLevel" required>
                        <option value="">Please select</option>
                        <option value="student">Student</option>
                        <option value="lecturer">Lecturer</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">Submit</button>
            </form>
            
            <p class="register-link">Already have an account? <a href="login.php">Back to Login</a></p>
        </div>
    </div>
</body>
</html>