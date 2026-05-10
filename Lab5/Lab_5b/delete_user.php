<?php
session_start();
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Get the matric from URL
if (isset($_GET['matric'])) {
    $matric = mysqli_real_escape_string($conn, $_GET['matric']);
    
    // Prevent user from deleting themselves
    if ($matric == $_SESSION['user']['matric']) {
        $_SESSION['delete_error'] = "You cannot delete your own account!";
    } else {
        $sql = "DELETE FROM users WHERE matric = '$matric'";
        $conn->query($sql);
    }
}

header("Location: display_users.php");
exit();
?>