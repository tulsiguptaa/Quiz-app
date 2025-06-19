<?php
session_start();
$conn = new mysqli("localhost", "root", "", "quiz_app");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$questionNumber = $_POST['questionNumber'];
$userAnswer = $_POST['answer'] ?? '';
$correctAnswer = $_POST['correctAnswer'] ?? '';

if ($userAnswer == $correctAnswer) {
    $_SESSION['score'] += 1;
}

// "SELECT * FROM questions WHERE id = $questionNumber"

$result = $conn->query("SELECT * FROM questions ORDER BY RAND() LIMIT 10");

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    header("Location: score.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="quiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <script>
        let timeLeft = 30;
        function startTimer() {
            const timer = setInterval(() => {
                document.getElementById("time").innerText = timeLeft;
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

    <!-- navbar page -->
    <div class="navbar">
        <header>
            <a href="#" class="logo"><i class="ri-home-heart-fill"></i><span>Quiz App</span></a>
            <ul class="navbar">
                <li><a href="Hhome.php" class="active">Home</a></li>
                <li><a href="About.html">About us</a></li>
                <li><a href="score.php">Scoreboard</a></li>
                <li><a href="#">Quiz</a></li>
                <li><a href="Contact.html">Contact Us</a></li>
                <li><a href="Login.html">Log in</a></li>
            </ul>

            <div class="main">
                <a href="#" class="" user><i class="ri-user-fill"></i>Profile</a>
                <div class="bx bx-menu" id="menu icon"></div>
            </div>
        </header>
    </div>

    <!-- Quiz Container -->
    <div class="quiz-container">
        <div class="quiz-header">
            <div class="quiz-info">
                <h2>Start Solving Quiz</h2>
                <p>Test your knowledge!</p>
            </div>
            <div class="timer">
                <i class="ri-timer-line"></i>
                <span id="time">30</span>s
            </div>
        </div>

        <div class="quiz-body">
            <div class="question-container">
                <h3 id="question"><?php echo $row['question_text']; ?></h3>
                <div class="options-container">
                    <form id="quizForm" method="post" action="next.php">
                        <input type="hidden" name="questionNumber" value="<?php echo $questionNumber + 1; ?>">
                        <input type="hidden" name="correctAnswer" value="<?php echo $row['correct_option']; ?>">
                        
                        <div class="option">
                            <input type="radio" name="answer" id="option1" value="A">
                            <label for="option1"><?php echo $row['option_a']; ?></label>
                        </div>
                        <div class="option">
                            <input type="radio" name="answer" id="option2" value="B">
                            <label for="option2"><?php echo $row['option_b']; ?></label>
                        </div>
                        <div class="option">
                            <input type="radio" name="answer" id="option3" value="C">
                            <label for="option3"><?php echo $row['option_c']; ?></label>
                        </div>
                        <div class="option">
                            <input type="radio" name="answer" id="option4" value="D">
                            <label for="option4"><?php echo $row['option_d']; ?></label>
                        </div>

                        <div class="quiz-footer">
                            <div class="progress-bar">
                                <div class="progress"></div>
                            </div>
                            <div class="quiz-controls">
                                <span id="question-number">Question: <?php echo $questionNumber; ?>/10</span>
                                <button type="submit" id="next-btn" class="btn">Next Question</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>