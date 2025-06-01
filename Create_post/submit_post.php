<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in.";
    header("Location: loginpage.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$post_title = isset($_POST['post_title']) ? trim($_POST['post_title']) : '';
$post_content = isset($_POST['post_content']) ? trim($_POST['post_content']) : '';

$timestamp = date('Y-m-d H:i:s');

// Insert post
$sql = "INSERT INTO post (author_id, title, content, timestamp) 
        VALUES ('$user_id', '$post_title', '$post_content', '$timestamp')";
mysqli_query($conn, $sql);
header("Location: all_posts.php");


mysqli_close($conn);
?>