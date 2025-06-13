<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_app";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo"connection succes ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action']; 
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($action === "login") {
     
        $sql = "SELECT * FROM login WHERE username='$user' AND password='$pass'";
        $result = $conn->query($sql);
        if ($result->num_rows === 1) {
            echo " Login successful!";
        } else {
            echo "Invalid username or password!";
        }
    } elseif ($action === "register") {
        
        $check = "SELECT * FROM login WHERE username='$user'";
        $checkResult = $conn->query($check);
        if ($checkResult->num_rows > 0) {
            echo "Username already exists!";
        } else {
            $insert = "INSERT INTO login (username, password) VALUES ('$user', '$pass')";
            if ($conn->query($insert) === TRUE) {
                echo "Registered successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Invalid action!";
    }
} else {
    echo "Form not submitted correctly.";
}

$conn->close();
?>
