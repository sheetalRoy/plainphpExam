-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2021 at 04:26 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examination`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_master`
--

CREATE TABLE `class_master` (
  `pk_id` int(11) NOT NULL,
  `class_name` varchar(250) DEFAULT NULL,
  `class_code` varchar(100) DEFAULT NULL,
  `batch` varchar(100) NOT NULL,
  `status_id` smallint(6) DEFAULT NULL,
  `active_flag` smallint(6) DEFAULT NULL,
  `sys_inserted_by` smallint(6) DEFAULT NULL,
  `sys_inserted_date` datetime DEFAULT NULL,
  `sys_updated_by` smallint(6) DEFAULT NULL,
  `sys_updated_date` datetime DEFAULT NULL,
  `etl_ref_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_master`
--

INSERT INTO `class_master` (`pk_id`, `class_name`, `class_code`, `batch`, `status_id`, `active_flag`, `sys_inserted_by`, `sys_inserted_date`, `sys_updated_by`, `sys_updated_date`, `etl_ref_no`) VALUES
(1, 'php', '001', 'Bangalore', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'MySql', '002', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Html course', '1003', 'Computer Science', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_master`
--

CREATE TABLE `exam_master` (
  `pk_id` int(11) NOT NULL,
  `exam_type_fk` int(11) DEFAULT NULL,
  `exam_name` varchar(250) DEFAULT NULL,
  `exam_code` varchar(10) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `topic` varchar(250) DEFAULT NULL,
  `status_id` smallint(6) DEFAULT NULL,
  `active_flag` smallint(6) DEFAULT NULL,
  `start_time` varchar(100) DEFAULT NULL,
  `end_time` varchar(100) DEFAULT NULL,
  `sys_inserted_by` smallint(6) DEFAULT NULL,
  `sys_inserted_date` datetime DEFAULT NULL,
  `sys_updated_by` smallint(6) DEFAULT NULL,
  `sys_updated_date` datetime DEFAULT NULL,
  `etl_ref_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_master`
--

INSERT INTO `exam_master` (`pk_id`, `exam_type_fk`, `exam_name`, `exam_code`, `exam_date`, `class`, `subject`, `topic`, `status_id`, `active_flag`, `start_time`, `end_time`, `sys_inserted_by`, `sys_inserted_date`, `sys_updated_by`, `sys_updated_date`, `etl_ref_no`) VALUES
(1, 1, 'Tier 1', 'E001', '2021-02-23', 1, NULL, NULL, NULL, NULL, '11:00', '12:00', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_question_set`
--

CREATE TABLE `exam_question_set` (
  `pk_id` int(11) NOT NULL,
  `exam_id_fk` int(11) DEFAULT NULL,
  `question_id_fk` int(11) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `exam_code` varchar(10) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `status_id` smallint(6) DEFAULT NULL,
  `active_flag` smallint(6) DEFAULT NULL,
  `sys_inserted_by` smallint(6) DEFAULT NULL,
  `sys_inserted_date` datetime DEFAULT NULL,
  `sys_updated_by` smallint(6) DEFAULT NULL,
  `sys_updated_date` datetime DEFAULT NULL,
  `etl_ref_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_question_set`
--

INSERT INTO `exam_question_set` (`pk_id`, `exam_id_fk`, `question_id_fk`, `remarks`, `exam_code`, `exam_date`, `status_id`, `active_flag`, `sys_inserted_by`, `sys_inserted_date`, `sys_updated_by`, `sys_updated_date`, `etl_ref_no`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(3, 1, 3, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_type`
--

CREATE TABLE `exam_type` (
  `pk_id` int(11) NOT NULL,
  `exam_type` varchar(250) DEFAULT NULL,
  `status_id` smallint(6) DEFAULT NULL,
  `active_flag` smallint(6) DEFAULT NULL,
  `sys_inserted_by` smallint(6) DEFAULT NULL,
  `sys_inserted_date` datetime DEFAULT NULL,
  `sys_updated_by` smallint(6) DEFAULT NULL,
  `sys_updated_date` datetime DEFAULT NULL,
  `etl_ref_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question_answer_student_txn`
--

CREATE TABLE `question_answer_student_txn` (
  `pk_id` int(11) NOT NULL,
  `reg_id_fk` int(11) DEFAULT NULL,
  `q_set_fk` int(11) DEFAULT NULL,
  `exam_id_fk` int(11) DEFAULT NULL,
  `ans` varchar(250) DEFAULT NULL,
  `ans_key` int(11) DEFAULT NULL,
  `ans_flag` int(11) DEFAULT NULL,
  `remark` varchar(250) DEFAULT NULL,
  `custom` varchar(250) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `status_id` smallint(6) DEFAULT NULL,
  `active_flag` smallint(6) DEFAULT NULL,
  `sys_inserted_by` smallint(6) DEFAULT NULL,
  `sys_inserted_date` datetime DEFAULT NULL,
  `sys_updated_by` smallint(6) DEFAULT NULL,
  `sys_updated_date` datetime DEFAULT NULL,
  `etl_ref_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question_diagram`
--

CREATE TABLE `question_diagram` (
  `pk_id` int(11) NOT NULL,
  `real_file_name` varchar(200) DEFAULT NULL,
  `formate_file_name` varchar(200) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `extension` varchar(200) DEFAULT NULL,
  `active_flag` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question_master`
--

CREATE TABLE `question_master` (
  `pk_id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `exam_id_fk` int(11) DEFAULT NULL,
  `exam_code` varchar(10) DEFAULT NULL,
  `part` varchar(10) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `subject` int(11) DEFAULT NULL,
  `topic` int(11) DEFAULT NULL,
  `ans1` varchar(250) DEFAULT NULL,
  `ans2` varchar(250) DEFAULT NULL,
  `ans3` varchar(250) DEFAULT NULL,
  `ans4` varchar(250) DEFAULT NULL,
  `ans_flag` varchar(10) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `status_id` smallint(6) DEFAULT NULL,
  `active_flag` smallint(6) DEFAULT NULL,
  `is_diagram` int(11) DEFAULT NULL,
  `sys_inserted_by` smallint(6) DEFAULT NULL,
  `sys_inserted_date` datetime DEFAULT NULL,
  `sys_updated_by` smallint(6) DEFAULT NULL,
  `sys_updated_date` datetime DEFAULT NULL,
  `etl_ref_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_master`
--

INSERT INTO `question_master` (`pk_id`, `question`, `exam_id_fk`, `exam_code`, `part`, `class`, `subject`, `topic`, `ans1`, `ans2`, `ans3`, `ans4`, `ans_flag`, `exam_date`, `status_id`, `active_flag`, `is_diagram`, `sys_inserted_by`, `sys_inserted_date`, `sys_updated_by`, `sys_updated_date`, `etl_ref_no`) VALUES
(1, 'What is php', 1, NULL, NULL, 1, NULL, NULL, 'Pre Hypertext Programming', 'Hypertext PreProcessor', 'Pre Hypertext Processor', 'Personal Hypertext Programme', '2', NULL, 10, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Correct for loop syntax?', 1, NULL, NULL, 1, NULL, NULL, 'for (int i = 1; i <= 5; i++)', 'foreach (int i in myArr )', 'for (int i in myArr )', 'for (int i of myArr )', '1', NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'What is include in php?', 1, NULL, NULL, 1, NULL, NULL, 'It is php global variable', 'It is magic constant', 'to insert the content of one PHP file into another PHP file', 'It is predefined string', '3', NULL, 10, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_master`
--

CREATE TABLE `subject_master` (
  `pk_id` int(11) NOT NULL,
  `class_fk` int(11) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `status_id` smallint(6) DEFAULT NULL,
  `active_flag` smallint(6) DEFAULT NULL,
  `sys_inserted_by` smallint(6) DEFAULT NULL,
  `sys_inserted_date` datetime DEFAULT NULL,
  `sys_updated_by` smallint(6) DEFAULT NULL,
  `sys_updated_date` datetime DEFAULT NULL,
  `etl_ref_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_registration`
--

CREATE TABLE `tb_registration` (
  `pk_id` int(11) NOT NULL,
  `candidate_id` varchar(50) NOT NULL,
  `reg_date` date DEFAULT NULL,
  `photo_Fk` int(11) DEFAULT NULL,
  `form_no` varchar(20) DEFAULT '0',
  `counselling_no` varchar(20) DEFAULT NULL,
  `ref_by` varchar(100) DEFAULT NULL,
  `source_id_fk` int(11) DEFAULT NULL,
  `highest_qual_id_fk` smallint(6) DEFAULT NULL,
  `person_id_fk` int(11) DEFAULT NULL,
  `active_flag` smallint(6) DEFAULT NULL,
  `sys_inserted_by` smallint(6) DEFAULT NULL,
  `sys_inserted_date` datetime DEFAULT NULL,
  `sys_updated_by` smallint(6) DEFAULT NULL,
  `sys_updated_date` datetime DEFAULT NULL,
  `etl_ref_no` varchar(255) DEFAULT NULL,
  `guardian_type` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_registration`
--

INSERT INTO `tb_registration` (`pk_id`, `candidate_id`, `reg_date`, `photo_Fk`, `form_no`, `counselling_no`, `ref_by`, `source_id_fk`, `highest_qual_id_fk`, `person_id_fk`, `active_flag`, `sys_inserted_by`, `sys_inserted_date`, `sys_updated_by`, `sys_updated_date`, `etl_ref_no`, `guardian_type`) VALUES
(1, 'S001', '2021-05-30', NULL, '0', '123', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `upload_file`
--

CREATE TABLE `upload_file` (
  `pk_id` int(11) NOT NULL,
  `real_file_name` varchar(200) NOT NULL,
  `formate_file_name` varchar(200) NOT NULL,
  `file_path` varchar(250) NOT NULL,
  `active_flag` smallint(6) NOT NULL,
  `inserted_by` varchar(100) NOT NULL,
  `inserted_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload_file`
--

INSERT INTO `upload_file` (`pk_id`, `real_file_name`, `formate_file_name`, `file_path`, `active_flag`, `inserted_by`, `inserted_date`) VALUES
(1, '', '', 'assets/images/Koala.jpg', 0, '', '0000-00-00 00:00:00'),
(2, '', '', 'assets/images/Tulips.jpg', 0, '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_master`
--
ALTER TABLE `class_master`
  ADD PRIMARY KEY (`pk_id`);

--
-- Indexes for table `exam_master`
--
ALTER TABLE `exam_master`
  ADD PRIMARY KEY (`pk_id`);

--
-- Indexes for table `exam_question_set`
--
ALTER TABLE `exam_question_set`
  ADD PRIMARY KEY (`pk_id`),
  ADD KEY `fk_exam_question_question_master` (`question_id_fk`),
  ADD KEY `fk_exam_question_exam_master` (`exam_id_fk`);

--
-- Indexes for table `exam_type`
--
ALTER TABLE `exam_type`
  ADD PRIMARY KEY (`pk_id`);

--
-- Indexes for table `question_answer_student_txn`
--
ALTER TABLE `question_answer_student_txn`
  ADD PRIMARY KEY (`pk_id`),
  ADD KEY `regis_id_fk` (`reg_id_fk`),
  ADD KEY `ques_id_fk` (`q_set_fk`),
  ADD KEY `exam_id_fk` (`exam_id_fk`);

--
-- Indexes for table `question_diagram`
--
ALTER TABLE `question_diagram`
  ADD PRIMARY KEY (`pk_id`);

--
-- Indexes for table `question_master`
--
ALTER TABLE `question_master`
  ADD PRIMARY KEY (`pk_id`),
  ADD KEY `fk_question_master_class_idx` (`class`),
  ADD KEY `fk_question_master_subject_idx` (`subject`),
  ADD KEY `fk_question_master_diagram` (`is_diagram`);

--
-- Indexes for table `subject_master`
--
ALTER TABLE `subject_master`
  ADD PRIMARY KEY (`pk_id`),
  ADD KEY `class_id_fk_idx` (`class_fk`);

--
-- Indexes for table `tb_registration`
--
ALTER TABLE `tb_registration`
  ADD PRIMARY KEY (`pk_id`);

--
-- Indexes for table `upload_file`
--
ALTER TABLE `upload_file`
  ADD PRIMARY KEY (`pk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_master`
--
ALTER TABLE `class_master`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_master`
--
ALTER TABLE `exam_master`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_question_set`
--
ALTER TABLE `exam_question_set`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_type`
--
ALTER TABLE `exam_type`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_answer_student_txn`
--
ALTER TABLE `question_answer_student_txn`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_diagram`
--
ALTER TABLE `question_diagram`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_master`
--
ALTER TABLE `question_master`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_master`
--
ALTER TABLE `subject_master`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_registration`
--
ALTER TABLE `tb_registration`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `upload_file`
--
ALTER TABLE `upload_file`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_question_set`
--
ALTER TABLE `exam_question_set`
  ADD CONSTRAINT `fk_exam_question_exam_master` FOREIGN KEY (`exam_id_fk`) REFERENCES `exam_master` (`pk_id`),
  ADD CONSTRAINT `fk_exam_question_question_master` FOREIGN KEY (`question_id_fk`) REFERENCES `question_master` (`pk_id`);

--
-- Constraints for table `question_answer_student_txn`
--
ALTER TABLE `question_answer_student_txn`
  ADD CONSTRAINT `exam_id_fk` FOREIGN KEY (`exam_id_fk`) REFERENCES `exam_master` (`pk_id`),
  ADD CONSTRAINT `ques_id_fk` FOREIGN KEY (`q_set_fk`) REFERENCES `exam_question_set` (`pk_id`),
  ADD CONSTRAINT `regis_id_fk` FOREIGN KEY (`reg_id_fk`) REFERENCES `tb_registration` (`pk_id`);

--
-- Constraints for table `question_master`
--
ALTER TABLE `question_master`
  ADD CONSTRAINT `fk_question_master_class` FOREIGN KEY (`class`) REFERENCES `class_master` (`pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_question_master_diagram` FOREIGN KEY (`is_diagram`) REFERENCES `question_diagram` (`pk_id`),
  ADD CONSTRAINT `fk_question_master_subject` FOREIGN KEY (`subject`) REFERENCES `subject_master` (`pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subject_master`
--
ALTER TABLE `subject_master`
  ADD CONSTRAINT `class_id_fk` FOREIGN KEY (`class_fk`) REFERENCES `class_master` (`pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
