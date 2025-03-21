<?php
// Start the session before any output
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // User is not authenticated, redirect to login page
    header("Location: login.html");
    exit();
}

// Include database connection file
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Include your existing CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #001f3f; /* Navy blue background */
            color: #ffffff;
        }

        .lesson-container {
            max-width: 800px;
            margin: 100px auto;
            padding: 20px; /* Reduced padding */
            background: #003366; /* Aesthetically matching color */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        h3 {
            font-family: Algerian, sans-serif; /* Algerian font */
            font-size: 34px; /* Font size 34 */
            font-weight: bold;
            text-decoration: underline; /* Underline */
            color: #ffffff; /* White color */
            text-align: center; /* Center the heading */
            margin-bottom: 20px; /* Add some space below the heading */
        }

        p {
            color: #ffffff; /* White color */
            text-align: center; /* Center the explanation */
            margin-bottom: 20px; /* Add some space below the explanation */
        }

        video {
            display: block;
            margin: 0 auto; /* Center the video */
            width: 100%; /* Make the video responsive */
            max-width: 100%; /* Make the video responsive */
            height: auto; /* Make the video responsive */
        }

        .action-buttons {
            text-align: center; 
            margin-bottom: 20px;/* Center the buttons */
        }

        .action-buttons a {
            display: inline-block;
            padding: 8px 16px;
            margin-right: 10px;
            background-color: #007bff; /* Blue color */
            color: #ffffff; /* White color */
            text-decoration: none;
            border-radius: 5px;
        }

        .action-buttons a:hover {
            background-color: #0056b3; /* Darker blue color on hover */
        }

        .upload-lesson-link {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .upload-lesson-link:hover {
            background-color: #0056b3;
        }

        
    </style>
</head>
<body>
<a href="index1.html" class="upload-lesson-link">Upload Lesson</a>
<div class="sidebar">
<div class="logo"></div>
<ul class="menu">
<li>
<a href="../index.html" >
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
            <a href="../profile.php">
            <i class="fas fa-user"></i>
            <span>Profile</span>
            </a>
            </li>
            <li>
               
                    <li class="logout">
                        <a href="../logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>logout</span>
                        </a>
                        </li>
</ul>
</div>
<div class="lesson-container">
<?php
// Fetch lessons/posts uploaded by the current user
$user_id = $_SESSION['user_id'];

// Prepare and execute SQL query to fetch user's posts
$sql = "SELECT * FROM lessons WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<h3>" . $row["heading"] . "</h3>";
        echo "<p>" . $row["explanation"] . "</p>";
        echo "<video width='320' height='240' controls>";
        echo "<source src='" . $row["video_path"] . "' type='video/mp4'>";
        echo "Your browser does not support the video tag.";
        echo "</video>";
        echo "<div class='action-buttons'>";
        echo "<a href='edit_lesson.php?lesson_id=" . $row["lesson_id"] . "'>Edit</a>";
        echo "<a href='delete_lesson.php?lesson_id=" . $row["lesson_id"] . "'>Delete</a>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

$stmt->close();
$conn->close();
?>
</div>
</body>
</html>
