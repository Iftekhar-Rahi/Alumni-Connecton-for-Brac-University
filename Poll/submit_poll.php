<?php
session_start();
require_once '../connection.php'; 

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in.";
    header("Location: loginpage.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Sanitize inputs
$poll_info = $_POST['poll_info'];
$options = $_POST['options'] ?? [];

$valid_options = [];

// Clean and validate options (at least 2 required)
foreach ($options as $opt) {
    $opt = trim($opt);
    if (!empty($opt)) {
        $valid_options[] = mysqli_real_escape_string($conn, $opt);
    }
}

if (count($valid_options) < 2) {
    $_SESSION['error'] = "At least 2 options are required.";
    header("Location: createpollpage.php");
    exit();
}

$timestamp= date('Y-m-d H:i:s');

// Insert poll with timestamp
$poll_info = mysqli_real_escape_string($conn, $_POST['poll_info']); // Add this line

$poll_sql = "INSERT INTO poll (created_by_id, timestamp, poll_info) 
             VALUES ('$user_id', '$timestamp', '$poll_info')";

if (mysqli_query($conn, $poll_sql)) {
    $poll_id = mysqli_insert_id($conn);



    // Insert options
    foreach ($valid_options as $index => $content) {
        $option_id = $index + 1;
        $option_sql = "INSERT INTO options (poll_id, option_id, content) VALUES ('$poll_id', '$option_id', '$content')";
        mysqli_query($conn, $option_sql);
    }

    $_SESSION['message'] = "Poll created successfully!";
    header("Location: ../homepage/index.php");
    exit();
} else {
    $_SESSION['error'] = "Failed to create poll.";
    header("Location: createpollpage.php");
    exit();
}
?>
