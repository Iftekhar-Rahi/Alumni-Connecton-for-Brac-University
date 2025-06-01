<?php
session_start();
require_once '../connection.php';

$user_name = $_SESSION['user_name'] ;
$user_id = $_SESSION['user_id'] ;
$query = "SELECT * FROM user WHERE user_id = '$user_id' " ;
$result = mysqli_query($conn, $query) ;
$row = mysqli_fetch_assoc($result) ;
$user_type = $row['user_type'] ?? 'student' ; // Default to 'student' if not set
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alumni Connect Home</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Alumni Connect Portal</h1>
    <nav>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="../profile_dashboard/profile_dashboard_page.php">Profile</a></li>
        <li><a href="../Create_post\all_posts.php">Posts</a></li>
        <li><a href="../Poll/poll_feed.php">Polls</a></li>
        <li><a href="../q&a_discussion\q&a_discussion.php">Q&A Board</a></li>
        <li><a href="../mentorship/mentorship.php">All Alumni</a></li>
        <li><a href="../mentorship/pending_requests.php">Mentorship Request</a></li>
        <li><a href="../mentorship/mentor_messages.php">Messages</a></li>
        <li><a href="../login/loginpage.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="welcome">
      <h2>Welcome, <?=  $user_name  ?> </h2>
      <p>You are logged in as a <strong> <?= $user_type ?> </strong>.</p>
    </section>

    <section class="quick-actions">
      <h3>Quick Actions</h3>
      <div class="cards">
        <div class="card"><a href="../create_post/create_postpage.php">Create a Post</a></div>
        <div class="card"><a href="../Poll/createpollpage.php">Start a Poll</a></div>
        <div class="card"><a href="../q&a_discussion\q&a_discussion.php">Ask a Question</a></div>
        <div class="card"><a href="../mentorship/mentorship.php">All Alumni</a></div>
        <div class="card"><a href="../mentorship/pending_requests.php">Mentorship Request</a></div>
        <div class="card"><a href="../mentorship/mentor_messages.php">Messages</a></div>
        <div class="card"><a href="../mentorship/accepted_mentors.php">Find my Mentors</a></div>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Alumni Connect. All rights reserved.</p>
  </footer>
</body>
</html>