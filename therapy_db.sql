-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2013 at 01:29 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `therapy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `worksheet_id` int(11) NOT NULL,
  `content` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_answers_questions1_idx` (`question_id`),
  KEY `fk_answers_worksheets1_idx` (`worksheet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `keyword` tinytext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `keyword`, `created_at`, `updated_at`) VALUES
(1, 'What is your trigger?', 'Trigger', '2013-09-05 09:39:07', NULL),
(2, 'What thought goes through your head?', 'Thought', '2013-09-05 09:44:21', NULL),
(3, 'What could you do differently?', 'New thought', '2013-09-05 09:39:03', NULL),
(4, 'What does your body feel?', 'Body', '2013-09-05 14:22:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions_has_topics`
--

CREATE TABLE `questions_has_topics` (
  `question_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`question_id`,`topic_id`),
  KEY `fk_questions_has_topics_topics1_idx` (`topic_id`),
  KEY `fk_questions_has_topics_questions1_idx` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions_has_topics`
--

INSERT INTO `questions_has_topics` (`question_id`, `topic_id`, `order`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 11),
(4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `definition` longtext,
  `emergency` longtext,
  `resources` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `definition`, `emergency`, `resources`, `created_at`, `updated_at`) VALUES
(1, 'Trauma', 'Trauma is an experience in which all your coping skills fail to help you manage the emotional toll of what happens.', 'If you are currently in life threatening danger, please call 911. If you or someone you know is currently being abused you can call CPS or Adult Protective Services.', NULL, '2013-09-04 15:19:40', NULL),
(2, 'Panic Attacks', 'Panic attacks cause physical symptoms as a result of anxiety. Often there is a strong heart beat, difficulty breathing, and fears of death.', 'If you cannot breath, or are experiencing serious heart problems, please call 911 or contact a medical professional.', NULL, '2013-09-04 15:19:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(225) DEFAULT NULL,
  `last_name` varchar(225) DEFAULT NULL,
  `admin_level` int(11) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `admin_level`, `email`, `date_of_birth`, `password`, `created_at`, `updated_at`) VALUES
(15, 'Margaret', 'Epps', 9, 'maggie.epps@gmail.com', '1986-04-16', 'd939a85377d6eecd295db9656d6221ebf52e65b0', '2013-09-04 17:47:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `worksheets`
--

CREATE TABLE `worksheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_worksheets_topics1_idx` (`topic_id`),
  KEY `fk_worksheets_users1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answers_questions1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_answers_worksheets1` FOREIGN KEY (`worksheet_id`) REFERENCES `worksheets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `questions_has_topics`
--
ALTER TABLE `questions_has_topics`
  ADD CONSTRAINT `fk_questions_has_topics_questions1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_questions_has_topics_topics1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `worksheets`
--
ALTER TABLE `worksheets`
  ADD CONSTRAINT `fk_worksheets_topics1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_worksheets_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
