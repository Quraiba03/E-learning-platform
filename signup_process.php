<?php
session_start();
require_once 'db_connect.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$usn = $_POST['USN']; // Assuming the USN is captured from the signup form

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if the email already exists
$query = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $_SESSION['error'] = urlencode("This email already exists. You can try logging in");
    header("Location: signup.php?error=" . $_SESSION['error']);
    exit;
} else {
    // Check if the USN already exists
    $query = "SELECT * FROM users WHERE USN = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $usn);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "You already have an account. Please log in.";
        echo "<div class='error-box'>" . $_SESSION['error'] . "</div>";
        header("Location: signup.php?error=" . urlencode($_SESSION['error']));
    }
        
    else {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, email, password, USN) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $usn);


        if ($stmt->execute()) {
            $_SESSION['success'] = "New user successfully created!";
            echo "<div class='success-box'>" . $_SESSION['success'] . "</div>";
           
        }
    }
}

$stmt->close();
$conn->close();
?>

<html>
<head>
	<title>GSSS Login/Signup</title>
    <style>
        .success-box {
            background-color: green;
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