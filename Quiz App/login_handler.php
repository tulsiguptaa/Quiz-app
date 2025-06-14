<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "quiz_app");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'login') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Check user credentials
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Login successful
                $_SESSION['username'] = $username;
                header("Location: quiz.html");
                exit;
            } else {
                // Login failed
                header("Location: Login.html?error=invalid");
                exit;
            }
        } elseif ($_POST['action'] == 'register') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Check if username already exists
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Username already exists
                header("Location: Login.html?error=exists");
                exit;
            }

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
            
            if ($stmt->execute()) {
                // Registration successful
                $_SESSION['username'] = $username;
                header("Location: quiz.html");
                exit;
            } else {
                // Registration failed
                header("Location: Login.html?error=register");
                exit;
            }
        }
    }
}

$conn->close();
?> 