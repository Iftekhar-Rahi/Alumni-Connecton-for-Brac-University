<?php
session_start();
require_once '../connection.php';

$user_id = $_SESSION['user_id'] ?? 0;

// Handle vote submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote_poll_id'], $_POST['vote_option_id'])) {
    $poll_id = (int)$_POST['vote_poll_id'];
    $option_id = (int)$_POST['vote_option_id'];

    // Prevent duplicate vote
    $check_sql = "SELECT * FROM voting WHERE poll_id=$poll_id AND user_id=$user_id";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) == 0) {
        $vote_sql = "INSERT INTO voting (poll_id, option_id, user_id) VALUES ($poll_id, $option_id, $user_id)";
        mysqli_query($conn, $vote_sql);
    }
}

// Fetch all polls
$poll_sql = "SELECT * FROM poll ORDER BY timestamp DESC";
$poll_result = mysqli_query($conn, $poll_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Poll Feed</title>
    <link rel="stylesheet" href="feed.css">
    
</head>
<body>
<h2>Poll Feed</h2>

<?php while ($poll = mysqli_fetch_assoc($poll_result)): ?>
    <div class="poll-box">
        <h3>Poll #<?= $poll['poll_id'] ?></h3>
        <p><?= htmlspecialchars($poll['poll_info']) ?></p>

        <?php
        $poll_id = $poll['poll_id'];

        // Get poll options
        $option_sql = "SELECT * FROM options WHERE poll_id=$poll_id";
        $option_result = mysqli_query($conn, $option_sql);

        // Get total votes
        $total_sql = "SELECT COUNT(*) as total_votes FROM voting WHERE poll_id=$poll_id";
        $total_result = mysqli_query($conn, $total_sql);
        $total_row = mysqli_fetch_assoc($total_result);
        $total_votes = $total_row['total_votes'];
        ?>

        <form method="POST" action="poll_feed.php">
            <input type="hidden" name="vote_poll_id" value="<?= $poll_id ?>">

            <?php while ($opt = mysqli_fetch_assoc($option_result)): ?>
                <?php
                $opt_id = $opt['option_id'];
                $vote_count_sql = "SELECT COUNT(*) as count FROM voting WHERE poll_id=$poll_id AND option_id=$opt_id";
                $vote_result = mysqli_query($conn, $vote_count_sql);
                $vote_data = mysqli_fetch_assoc($vote_result);
                $votes = $vote_data['count'];
                $percentage = $total_votes > 0 ? round(($votes / $total_votes) * 100) : 0;
                ?>

                <button type="submit" name="vote_option_id" value="<?= $opt_id ?>">
                    <?= htmlspecialchars($opt['content']) ?> (<?= $percentage ?>%)
                </button><br>
            <?php endwhile; ?>
        </form>
    </div>
<?php endwhile; ?>
</body>
</html>
