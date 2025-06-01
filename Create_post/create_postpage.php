<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in.";
    header("Location: loginpage.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f9;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .message {
            color: green;
            text-align: center;
        }
        .error {
            color: red;
            text-align: center;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .nav-links {
            text-align: center;
            margin-top: 20px;
        }
        .nav-links a {
            color: #007BFF;
            text-decoration: none;
            margin: 0 10px;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Create a New Post</h2>

    

    <form action="submit_post.php" method="POST">
        <label for="post_title">Title:</label>
        <input type="text" id="post_title" name="post_title" required>
        
        <label for="post_content">Content:</label>
        <textarea id="post_content" name="post_content" rows="6" required></textarea>
        
        <input type="submit" value="Post">
    </form>

    <div class="nav-links">
        <a href="all_posts.php">View All Posts</a> |
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>