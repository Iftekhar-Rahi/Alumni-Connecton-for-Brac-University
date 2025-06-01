<?php
session_start();
require_once '../connection.php';

$user_id = $_SESSION['user_id'] ?? 0;


if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

if (!isset($_GET['post_id'])) {
    die("Post ID not provided.");
}

$post_id = intval($_GET['post_id']);
$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM Post WHERE Post_Id = $post_id AND Author_Id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("You are not authorized to edit this post.");
}

$post = $result->fetch_assoc();
include 'edit_post.html';

$conn->close();
?>
