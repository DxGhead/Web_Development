<?php
session_start();
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Get all users
$sql = "SELECT matric, name, accessLevel FROM users ORDER BY matric";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="table-container">
            <div class="header">
                <h2>User Management</h2>
                <a href="logout.php" class="btn-logout">Logout</a>
            </div>
            
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Matric</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['matric']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['accessLevel']); ?></td>
                                <td class="action-buttons">
                                    <a href="update_user.php?matric=<?php echo urlencode($row['matric']); ?>" 
                                       class="btn-update">Update</a>
                                    <a href="delete_user.php?matric=<?php echo urlencode($row['matric']); ?>" 
                                       class="btn-delete" 
                                       onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="no-data">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>