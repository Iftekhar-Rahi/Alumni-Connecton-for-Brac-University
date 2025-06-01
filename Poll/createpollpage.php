<?php
session_start();

$max_options = 4;
$default_options = 2;

// Track how many are active
$option_count = isset($_POST['option_count']) ? (int)$_POST['option_count'] : $default_options;
if (isset($_POST['add_option']) && $option_count < $max_options) {
    $option_count++;
}

$poll_info = isset($_POST['poll_info']) ? htmlspecialchars($_POST['poll_info']) : '';
$options = isset($_POST['options']) ? $_POST['options'] : [];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Poll</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h2>Create a Poll</h2>

    <form action="createpollpage.php" method="POST">
        <label for="poll_info">Poll Question :</label><br>
        <textarea name="poll_info" maxlength="200" required><?= $poll_info ?></textarea><br>

        <label>Options:</label><br>

        <?php for ($i = 0; $i < $max_options; $i++): ?>
            <div class="<?= $i < $option_count ? '' : 'hidden' ?>">
                <input type="text" name="options[]" maxlength="100" placeholder="Option <?= $i+1 ?>" value="<?= isset($options[$i]) ? htmlspecialchars($options[$i]) : '' ?>" <?= $i < $option_count ? 'required' : '' ?>>
            </div>
        <?php endfor; ?>

        <input type="hidden" name="option_count" value="<?= $option_count ?>">

        <?php if ($option_count < $max_options): ?>
            <button type="submit" name="add_option">+ Add Option</button>
        <?php endif; ?>

        <br><br>
        <button type="submit" formaction="submit_poll.php">Create Poll</button>
    </form>
</body>
</html>
