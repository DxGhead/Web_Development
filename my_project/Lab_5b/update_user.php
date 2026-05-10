<?php
session_start();
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$message = '';
$error = '';

// Get the matric from URL
if (!isset($_GET['matric'])) {
    header("Location: display_users.php");
    exit();
}

$matric = mysqli_real_escape_string($conn, $_GET['matric']);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $accessLevel = mysqli_real_escape_string($conn, $_POST['accessLevel']);
    
    // Update password if provided
    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $sql = "UPDATE users SET name='$name', password='$password', accessLevel='$accessLevel' 
                WHERE matric='$matric'";
    } else {
        $sql = "UPDATE users SET name='$name', accessLevel='$accessLevel' 
                WHERE matric='$matric'";
    }
    
    if ($conn->query($sql) === TRUE) {
        $message = "User updated successfully!";
        // Refresh user data
        $sql = "SELECT * FROM users WHERE matric='$matric'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
    } else {
        $error = "Error updating user: " . $conn->error;
    }
}

// Get user data
$sql = "SELECT * FROM users WHERE matric='$matric'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: display_users.php");
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Update User</h2>
            
            <?php if ($message): ?>
                <div class="success"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="input-group">
                    <label>Matric:</label>
                    <input type="text" value="<?php echo htmlspecialchars($user['matric']); ?>" disabled>
                    <input type="hidden" name="matric" value="<?php echo htmlspecialchars($user['matric']); ?>">
                </div>

                <div class="input-group">
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>

                <div class="input-group">
                    <label>Password (leave blank to keep current):</label>
                    <input type="password" name="password">
                </div>

                <div class="input-group">
                    <label>Access Level:</label>
                    <select name="accessLevel" required>
                        <option value="student" <?php echo ($user['accessLevel'] == 'student') ? 'selected' : ''; ?>>Student</option>
                        <option value="lecturer" <?php echo ($user['accessLevel'] == 'lecturer') ? 'selected' : ''; ?>>Lecturer</option>
                    </select>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-update">Update</button>
                    <a href="display_users.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>