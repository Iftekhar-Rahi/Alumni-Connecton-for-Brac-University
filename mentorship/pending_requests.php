<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view pending requests.";
    exit;
}

$receiver_id = $_SESSION['user_id'];

$query = "SELECT fr.id, u.name, u.email
          FROM friend_requests fr
          JOIN user u ON fr.sender_id = u.user_id
          WHERE fr.receiver_id = ? AND fr.status = 'pending'";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $receiver_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h2>Pending Friend Requests</h2>";
    echo "<table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>
                    <a href='manage_request.php?request_id={$row['id']}'>Manage Request</a>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No pending friend requests.";
}

$stmt->close();
$conn->close();
?>
