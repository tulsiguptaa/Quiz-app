<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Landing Page</title>
    <link rel="stylesheet" href="quiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
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
                <!-- <a href="Profile.php" class="" user><i class="ri-user-fill"></i>Profile</a> -->
            </ul>

            <div class="main">
                <a href="Profile.php" class="" user><i class="ri-user-fill"></i>Profile</a>
                <div class="bx bx-menu" id="menu icon"></div>
            </div>
        </header>
    </div>

    <!-- Quiz Landing Container -->
    <div class="quiz-container">
        <div class="quiz-landing">
            <div class="quiz-info">
                <h2>Welcome to CodeQuest</h2>
                <p>Test your knowledge and challenge yourself!</p>
            </div>

            <div class="quiz-features">
                <div class="feature">
                    <i class="ri-time-line"></i>
                    <h3>30 Seconds per Question</h3>
                    <p>Think fast and answer quickly!</p>
                </div>
                <div class="feature">
                    <i class="ri-question-line"></i>
                    <h3>10 Questions</h3>
                    <p>Test your knowledge across various topics</p>
                </div>
                <div class="feature">
                    <i class="ri-trophy-line"></i>
                    <h3>Score Points</h3>
                    <p>Earn points for correct answers</p>
                </div>
            </div>

            <div class="quiz-rules">
                <h3>Quiz Rules:</h3>
                <ul>
                    <li>Each question has 4 options</li>
                    <li>You have 30 seconds to answer each question</li>
                    <li>The timer starts as soon as the quiz begins</li>
                    <li>You cannot go back to previous questions once submitted</li>
                    <li>Do not refresh or close the quiz tab while attempting</li>
                    <li>Your answers will be automatically submitted when time runs out</li>
                    <li>No negative marking</li>
                    <li>Your score will be displayed at the end</li>
                </ul>
            </div>

            <div class="quiz-start">
                <?php
                session_start();
                if(isset($_SESSION['user_id'])) {
                    echo '<a href="new.php" class="start-btn">Start Quiz</a>';
                } else {
                    echo '<div class="login-prompt">';
                    echo '<p>Please login to start the quiz</p>';
                    echo '<a href="Login.html" class="login-btn">Login Now</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <style>
        .login-prompt {
            text-align: center;
            margin: 20px 0;
        }

        .login-prompt p {
            color: #666;
            margin-bottom: 15px;
            font-size: 1.1em;
        }

        .login-btn {
            display: inline-block;
            padding: 12px 30px;
            background-color:rgb(55, 184, 231);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .login-btn:hover {
            background-color:rgb(32, 102, 128);
        }

        .start-btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
            margin: 20px auto;
        }

        .start-btn:hover {
            background-color: #1976D2;
        }
    </style>

    <script src="quiz.js"></script>
</body>

</html>