<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in.";
    header("Location: loginpage.php");
    exit();
}

// Fetch all posts with author details
$sql = "SELECT p.post_id, p.title, p.content, p.timestamp, u.name 
        FROM post p 
        JOIN user u ON p.author_id = u.user_id 
        ORDER BY p.timestamp DESC";
$result = $conn->query($sql);

// Check for session messages
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['message'], $_SESSION['error']);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Alumni Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f9;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .message {
            color: green;
            text-align: center;
            margin: 10px 0;
        }
        .error {
            color: red;
            text-align: center;
            margin: 10px 0;
        }
        .post {
            background: white;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .post h3 {
            margin: 0 0 10px;
            color: #007BFF;
            font-size: 1.5em;
        }
        .post-meta {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 10px;
            font-style: italic;
        }
        .post-content {
            line-height: 1.6;
            color: #333;
        }
        .no-posts {
            text-align: center;
            color: #666;
            font-size: 1.1em;
        }
        .nav-links {
            text-align: center;
            margin-top: 20px;
        }
        .nav-links a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
            margin: 0 15px;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>All Alumni Posts</h2>

    <?php if ($message): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="post">
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <div class="post-meta">
                    Posted by <?php echo htmlspecialchars($row['name']); ?> on 
                    <?php echo date('F j, Y, g:i a', strtotime($row['timestamp'])); ?>
                </div>
                <div class="post-content">
                    <?php echo nl2br(htmlspecialchars($row['content'])); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="no-posts">No posts available yet.</p>
    <?php endif; ?>

    <div class="nav-links">
        <a href="create_postpage.php">Create New Post</a> |
        <a href="../homepage/index.php">Back to Dashboard</a>
    </div>
</body>
</html>