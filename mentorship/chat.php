<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['user_id'];
$other_user = intval($_GET['user_id']);

$check = $conn->prepare("SELECT 1 FROM friend_requests 
    WHERE ((sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)) 
    AND status = 'accepted'");
$check->bind_param("iiii", $current_user, $other_user, $other_user, $current_user);
$check->execute();
$check->store_result();

if ($check->num_rows === 0) {
    echo "You are not connected with this user.";
    exit();
}


$name_query = $conn->prepare("SELECT name FROM user WHERE user_id = ?");
$name_query->bind_param("i", $other_user);
$name_query->execute();
$name_result = $name_query->get_result();
$other_user_name = $name_result->fetch_assoc()['name'] ?? 'User';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message'])) {
    $msg = htmlspecialchars($_POST['message']);
    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $current_user, $other_user, $msg);
    $stmt->execute();
}

$msg_query = $conn->prepare("SELECT sender_id, message, sent_at FROM messages 
    WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)
    ORDER BY sent_at ASC");
$msg_query->bind_param("iiii", $current_user, $other_user, $other_user, $current_user);
$msg_query->execute();
$msg_result = $msg_query->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat with <?= htmlspecialchars($other_user_name) ?></title>
    <style>
        .chat-box { width: 60%; margin: auto; font-family: Arial; }
        .message { margin: 10px; padding: 10px; border-radius: 5px; white-space: pre-line; }
        .sent { background-color: #dcf8c6; text-align: right; }
        .received { background-color: #f1f0f0; text-align: left; }
        textarea { width: 100%; padding: 10px; margin-top: 10px; }
        button { padding: 8px 16px; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="chat-box">
        <h3>Chat with <?= htmlspecialchars($other_user_name) ?></h3>
        <div class="messages">
            <?php while ($row = $msg_result->fetch_assoc()): ?>
                <div class="message <?= $row['sender_id'] == $current_user ? 'sent' : 'received' ?>">
                    <?= htmlspecialchars($row['message']) ?><br>
                    <small><?= $row['sent_at'] ?></small>
                </div>
            <?php endwhile; ?>
        </div>
        <form method="post">
            <textarea name="message" rows="3" required placeholder="Type your message..."></textarea><br>
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>
