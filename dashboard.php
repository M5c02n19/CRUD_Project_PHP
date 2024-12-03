<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$username = $_SESSION['username'];
$records = readRecords($username);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?></h1>
    <a href="crud.php?action=create">เพิ่มข้อมูลใหม่</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($records as $record): ?>
        <tr>
            <td><?php echo $record[0]; ?></td>
            <td><?php echo $record[2]; ?></td>
            <td><?php echo $record[3]; ?></td>
            <td>
                <a href="crud.php?action=edit&id=<?php echo $record[0]; ?>">Edit</a>
                <a href="crud.php?action=delete&id=<?php echo $record[0]; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
