<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "quiz_app");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get total number of users
$sql = "SELECT COUNT(*) AS total_users FROM users";
$result = $conn->query($sql);

$total_users = 0;
if ($result && $row = $result->fetch_assoc()) {
    $total_users = $row['total_users'];
}
?>
