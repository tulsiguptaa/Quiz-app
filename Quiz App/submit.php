<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $qno = $_GET['q'];
    $user_answer = $_POST['answer'] ?? 'NA';

    // Save answer in session (you can store in DB if needed)
    $_SESSION["answers"][$qno] = $user_answer;

    // Redirect to next question
    header("Location: quizpage.php?q=" . ($qno + 1));
    exit();
}
?>
