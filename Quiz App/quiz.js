document.addEventListener('DOMContentLoaded', () => {
  const form_outer = document.querySelector('.form-outer');
  const log_in = document.querySelectorAll('.log-in');
  const sign_up = document.querySelector('.sign-up');
  const register = document.querySelector('.form-box.Register');
  const login = document.querySelector('.form-box.Login');
  const infoLogin = document.querySelector('.info.Login');
  const infoRegister = document.querySelector('.info.Register');

  // Set initial state
  login.style.display = "flex";
  register.style.display = "none";
  infoLogin.style.display = "flex";
  infoRegister.style.display = "none";

  // Sign Up click handler
  sign_up.addEventListener('click', (e) => {
    e.preventDefault();
    console.log('Sign up clicked'); // Debug log
    form_outer.classList.add('active');
  });

  // Sign In click handler for all sign-in links
  log_in.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      console.log('Sign in clicked'); // Debug log
      form_outer.classList.remove('active');
    });
  });

  // navbar page
  let menu = document.querySelector('#menu-icon');
  let navbar = document.querySelector('.navbar');

  menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');
  }

  // User data management
  let currentUser = null;

  // Function to get user data
  function getUserData() {
    return JSON.parse(localStorage.getItem('userData')) || {};
  }

  // Function to save user data
  function saveUserData(userData) {
    localStorage.setItem('userData', JSON.stringify(userData));
  }

  // Function to update user score
  function updateUserScore(username, quizName, score) {
    const userData = getUserData();

    if (!userData[username]) {
      userData[username] = {
        name: username,
        scores: [],
        totalScore: 0,
        quizzesTaken: 0,
        highestScore: 0
      };
    }

    // Add new score
    userData[username].scores.push({
      quizName: quizName,
      score: score,
      date: new Date().toISOString().split('T')[0]
    });

    // Update statistics
    userData[username].totalScore += score;
    userData[username].quizzesTaken += 1;
    userData[username].highestScore = Math.max(userData[username].highestScore, score);

    saveUserData(userData);
  }

  // Function to get user scores
  function getUserScores(username) {
    const userData = getUserData();
    return userData[username] || null;
  }

  // Function to update scoreboard display
  function updateScoreboard(username) {
    const userData = getUserScores(username);
    if (!userData) return;

    // Update welcome message
    document.querySelector('.score-h2').textContent = `Welcome, ${userData.name} 👋`;

    // Update statistics
    const statBoxes = document.querySelectorAll('.stat-box p');
    if (statBoxes.length >= 3) {
      statBoxes[0].textContent = userData.totalScore;
      statBoxes[1].textContent = userData.quizzesTaken;
      statBoxes[2].textContent = `${userData.highestScore}%`;
    }

    // Update recent scores table
    const tableBody = document.querySelector('.score-table tbody');
    if (tableBody) {
      tableBody.innerHTML = '';
      userData.scores.slice(-3).reverse().forEach(score => {
        const row = document.createElement('tr');
        row.innerHTML = `
                    <td>${score.quizName}</td>
                    <td>${score.date}</td>
                    <td>${score.score}%</td>
                    <td><span class="status passed">Passed</span></td>
                `;
        tableBody.appendChild(row);
      });
    }
  }

  // Example usage:
  // updateUserScore('Naina', 'JavaScript Basics', 85);
  // updateUserScore('Naina', 'HTML & CSS', 92);
  // updateUserScore('Naina', 'Python Fundamentals', 78);

  // Call this when the scoreboard page loads
  document.addEventListener('DOMContentLoaded', () => {
    // Get current user from localStorage or use a default
    currentUser = localStorage.getItem('currentUser') || 'Naina';
    updateScoreboard(currentUser);
  });

  // Quiz functionality
  const questions = [
    {
      question: "What is JavaScript?",
      options: [
        "A programming language",
        "A markup language",
        "A styling language",
        "A database"
      ],
      correct: 0
    },
    {
      question: "Which of the following is NOT a JavaScript data type?",
      options: [
        "String",
        "Boolean",
        "Float",
        "Number"
      ],
      correct: 2
    },
    {
      question: "What does DOM stand for?",
      options: [
        "Document Object Model",
        "Data Object Model",
        "Document Oriented Model",
        "Data Oriented Model"
      ],
      correct: 0
    },
    // Add more questions here
  ];

  let currentQuestion = 0;
  let score = 0;
  let timer;
  let timeLeft = 30;

  function startQuiz() {
    showQuestion();
    startTimer();
  }

  function showQuestion() {
    const question = questions[currentQuestion];
    document.getElementById('question').textContent = question.question;

    for (let i = 0; i < 4; i++) {
      document.getElementById(`option${i + 1}`).nextElementSibling.textContent = question.options[i];
    }

    document.getElementById('question-number').textContent = `Question ${currentQuestion + 1}/${questions.length}`;
    updateProgress();
  }

  function startTimer() {
    timeLeft = 30;
    const timerElement = document.getElementById('time');
    const timerContainer = document.querySelector('.timer');

    timerElement.textContent = timeLeft;
    timerContainer.style.color = 'var(--CORRECT-ANS)';

    clearInterval(timer);
    timer = setInterval(() => {
      timeLeft--;
      timerElement.textContent = timeLeft;

      // Change color when time is running low
      if (timeLeft <= 10) {
        timerContainer.style.color = '#EF5350'; // Red color for warning
        timerContainer.style.animation = 'pulse 1s infinite';
      }

      if (timeLeft <= 0) {
        clearInterval(timer);
        nextQuestion();
      }
    }, 1000);
  }

  function nextQuestion() {
    const selectedOption = document.querySelector('input[name="answer"]:checked');

    if (selectedOption) {
      const answer = parseInt(selectedOption.id.replace('option', '')) - 1;
      if (answer === questions[currentQuestion].correct) {
        score++;
      }
    }

    currentQuestion++;

    if (currentQuestion < questions.length) {
      showQuestion();
      startTimer();
      document.querySelectorAll('input[name="answer"]').forEach(input => input.checked = false);
    } else {
      endQuiz();
    }
  }

  function updateProgress() {
    const progress = (currentQuestion / questions.length) * 100;
    document.querySelector('.progress').style.width = `${progress}%`;
  }

  function endQuiz() {
    clearInterval(timer);
    const scorePercentage = (score / questions.length) * 100;

    // Update user's score
    const currentUser = localStorage.getItem('currentUser');
    if (currentUser) {
      updateUserScore(currentUser, 'JavaScript Quiz', scorePercentage);
    }

    // Show results
    document.querySelector('.quiz-container').innerHTML = `
            <div class="quiz-results">
                <h2>Quiz Completed!</h2>
                <p>Your score: ${scorePercentage}%</p>
                <p>Correct answers: ${score} out of ${questions.length}</p>
                <button onclick="window.location.href='Scoreboard.html'" class="btn">View Scoreboard</button>
            </div>
        `;
  }

  // Add this CSS animation for the warning state
  const style = document.createElement('style');
  style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    `;
  document.head.appendChild(style);

  // Make sure timer starts when quiz begins
  document.addEventListener('DOMContentLoaded', () => {
    startQuiz();

    // Add event listener for next button
    document.getElementById('next-btn').addEventListener('click', () => {
      clearInterval(timer); // Clear timer when manually moving to next question
      nextQuestion();
    });
  });
});
