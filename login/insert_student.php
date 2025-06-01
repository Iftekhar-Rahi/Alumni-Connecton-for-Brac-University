<?php
session_start();

require_once '../connection.php';

//regi
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $interests = $_POST['interests'];

    
    $check = $conn->query("SELECT * FROM user WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.history.back();</script>";
        exit();
    }

    
    $insert = $conn->query("INSERT INTO user (name, email, password, interests, user_type) VALUES ('$name', '$email', '$password', '$interests', 'student')");
    if ($insert) {
        header("Location: loginpage.php"); 
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
