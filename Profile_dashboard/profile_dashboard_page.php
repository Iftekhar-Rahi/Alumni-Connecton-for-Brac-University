<?php
session_start();
require_once '../connection.php';

$user_id = $_SESSION['user_id'] ?? 1;

$userResult = $conn->query("SELECT * FROM user WHERE user_id = $user_id");
$user = $userResult->fetch_assoc();

$socialResult = $conn->query("SELECT * FROM Alumni_socials WHERE user_id = $user_id");
$social = $socialResult->fetch_assoc();

$conn->close();


$facebook = $social['facebook'] ?? '#';
$linkedin = $social['linkedin'] ?? '#';
$github   = $social['github'] ?? '#';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile Dashboard</title>
    <link rel="stylesheet" href="profile_dashboard_style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>User Profile Dashboard</h2>
        <div class="profile-box">
            
            <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>User Type:</strong> <?= htmlspecialchars($user['user_type']) ?></p>
            <p><strong>Interests:</strong> <?= htmlspecialchars($user['interests']) ?></p>
            <p><strong>Graduation Year:</strong> <?= htmlspecialchars($user['graduation_year']) ?></p>
            <p><strong>Skills:</strong> <?= htmlspecialchars($user['skills']) ?></p>
            <p><strong>Industry:</strong> <?= htmlspecialchars($user['industry']) ?></p>
            <p><strong>Achievements:</strong> <?= htmlspecialchars($user['achievements']) ?></p>
            <p><strong>Facebook:</strong> <a href="<?= $facebook ?>" target="_blank">View</a></p>
            <p><strong>LinkedIn:</strong> <a href="<?= $linkedin ?>" target="_blank">View</a></p>
            <p><strong>GitHub:</strong> <a href="<?= $github ?>" target="_blank">View</a></p>
        </div>
    </div>
</body>
</html>
