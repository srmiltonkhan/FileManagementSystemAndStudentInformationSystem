-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2020 at 05:06 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uni_mgt_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `dep_name` varchar(50) NOT NULL,
  `dep_status` enum('active','inactive') DEFAULT NULL,
  PRIMARY KEY (`department_id`),
  UNIQUE KEY `unique_key` (`department_id`,`dep_name`),
  KEY `dept_user_fk` (`user_id`),
  KEY `dept_faculty_fk` (`faculty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `user_id`, `faculty_id`, `dep_name`, `dep_status`) VALUES
(1, 1, 1, 'Biochemistry and Biotechnology', 'active'),
(2, 1, 1, 'Microbiology ', 'active'),
(3, 1, 1, 'Pharmacy ', 'active'),
(4, 1, 2, 'Business Administration', 'active'),
(5, 1, 2, 'Management Information Systems', 'active'),
(6, 1, 3, 'English', 'active'),
(7, 1, 3, 'Islamic Studies', 'active'),
(8, 1, 3, 'Library & Information Science', 'active'),
(9, 1, 4, 'Law ', 'active'),
(10, 1, 5, 'Computer Science and Engineering', 'active'),
(11, 1, 5, 'Electrical and Electronics Engineering', 'active'),
(12, 1, 5, ' Electronic and Telecommunication Engineering', 'active'),
(13, 1, 5, 'Mechatronics and Micro-mechatronics Engineering', 'active'),
(14, 1, 5, 'Medical Physics', 'active'),
(15, 1, 5, 'Textile Engineering', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `faculty_name` varchar(40) NOT NULL,
  `faculty_status` enum('active','inactive') DEFAULT NULL,
  PRIMARY KEY (`faculty_id`),
  UNIQUE KEY `unique_key` (`faculty_id`,`faculty_name`),
  KEY `fac_user_fk` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `user_id`, `faculty_name`, `faculty_status`) VALUES
(1, 1, 'School of Bio-Medical Science', 'active'),
(2, 1, 'School of Business', 'active'),
(3, 1, 'School of Human Science', 'active'),
(4, 1, 'School of Law', 'active'),
(5, 1, 'School of Science and Engineering', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `file_cat`
--

DROP TABLE IF EXISTS `file_cat`;
CREATE TABLE IF NOT EXISTS `file_cat` (
  `file_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`file_cat_id`),
  UNIQUE KEY `unique_key` (`category_name`),
  KEY `file_cat_fk` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_cat`
--

INSERT INTO `file_cat` (`file_cat_id`, `user_id`, `category_name`) VALUES
(1, 1, 'Academic'),
(2, 1, 'Administration');

-- --------------------------------------------------------

--
-- Table structure for table `file_mgt`
--

DROP TABLE IF EXISTS `file_mgt`;
CREATE TABLE IF NOT EXISTS `file_mgt` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file_id_num` varchar(30) NOT NULL,
  `file_cat_id` int(11) NOT NULL,
  `file_sub_cat_id` int(11) NOT NULL,
  `file_sup_cat_id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `upld_file` varchar(100) NOT NULL,
  `create_date` varchar(30) NOT NULL,
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `unique_key` (`file_id_num`,`upld_file`) USING BTREE,
  KEY `file_user_fk` (`user_id`),
  KEY `file_cat_mgt_fk` (`file_cat_id`),
  KEY `file_sub_fk` (`file_sub_cat_id`),
  KEY `file_sup_fk` (`file_sup_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_mgt`
--

INSERT INTO `file_mgt` (`file_id`, `user_id`, `file_id_num`, `file_cat_id`, `file_sub_cat_id`, `file_sup_cat_id`, `file_name`, `upld_file`, `create_date`) VALUES
(9, 1, '10001', 1, 2, 1, 'jk', '10001.docx', '2020-10-21'),
(10, 1, '10002', 1, 2, 2, 'dd', '10002.docx', '2020-10-21'),
(11, 1, '10006', 2, 4, 3, '.3', '', '2020-10-24'),
(12, 1, 'testd', 1, 2, 1, 'ter', 'testd.jpg', '2020-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `file_sub_cat`
--

DROP TABLE IF EXISTS `file_sub_cat`;
CREATE TABLE IF NOT EXISTS `file_sub_cat` (
  `file_sub_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_cat_id` int(11) NOT NULL,
  `file_sub_cat_name` varchar(70) NOT NULL,
  PRIMARY KEY (`file_sub_cat_id`),
  UNIQUE KEY `unique_key` (`file_sub_cat_id`),
  KEY `sub_cat_fk` (`file_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_sub_cat`
--

INSERT INTO `file_sub_cat` (`file_sub_cat_id`, `file_cat_id`, `file_sub_cat_name`) VALUES
(1, 1, 'Faculty'),
(2, 1, 'Department'),
(3, 1, 'ter'),
(4, 2, 'Test3'),
(5, 2, 'Department');

-- --------------------------------------------------------

--
-- Table structure for table `file_sup_cat`
--

DROP TABLE IF EXISTS `file_sup_cat`;
CREATE TABLE IF NOT EXISTS `file_sup_cat` (
  `file_sup_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_cat_id` int(11) NOT NULL,
  `file_sub_cat_id` int(11) NOT NULL,
  `file_sup_cat_name` varchar(100) NOT NULL,
  PRIMARY KEY (`file_sup_cat_id`),
  UNIQUE KEY `unique_key` (`file_sup_cat_id`),
  KEY `sup_cat_fk` (`file_cat_id`),
  KEY `sup_sub_fk` (`file_sub_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_sup_cat`
--

INSERT INTO `file_sup_cat` (`file_sup_cat_id`, `file_cat_id`, `file_sub_cat_id`, `file_sup_cat_name`) VALUES
(1, 1, 2, 'Biochemistry and Biotechnology'),
(2, 1, 2, 'Business Administration'),
(3, 2, 4, 'Milton'),
(4, 1, 2, 'test4'),
(5, 1, 2, 'dfd45');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE IF NOT EXISTS `program` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `program_name` varchar(60) NOT NULL,
  `program_status` enum('active','inactive') DEFAULT NULL,
  PRIMARY KEY (`program_id`),
  UNIQUE KEY `unique_key` (`program_id`,`program_name`),
  KEY `prog_user_fk` (`user_id`),
  KEY `prog_faculty_fk` (`faculty_id`),
  KEY `prog_dept_fk` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `user_id`, `faculty_id`, `department_id`, `program_name`, `program_status`) VALUES
(1, 1, 1, 1, 'B.Sc. in Biochemistry and Biotechnology', 'active'),
(2, 1, 1, 2, 'B.Sc. in Microbiology', 'active'),
(3, 1, 1, 3, 'Bachelor of Pharmacy', 'active'),
(4, 1, 2, 4, 'Bachelor of Business Administration', 'active'),
(5, 1, 2, 5, 'Bachelor of Management Information Systems', 'active'),
(6, 1, 2, 4, 'Master of Business Administration', 'active'),
(7, 1, 2, 4, 'Executive Masters of Business Administration', 'active'),
(8, 1, 3, 6, 'B.A (Hon\'s) in English', 'active'),
(9, 1, 3, 6, 'Master of Arts in English', 'active'),
(10, 1, 3, 7, 'B.A (Hon\'s) in Islamic Studies', 'active'),
(11, 1, 3, 7, 'Master of Arts in Islamic Studies (M.IS)', 'active'),
(12, 1, 3, 7, 'Master of Arts Islamic Studies (Preliminary)', 'active'),
(13, 1, 3, 8, 'Bachelor of Library & Information Science', 'active'),
(14, 1, 3, 8, 'Master of Library & Information Science', 'active'),
(15, 1, 3, 8, 'Postgraduate Diploma in Library & Information Science', 'active'),
(16, 1, 4, 9, 'Bachelor of Law', 'active'),
(17, 1, 4, 9, 'Master of Law', 'active'),
(18, 1, 5, 10, 'B.Sc. in Computer Science and Engineering', 'active'),
(19, 1, 5, 10, 'M.Sc. in Computer Science and Engineering', 'active'),
(20, 1, 5, 11, 'B.Sc. in Electrical and Electronics Engineering', 'active'),
(21, 1, 5, 11, 'M.Sc. in Electrical and Electronics Engineering', 'active'),
(22, 1, 5, 12, 'B.Sc. in Electronic and Telecommunication Engineering', 'active'),
(23, 1, 5, 12, 'M.Sc. in Electronic and Telecommunication Engineering', 'active'),
(24, 1, 5, 14, 'M.S. in Medical Physics', 'active'),
(25, 1, 5, 15, 'B.Sc. in Textile Engineering', 'active'),
(26, 1, 5, 15, 'M.Sc. in Textile Engineering', 'active'),
(27, 1, 5, 13, 'M.Sc. in Mechatronics and Micro-mechatronics Engineering', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `stud_ape_info`
--

DROP TABLE IF EXISTS `stud_ape_info`;
CREATE TABLE IF NOT EXISTS `stud_ape_info` (
  `stud_ape_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ad_form_num` varchar(10) DEFAULT NULL,
  `waiver_perctg` varchar(5) DEFAULT NULL,
  `ad_semester` varchar(10) NOT NULL,
  `ad_semester_y` varchar(4) NOT NULL,
  `stud_status` varchar(15) NOT NULL,
  `sibling_id` varchar(30) DEFAULT NULL,
  `nid` varchar(15) DEFAULT NULL,
  `brth_regst_num` varchar(15) DEFAULT NULL,
  `marital_sts` varchar(10) NOT NULL,
  `prst_addr` varchar(100) NOT NULL,
  `per_addr` varchar(100) NOT NULL,
  `citizenship` varchar(15) NOT NULL,
  `father_nm` varchar(50) NOT NULL,
  `father_occpt` varchar(30) NOT NULL,
  `mother_nm` varchar(50) NOT NULL,
  `mother_occpt` varchar(30) NOT NULL,
  `gardn_mobile` char(11) DEFAULT NULL,
  `ssc_exm_deg_tle` varchar(20) DEFAULT NULL,
  `ssc_con_mjr_grp` varchar(30) DEFAULT NULL,
  `ssc_board` varchar(12) DEFAULT NULL,
  `ssc_institue` varchar(60) DEFAULT NULL,
  `ssc_roll` varchar(10) DEFAULT NULL,
  `ssc_registration` varchar(10) DEFAULT NULL,
  `ssc_y_passing` varchar(4) DEFAULT NULL,
  `ssc_result` varchar(5) DEFAULT NULL,
  `hsc_exm_deg_tle` varchar(20) DEFAULT NULL,
  `hsc_con_mjr_grp` varchar(30) DEFAULT NULL,
  `hsc_board` varchar(12) DEFAULT NULL,
  `hsc_institue` varchar(60) DEFAULT NULL,
  `hsc_roll` varchar(10) DEFAULT NULL,
  `hsc_registration` varchar(10) DEFAULT NULL,
  `hsc_y_passing` varchar(4) DEFAULT NULL,
  `hsc_result` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`stud_ape_id`),
  UNIQUE KEY `unique_key` (`stud_ape_id`,`stud_id`,`ad_form_num`),
  KEY `stud_ape_user_fk` (`user_id`),
  KEY `stud_ape_fk` (`stud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stud_bsc_info`
--

DROP TABLE IF EXISTS `stud_bsc_info`;
CREATE TABLE IF NOT EXISTS `stud_bsc_info` (
  `stud_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stud_id_num` varchar(14) NOT NULL,
  `stud_name` varchar(60) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `faculty_id` int(2) NOT NULL,
  `department_id` int(3) NOT NULL,
  `program_id` int(4) NOT NULL,
  `batch` varchar(10) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `bld_grp` varchar(5) DEFAULT NULL,
  `dob` varchar(30) DEFAULT NULL,
  `reg_time` varchar(15) NOT NULL,
  `reg_date` date DEFAULT NULL,
  `profile_image` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`stud_id`),
  UNIQUE KEY `unique_key` (`stud_id`,`mobile`,`email`,`profile_image`),
  KEY `stud_user_fk` (`user_id`),
  KEY `stud_faculty_fk` (`faculty_id`),
  KEY `stud_dept_fk` (`department_id`),
  KEY `stud_program_fk` (`program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_num` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_mobile` varchar(15) NOT NULL,
  `user_department` varchar(50) NOT NULL,
  `user_designation` varchar(50) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `user_status` enum('active','inactive') NOT NULL,
  `user_reg_date` date DEFAULT NULL,
  `user_image` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_mobile` (`user_mobile`),
  UNIQUE KEY `unique_key` (`user_id_num`,`user_email`,`user_mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_id_num`, `user_name`, `user_email`, `user_mobile`, `user_department`, `user_designation`, `user_password`, `user_type`, `user_status`, `user_reg_date`, `user_image`) VALUES
(1, 239, 'Md. Milton Khan', 'srmiltonkhan@gmail.com', '1621000361', 'Information Technology', 'IT Support Engineer', '$2y$10$AW079ZikBdCaXBp5kjxWZejrYXyOyi0oB7Y9fWNvPDNtL9DP1G0uq', 'super_admin', 'active', '0000-00-00', 'milton.jpg'),
(2, 230, 'Md. Ismail Hossain', 'ismail@gmail.com', '1621000352', 'Account', 'Assistant Accountance', '$2y$10$nRgiq47MKN39TUm7KMGwMugjYilMg8QMlfpuqKn0mZUDeuUFYUVJ6', 'Standard User', 'active', '0000-00-00', 'ismail.jpg'),
(3, 35, 'Md. Mahmudul Hasan', 'mh01746105856@gmail.com', '1746105856', 'Account', 'Deputy Director of Finance', '$2y$10$0Yo2F.EetL3yhB8l6MNvcOH8AYNS0SuXLOoAQr1qXJa3uPASWV0NC', 'Standard User', 'active', '0000-00-00', 'mahmudul.jpg'),
(4, 42, 'Md. Hazrat Ali', 'hmali084@gmail.com', '1710722572', 'Account', 'Senior Assistant Director of Accounts', '$2y$10$0Yo2F.EetL3yhB8l6MNvcOH8AYNS0SuXLOoAQr1qXJa3uPASWV0NC', 'Standard User', 'active', '0000-00-00', 'hazrat.jpg'),
(5, 216, 'Md. Rokonuzzaman', 'rokonuzzaman.sarker2019@gmail.com', '01750591432', 'Admission', 'Admission Officer', '$2y$10$1jsfNSpljacRPpuyW8HFju3/ySeDAyGKasY3unxj74hPzcBZwKB2G', 'End User', 'active', '2020-09-13', '1824591613.png');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `dept_faculty_fk` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dept_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `fac_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `file_cat`
--
ALTER TABLE `file_cat`
  ADD CONSTRAINT `file_cat_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `file_mgt`
--
ALTER TABLE `file_mgt`
  ADD CONSTRAINT `file_cat_mgt_fk` FOREIGN KEY (`file_cat_id`) REFERENCES `file_cat` (`file_cat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `file_sub_fk` FOREIGN KEY (`file_sub_cat_id`) REFERENCES `file_sub_cat` (`file_sub_cat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `file_sup_fk` FOREIGN KEY (`file_sup_cat_id`) REFERENCES `file_sup_cat` (`file_sup_cat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `file_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `file_sub_cat`
--
ALTER TABLE `file_sub_cat`
  ADD CONSTRAINT `sub_cat_fk` FOREIGN KEY (`file_cat_id`) REFERENCES `file_cat` (`file_cat_id`) ON UPDATE CASCADE;

--
-- Constraints for table `file_sup_cat`
--
ALTER TABLE `file_sup_cat`
  ADD CONSTRAINT `sup_cat_fk` FOREIGN KEY (`file_cat_id`) REFERENCES `file_cat` (`file_cat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sup_sub_fk` FOREIGN KEY (`file_sub_cat_id`) REFERENCES `file_sub_cat` (`file_sub_cat_id`) ON UPDATE CASCADE;

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `prog_dept_fk` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prog_faculty_fk` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prog_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `stud_ape_info`
--
ALTER TABLE `stud_ape_info`
  ADD CONSTRAINT `stud_ape_fk` FOREIGN KEY (`stud_id`) REFERENCES `stud_bsc_info` (`stud_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stud_ape_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `stud_bsc_info`
--
ALTER TABLE `stud_bsc_info`
  ADD CONSTRAINT `stud_dept_fk` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stud_faculty_fk` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stud_program_fk` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stud_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
