
<?php
// Establish a database connection
$servername = "localhost"; // Change this to your database server name if necessary
$username = "gsss"; // Change this to your database username
$password = "gsssietw"; // Change this to your database password
$dbname = "gsss"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to handle search functionality
function searchVideos($conn) {
    if (isset($_GET['query']) && !empty($_GET['query'])) {
        $query = $_GET['query']; // User input from the search box

        // Prepare the SQL query to search for videos matching the search query
        $sql = "SELECT heading, explanation, video_path, username
                FROM lessons
                INNER JOIN users ON lessons.user_id = users.user_id
                WHERE heading LIKE '%$query%'
                UNION
                SELECT heading, explanation, video_path, username
                FROM lessons
                INNER JOIN keywords ON lessons.lesson_id = keywords.lesson_id
                INNER JOIN users ON lessons.user_id = users.user_id
                WHERE keyword LIKE '%$query%'";

        // Execute the SQL query
        $result = $conn->query($sql);

        // Check if any results were found
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Display video information
                echo "<div class='video-item'>";
                echo "<h2>" . $row['heading'] . "</h2>";
                echo "<p>" . $row['explanation'] . "</p>";
                
                echo "<p class='username'><a href='profile.php?username=" . urlencode($row['username']) . "'>Uploaded by: " . $row['username'] . "</a></p>";
                
                
                // Check if video path is not null
                if ($row['video_path']) {
                    // Output video player with the correct video path
                    echo "<div class='video-container'>";
                    echo "<video controls>";
                    echo "<source src='" . htmlspecialchars($row['video_path']) . "' type='video/mp4'>";
                    echo "Your browser does not support the video tag.";
                    echo "</video>";
                    echo "</div>";
                }
                echo "</div>";
            }
        } else {
            echo "No results found.";
        }
    } else {
        echo "Please enter a search query.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Dashboard</title>
<link rel="stylesheet" href="ss.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
    <div class="sidebar">
    <div class="logo"></div>
<ul class="menu">
<li>
<a href="../index.html" >
<i class="fas fa-tachometer-alt"></i>
<span>Dashboard</span>
</a>
</li>
<li>
   
      <a href="../video_lesson/your_posts.php">
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

    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <h2>Dashboard</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                <form action="" method="GET">
                <i class="fas fa-search"></i>
                <input type="text" name="query" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
                        
                       
                </div>
                
            </div>
        </div>
        
        <div class="search-results">
            <?php searchVideos($conn); ?>
        </div>
    </div>
</body>
</html>