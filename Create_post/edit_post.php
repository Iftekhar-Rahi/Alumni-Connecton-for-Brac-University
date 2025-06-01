<?php
session_start();
require_once '../connection.php';

$user_id = $_SESSION['user_id'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="edit_post_style.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Your Post</h2>
        <form action="update_page.php" method="POST">
            <input type="hidden" name="post_id" value="<?php echo $post['Post_Id']; ?>">

            <label for="title">Title:</label><br>
            <input type="text" name="title" value="<?php echo htmlspecialchars($post['Title']); ?>" required><br><br>

            <label for="content">Content:</label><br>
            <textarea name="content" rows="6" required><?php echo htmlspecialchars($post['Content']); ?></textarea><br><br>

            <input type="submit" value="Update Post">
        </form>
    </div>
</body>
</html>
