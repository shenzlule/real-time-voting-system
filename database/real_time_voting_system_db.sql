-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 07:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `role` enum('superadmin','moderator','viewer') DEFAULT 'superadmin',
  `photo` varchar(150) NOT NULL,
  `created_on` date NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `role`, `photo`, `created_on`, `last_login`) VALUES
(1, 'jeremie', 'jeremie01@gmail.com', '$2y$10$61DjkKbA0wHZqnHmRZ/wAe4XPdoaQCIjRyuDiRByD8EVWiW93wFP.', 'Jeremie', 'KAMBALE LUSENGE', 'superadmin', 'profile.png', '2025-04-02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `target_table` varchar(64) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `photo` varchar(150) NOT NULL,
  `platform` text NOT NULL,
  `consituency` varchar(300) DEFAULT NULL,
  `faculty` varchar(300) DEFAULT NULL,
  `group` varchar(300) DEFAULT NULL,
  `campaign_slogan` varchar(255) DEFAULT NULL,
  `votes` int(11) DEFAULT 0,
  `content` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `position_id`, `firstname`, `lastname`, `nickname`, `photo`, `platform`, `consituency`, `faculty`, `group`, `campaign_slogan`, `votes`, `content`, `created_at`) VALUES
(1, 1, 'Horace', 'Asiimwe', 'Asher', 'profile.jpg', 'Unity, transparency and growth.', 'Union', NULL, 'executives', 'Together We Rise', 0, 'I stand for student empowerment and integrity.', '2025-05-17 17:59:31'),
(2, 1, 'John', 'Mukasa', 'Big John', 'profile.jpg', 'Accessible leadership.', 'Union', NULL, 'executives', 'For a Better Union', 0, 'Focused on welfare and inclusive participation.', '2025-05-17 17:59:31'),
(3, 1, 'Emily', 'Namirembe', 'Ema', 'profile.jpg', 'Progress through unity.', 'Union', NULL, 'executives', 'Students First', 0, 'Driven by change and positive representation.', '2025-05-17 17:59:31'),
(4, 2, 'Emmanuel', 'Ddumba', 'Kamya', 'profile.jpg', 'Supportive leadership.', 'Kavuma Hall', NULL, 'executives', 'Let’s Make it Happen', 0, 'Ready to serve and amplify voices.', '2025-05-17 17:59:31'),
(19, 30, 'Osbert', 'Kamugira', NULL, 'profile.jpg', 'Voicing Katonga.', 'Katonga Hostel', NULL, 'councilor', 'Katonga First', 0, 'Representing hostel interests.', '2025-05-17 17:59:31'),
(20, 44, 'Martha', 'Tuheirwe', NULL, 'profile.jpg', 'Bringing voice to BAM.', NULL, 'BAM FACULTY', 'councilor', 'BAM Forward', 0, 'Focused on academic reforms.', '2025-05-17 17:59:31'),
(21, 41, 'Isaac', 'Ntale', NULL, 'profile.jpg', 'Educational strength.', NULL, 'EDUCATION FACULTY', 'councilor', 'Quality Learning Matters', 0, 'Push for learning infrastructure.', '2025-05-17 17:59:31'),
(22, 45, 'Assumpta', 'Atuhaire', NULL, 'profile.jpg', 'Voice of Martyrs Hall.', 'Martyrs Hall', NULL, 'councilor', 'Together at Martyrs', 0, 'A better student experience.', '2025-05-17 17:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `id` int(11) NOT NULL,
  `election_name` varchar(255) NOT NULL,
  `election_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('upcoming','ongoing','completed') DEFAULT 'upcoming',
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `election_name`, `election_date`, `start_time`, `end_time`, `status`, `created_on`) VALUES
(3, 'UMU Guild Presidential Elections 2025', '2025-05-30', '09:00:00', '18:30:00', 'ongoing', '2025-05-19 12:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `max_vote` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `faculty` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `description`, `max_vote`, `priority`, `created_at`, `faculty`) VALUES
(1, 'UNION PRESIDENT', 1, 1, '2025-05-17 17:46:49', NULL),
(2, 'VICE PRESIDENT', 1, 2, '2025-05-17 17:46:49', NULL),
(30, 'MUKASA HALL REPRESENTATIVE', 1, 6, '2025-05-17 17:44:35', NULL),
(41, 'EDUCATION FACULTY REPRESENTATIVE', 1, 3, '2025-05-17 17:45:02', 'EDUCATION FACULTY'),
(44, 'BAM FACULTY REPRESENTATIVE', 1, 4, '2025-05-17 17:45:02', 'BAM FACULTY'),
(45, 'LAW FACULTY REPRESENTATIVE', 1, 5, '2025-05-17 17:45:02', 'LAW FACULTY');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `voters_id` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `faculty` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `voters_id`, `password`, `firstname`, `lastname`, `photo`, `faculty`) VALUES
(2, 'evliCGW3k4fQpmP', '$2y$10$61DjkKbA0wHZqnHmRZ/wAe4XPdoaQCIjRyuDiRByD8EVWiW93wFP.', 'Anthony', 'Ssenyonyi', 'download.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voters_id`, `election_id`, `candidate_id`, `position_id`) VALUES
(95, 2, 3, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
