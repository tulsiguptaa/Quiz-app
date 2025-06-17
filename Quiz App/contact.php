<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input safely
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // (Optional) Save to database or send email
    echo "Thanks, $name! Your message has been received.";
}
?>

<?php
$conn = new mysqli("localhost", "root", "", "quiz_app");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepared statement
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();

    echo "✅ Message saved successfully!";
}
?> 



