-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2012 at 09:47 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `answer`, `status`) VALUES
(1, 'None of the above', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=383 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(255) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=242 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(7, 'Evan', 'Louie', 'evan.louie@sap.com', 'password'),
(9, 'Ivy', 'Cheung', 'i.cheung@sap.com', 'password'),
(10, 'Mitch', 'Chiquita', 'mitch.chiquita@sap.com', 'password');

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
