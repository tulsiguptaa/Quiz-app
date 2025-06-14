<?php
session_start();
$conn = new mysqli("localhost", "root", "", "quiz_app");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$_SESSION['score'] = 0;
$questionNumber = 1;

$result = $conn->query("SELECT * FROM questions WHERE id = $questionNumber");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <link rel="stylesheet" href="quiz.css">
    <script>
        let timeLeft = 30;
        function startTimer() {
            const timer = setInterval(() => {
                document.getElementById("timer").innerText = timeLeft + "s";
                timeLeft--;
                if (timeLeft < 0) {
                    clearInterval(timer);
                    document.getElementById("quizForm").submit();
                }
            }, 1000);
        }
        window.onload = startTimer;
    </script>
</head>
<body>
    <h2>Question <?php echo $questionNumber; ?>:</h2>
    <div id="timer" style="font-weight: bold; color: red;">30s</div>
    <p><?php echo $row['question_text']; ?></p>
    <form id="quizForm" method="post" action="next.php">
        <input type="hidden" name="questionNumber" value="2">
        <input type="hidden" name="correctAnswer" value="<?php echo $row['correct_option']; ?>">
        <label><input type="radio" name="answer" value="A"> <?php echo $row['option_a']; ?></label><br>
        <label><input type="radio" name="answer" value="B"> <?php echo $row['option_b']; ?></label><br>
        <label><input type="radio" name="answer" value="C"> <?php echo $row['option_c']; ?></label><br>
        <label><input type="radio" name="answer" value="D"> <?php echo $row['option_d']; ?></label><br><br>
        <button type="submit">Next</button>
    </form>
</body>
</html>
