<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$username = $_SESSION['username'];

if ($_GET['action'] === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    createRecord($username, $_POST['title'], $_POST['content']);
    header('Location: dashboard.php');
} elseif ($_GET['action'] === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    updateRecord($_POST['id'], $username, $_POST['title'], $_POST['content']);
    header('Location: dashboard.php');
} elseif ($_GET['action'] === 'delete') {
    deleteRecord($_GET['id'], $username);
    header('Location: dashboard.php');
}
?>
