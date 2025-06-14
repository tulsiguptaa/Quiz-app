<?php
session_start();

// Connect to DB
$conn = new mysqli("localhost", "root", "", "quiz_app");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 1: Total number of questions
$totalQ = $conn->query("SELECT COUNT(*) as total FROM questions")->fetch_assoc()['total'];

// Step 2: Get current question number
$qno = isset($_GET['q']) ? (int)$_GET['q'] : 1;
if ($qno < 1) $qno = 1;
if ($qno > $totalQ) $qno = $totalQ;

// Step 3: Get that specific question
$sql = "SELECT * FROM questions LIMIT 1 OFFSET " . ($qno - 1);
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Step 4: Show question
echo "<h2>Question $qno of $totalQ</h2>";
echo "<form method='post' action='submit_one.php?q=$qno'>";

echo "<p><b>{$row['question_text']}</b></p>";
echo "<label><input type='radio' name='answer' value='A'> A. {$row['option_a']}</label><br>";
echo "<label><input type='radio' name='answer' value='B'> B. {$row['option_b']}</label><br>";
echo "<label><input type='radio' name='answer' value='C'> C. {$row['option_c']}</label><br>";
echo "<label><input type='radio' name='answer' value='D'> D. {$row['option_d']}</label><br>";

echo "<br><input type='submit' value='Submit & Next'>";
echo "</form>";

// Step 5: Navigation buttons (optional)
if ($qno < $totalQ) {
    echo "<a href='quizpage.php?q=" . ($qno + 1) . "'><button>Skip to Next</button></a>";
}

$conn->close();
?>
