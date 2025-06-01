<?php
session_start();
require_once '../connection.php';


$query = "SELECT * FROM user WHERE user_type = 'alumni'";
$result = $conn->query($query);


if ($result->num_rows > 0) {
    $alumniList = [];
    while ($row = $result->fetch_assoc()) {
        $alumniList[] = [
            'user_id' => $row['user_id'],
            'name' => htmlspecialchars($row['name']),
            'email' => htmlspecialchars($row['email']),
            'graduation_year' => htmlspecialchars($row['graduation_year']),
            'skills' => htmlspecialchars($row['skills']),
            'industry' => htmlspecialchars($row['industry']),
            'achievements' => htmlspecialchars($row['achievements']),
        ];
    }
    $conn->close();
} else {
    echo "No alumni found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alumni List</title>
    <link rel="stylesheet" href="mentorship.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>All Alumni Profiles</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Graduation Year</th>
                    <th>Skills</th>
                    <th>Industry</th>
                    <th>Achievements</th>
                    <th>Connect with alumni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumniList as $alumni): ?>
                    <tr>
                        <td><?= $alumni['name'] ?></td>
                        <td><?= $alumni['email'] ?></td>
                        <td><?= $alumni['graduation_year'] ?></td>
                        <td><?= $alumni['skills'] ?></td>
                        <td><?= $alumni['industry'] ?></td>
                        <td><?= $alumni['achievements'] ?></td>
                        <td>
                            <form method="post" action="send_request.php">
                                <input type="hidden" name="receiver_id" value="<?= $alumni['user_id'] ?>">
                                <button type="submit">Send Friend Request</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
