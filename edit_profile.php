<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to update profile
    $bio = $_POST['bio'];
    $semester = $_POST['semester'];
    
    // Handle file upload for profile photo
    $target_dir = "profile_photos/";
    $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
    move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file);
    $profile_photo = $target_file;
    
    // Update profile in the database
    $conn = new mysqli("localhost", "gsss", "gsssietw", "gsss");
    $stmt = $conn->prepare("INSERT INTO profiles (user_id, bio, semester, profile_photo) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE bio = VALUES(bio), semester = VALUES(semester), profile_photo = VALUES(profile_photo)");
    $stmt->bind_param("isss", $user_id, $bio, $semester, $profile_photo);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    $conn = new mysqli("localhost", "gsss", "gsssietw", "gsss");
    $stmt = $conn->prepare("UPDATE profiles SET bio = ?, semester = ?, profile_photo = ? WHERE user_id = ?");
    $stmt->bind_param("sssi", $bio, $semester, $target_file, $user_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();


    // Redirect back to profile page after editing
    header("Location: profile.php");
    exit();
}

// Retrieve existing profile information from the database
$conn = new mysqli("localhost", "gsss", "gsssietw", "gsss");
$stmt = $conn->prepare("SELECT bio, semester, profile_photo FROM profiles WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($bio, $semester, $profile_photo);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Include your existing CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- Font Awesome CSS -->
    <title>Upload Lesson</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #333333, #eeeeee);
            color: #000000; /* Set text color to black */
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fae5df; /* Peach color background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
            color: #000000; /* Set heading color to black */
            font-family: 'Arial Black', sans-serif; /* Stylish font */
        }

        label {
            font-size: 24px; /* Large font size for labels */
            color: #000000; /* Set label color to black */
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 15px; /* Increased padding for input fields */
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px; /* Large font size for input fields */
            ; /* Bold font weight for input fields */
        }
        #heading {
            font-size:28px;
            font-weight: bold;
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 24px; /* Large font size for submit button */
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
        <li >
        <a href="index.html" >
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
        </a>
        </li>
        <li class="active">
           
              <a href="../gsss/video_lesson/your_posts.php">
                <i class="fas fa-listfas fa-user"></i>
                <span>Your Posts</span>
                </a>
                </li>
                <li>
                    <a href="profile.php">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                    </a>
                    </li>
                    <li>
                       
                            <li class="logout">
                                <a href="logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>logout</span>
                                </a>
                                </li>
        </ul>
    </div>
    <div class="container">

    <h2>Edit Profile</h2>

    <form method="post" enctype="multipart/form-data">
        Bio: <textarea name="bio"><?php echo $bio; ?></textarea><br><br>
        Semester: <input type="text" name="semester" value="<?php echo $semester; ?>"><br><br>
        Profile Photo: <input type="file" name="profile_photo"><br><br>
        <input type="submit" value="Save">
    </form>

</body>
</html>