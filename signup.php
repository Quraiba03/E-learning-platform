<?php
session_start();
if (isset($_GET['error'])) {
    $error_message = htmlspecialchars($_GET['error']);
    echo "<div class='error-box'><p>$error_message</p></div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - GSSS</title>
    <style>
        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #3E8E41;
        }
        .error-box {
            background-color: red;
            color: white;
            border: 1px solid #ccc;
            padding: 10px 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            position: fixed;
			top: 80%;
			left: 50%;
			transform: translate(-50%, -50%);
            display: inline-block;
        }
        .error-box p {
            margin: 0;
        }
    </style>
</head>
<body>
    <form method="post" action="signup_process.php">
        <h2>Sign Up</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="USN">USN:</label>
        <input type="text" name="USN" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Sign Up">
    </form>
</body>
</html>