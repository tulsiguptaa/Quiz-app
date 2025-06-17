<?php
session_start();
$score = $_SESSION['score'] ?? 0;
$totalQuestions = 20; 
$percentage = ($score / $totalQuestions) * 100;
$status = $percentage >= 50 ? "Passed" : "Failed";
$date = date("Y-m-d");
$quizName = "General Quiz";


// Get username from session, default to "Guest" if not set
$username = $_SESSION['username'] ?? "Guest";
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz App</title>
    <link rel="stylesheet" href="quiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
           <!-- navbar page -->
     <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"
/>
  <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">

    
</head>
<body>
   <!-- navbar page -->
     <div class ="navbar">
        <header>
        <a href="#" class="logo"><i class="ri-home-heart-fill"></i><span>Quiz App</span></a>
        <ul class ="navbar">
            <li><a href="Hhome.php" class ="active">Home</a></li>
            <li><a href="About.html">About us</a></li>
            <li><a href="#">Scoreboard</a></li>
            <li><a href="quizStart.php">Quiz</a></li>
                <li><a href="Contact.html">Contact Us</a></li>
            <li><a href="Login.html">Log in</a></li>
            


        </ul>

        <div class="main">
            <a href="#" class=""user><i class="ri-user-fill"></i>sign In</a>
            <div class="bx bx-menu" id="menu icon"></div>
        </div>
        </header>


     </div>
<div class="score-outer">
    <div class="score-user">
        <h2 class="score-h2">Welcome, <?php echo htmlspecialchars($username); ?> 👋</h2>
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
