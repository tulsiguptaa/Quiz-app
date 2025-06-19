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
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $username = $_POST['username'];
    $name = $_POST['fullname'];

    if ($action === "login") {
     
        $sql = "SELECT * FROM login WHERE username ='$username' AND password='$pass'";
        $result = $conn->query($sql);
        if ($result->num_rows === 1) { 
            echo " Login successful!"; 
            header("Location: new.php");
            exit();            
        } else {
            echo "Invalid username or password!";
        }
    } elseif ($action === "register") {
        
        $check = "SELECT * FROM login WHERE email='$email'";
        $checkResult = $conn->query($check);
        if ($checkResult->num_rows > 0) {
            echo "Username already exists!";
        } else {
            $insert = "INSERT INTO login (username, password, email, fullname) VALUES ('$username', '$pass', '$email', '$name')";
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

