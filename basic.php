<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to GSSS E-Learning Website</title>
    <style>
        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: top;
            color: white;
            font-family: Arial, sans-serif;
        }
        .welcome-box {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 50px;
            border-radius: 5px;
            text-align: center;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
        }
        .login-box {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            position: fixed;
			top: 70%;
			left: 50%;
			transform: translate(-50%, -50%);
            margin-bottom: 20px;
        }
        h1 {
            font-size: 6rem;
            margin: 0;
            color: #ffffcc;
            text-shadow: 2px 2px #333,
                        2px 2px #333,
                        3px 3px #333;
        }
        a {
            color: #333;
            text-decoration: none;
            font-size: 2rem;
            margin: 0 10px;
        }
        a:hover {
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="welcome-box">
        <h1>Welcome to GSSS <br>E-Learning Website</h1>
        <h2>Your one-stop destination for online learning and resources</h2>
    </div>
    <div class="login-box">
	<p style="color: black;"><strong>Already have an account?.</strong> <a href="login.php">Log in</a><br></p>
	<p style="color: black;"><b>Don't have an account?. </b> <a href="signup.php">Sign up</a></p>
    </div>
</body>
</html>