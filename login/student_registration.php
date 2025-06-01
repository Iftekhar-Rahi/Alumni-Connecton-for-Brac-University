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
            <form action="insert_student.php" method="post">
                <h2>Student Registration</h2>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="interests" placeholder="Interests">
                <button type="submit" name="register">Register</button>
                <p>Already have an account? <a href="loginpage.php">Login</a></p>
            </form>
        </div>  

    </div>

    
</body>
</html>
