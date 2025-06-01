<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT u.user_id, u.name, u.email
          FROM friend_requests fr
          JOIN user u ON fr.receiver_id = u.user_id
          WHERE fr.sender_id = ? AND fr.status = 'accepted'";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Accepted Mentors</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Mentors Who Accepted Your Requests</h2>

    <?php if ($result->num_rows > 0): ?>
        <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <strong><?= htmlspecialchars($row['name']) ?></strong> 
                (<?= htmlspecialchars($row['email']) ?>)
                <a href="chat.php?user_id=<?= $row['user_id'] ?>">Chat</a>
            </li>
        <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No mentors have accepted your friend requests yet.</p>
    <?php endif; ?>

</body>
</html>