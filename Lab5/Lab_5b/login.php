<?php
session_start();
require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = mysqli_real_escape_string($conn, $_POST['matric']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE matric = '$matric' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user;
        header("Location: display_users.php");
        exit();
    } else {
        $error = "Invalid username or password, try login again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Login</h2>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="input-group">
                    <label>Matric:</label>
                    <input type="text" name="matric" required>
                </div>

                <div class="input-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" class="btn-submit">Login</button>
            </form>
            
            <p class="register-link">Register here if you have not. <a href="register.php">Register Now</a></p>
        </div>
    </div>
</body>
</html>