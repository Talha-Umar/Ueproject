-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2021 at 09:48 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ueproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactno` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `contactno`, `password`, `department`, `type`) VALUES
(3, 'Talha Umar', 'admin', 'admin@gmail.com', '03037495997', 'admin', 0, 'mainadmin'),
(4, 'Muhammad Bilal', 'tuc', 'betagaming101@gmail.com', '03124567890', 'tuc123', 1, 'subadmin');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student`, `shift`, `course`, `status`, `date`) VALUES
(1, 1, 1, '54ert6', 1, '2021-07-10'),
(2, 1, 1, '54ert6', 1, '2021-07-11'),
(3, 1, 1, '54ert6', 1, '2021-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ch_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`code`, `name`, `ch_id`, `p_id`, `semester`) VALUES
('54ert6', 'Database', 2, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `coursestostudents`
--

CREATE TABLE `coursestostudents` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursestostudents`
--

INSERT INTO `coursestostudents` (`id`, `student`, `course`) VALUES
(1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `coursetoprogram`
--

CREATE TABLE `coursetoprogram` (
  `id` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `semesterno` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `session` int(11) NOT NULL,
  `shift` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursetoprogram`
--

INSERT INTO `coursetoprogram` (`id`, `program`, `semesterno`, `course`, `session`, `shift`) VALUES
(1, 1, 4, '54ert6', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coursetoteacher`
--

CREATE TABLE `coursetoteacher` (
  `id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `c_id` varchar(255) NOT NULL,
  `session_id` int(11) NOT NULL,
  `sh_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursetoteacher`
--

INSERT INTO `coursetoteacher` (`id`, `t_id`, `p_id`, `c_id`, `session_id`, `sh_id`, `d_id`, `semester`) VALUES
(2, 1, 1, '54ert6', 1, 1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `credit_hours`
--

CREATE TABLE `credit_hours` (
  `id` int(11) NOT NULL,
  `hours` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_hours`
--

INSERT INTO `credit_hours` (`id`, `hours`) VALUES
(1, '3+0'),
(2, '3+1');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'IT'),
(2, 'Physics'),
(3, 'Chemistry'),
(4, 'Math');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `d_id` int(11) NOT NULL,
  `nsemester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `code`, `name`, `d_id`, `nsemester`) VALUES
(1, 'e352', 'BS IT', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `semsters`
--

CREATE TABLE `semsters` (
  `id` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `current` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semsters`
--

INSERT INTO `semsters` (`id`, `semester`, `current`) VALUES
(1, 'Fall-2021', 1),
(2, 'Spring-2022', 0),
(3, 'Fall-2022', 0),
(4, 'Spring-2023', 0),
(5, 'Fall-2023', 0),
(6, 'Spring-2024', 0),
(7, 'Fall-2024', 0),
(8, 'Spring-2025', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session`) VALUES
(1, 'Fall-2021'),
(2, 'Fall-2022'),
(3, 'Fall-2023'),
(4, 'Fall-2024');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(11) NOT NULL,
  `shift` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `shift`) VALUES
(1, 'Morning'),
(2, 'Evening');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `rollno` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pg_id` int(11) NOT NULL,
  `ss_id` int(11) NOT NULL,
  `sm_id` int(11) NOT NULL,
  `sh_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `rollno`, `name`, `cnic`, `email`, `contact`, `address`, `pg_id`, `ss_id`, `sm_id`, `sh_id`, `password`) VALUES
(1, 'bsf1704454', 'Muhammad Adnan', '3660365789081', 'mdani5535@gmail.com', '03115678457', 'Mailsi', 1, 1, 1, 1, 'adnan1122');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `d_id` int(11) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `d_id`, `contact`, `email`, `address`, `password`) VALUES
(1, 'Talha Umar', 1, '03037495997', 'tuc4373@gmail.com', 'Sharqi Colony Vehari', 'tuc456'),
(2, 'Muhammad Adnan', 1, '03115478977', 'mdani5535@gmail.com', 'mailsi', 'adnan1122');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student` (`student`),
  ADD KEY `course` (`course`),
  ADD KEY `shift` (`shift`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`code`),
  ADD KEY `ch_id` (`ch_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `coursestostudents`
--
ALTER TABLE `coursestostudents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `coursetoprogram`
--
ALTER TABLE `coursetoprogram`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course` (`course`),
  ADD KEY `session` (`session`),
  ADD KEY `program` (`program`),
  ADD KEY `shift` (`shift`);

--
-- Indexes for table `coursetoteacher`
--
ALTER TABLE `coursetoteacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `d_id` (`d_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `sh_id` (`sh_id`),
  ADD KEY `t_id` (`t_id`);

--
-- Indexes for table `credit_hours`
--
ALTER TABLE `credit_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `semsters`
--
ALTER TABLE `semsters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pg_id` (`pg_id`),
  ADD KEY `sh_id` (`sh_id`),
  ADD KEY `sm_id` (`sm_id`),
  ADD KEY `ss_id` (`ss_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_id` (`d_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coursestostudents`
--
ALTER TABLE `coursestostudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coursetoprogram`
--
ALTER TABLE `coursetoprogram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coursetoteacher`
--
ALTER TABLE `coursetoteacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credit_hours`
--
ALTER TABLE `credit_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `semsters`
--
ALTER TABLE `semsters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`course`) REFERENCES `courses` (`code`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`shift`) REFERENCES `shifts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`ch_id`) REFERENCES `credit_hours` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coursestostudents`
--
ALTER TABLE `coursestostudents`
  ADD CONSTRAINT `coursestostudents_ibfk_1` FOREIGN KEY (`student`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coursetoprogram`
--
ALTER TABLE `coursetoprogram`
  ADD CONSTRAINT `coursetoprogram_ibfk_1` FOREIGN KEY (`course`) REFERENCES `courses` (`code`) ON DELETE CASCADE,
  ADD CONSTRAINT `coursetoprogram_ibfk_2` FOREIGN KEY (`session`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coursetoprogram_ibfk_3` FOREIGN KEY (`program`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coursetoprogram_ibfk_4` FOREIGN KEY (`shift`) REFERENCES `shifts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coursetoteacher`
--
ALTER TABLE `coursetoteacher`
  ADD CONSTRAINT `coursetoteacher_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `courses` (`code`) ON DELETE CASCADE,
  ADD CONSTRAINT `coursetoteacher_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coursetoteacher_ibfk_3` FOREIGN KEY (`p_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coursetoteacher_ibfk_4` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coursetoteacher_ibfk_5` FOREIGN KEY (`sh_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coursetoteacher_ibfk_6` FOREIGN KEY (`t_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`pg_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`sh_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`sm_id`) REFERENCES `semsters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_4` FOREIGN KEY (`ss_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
