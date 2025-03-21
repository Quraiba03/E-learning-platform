<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Include your existing CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- Font Awesome CSS -->
    <title>Edit Lesson</title>
    <style>
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom, #001f3f, #0077b6); /* Fading from dark blue to light blue */
    color: #ffffff;
    animation: fadeBackground 5s forwards; /* Animation applied */
}

@keyframes fadeBackground {
    0% {
        background: #001f3f; /* Start with dark blue */
    }
    100% {
        background: #0077b6; /* End with light blue */
    }
}


        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 100px;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        h1 {
            font-size: 30px; /* Font size 30 for the title */
            font-weight: bold;
        }

        label {
            font-size: 20px; /* Font size 20 for labels */
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 20px 0;
            box-sizing: border-box;
            border: none;
            border-radius: 5px;
            background-color: #333333; /* Dark grey input background */
            color: #ffffff; /* White text color */
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #0077b6; /* Light blue button background */
            color: #ffffff; /* White text color */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #005b8e; /* Darker blue on hover */
        }
    </style>
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
    <div class="container">
        <h1>Edit Lesson</h1>
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

            // Retrieve lesson details from the database
            $sql = "SELECT * FROM lessons WHERE lesson_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $lesson_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Output data of the selected lesson
                $row = $result->fetch_assoc();
                // Display form with pre-filled values for editing
                ?>
                <form action="update_lesson.php" method="post">
                    <input type="hidden" name="lesson_id" value="<?php echo $row['lesson_id']; ?>">
                    <label for="heading">Heading:</label><br>
                    <input type="text" id="heading" name="heading" value="<?php echo $row['heading']; ?>" required><br>
                    <label for="explanation">Explanation:</label><br>
                    <textarea id="explanation" name="explanation" rows="4" cols="50" required><?php echo $row['explanation']; ?></textarea><br>
                    <input type="submit" value="Update">
                </form>
                <?php
            } else {
                echo "Lesson not found";
            }

            $conn->close();
        } else {
            echo "Invalid request";
        }
        ?>
    </div>
</body>
</html>
