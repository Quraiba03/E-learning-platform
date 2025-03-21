<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Success</title>
    <link rel="stylesheet" href="uploadmessage_style.css">
    <link rel="stylesheet" href="style.css"> <!-- Include your existing CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- Font Awesome CSS -->
    <script>
        // Redirect the user to the view_lesson page after 3 seconds
        setTimeout(function() {
            window.location.href = "your_posts.php";
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
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
    <div class="upload-success">
        <h2>Upload Successful!</h2>
    </div>
</body>
</html>
