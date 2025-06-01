<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to send a friend request.";
    exit;
}

$receiver_id = $_POST['receiver_id'];
$sender_id = $_SESSION['user_id'];


if (!isset($receiver_id) || empty($receiver_id)) {
    echo "Invalid request.";
    exit;
}

$query = "SELECT * FROM friend_requests WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "A friend request has already been sent or received.";
    exit;
}

$query = "INSERT INTO friend_requests (sender_id, receiver_id, status) VALUES (?, ?, 'pending')";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $sender_id, $receiver_id);

if ($stmt->execute()) {
    echo "Friend request sent successfully.";
} else {
    echo "Error sending friend request.";
}

$stmt->close();
$conn->close();
?>
