<?php
$servername = "localhost";
$username = "gsss";
$password = "gsssietw";
$dbname = "gsss";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>