<?php
session_start();
require_once 'db_connect.php';

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];
$usn = $_POST['USN']; // Assuming the USN is captured from the login form

// Validate form data
if (empty($username) || empty($password) || empty($usn)) {
    header('Location: login.php?error=All fields are required');
    exit();
}

// Prepare query to fetch user data based on username and USN
$sql = "SELECT * FROM users WHERE username = ? AND USN = ?";

$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param('ss', $username, $usn);

// Execute query
$stmt->execute();

// Get result
$result = $stmt->get_result();

// Initialize error message
$error = '';

// Check if user exists
if ($result->num_rows > 0) {
    // Fetch user data
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        // Password is correct
        $_SESSION['user_id'] = $user['user_id']; // Set user_id in session
        header('Location: index.html'); // Redirect to the home page
        exit();
    } else {
        // Password is incorrect
        $error = "Incorrect password. Try again.";
    }
} else {
    // User not found
    $error = "User not found or incorrect USN. Try signing up. <a href='signup.php'>Sign up</a>";
}

$error_box = "<div class='error-box'>" . $error . "</div>";

// Store error message in session
if (isset($error)) {
    $_SESSION['error'] = $error;
}

// Print error box if it exists
if (isset($error_box)) {
    echo $error_box;
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .error-box {
            background-color: red;
            color: #333;
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
    </style>
</head>
<body>
    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GSSS</title>
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
        }.error {
            color: white;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form method="post" action="login_process.php">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="USN">USN:</label>
        <input type="text" name="USN" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
</body>
</html>
   
