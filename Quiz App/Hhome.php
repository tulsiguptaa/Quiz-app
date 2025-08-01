<!-- home.php -->
<?php
$host = "localhost";   
$user = "root";         
$password = "";           
$database = "quiz_app"; 

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- count the total number of users  -->
<?php
$sql = "SELECT COUNT(*) AS total_users FROM login";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_users = $row['total_users'];
} else {
    $total_users = 0;
}
?>

<!-- count the total qustions  -->
 <?php
$sql_questions = "SELECT COUNT(*) AS total_questions FROM questions";
$result_questions = $conn->query($sql_questions);

$total_questions = 0;
if ($result_questions->num_rows > 0) {
    $row_questions = $result_questions->fetch_assoc();
    $total_questions = $row_questions['total_questions'];
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- navbar page -->
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
                <li><a href="#">Home</a></li>
                <li><a href="About.html">About us</a></li>
                <li><a href="score.php">Scoreboard</a></li>
                <li><a href="quizStart.php">Quiz</a></li>
                <li><a href="Contact.html">Contact Us</a></li>
                <li><a href="Login.html">Log in</a></li>
            </ul>

            <div class="main">
                <a href="Profile.php" class="" user><i class="ri-user-fill"></i>Profile</a>

                <div class="bx bx-menu" id="menu icon"></div>
            </div>
        </header> 
    </div>
    <main></main>

    <!-- home page  -->
    <div class="home-outer">
        <div class="home-left">
            <h1 class="home-h1">
                Welcome to <span class="highlight">CodeQuest</span>
            </h1>
            <p class="home-p">
                Your Ultimate Destination for Fun, Learning & Challenge!<br><br>
                CodeQuest is an interactive quiz platform designed to sharpen your skills, test your knowledge, and make
                learning fun! Whether you're a beginner exploring the world of coding or a pro brushing up your skills —
                we have something for everyone.
            </p>
            <div class="home-btns">
                <a href="new.php" class="primary-btn">
                    <button class="home-get">
                        Get Started
                        <i class="ri-arrow-right-line"></i>
                    </button>
                </a>
                <a href="About.html" class="secondary-btn">
                    <button class="home-learn">
                        Learn More
                        <i class="ri-information-line"></i>
                    </button>
                </a>
            </div>
            <div class="home-stats">
                <div class="stat-item">
                    <i class="ri-user-line"></i>
                    <span class="stat-number"><?php echo $total_users; ?></span>
                    <span class="stat-label">Users</span>
                </div>
                <div class="stat-item">
                    <i class="ri-question-line"></i>
                    <span class="stat-number"> <?php echo $total_questions; ?>+</span>
                    <span class="stat-label">Questions</span>
                </div>
                <div class="stat-item">
                    <i class="ri-trophy-line"></i>
                    <span class="stat-number">10+</span>
                    <span class="stat-label">Topics</span>
                </div>
            </div>
        </div>
        <div class="home-right">
            <div class="image-container">
                <img src="bg.jpg" alt="home" id="home-img">
                <div class="floating-card">
                    <i class="ri-code-line"></i>
                    <span>Start Coding Now!</span>
                </div>
            </div>
        </div>
    </div>

    <script src="quiz.js"></script>
</body>

</html>