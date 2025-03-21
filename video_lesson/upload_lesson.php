<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST['heading']) && !empty($_FILES['video']['name']) && isset($_SESSION['user_id'])) {
        require_once 'db_connect.php';  
        // Get the logged-in user's ID from the session
        $user_id = $_SESSION['user_id'];

        // Process file upload
        $upload_dir = 'uploads/';
        $video_path = $upload_dir . $_FILES['video']['name'];
        if (move_uploaded_file($_FILES['video']['tmp_name'], $video_path)) {
            // Insert lesson details into the database
            $heading = $_POST['heading'];
            $explanation = $_POST['explanation'];
            $keywords = $_POST['keywords'];

            // Prepare and execute the SQL query to insert the lesson
            $insert_lesson_sql = "INSERT INTO lessons (heading, explanation, video_path, user_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_lesson_sql);
            $stmt->bind_param("sssi", $heading, $explanation, $video_path, $user_id);
            if ($stmt->execute()) {
                // Get the lesson ID of the inserted lesson
                $lesson_id = $stmt->insert_id;

                // Insert keywords into the keywords table (if applicable)
                if (!empty($keywords)) {
                    $keywords_array = explode(',', $keywords);
                    $insert_keyword_sql = "INSERT INTO keywords (lesson_id, keyword) VALUES (?, ?)";
                    $stmt = $conn->prepare($insert_keyword_sql);
                    $stmt->bind_param("is", $lesson_id, $keyword);
                    foreach ($keywords_array as $keyword) {
                        $keyword = trim($keyword);
                        $stmt->execute();
                    }
                }

                // Redirect to upload success page
                header("Location: upload_success.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "Please fill all required fields.";
    }
}
?>