<?php
// Establish a database connection (same as in your existing file)
$servername = "localhost";
$username = "gsss";
$password = "gsssietw";
$dbname = "gsss";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user information based on the username provided in the URL
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    
    // Fetch user details
    $stmt = $conn->prepare("SELECT user_id, USN, email FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $USN, $email);
    $stmt->fetch();
    $stmt->close();
    
    // Fetch profile information based on user_id
    if ($user_id) {
        $stmt = $conn->prepare("SELECT bio, semester, profile_photo FROM profiles WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($bio, $semester, $profile_photo);
        $stmt->fetch();
        $stmt->close();
    }}
      
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: rgba(0,0,0,0); /* Off-white background */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: row; /* Change to row to align sidebar and profile card horizontally */
            justify-content: flex-start; /* Align items at the beginning of the container */
            align-items: flex-start; /* Align items at the beginning of the container */
            height: 100vh;
        }
        
        /* CSS styles for profile container */
        .profile-card {
            background-color: #000; /* Black box */
            color: #fff; /* White text */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 600px; /* Adjust width to accommodate sidebar */
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
        /* CSS styles for profile elements */
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
      
    </style>
</head>
<body>
<div class="profile-card">
<img src="<?php echo '../'.$profile_photo; ?>" alt="Profile Photo" class="profile-photo">



        <div class="profile-name"><?php echo $username; ?></div>
        <div class="profile-info">
        <p><strong>USN:</strong> <?php echo $USN; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Bio:</strong> <?php echo $bio; ?></p>
            <p><strong>Semester:</strong> <?php echo $semester; ?></p>
        </div>
        </body>
</html>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Handle click event on the username link
    $('.username a').click(function(e) {
        e.preventDefault(); // Prevent default action of the link
        // Toggle the visibility of the profile card
        $('#profile-card').toggle();
    });
});
</script>
