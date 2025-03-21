<?php
// Connect to the database
$host = 'localhost';
$user = 'gsss';
$password = 'gsssietw';
$dbname = 'gsss';

// Create a new database connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check for errors
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get the user's ID from the query string
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

// Prepare a SQL statement to retrieve the user's information
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");

// Bind the user's ID to the statement
$stmt->bind_param("i", $id);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch the user's information
if ($row = $result->fetch_assoc()) {
    $user = $row;
} else {
    $user = [];
}

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div id="user-profile">
		<img id="profile-image" src="profile_image.php?id=<?php echo htmlspecialchars($user['id']); ?>" alt="Profile Image">
		<div id="profile-info">
			<h1 id="profile-name"><?php echo htmlspecialchars($user['username']); ?></h1>
			<p id="profile-email"><?php echo htmlspecialchars($user['email']); ?></p>
		</div>
	</div>
</body>
</html>