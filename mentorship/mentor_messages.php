<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['user_id'];

$msg_query = $conn->prepare("SELECT m.id, m.sender_id, m.message, m.sent_at, u.name 
    FROM messages m
    JOIN user u ON m.sender_id = u.user_id
    WHERE m.receiver_id = ? ORDER BY m.sent_at ASC");
$msg_query->bind_param("i", $current_user);
$msg_query->execute();
$msg_result = $msg_query->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages - Mentor</title>
    <style>
        .message-box { width: 70%; margin: auto; padding: 20px; border: 1px solid #ddd; }
        .message { margin: 10px 0; padding: 10px; border-radius: 5px; }
        .message .sender { font-weight: bold; }
        .received { background-color: #f1f0f0; text-align: left; }
        .message-content { padding: 10px; }
    </style>
</head>
<body>
    <div class="message-box">
        <h3>Messages from Mentees</h3>
        <?php if ($msg_result->num_rows > 0): ?>
            <?php while ($row = $msg_result->fetch_assoc()): ?>
                <div class="message received">
                    <div class="sender"><?= htmlspecialchars($row['name']) ?>:</div>
                    <div class="message-content"><?= htmlspecialchars($row['message']) ?></div>
                    <small>Sent at: <?= $row['sent_at'] ?></small>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No messages to display.</p>
        <?php endif; ?>
        
        <form method="post">
            <textarea name="message" rows="3" cols="60" required></textarea><br>
            <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Reply
            </button>
        </form>
    </div>
</body>
</html>
