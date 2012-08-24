-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 24, 2012 at 11:30 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `exam_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`) VALUES
(7);

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `answer_id` int(255) NOT NULL AUTO_INCREMENT,
  `answer` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `answer`, `status`) VALUES
(1, 'None of the above', 1),
(2, 'awefawefwef', 1),
(3, 'awefawef', 1),
(4, 'wefa', 1),
(5, 'wf', 1),
(6, 'awe', 1),
(7, 'fawe', 1),
(8, 'faw', 1),
(9, 'ef', 1),
(10, 'eg', 1),
(11, 'awrg', 1),
(12, 'aeth', 1),
(13, 'r', 1),
(14, 'hr', 1),
(15, 'th', 1),
(16, 'rw', 1),
(17, 'Default Answer, replace with real answer', 1),
(18, 'NOT REAL ANSWER~~~~', 1),
(19, 'wofijwioefjo23ij12io3j41io342irj', 1),
(20, 'testing answer creation using AJAX', 1),
(21, 'Answer', 1),
(22, 'Answer 2', 1),
(23, 'Answer 3', 1),
(24, 'Answer 1', 1),
(25, 'awawf3rf', 1),
(26, 'Ivy', 1),
(27, 'Systems Applications and Products', 1),
(28, 'Title321', 1),
(29, 'awg3', 1),
(30, 'asdf1223asdf', 1),
(31, 'TEWasdwq', 1),
(32, 'Demo Answer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attempt`
--

CREATE TABLE IF NOT EXISTS `attempt` (
  `attempt_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `score` int(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `out_of` int(255) NOT NULL,
  PRIMARY KEY (`attempt_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=345 ;

--
-- Dumping data for table `attempt`
--

INSERT INTO `attempt` (`attempt_id`, `user_id`, `score`, `timestamp`, `status`, `out_of`) VALUES
(342, 7, 3, '2012-08-23 21:29:47', 1, 3),
(343, 7, 0, '2012-08-23 21:30:39', 0, 0),
(344, 7, 3, '2012-08-23 22:11:36', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `attempt_exam_map`
--

CREATE TABLE IF NOT EXISTS `attempt_exam_map` (
  `attempt_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  KEY `attempt_id` (`attempt_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attempt_exam_map`
--

INSERT INTO `attempt_exam_map` (`attempt_id`, `exam_id`) VALUES
(342, 35),
(344, 35);

-- --------------------------------------------------------

--
-- Table structure for table `attempt_sqa_map`
--

CREATE TABLE IF NOT EXISTS `attempt_sqa_map` (
  `attempt_id` int(255) NOT NULL,
  `sqam_id` int(255) NOT NULL,
  `answer_id` int(255) DEFAULT NULL,
  KEY `sqam_id` (`sqam_id`),
  KEY `answer_id` (`answer_id`),
  KEY `attempt_id` (`attempt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attempt_sqa_map`
--

INSERT INTO `attempt_sqa_map` (`attempt_id`, `sqam_id`, `answer_id`) VALUES
(342, 211, 1),
(342, 209, 1),
(342, 210, 1),
(344, 217, 1),
(344, 216, 1),
(344, 219, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `title`, `status`) VALUES
(1, 'TEST EXAM', 0),
(2, 'exam123', 0),
(3, 'testing the examManager.php', 0),
(4, 'testing exam creation using AJAX', 0),
(5, 'test', 0),
(6, 'awefawefwefwe', 0),
(7, 'testing examlist refresh', 0),
(8, 'testawefawef', 0),
(9, 'Titleawefawefwef', 0),
(10, 'Exam UI Testing', 0),
(11, 'mxcvmbxcvb', 0),
(12, 'Exam11111', 0),
(13, 'exam3', 0),
(14, 'Exam I Just Created', 1),
(15, 'TESRIN098', 0),
(16, 'TEWFwef', 0),
(17, 'test21654', 0),
(18, 'asdfwefwef', 0),
(19, 'asfvzxcv', 0),
(20, 'Title', 0),
(21, 'Title', 0),
(22, 'Title123', 0),
(23, 'TEST ONE', 0),
(24, 'Stuff', 0),
(25, 'testwts', 0),
(26, 'asdf', 0),
(27, 'asf', 0),
(28, 'asdf', 0),
(29, 'asdqwe', 0),
(30, 'asdf', 0),
(31, 'asdf', 0),
(32, 'asdf', 0),
(33, 'asdf234', 1),
(34, 'test1', 1),
(35, 'Demo Exam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_section_map`
--

CREATE TABLE IF NOT EXISTS `exam_section_map` (
  `exam_id` int(255) NOT NULL,
  `section_id` int(255) NOT NULL,
  KEY `exam_id` (`exam_id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_section_map`
--

INSERT INTO `exam_section_map` (`exam_id`, `section_id`) VALUES
(1, 7),
(1, 6),
(1, 5),
(1, 4),
(1, 3),
(1, 1),
(2, 7),
(2, 6),
(5, 16),
(5, 14),
(5, 15),
(10, 16),
(10, 15),
(10, 14),
(11, 4),
(11, 9),
(11, 12),
(12, 14),
(13, 16),
(13, 15),
(9, 16),
(9, 15),
(9, 14),
(14, 15),
(14, 14),
(14, 16),
(18, 16),
(18, 15),
(18, 14),
(19, 16),
(19, 15),
(19, 14),
(20, 18),
(23, 20),
(12, 9),
(24, 13),
(24, 6),
(24, 9),
(24, 14),
(24, 15),
(24, 16),
(23, 19),
(15, 20),
(25, 20),
(25, 22),
(25, 21),
(30, 18),
(30, 23),
(33, 17),
(33, 19),
(33, 18),
(33, 16),
(33, 20),
(33, 21),
(33, 22),
(33, 24),
(32, 24),
(32, 23),
(32, 22),
(32, 21),
(32, 20),
(34, 23),
(34, 24),
(34, 22),
(34, 21),
(34, 19),
(34, 18),
(35, 16);

-- --------------------------------------------------------

--
-- Table structure for table `exam_sqa_map`
--

CREATE TABLE IF NOT EXISTS `exam_sqa_map` (
  `exam_id` int(255) NOT NULL,
  `sqam_id` int(255) NOT NULL,
  KEY `exam_id` (`exam_id`),
  KEY `sqam_id` (`sqam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_sqa_map`
--

INSERT INTO `exam_sqa_map` (`exam_id`, `sqam_id`) VALUES
(1, 16),
(1, 25),
(1, 3),
(1, 24),
(10, 52),
(10, 69),
(10, 53),
(10, 51),
(10, 64),
(10, 73),
(10, 81),
(10, 78),
(10, 72),
(10, 82),
(10, 54),
(10, 70),
(10, 83),
(10, 84),
(10, 85),
(10, 86),
(10, 87),
(10, 88),
(10, 71),
(10, 55),
(10, 56),
(10, 89),
(10, 90),
(10, 91),
(10, 92),
(10, 93),
(10, 94),
(10, 96),
(11, 103),
(11, 104),
(11, 105),
(11, 106),
(11, 49),
(12, 71),
(13, 71),
(13, 55),
(13, 56),
(13, 87),
(13, 64),
(13, 73),
(13, 81),
(14, 54),
(14, 51),
(14, 69),
(13, 88),
(13, 69),
(13, 119),
(13, 86),
(13, 70),
(13, 54),
(14, 52),
(14, 55),
(14, 71),
(14, 56),
(14, 53),
(11, 117),
(11, 114),
(11, 113),
(11, 47),
(11, 112),
(11, 111),
(11, 110),
(20, 120),
(20, 121),
(20, 122),
(24, 123),
(24, 90),
(24, 92),
(24, 89),
(23, 125),
(23, 126),
(23, 127),
(12, 134),
(12, 113),
(23, 129),
(24, 52),
(24, 53),
(24, 51),
(23, 137),
(23, 135),
(15, 125),
(15, 126),
(15, 127),
(25, 139),
(25, 140),
(25, 141),
(30, 142),
(11, 107),
(11, 143),
(33, 142),
(33, 144),
(33, 145),
(33, 148),
(33, 149),
(33, 150),
(32, 125),
(32, 153),
(32, 126),
(32, 127),
(32, 128),
(33, 154),
(33, 155),
(33, 157),
(33, 158),
(33, 159),
(33, 160),
(33, 52),
(33, 81),
(33, 73),
(33, 101),
(33, 162),
(33, 164),
(33, 163),
(33, 165),
(33, 167),
(33, 168),
(33, 169),
(33, 170),
(33, 171),
(32, 158),
(33, 191),
(34, 173),
(34, 174),
(34, 175),
(34, 162),
(34, 164),
(34, 192),
(34, 168),
(34, 193),
(34, 194),
(34, 195),
(34, 196),
(34, 146),
(34, 197),
(34, 198),
(35, 199),
(35, 200),
(35, 201),
(35, 202),
(35, 206),
(35, 216),
(35, 214),
(35, 218);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(255) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `question`, `status`) VALUES
(2, 'test', 1),
(3, 'test question', 1),
(4, '"test question for url"', 1),
(5, 'another test question', 1),
(6, 'This is a test question created in order to test the functionality of the question manager', 1),
(7, 'testing question creating using ajax', 1),
(8, 'Question 1', 0),
(9, 'Question 2', 0),
(10, 'Question 3 kjhjnlnj', 0),
(11, 'ag34fawef', 1),
(12, 'What is my name?', 1),
(13, 'What does SAP mean?', 1),
(14, 'Title123412', 1),
(15, 'zxcv', 1),
(16, 'test123', 1),
(17, 'asdf123a', 1),
(18, 'Demo Question', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_answer_map`
--

CREATE TABLE IF NOT EXISTS `question_answer_map` (
  `sqam_id` int(255) NOT NULL,
  `answer_id` int(255) NOT NULL,
  KEY `sqam_id` (`sqam_id`),
  KEY `answer_id` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_answer_map`
--

INSERT INTO `question_answer_map` (`sqam_id`, `answer_id`) VALUES
(1, 17),
(1, 18),
(1, 1),
(1, 10),
(25, 18),
(25, 17),
(38, 18),
(38, 14),
(38, 8),
(38, 1),
(38, 4),
(51, 21),
(51, 16),
(51, 14),
(53, 24),
(53, 22),
(54, 24),
(54, 17),
(54, 19),
(51, 12),
(73, 17),
(111, 11),
(111, 15),
(111, 18),
(111, 20),
(111, 17),
(111, 14),
(78, 25),
(78, 20),
(78, 9),
(78, 13),
(101, 1),
(101, 10),
(52, 15),
(52, 12),
(52, 1),
(52, 2),
(52, 9),
(52, 13),
(52, 16),
(71, 22),
(71, 21),
(71, 23),
(71, 24),
(55, 23),
(55, 17),
(55, 20),
(55, 16),
(56, 19),
(56, 17),
(56, 16),
(56, 18),
(56, 15),
(56, 21),
(69, 19),
(69, 20),
(69, 23),
(52, 23),
(52, 24),
(52, 22),
(56, 23),
(56, 22),
(56, 24),
(101, 22),
(101, 21),
(101, 12),
(101, 23),
(101, 24),
(113, 23),
(113, 22),
(113, 21),
(90, 23),
(90, 21),
(90, 16),
(127, 26),
(127, 24),
(127, 22),
(134, 22),
(134, 19),
(126, 24),
(126, 23),
(126, 22),
(125, 24),
(125, 23),
(125, 22),
(125, 19),
(125, 16),
(125, 20),
(125, 17),
(125, 15),
(125, 14),
(125, 13),
(125, 12),
(52, 6),
(52, 3),
(52, 18),
(54, 28),
(128, 16),
(128, 31),
(128, 30),
(128, 29),
(128, 28),
(128, 26),
(150, 30),
(150, 29),
(149, 26),
(149, 25),
(149, 24),
(89, 31),
(89, 30),
(89, 29),
(89, 28),
(152, 25),
(152, 24),
(191, 30),
(191, 29),
(193, 31),
(193, 25),
(193, 22),
(193, 26),
(169, 31),
(169, 29),
(169, 21),
(169, 20),
(169, 20),
(199, 31),
(199, 30),
(209, 32),
(209, 31),
(209, 30),
(218, 31),
(218, 30),
(218, 29);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `title`, `status`) VALUES
(1, 'awefwf', 1),
(3, 'test title', 0),
(4, 'test title 222', 0),
(5, 'testsection', 1),
(6, '12312312', 1),
(7, '232323232', 1),
(9, 'Question333', 1),
(10, 'testing section creation using AJAX', 1),
(11, 'a342423', 1),
(12, 'testing section 223', 1),
(13, 'awegergerlhljlkjl', 1),
(14, 'Section 1', 1),
(15, 'Section 2', 1),
(16, 'Section 4', 1),
(17, 'zxcv', 1),
(18, 'vcxz', 1),
(19, 'Easy Question', 1),
(20, 'Section1', 1),
(21, 'adf123556790', 1),
(22, '12345', 1),
(23, '12323', 1),
(24, 'asdf123', 1),
(25, 'TESTING MANUAL', 1),
(26, 'Demo Section - Test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `section_question_answer_map`
--

CREATE TABLE IF NOT EXISTS `section_question_answer_map` (
  `sqam_id` int(255) NOT NULL AUTO_INCREMENT,
  `section_id` int(255) NOT NULL,
  `question_id` int(255) NOT NULL,
  `answer_id` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`sqam_id`),
  KEY `section_id` (`section_id`),
  KEY `question_id` (`question_id`),
  KEY `answer_id` (`answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=220 ;

--
-- Dumping data for table `section_question_answer_map`
--

INSERT INTO `section_question_answer_map` (`sqam_id`, `section_id`, `question_id`, `answer_id`, `status`) VALUES
(1, 5, 5, 18, 1),
(2, 5, 4, 3, 1),
(3, 4, 3, 6, 1),
(15, 5, 2, 17, 1),
(16, 5, 3, 16, 1),
(23, 4, 2, 1, 1),
(24, 3, 2, 17, 1),
(25, 4, 5, 14, 1),
(27, 4, 4, 17, 1),
(31, 3, 5, 1, 1),
(34, 3, 4, 1, 1),
(37, 3, 3, 1, 1),
(38, 7, 5, 23, 1),
(39, 6, 5, 1, 1),
(40, 1, 5, 1, 1),
(41, 7, 3, 1, 1),
(42, 7, 2, 1, 1),
(43, 7, 4, 1, 1),
(44, 6, 4, 1, 1),
(45, 1, 4, 17, 1),
(46, 7, 6, 1, 1),
(47, 9, 7, 1, 1),
(48, 7, 7, 1, 1),
(49, 12, 7, 1, 1),
(50, 10, 7, 1, 1),
(51, 16, 8, 1, 1),
(52, 16, 10, 12, 1),
(53, 16, 9, 24, 1),
(54, 15, 9, 22, 1),
(55, 14, 9, 22, 1),
(56, 14, 8, 23, 1),
(57, 1, 10, 1, 1),
(59, 1, 8, 1, 1),
(60, 1, 6, 1, 1),
(61, 4, 6, 1, 1),
(62, 1, 7, 1, 1),
(64, 16, 7, 22, 1),
(65, 4, 10, 1, 1),
(66, 4, 7, 1, 1),
(67, 4, 8, 1, 1),
(68, 4, 9, 1, 1),
(69, 15, 10, 24, 1),
(70, 15, 8, 24, 1),
(71, 14, 10, 22, 1),
(72, 16, 3, 1, 0),
(73, 16, 6, 1, 0),
(78, 16, 4, 1, 0),
(81, 16, 5, 1, 0),
(82, 16, 2, 1, 0),
(83, 15, 7, 1, 1),
(84, 15, 6, 1, 1),
(85, 15, 5, 1, 1),
(86, 15, 4, 1, 1),
(87, 15, 3, 1, 1),
(88, 15, 2, 1, 1),
(89, 14, 7, 1, 1),
(90, 14, 6, 1, 1),
(91, 14, 5, 1, 1),
(92, 14, 4, 1, 1),
(93, 14, 3, 1, 1),
(94, 14, 2, 1, 1),
(96, 14, 11, 1, 1),
(101, 16, 11, 12, 1),
(103, 12, 11, 1, 1),
(104, 12, 10, 1, 1),
(105, 12, 9, 1, 1),
(106, 12, 8, 1, 1),
(107, 12, 6, 1, 1),
(108, 9, 3, 1, 1),
(109, 9, 2, 1, 1),
(110, 9, 4, 1, 1),
(111, 9, 5, 25, 1),
(112, 9, 6, 1, 1),
(113, 9, 8, 23, 1),
(114, 9, 9, 1, 1),
(115, 9, 10, 1, 1),
(117, 9, 11, 1, 1),
(119, 15, 11, 1, 1),
(120, 18, 10, 1, 1),
(121, 18, 9, 1, 1),
(122, 18, 8, 1, 1),
(123, 14, 12, 1, 1),
(124, 14, 13, 1, 1),
(125, 20, 13, 18, 1),
(126, 20, 12, 23, 1),
(127, 20, 11, 26, 1),
(128, 20, 10, 1, 1),
(129, 20, 9, 1, 1),
(130, 20, 8, 1, 1),
(131, 20, 6, 1, 1),
(132, 20, 7, 1, 1),
(133, 20, 5, 1, 1),
(134, 9, 12, 1, 1),
(135, 19, 9, 1, 1),
(136, 19, 6, 1, 1),
(137, 19, 10, 1, 1),
(138, 19, 7, 1, 1),
(139, 21, 14, 1, 1),
(140, 21, 13, 1, 1),
(141, 21, 12, 1, 1),
(142, 23, 16, 1, 1),
(143, 12, 5, 1, 1),
(144, 23, 15, 1, 1),
(145, 23, 14, 1, 1),
(146, 23, 13, 1, 1),
(147, 23, 12, 1, 1),
(148, 23, 11, 1, 1),
(149, 24, 15, 1, 1),
(150, 24, 14, 1, 1),
(151, 24, 16, 1, 1),
(152, 24, 13, 1, 1),
(153, 20, 14, 1, 1),
(154, 22, 17, 1, 1),
(155, 22, 16, 1, 1),
(156, 22, 15, 1, 1),
(157, 20, 16, 1, 1),
(158, 20, 17, 1, 1),
(159, 20, 15, 1, 1),
(160, 16, 17, 1, 0),
(161, 16, 14, 1, 1),
(162, 18, 17, 1, 1),
(163, 18, 15, 1, 1),
(164, 18, 16, 1, 1),
(165, 18, 14, 1, 1),
(166, 18, 13, 1, 1),
(167, 19, 17, 1, 1),
(168, 19, 16, 1, 1),
(169, 19, 15, 1, 1),
(170, 17, 17, 1, 1),
(171, 17, 16, 1, 1),
(172, 17, 15, 1, 1),
(173, 21, 17, 1, 1),
(174, 21, 16, 1, 1),
(175, 21, 15, 1, 1),
(176, 21, 11, 1, 1),
(177, 21, 10, 1, 1),
(178, 21, 9, 1, 1),
(179, 21, 6, 1, 1),
(180, 21, 5, 1, 1),
(181, 21, 4, 1, 1),
(182, 21, 3, 1, 1),
(183, 21, 2, 1, 1),
(184, 21, 8, 1, 1),
(185, 21, 5, 1, 1),
(186, 21, 5, 1, 1),
(187, 21, 5, 1, 1),
(188, 21, 5, 1, 1),
(189, 21, 6, 1, 1),
(190, 24, 5, 1, 1),
(191, 24, 17, 1, 1),
(192, 18, 7, 1, 1),
(193, 19, 11, 1, 1),
(194, 22, 14, 1, 1),
(195, 22, 6, 1, 1),
(196, 22, 4, 1, 1),
(197, 23, 7, 1, 1),
(198, 23, 4, 1, 1),
(199, 26, 18, 1, 1),
(200, 26, 17, 1, 1),
(201, 26, 16, 1, 1),
(202, 25, 18, 1, 1),
(203, 25, 17, 1, 1),
(204, 25, 16, 1, 1),
(205, 25, 14, 1, 1),
(206, 25, 13, 1, 1),
(207, 25, 12, 1, 1),
(208, 25, 15, 1, 1),
(209, 16, 18, 1, 0),
(210, 16, 13, 1, 0),
(211, 16, 12, 1, 0),
(213, 16, 13, 1, 0),
(214, 16, 13, 1, 0),
(215, 16, 18, 1, 0),
(216, 16, 18, 1, 1),
(217, 16, 13, 1, 1),
(218, 16, 12, 1, 0),
(219, 16, 12, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(7, 'Evan', 'Louie', 'evan.louie@sap.com', 'password');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `attempt`
--
ALTER TABLE `attempt`
  ADD CONSTRAINT `attempt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `attempt_exam_map`
--
ALTER TABLE `attempt_exam_map`
  ADD CONSTRAINT `attempt_exam_map_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `attempt` (`attempt_id`),
  ADD CONSTRAINT `attempt_exam_map_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`);

--
-- Constraints for table `attempt_sqa_map`
--
ALTER TABLE `attempt_sqa_map`
  ADD CONSTRAINT `attempt_sqa_map_ibfk_1` FOREIGN KEY (`sqam_id`) REFERENCES `section_question_answer_map` (`sqam_id`),
  ADD CONSTRAINT `attempt_sqa_map_ibfk_2` FOREIGN KEY (`attempt_id`) REFERENCES `attempt` (`attempt_id`);

--
-- Constraints for table `exam_section_map`
--
ALTER TABLE `exam_section_map`
  ADD CONSTRAINT `exam_section_map_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`),
  ADD CONSTRAINT `exam_section_map_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);

--
-- Constraints for table `exam_sqa_map`
--
ALTER TABLE `exam_sqa_map`
  ADD CONSTRAINT `exam_sqa_map_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`),
  ADD CONSTRAINT `exam_sqa_map_ibfk_2` FOREIGN KEY (`sqam_id`) REFERENCES `section_question_answer_map` (`sqam_id`);

--
-- Constraints for table `question_answer_map`
--
ALTER TABLE `question_answer_map`
  ADD CONSTRAINT `question_answer_map_ibfk_1` FOREIGN KEY (`sqam_id`) REFERENCES `section_question_answer_map` (`sqam_id`),
  ADD CONSTRAINT `question_answer_map_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`answer_id`);

--
-- Constraints for table `section_question_answer_map`
--
ALTER TABLE `section_question_answer_map`
  ADD CONSTRAINT `section_question_answer_map_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`),
  ADD CONSTRAINT `section_question_answer_map_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`),
  ADD CONSTRAINT `section_question_answer_map_ibfk_3` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`answer_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
