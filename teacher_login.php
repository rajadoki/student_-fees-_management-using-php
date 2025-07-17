<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #FF416C, #FF4B2B); /* Red-Yellow Gradient */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 10px;
            color: white;
            width: 300px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        h2 {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #FF416C; /* Red button */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #FF4B2B;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Teacher Login</h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="login" value="Login">
        </form>
    </div>

    <?php
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Predefined teacher usernames and passwords
        $teachers = array(
            "Teacher1" => "Teach@1",
            "Teacher2" => "Teach@2",
            "Teacher3" => "Teach@3",
            // Add more teachers if needed
        );

        // Check if the entered username and password match any teacher
        if (array_key_exists($username, $teachers) && $teachers[$username] == $password) {
            // Successful login, redirect to teacher dashboard
            header('Location: teacher_dashboard.php');
            exit;
        } else {
            echo "<p style='color:red;text-align:center;'>Invalid login credentials!</p>";
        }
    }
    ?>
</body>
</html>
