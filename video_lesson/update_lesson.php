<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST['lesson_id']) && !empty($_POST['heading']) && !empty($_POST['explanation'])) {
        // Get form data
        $lesson_id = $_POST['lesson_id'];
        $heading = $_POST['heading'];
        $explanation = $_POST['explanation'];
        
        // Connect to the database
        $conn = new mysqli('localhost', 'gsss', 'gsssietw', 'gsss');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Update lesson details in the database
        $sql = "UPDATE lessons SET heading=?, explanation=? WHERE lesson_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $heading, $explanation, $lesson_id);
        
        if ($stmt->execute()) {
            // Redirect to view_lesson.php after successful update
            header("Location: your_posts.php");
            exit();
        } else {
            echo "Error updating lesson";
        }

        $conn->close();
    } else {
        echo "Please fill all required fields.";
    }
} else {
    echo "Invalid request";
}
?>
