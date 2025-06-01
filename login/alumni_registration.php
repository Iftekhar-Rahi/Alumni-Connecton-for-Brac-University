<?php
session_start();
require_once '../connection.php';

$user_id = $_SESSION['user_id'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <div class="form-box" id="register-form">
            <form action="insert_alumni.php" method="post">
                <h2>Alumni Registration</h2>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="interests" placeholder="Interests">
                <input type="text" name="achievements" placeholder="Achievements">
                <input type="text" name="graduation_year" placeholder="Graduation_year" required>
                <input type="text" name="skills" placeholder="Skills">
                <input type="text" name="industry" placeholder="Industry">
                <button type="submit" name="register">Register</button>
                <p>Already have an account? <a href="loginpage.php">Login</a></p>
            </form>
        </div>  

    </div>

    
</body>
</html>
