<?php
session_start();
$score = $_SESSION['score'] ?? 0;
$totalQuestions = 20; 
$percentage = ($score / $totalQuestions) * 100;
$status = $percentage >= 50 ? "Passed" : "Failed";
$date = date("Y-m-d");
$quizName = "General Quiz";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scoreboard</title>
    <link rel="stylesheet" href="quiz.css">
    
</head>
<body>

<div class="score-outer">
    <div class="score-user">
        <h2 class="score-h2">Welcome </h2>
        <p class="score-p">Here's your quiz performance summary.</p>
    </div>

    <div class="score-stats">
        <div class="stat-box">
            <i class="ri-medal-line"></i>
            <h3>Your Score</h3>
            <p><?php echo $score . "/" . $totalQuestions; ?></p>
        </div>
        <div class="stat-box">
            <i class="ri-question-answer-line"></i>
            <h3>Percentage</h3>
            <p><?php echo round($percentage); ?>%</p>
        </div>
        <div class="stat-box">
            <i class="ri-trophy-line"></i>
            <h3>Status</h3>
            <p><?php echo $status; ?></p>
        </div>
    </div>

    <div class="recent-scores">
        <h3>Recent Scores</h3>
        <div class="score-table">
            <table>
                <thead>
                    <tr>
                        <th>Quiz Name</th>
                        <th>Date</th>
                        <th>Score</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $quizName; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo round($percentage); ?>%</td>
                        <td><span class="status <?php echo strtolower($status); ?>"><?php echo $status; ?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
