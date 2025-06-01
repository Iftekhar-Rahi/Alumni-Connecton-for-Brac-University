<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question'])) {
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO qa_board_discussion (asked_by_id, question, timestamp) VALUES ('$user_id', '$question', NOW())";
    mysqli_query($conn, $sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['answer']) && isset($_POST['question_id'])) {
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);
    $qid = $_POST['question_id'];
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO answer (answered_by_id, question_id, answer) VALUES ('$user_id', '$qid', '$answer')";
    mysqli_query($conn, $sql);
}

$questions = mysqli_query($conn, "SELECT q.*, u.name FROM qa_board_discussion q JOIN user u ON q.asked_by_id = u.user_id ORDER BY q.timestamp DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Q&A Board</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>

    <form method="POST">
        <textarea name="question" placeholder="Ask a question..." required></textarea><br>
        <button type="submit">Post Question</button>
    </form>

    <h3>Questions</h3>
    <?php while ($q = mysqli_fetch_assoc($questions)): ?>
        <div class="box question-box">
        <small><i><?php echo $q['timestamp']; ?></i></small><br><strong><?php echo htmlspecialchars($q['name']); ?> asked:</strong><br>
            <?php echo nl2br(htmlspecialchars($q['question'])); ?><br>

            <?php
            $qid = $q['question_id'];
            $answers = mysqli_query($conn, "SELECT a.*, u.name FROM answer a JOIN user u ON a.answered_by_id = u.user_id WHERE a.question_id = '$qid'");
            while ($ans = mysqli_fetch_assoc($answers)): ?>
                <div class="box answer-box">
                    <strong><?php echo htmlspecialchars($ans['name']); ?> answered:</strong><br>
                    <?php echo nl2br(htmlspecialchars($ans['answer'])); ?>
                </div>
            <?php endwhile; ?>

            <form method="POST">
                <input type="hidden" name="question_id" value="<?php echo $qid; ?>">
                <textarea name="answer" placeholder="Write your answer..." required></textarea><br>
                <button type="submit">Submit Answer</button>
            </form>
        </div>
    <?php endwhile; ?>
</body>
</html>

<?php mysqli_close($conn); ?>
