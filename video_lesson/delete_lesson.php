<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['lesson_id'])) {
    // Get lesson ID from the URL
    $lesson_id = $_GET['lesson_id'];
    
    // Connect to the database
    $conn = new mysqli('localhost', 'gsss', 'gsssietw', 'gsss');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete lesson from the database
    $sql = "DELETE FROM lessons WHERE lesson_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $lesson_id);
    if ($stmt->execute()) {
        // Redirect to view_lesson.php after successful deletion
        header("Location: your_posts.php");
        exit();
    } else {
        echo "Error deleting lesson";
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
