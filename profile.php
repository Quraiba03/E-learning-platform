<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve user information from the database
$conn = new mysqli("localhost", "gsss", "gsssietw", "gsss");
$stmt = $conn->prepare("SELECT username,USN, email FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username,$USN, $email);
$stmt->fetch();
$stmt->close();

// Retrieve profile information from the database
$stmt = $conn->prepare("SELECT bio, semester, profile_photo FROM profiles WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($bio, $semester, $profile_photo);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: #f9f9f9; /* Off-white background */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: row; /* Change to row to align sidebar and profile card horizontally */
            justify-content: flex-start; /* Align items at the beginning of the container */
            align-items: flex-start; /* Align items at the beginning of the container */
            height: 100vh;
        }
        .sidebar {
            position: sticky;
            top: 0;
            width: 110px;
            height: 100vh;
            padding: 0 1.7rem;
            color: #ffff;
            overflow: hidden;
            transition: all 0.5s linear;
            background: rgba(0,0,0,1);
        }
        .sidebar:hover {
            width: 240px;
            transition: 0.5s;
        }
        .logo {
            height: 80px;
            padding: 16px;
        }
        .menu {
             height: 88%;
             position: relative;
             list-style: none;
             padding: 0;
        }
        .menu li{
            padding: 1rem;
            margin: 8px 0;
            border-radius: 8px;
            transition: all 0.5s ease-in-out
        }
        .menu li:hover, 
        .active {
            background: #e0e0e058;
        }
        .menu a {
            color: #fff;
            font-size: 14px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .menu a span {
            overflow: hidden;
        }
        .menu a i {
            font-size: 1.2rem;
        }
        .logout {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }
        .profile-card {
    background-color: #000; /* Black box */
    color: #fff; /* White text */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: calc(100% - 250px); /* Adjust width to accommodate sidebar */
    max-width: 600px; /* Maximum width for responsiveness */
    text-align: center; /* Center align text */
    display: flex;
    flex-direction: column; /* Arrange elements vertically */
    justify-content: center; /* Center align vertically */
    align-items: center; /* Center align horizontally */
    margin-left: 250px; /* Ensure content doesn't overlap with sidebar */
    height: 75vh; /* Set height to 75% of the viewport height */
    position: absolute; /* Position the card */
    top: 50%; /* Move the card 50% from the top */
    left: 40%; /* Move the card 50% from the left */
    transform: translate(-50%, -50%); /* Center the card horizontally and vertically */
}


        .profile-photo {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            margin-bottom: 10px; /* Space between photo and username */
        }
        .profile-name {
            font-size: 24px;
            font-weight: bold;
            margin: 0; /* Remove margin */
        }
        .profile-info {
            text-align: center;
        }
        .profile-info p {
            margin: 5px 0;
        }
        .edit-profile-link {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="index.html">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../gsss/video_lesson/your_posts.php">
                    <i class="fas fa-list"></i> <!-- Fixed typo -->
                    <span>Your Posts</span>
                </a>
            </li>
            <li class="active">
                <a href="profile.php">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="logout">
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="profile-card">
        <img src="<?php echo $profile_photo; ?>" alt="Profile Photo" class="profile-photo">
        <div class="profile-name"><?php echo $username; ?></div>
        <div class="profile-info">
        <p><strong>USN:</strong> <?php echo $USN; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Bio:</strong> <?php echo $bio; ?></p>
            <p><strong>Semester:</strong> <?php echo $semester; ?></p>
        </div>
        <a href="edit_profile.php" class="edit-profile-link">Edit Profile</a>
    </div>
</body>
</html>