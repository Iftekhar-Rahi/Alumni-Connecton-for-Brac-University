-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 08:23 AM
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
-- Database: `alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumni_socials`
--

CREATE TABLE `alumni_socials` (
  `user_id` int(11) NOT NULL,
  `socials` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answered_by_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answered_by_id`, `question_id`, `answer`) VALUES
(40, 1, 'Hi');

-- --------------------------------------------------------

--
-- Table structure for table `eventseminar`
--

CREATE TABLE `eventseminar` (
  `event_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `event_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `sender_id`, `receiver_id`, `status`, `created_at`) VALUES
(1, 40, 9, 'pending', '2025-05-14 04:23:24'),
(5, 40, 17, 'pending', '2025-05-14 04:26:07'),
(6, 40, 11, 'pending', '2025-05-14 04:27:29'),
(7, 7, 40, 'accepted', '2025-05-14 04:50:59'),
(8, 7, 41, 'accepted', '2025-05-14 05:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `sent_at`) VALUES
(1, 7, 40, 'Hlw bhai', '2025-05-14 05:15:32'),
(2, 7, 40, 'How are you?', '2025-05-14 05:15:41'),
(3, 7, 40, 'Bhaiiiiiiiiiiiii', '2025-05-14 05:21:44'),
(4, 7, 40, 'OOO', '2025-05-14 05:33:12'),
(5, 7, 40, 'pp\r\n', '2025-05-14 05:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `poll_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `content` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`poll_id`, `option_id`, `content`) VALUES
(14, 1, 'sdfg'),
(14, 2, 'xcv'),
(15, 1, 'sdfg'),
(15, 2, 'xcv'),
(16, 1, 'sdfg'),
(16, 2, 'xcv'),
(17, 1, '1'),
(17, 2, '2'),
(17, 3, '3');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `poll_id` int(11) NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `poll_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`poll_id`, `created_by_id`, `timestamp`, `poll_info`) VALUES
(14, 4, '2025-05-06 13:54:52', 'asdfghj'),
(15, 4, '2025-05-06 13:55:15', 'asdfghj'),
(16, 4, '2025-05-06 13:56:26', 'asdfghj'),
(17, 5, '2025-05-07 05:42:20', 'color?');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qa_board_discussion`
--

CREATE TABLE `qa_board_discussion` (
  `question_id` int(11) NOT NULL,
  `asked_by_id` int(11) DEFAULT NULL,
  `question` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qa_board_discussion`
--

INSERT INTO `qa_board_discussion` (`question_id`, `asked_by_id`, `question`, `timestamp`) VALUES
(1, 40, 'Hlw', '2025-05-14 03:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `interests` text DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL,
  `achievements` text DEFAULT NULL,
  `graduation_year` int(11) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `interests`, `user_type`, `achievements`, `graduation_year`, `skills`, `industry`) VALUES
(4, 'bus', 'busin@gmail.com', '$2y$10$1wNt2cO9/2Yi59e/.db6guTpbPfXZkqSmGC2yLFYV548ea7ihytai', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Bithi', 'bithiHaque@gmail.com', '$2y$10$qV9MpFbzc8r2cygyl7vkPeyjq9qmYhdbzs8aj.e3gVmWblX5jpNXe', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'namira', 'abrar@gmail.com', '$2y$10$CZafwQpsryswR8fpuEeDmuKEv9xCyRbw/1nlQioQOXaDCLxX8TKNW', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Rahi', 'iftekharhossainrahi@gmail.com', '$2y$10$sXO/HvSK.MGzLYlE2HKVauFUNsH/Tuj1AMc6/X0szFdQrkvrntYzu', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Rafi', 'rafi@example.com', '1234', 'AI, Robotics', 'student', 'Math Olympiad Winner', 2026, 'Python, C++', 'Technology'),
(9, 'Tanim', 'tanim@example.com', '1234', 'Web Development, Design', 'alumni', 'Dean’s List', 2022, 'HTML, CSS, JavaScript', 'IT'),
(10, 'Sajid', 'sajid@example.com', '1234', 'Machine Learning, Startups', 'student', 'Top 10 Hackathon', 2025, 'Python, TensorFlow', 'AI'),
(11, 'Nayeem', 'nayeem@example.com', '1234', 'Cybersecurity, Gaming', 'alumni', 'Capture the Flag Finalist', 2021, 'Linux, Networking', 'Security'),
(12, 'Sabbir', 'sabbir@example.com', '1234', 'Data Science, Books', 'student', 'Research Paper Published', 2024, 'R, SQL', 'Data Analysis'),
(13, 'Arif', 'arif@gmail.com', '1234', 'Software Development, AI', 'student', 'Best Project Award', 2027, 'Java, C#', 'Technology'),
(14, 'Mina', 'mina@gmail.com', '1234', 'Design, UI/UX', 'student', 'Internship at Google', 2026, 'Figma, Photoshop', 'Design'),
(15, 'Kamal', 'kamal@gmail.com', '1234', 'Cloud Computing, Data Science', 'alumni', 'Cloud Champion', 2023, 'AWS, Python', 'Cloud'),
(16, 'Rana', 'rana@gmail.com', '1234', 'Gaming, Game Development', 'student', 'Top Gamer Award', 2026, 'Unity, C#', 'Gaming'),
(17, 'Anika', 'anika@gmail.com', '1234', 'Finance, Investment', 'alumni', 'CFA Level 1', 2020, 'Excel, Financial Modeling', 'Finance'),
(18, 'Shakib', 'shakib@gmail.com', '1234', 'Digital Marketing, Content Creation', 'student', 'YouTube Channel Success', 2027, 'SEO, Social Media', 'Marketing'),
(19, 'Farhan', 'farhan@gmail.com', '1234', 'AI, Robotics', 'student', 'AI Hackathon Winner', 2025, 'Python, Machine Learning', 'AI'),
(20, 'Fariha', 'fariha@gmail.com', '1234', 'Philosophy, Psychology', 'alumni', 'Published Book', 2022, 'Research, Writing', 'Academia'),
(21, 'Rashed', 'rashed@gmail.com', '1234', 'Photography, Editing', 'student', 'Top Photographer of the Year', 2024, 'Adobe Photoshop, Lightroom', 'Photography'),
(22, 'Sadia', 'sadia@gmail.com', '1234', 'Fashion, Marketing', 'alumni', 'Fashion Blogger', 2021, 'Branding, E-commerce', 'Fashion'),
(23, 'Bilal', 'bilal@gmail.com', '1234', 'Healthcare, Nutrition', 'student', 'Nutritionist of the Year', 2026, 'Diet Plans, Wellness', 'Healthcare'),
(24, 'Sara', 'sara@gmail.com', '1234', 'Software Engineering, Web Development', 'student', 'Hackathon Winner', 2025, 'JavaScript, React', 'Technology'),
(25, 'Tariq', 'tariq@gmail.com', '1234', 'Data Analytics, Business Intelligence', 'alumni', 'BI Tools Certification', 2020, 'Tableau, Power BI', 'Analytics'),
(26, 'Hassan', 'hassan@gmail.com', '1234', 'Entrepreneurship, Marketing', 'student', 'Startup Founder', 2026, 'Business Strategy, Sales', 'Business'),
(27, 'Mushfiq', 'mushfiq@gmail.com', '1234', 'Education, E-Learning', 'alumni', 'E-Learning Platform Developer', 2022, 'Moodle, Content Creation', 'Education'),
(28, 'Rohit', 'rohit@gmail.com', '1234', 'AI, Deep Learning', 'student', 'Deep Learning Certification', 2024, 'TensorFlow, Keras', 'AI'),
(29, 'Zara', 'zara@gmail.com', '1234', 'Cybersecurity, Ethical Hacking', 'alumni', 'Penetration Testing Certified', 2021, 'Kali Linux, Nmap', 'Security'),
(30, 'Ahsan', 'ahsan@gmail.com', '1234', 'Content Writing, Marketing', 'student', 'Content Creator of the Year', 2027, 'WordPress, SEO', 'Marketing'),
(31, 'Mehreen', 'mehreen@gmail.com', '1234', 'Journalism, Media', 'alumni', 'Best Journalist Award', 2020, 'Writing, Editing', 'Media'),
(32, 'Omar', 'omar@gmail.com', '1234', 'Architecture, Design', 'student', 'Architectural Design Award', 2026, 'AutoCAD, Revit', 'Architecture'),
(38, 'dhur', 'dhur@gmail.com', '1234', 'Web design', 'student', NULL, NULL, NULL, NULL),
(40, 'TOnu', 'tonu@gmail.com', '$2y$10$uCCpvW88HghyhxYndeUdK.XdDeCFSzRNH939cJh89iBSxBNvkvvdm', 'Web design', 'alumni', 'Deans Award', 2027, 'Fighting', 'Data Science'),
(41, 'Nananana', 'no@gmail.com', '$2y$10$cBzRZutLwzsMms3fVVlyR.m1JkNSMKPmPP3eQTvIj/bnBPWVIlF1e', 'Web design', 'alumni', 'Deans Award', 2027, 'Fighting', 'Data Science');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `user_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`user_id`, `poll_id`, `option_id`) VALUES
(4, 14, 2),
(5, 17, 2),
(6, 17, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumni_socials`
--
ALTER TABLE `alumni_socials`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answered_by_id`,`question_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `eventseminar`
--
ALTER TABLE `eventseminar`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sender_id` (`sender_id`,`receiver_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`poll_id`,`option_id`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`user_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`poll_id`),
  ADD KEY `created_by_id` (`created_by_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `qa_board_discussion`
--
ALTER TABLE `qa_board_discussion`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `asked_by_id` (`asked_by_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`poll_id`,`option_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventseminar`
--
ALTER TABLE `eventseminar`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qa_board_discussion`
--
ALTER TABLE `qa_board_discussion`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni_socials`
--
ALTER TABLE `alumni_socials`
  ADD CONSTRAINT `alumni_socials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`answered_by_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `qa_board_discussion` (`question_id`);

--
-- Constraints for table `eventseminar`
--
ALTER TABLE `eventseminar`
  ADD CONSTRAINT `eventseminar_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD CONSTRAINT `friend_requests_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friend_requests_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`poll_id`);

--
-- Constraints for table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `eventseminar` (`event_id`);

--
-- Constraints for table `poll`
--
ALTER TABLE `poll`
  ADD CONSTRAINT `poll_ibfk_1` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `qa_board_discussion`
--
ALTER TABLE `qa_board_discussion`
  ADD CONSTRAINT `qa_board_discussion_ibfk_1` FOREIGN KEY (`asked_by_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `voting`
--
ALTER TABLE `voting`
  ADD CONSTRAINT `voting_ibfk_1` FOREIGN KEY (`poll_id`,`option_id`) REFERENCES `options` (`poll_id`, `option_id`),
  ADD CONSTRAINT `voting_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
