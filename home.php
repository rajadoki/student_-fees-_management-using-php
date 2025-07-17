<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Fee Management System - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('images/background_image.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 50px;
        }

        h1 {
            font-size: 3em;
            margin-bottom: 40px;
            color: #fff;
            text-shadow: 2px 2px 5px #000;
        }

        .login-container {
            margin: 50px auto;
            width: 300px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .login-container h2 {
            color: #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .login-container a {
            display: inline-block;
            padding: 12px 25px;
            margin: 15px 0;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .login-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Student Fee Management System</h1>

    <div class="login-container">
        <h2>Select Login</h2>
        <a href="admin_login.php">Admin Login</a><br>
        <a href="student_login.php">Student Login</a><br>
        <a href="teacher_login.php">Teacher Login</a>
    </div>
</body>
</html>
