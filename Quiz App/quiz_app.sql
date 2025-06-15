-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2025 at 04:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'ttulsi1@gmail.com', 'naina'),
(2, 'ttulsigupta86@gmail.com', 'nanana');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_text` varchar(66) DEFAULT NULL,
  `option_a` varchar(30) DEFAULT NULL,
  `option_b` varchar(26) DEFAULT NULL,
  `option_c` varchar(28) DEFAULT NULL,
  `option_d` varchar(26) DEFAULT NULL,
  `correct_option` varchar(1) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `id`) VALUES
('What is the output of print(2 ** 3) in Python?', '6', '8', '9', '16', 'B', 1),
('Which data structure uses FIFO?', 'Stack', 'Queue', 'Tree', 'Graph', 'B', 2),
('What does HTML stand for?', 'Hyper Trainer Marking Language', 'Hyper Text Markup Language', 'Hyper Text Markdown Language', 'High Text Machine Language', 'B', 3),
('Which keyword is used to create a function in Python?', 'func', 'function', 'def', 'define', 'C', 4),
('Which of these is a correct variable name in C?', '1value', '_value', '@value', '#value', 'B', 5),
('Which of these is not a programming language?', 'Python', 'Java', 'HTML', 'Swift', '7', 6),
('Which loop is guaranteed to execute at least once?', 'for', 'while', 'do-while', 'foreach', 'C', 7),
('Which operator is used for assignment in C++?', '==', '=', ':=', '===', 'B', 8),
('What is the time complexity of binary search?', 'O(n)', 'O(log n)', 'O(n log n)', 'O(1)', 'B', 9),
('What is the purpose of SQL?', 'Design webpages', 'Style HTML', 'Manage databases', 'Send emails', 'C', 10),
('Which language is used for web page structure?', 'CSS', 'HTML', 'JavaScript', 'Python', 'B', 11),
('Which sorting algorithm is best on average?', 'Bubble Sort', 'Quick Sort', 'Selection Sort', 'Insertion Sort', 'B', 12),
('Which of the following is a Python data type?', 'tuple', 'set', 'list', 'All of these', 'D', 13),
('Which file extension is used for Python?', '.py', '.java', '.js', '.html', 'A', 14),
('Which keyword is used to stop a loop in Python?', 'exit', 'stop', 'break', 'return', 'C', 15),
('Which of the following is a loop structure in C?', 'if', 'switch', 'for', 'case', 'C', 16),
('What is the extension of a C++ file?', '.c', '.cpp', '.py', '.java', 'B', 17),
('What is used to define a class in Python?', 'object', 'class', 'define', 'init', 'B', 18),
('Which of the following is used to comment a single line in Python?', '//', '#', '<!-->', '--', 'B', 19),
('What is the default value of an uninitialized int variable in C?', '0', '-1', 'undefined', 'null', 'C', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_email` (`username`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
