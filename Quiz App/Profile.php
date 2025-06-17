 <?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: Login.html");
    exit();
}

$username = $_SESSION['username'];

// Fetch user data from database
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Fetch user's quiz statistics
$stats_sql = "SELECT 
    COUNT(*) as quizzes_taken,
    SUM(score) as total_score,
    MAX(score) as highest_score,
    AVG(score) as average_score
    FROM quiz_results 
    WHERE username = ?";
$stats_stmt = $conn->prepare($stats_sql);
$stats_stmt->bind_param("s", $username);
$stats_stmt->execute();
$stats = $stats_stmt->get_result()->fetch_assoc();

// Fetch recent quiz results
$recent_sql = "SELECT quiz_name, score, date_taken 
    FROM quiz_results 
    WHERE username = ? 
    ORDER BY date_taken DESC 
    LIMIT 5";
$recent_stmt = $conn->prepare($recent_sql);
$recent_stmt->bind_param("s", $username);
$recent_stmt->execute();
$recent_results = $recent_stmt->get_result();

// Calculate achievement level based on total score
$achievement_level = "Beginner";
if ($stats['total_score'] > 1000) $achievement_level = "Expert";
elseif ($stats['total_score'] > 500) $achievement_level = "Advanced";
elseif ($stats['total_score'] > 200) $achievement_level = "Intermediate";
?> 

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Quiz App</title>
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
                <li><a href="quizStart.php">Quiz</a></li>
                <li><a href="Contact.html">Contact Us</a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
            <div class="main">
                <a href="Profile.php" class="user"><i class="ri-user-fill"></i>Profile</a>
                <div class="bx bx-menu" id="menu-icon"></div>
            </div>
        </header>
    </div>

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="ri-user-fill"></i>
                <div class="achievement-badge">
                    <span><?php echo $achievement_level; ?></span>
                </div>
            </div>
            <div class="profile-title">
                <h1><?php echo htmlspecialchars($user['username']); ?></h1>
                <p class="member-since">Member since <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
            </div>
        </div>

        <div class="profile-stats">
            <div class="stat-card">
                <i class="ri-trophy-fill"></i>
                <div class="stat-info">
                    <h3>Total Score</h3>
                    <p><?php echo number_format($stats['total_score'] ?? 0); ?></p>
                </div>
            </div>
            <div class="stat-card">
                <i class="ri-question-answer-fill"></i>
                <div class="stat-info">
                    <h3>Quizzes Taken</h3>
                    <p><?php echo $stats['quizzes_taken'] ?? 0; ?></p>
                </div>
            </div>
            <div class="stat-card">
                <i class="ri-star-fill"></i>
                <div class="stat-info">
                    <h3>Highest Score</h3>
                    <p><?php echo ($stats['highest_score'] ?? 0) . '%'; ?></p>
                </div>
            </div>
            <div class="stat-card">
                <i class="ri-line-chart-fill"></i>
                <div class="stat-info">
                    <h3>Average Score</h3>
                    <p><?php echo round($stats['average_score'] ?? 0) . '%'; ?></p>
                </div>
            </div>
        </div>

        <div class="profile-sections">
            <div class="section personal-info">
                <h2><i class="ri-user-settings-fill"></i> Personal Information</h2>
                <div class="info-content">
                    <div class="info-group">
                        <label>Username</label>
                        <p><?php echo htmlspecialchars($user['username']); ?></p>
                    </div>
                    <div class="info-group">
                        <label>Email</label>
                        <p><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                    <div class="info-group">
                        <label>Achievement Level</label>
                        <p class="achievement-level"><?php echo $achievement_level; ?></p>
                    </div>
                </div>
            </div>

            <div class="section recent-quizzes">
                <h2><i class="ri-history-fill"></i> Recent Quiz Results</h2>
                <div class="quiz-results">
                    <?php if ($recent_results->num_rows > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Quiz Name</th>
                                    <th>Score</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $recent_results->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['quiz_name']); ?></td>
                                        <td>
                                            <div class="score-bar">
                                                <div class="score-fill" style="width: <?php echo $row['score']; ?>%"></div>
                                                <span><?php echo $row['score']; ?>%</span>
                                            </div>
                                        </td>
                                        <td><?php echo date('M j, Y', strtotime($row['date_taken'])); ?></td>
                                        <td>
                                            <span class="status-badge <?php echo $row['score'] >= 70 ? 'passed' : 'failed'; ?>">
                                                <?php echo $row['score'] >= 70 ? 'Passed' : 'Failed'; ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="no-results">
                            <i class="ri-question-answer-line"></i>
                            <p>No quiz results yet. Start taking quizzes to see your results here!</p>
                            <a href="new.php" class="btn">Take a Quiz</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="profile-actions">
            <button class="btn edit-profile" onclick="editProfile()">
                <i class="ri-edit-fill"></i> Edit Profile
            </button>
            <button class="btn change-password" onclick="changePassword()">
                <i class="ri-lock-password-fill"></i> Change Password
            </button>
        </div>
    </div>

    <script src="quiz.js"></script>
</body>
</html>  

