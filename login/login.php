<?php
session_start();
require_once '../connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
    
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: ../Homepage/index.php");
        exit();
    } else {
        $_SESSION['error'] = "Incorrect email or password!";
        header("Location: loginpage.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Incorrect email or password!";
    header("Location: loginpage.php");
    exit();
}

mysqli_close($conn);
?>