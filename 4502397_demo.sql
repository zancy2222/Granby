-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 03:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4502397_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL,
  `evaluator_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `evaluated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_form`
--

CREATE TABLE `evaluation_form` (
  `Tname` varchar(222) NOT NULL,
  `Tsubject` varchar(222) NOT NULL,
  `Q1` varchar(143) NOT NULL,
  `Q2` varchar(143) NOT NULL,
  `Q3` varchar(143) NOT NULL,
  `Q4` varchar(143) NOT NULL,
  `Q5` varchar(143) NOT NULL,
  `Q6` varchar(143) NOT NULL,
  `Q7` varchar(143) NOT NULL,
  `Q8` varchar(143) NOT NULL,
  `Q9` varchar(143) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `evaluation_time` datetime DEFAULT NULL,
  `teacher_feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_form`
--

INSERT INTO `evaluation_form` (`Tname`, `Tsubject`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `Q8`, `Q9`, `user_id`, `teacher_id`, `evaluation_time`, `teacher_feedback`) VALUES
('Mr. Marvin Ramos', 'Computer Programming 1', '5', '5', '5', '5', '5', '5', '5', '5', '5', 63323, 15, NULL, NULL),
('Mr. Clifford Togonon', 'Introduction to Computing', '5', '5', '5', '5', '5', '5', '5', '5', '5', 63323, 16, NULL, NULL),
('Mr. Marvin Ramos', 'Computer Programming 1', '5', '5', '5', '5', '5', '5', '5', '5', '5', 313213, 39, NULL, NULL),
('Mr. Matucad', 'Granby Values 1', '5', '5', '5', '5', '5', '5', '5', '5', '5', 313213, 43, NULL, NULL),
('Mr. Jovemer Agudo', 'Software Engineering', '2', '3', '3', '3', '3', '2', '4', '3', '3', 308, 78, NULL, NULL),
('Mr. Jonnel Bilaos', 'Database Management System 2', '3', '3', '3', '3', '2', '2', '2', '4', '4', 308, 79, NULL, NULL),
('Mr. Marvin Ramos', 'Computer Programming 1', '1', '2', '3', '4', '3', '2', '1', '2', '3', 42312, 8, '2024-11-10 18:27:28', 'Hello world, ang hirap mo ayusin!!!!!!!!!!!!'),
('Mr. Clifford Togonon', 'Introduction to Computing', '2', '5', '5', '5', '5', '5', '5', '5', '5', 42312, 9, '2024-11-10 18:48:23', 'Mahalin mo naman ako '),
('Ms. Lyka Acedillo', 'Literature', '4', '3', '4', '4', '2', '4', '2', '4', '3', 308, 83, '2024-11-11 12:10:59', 'fsutdilwehd.lwhenc'),
('Mr. Regan Legaspi', 'Purposive Communication', '1', '5', '5', '3', '2', '3', '3', '2', '3', 111223, 168, '2024-11-11 22:19:57', 'qwqewr ere ssssssssssssssssssssssssssssssssssssssssssssssssssssssssss'),
('Mr. Clifford Togonon', 'Emerging Technology', '1', '4', '3', '2', '4', '1', '2', '3', '2', 222111, 170, '2024-11-13 22:06:29', 'good'),
('Mr. Clifford Togonon', 'Emerging Technology', '5', '4', '3', '3', '3', '3', '3', '3', '3', 299900, 170, '2024-11-14 12:03:12', 'good');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_status`
--

CREATE TABLE `evaluation_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_status`
--

INSERT INTO `evaluation_status` (`id`, `status`, `last_updated`) VALUES
(104, 'ongoing', '2024-10-26 12:15:56'),
(105, 'closed', '2024-11-06 09:50:54'),
(106, 'closed', '2024-11-06 09:51:07'),
(107, 'ongoing', '2024-11-06 09:51:10'),
(108, 'closed', '2024-11-09 13:07:20'),
(109, 'ongoing', '2024-11-09 13:07:36'),
(110, 'closed', '2024-11-10 08:07:25'),
(111, 'ongoing', '2024-11-10 08:17:04'),
(112, 'closed', '2024-11-11 04:07:31'),
(113, 'ongoing', '2024-11-11 04:09:55'),
(114, 'closed', '2024-11-11 14:24:03'),
(115, 'ongoing', '2024-11-11 14:51:51'),
(116, 'closed', '2024-11-14 04:14:17'),
(117, 'ongoing', '2024-11-15 05:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `message`, `created_at`) VALUES
(1, 'hello world', '2024-11-10 10:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `mlogin`
--

CREATE TABLE `mlogin` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Cpassword` varchar(255) NOT NULL,
  `Mbranch` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_login`
--

CREATE TABLE `m_login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_login`
--

INSERT INTO `m_login` (`id`, `username`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `question_type` enum('rating','text') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `rate`, `question_type`, `created_at`, `comments`) VALUES
(32, 'Does the teacher incorporate technology and modern teaching tools effectively into their lessons?', 0, 'rating', '2024-06-12 17:08:51', NULL),
(33, 'Does the teacher demonstrate a genuine passion for teaching and a commitment to student success?', 0, 'rating', '2024-06-12 17:08:56', NULL),
(34, 'How effective are the teaching methods in this course? Do they help you understand the material?', 0, 'rating', '2024-06-13 18:37:21', NULL),
(35, 'Rate the instructor\'s availability and responsiveness; have they addressed your questions?', 0, 'rating', '2024-06-13 18:37:37', NULL),
(36, 'Does the course content meet your expectations and learning goals? Is it relevant?', 0, 'rating', '2024-06-13 18:37:46', NULL),
(40, 'Does the teacher use a variety of teaching methods and resources to cater to different learning styles?', 0, 'rating', '2024-06-26 10:46:16', NULL),
(41, 'Does the teacher use a variety of teaching methods and resources to cater to different learning styles?', 0, 'rating', '2024-06-26 10:46:24', NULL),
(43, 'Does the teacher provide prompt and constructive feedback on assignments and assessments?', 0, 'rating', '2024-07-08 11:55:05', NULL),
(44, 'Does the teacher provide prompt and constructive feedback on assignments and assessments?', 0, 'rating', '2024-07-08 11:55:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `remember_tokens`
--

CREATE TABLE `remember_tokens` (
  `id` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slogin`
--

CREATE TABLE `slogin` (
  `id_student` int(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `Cpass` varchar(2222) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Mname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Suffix` varchar(50) NOT NULL,
  `Branch` varchar(255) NOT NULL,
  `Course` varchar(255) NOT NULL,
  `Section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slogin`
--

INSERT INTO `slogin` (`id_student`, `pass`, `Cpass`, `Fname`, `Mname`, `Lname`, `Suffix`, `Branch`, `Course`, `Section`) VALUES
(111111, '12345678', '12345678', 'Bambi', '', 'Ocampo', '', 'Granby College', 'Bachelor of Science in Information Technology', 'BSIT 3A'),
(111223, '12345678', '12345678', 'Apple', '', 'Grata', '', 'Granby College', 'Bachelor of Science in Information Technology', 'BSIT 4A'),
(123456, 'qwertyui', 'qwertyui', 'Kyle', '', 'Absalon', '', 'Granby College', 'Bachelor of Science in Information Technology', 'BSIT 3A'),
(222111, '12345678', '12345678', 'Dongie', '', 'Ilac', '', 'Granby College', 'Bachelor of Science in Information Technology', 'BSIT 4A'),
(222216, '11111111', '11111111', 'GIlliane', 'Trenchera', 'Soliman', '', 'Granby College', 'Bachelor of Science in Information Technology', 'BSIT 3A'),
(299900, '12345678', '12345678', 'Kyle', '', 'Absalon', '', 'Granby College', 'Bachelor of Science in Information Technology', 'BSIT 4A');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `image_path` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `Tname` varchar(255) NOT NULL,
  `Tsubject` varchar(255) NOT NULL,
  `Section` varchar(255) NOT NULL,
  `Branch` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`image_path`, `id`, `Tname`, `Tsubject`, `Section`, `Branch`) VALUES
('img/t2.png', 9, 'Mr. Clifford Togonon', 'Introduction to Computing', 'BSIT 1B', 'Granby College'),
('img/t3.png', 10, 'Mr. Wilbur Neon Terrence Mundo', 'Purposive Communication', 'BSIT 1B', 'Granby College'),
('img/t4.png', 11, 'Mr. Ryan Grumal', 'Civil Welfare Training Services 1 (NSTP1)', 'BSIT 1B', 'Granby College'),
('img/t5.png', 12, 'Mr. Matucad', 'Granby Values 1', 'BSIT 1B', 'Granby College'),
('img/t6.png', 13, 'Mr. Esteron', 'Mathematics in Modern World', 'BSIT 1B', 'Granby College'),
('img/t7.png', 14, 'Ms. Vergino', 'Readings in Philippine History', 'BSIT 1B', 'Granby College'),
('img/t1.png', 78, 'Mr. Jovemer Agudo', 'Software Engineering', 'BSIT 3A', 'Granby College'),
('img/t3.png', 80, 'Mr. Victoriano', 'IT Elective', 'BSIT 3A', 'Granby College'),
('img/t4.png', 81, 'Mr. Jonnel Bilaos', 'PE 4', 'BSIT 3A', 'Granby College'),
('img/t5.png', 82, 'Ms. Cherri Sorrida', 'Readings in Philippine History', 'BSIT 3A', 'Granby College'),
('img/t6.png', 83, 'Ms. Lyka Acedillo', 'Literature', 'BSIT 3A', 'Granby College'),
('img/t7.png', 84, 'Mrs. Madriaga', 'Filipino 2', 'BSIT 3A', 'Granby College'),
('img/t8.png', 85, 'Mr. Jonathan Sabalo', 'Network Administration', 'BSIT 3A', 'Granby College'),
('./teacher/businessman-1.png', 170, 'Mr. Clifford Togonon', 'Emerging Technology', 'BSIT 4A', 'Granby College'),
('./teacher/businessman-1.png', 172, 'Mr. Daryl Abad', 'System Administration', 'BSIT 4A', 'Granby College'),
('./teacher/businessman-1.png', 173, 'Mr. Clifford Togonon', 'Technopreneurship', 'BSIT 4A', 'Granby College'),
('./teacher/businessman-1.png', 174, 'Mr. Marvin Ramos', 'System Integration and Architecture', 'BSIT 4A', 'Granby College'),
('./teacher/beautiful-woman-avatar-character-icon-free-vector.jpg', 175, 'Ms. Arvel Himor', 'IT Elective 2 (Mobile Application)', 'BSIT 4A', 'Granby College'),
('./teacher/businessman-1.png', 176, 'Mr. Regan Legaspi', 'Filipino 2', 'BSIT 4A', 'Granby College'),
('./teacher/businessman-1.png', 177, 'Mr. Clifford Togonon', 'Computer Programming', 'BSIT 1B', 'Granby College');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_status`
--
ALTER TABLE `evaluation_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlogin`
--
ALTER TABLE `mlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_login`
--
ALTER TABLE `m_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slogin`
--
ALTER TABLE `slogin`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evaluation_status`
--
ALTER TABLE `evaluation_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_login`
--
ALTER TABLE `m_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
