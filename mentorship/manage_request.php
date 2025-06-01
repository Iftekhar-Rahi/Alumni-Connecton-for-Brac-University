<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to manage friend requests.";
    exit;
}

$receiver_id = $_SESSION['user_id'];
$request_id = $_GET['request_id'];

if (!isset($request_id) || empty($request_id)) {
    echo "Invalid request.";
    exit;
}

$query = "SELECT * FROM friend_requests WHERE id = ? AND receiver_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $request_id, $receiver_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "No such request found or you are not the receiver of this request.";
    exit;
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $status = '';

    if ($action == 'accept') {
        $status = 'accepted';
    } elseif ($action == 'reject') {
        $status = 'rejected';
    }

    $updateQuery = "UPDATE friend_requests SET status = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("si", $status, $request_id);

    if ($updateStmt->execute()) {
        echo "Request " . ucfirst($status) . " successfully.";
    } else {
        echo "Error updating the request status.";
    }
    $updateStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Friend Request</title>
</head>
<body>
    <h2>Manage Friend Request</h2>
    <form method="post" action="">
        <button type="submit" name="action" value="accept">Accept</button>
        <button type="submit" name="action" value="reject">Reject</button>
    </form>
</body>
</html>
