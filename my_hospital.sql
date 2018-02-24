-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2016 at 04:29 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_hospital`
--
CREATE DATABASE IF NOT EXISTS `my_hospital` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `my_hospital`;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `at` datetime DEFAULT NULL,
  `about` text NOT NULL,
  `description` text,
  `remarks` text,
  PRIMARY KEY (`id`),
  KEY `AppointmentOF_idx` (`patient`),
  KEY `AppointmentWith` (`doctor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctor`, `patient`, `at`, `about`, `description`, `remarks`) VALUES
(1, 3, 1, '1993-07-27 20:45:00', 'Nose', 'nose got iron', 'Update date time #5'),
(2, 1, 3, '2016-03-19 13:00:00', 'Ears', 'I am not listening properly.', 'Your hearing is fine just take meds I told you about.'),
(3, 1, 3, '2016-03-19 13:00:00', 'Eyes', 'Can''t see anything either', 'You have another appointment so I''ll look into both problems at once. Don''t worry about anything you are in good hands.'),
(4, 1, 2, '2016-03-19 12:55:00', 'Nose', 'Nose issue', 'Done take prescription.'),
(5, 6, 2, '2016-03-19 12:15:00', 'General', 'Regular checkup', 'Please come on time.'),
(6, 1, 8, '2016-04-01 12:15:00', 'Eyes', 'Just for regular checkup.', 'Appointment was done');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE IF NOT EXISTS `specialization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor` int(11) DEFAULT NULL,
  `body_part` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SpecializationFor_idx` (`doctor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`id`, `doctor`, `body_part`) VALUES
(1, 1, 'Eyes'),
(2, 1, 'Nose'),
(3, 3, 'Eyes'),
(4, 3, 'Ears'),
(5, 4, 'Nose'),
(6, 5, 'Eyes'),
(7, 6, 'Nose'),
(8, 6, 'General'),
(9, 9, 'General'),
(11, 11, 'General');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` set('Doctor','Senior Doctor','Patient') DEFAULT 'Patient',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `password`, `dob`, `address`, `mobile`, `email`, `type`) VALUES
(1, 'Lakshay', 'Verma', 'lakshay', 'lk', '1993-10-31', 'Mohalla No 14 House No 8\r\nJalandhar Cantt, Punjab', '+919779333346', 'verma_lakshay@live.in', 'Senior Doctor'),
(2, 'Lakshay', 'Verma', 'lk7253', '9713', '1995-12-29', 'Mohalla No 14 House No 8\r\nJalandhar Cantt', '+919779333346', 'lake.verma25@gmail.com', 'Patient'),
(3, 'Mandeep', 'Kaur', 'mandy', 'mk', '1993-07-27', 'Jalandhar City', '7589417253', 'nomail@example.com', 'Senior Doctor'),
(4, 'Lucky', 'Verma', 'lucky', '7', '1993-10-31', 'Jalandhar Cantt', '7589417253', 'nomail@example.com', 'Doctor'),
(5, 'Sunny', 'Verma', 'sunny', '1996', '1996-12-08', 'Jalandhar Cantt', '9041972991', 'nomail@example.com', 'Doctor'),
(6, 'Barry', 'Allen', 'flash', 'red', '1990-04-29', 'Jalandhar', '0000', 'flash@dc.us', 'Doctor'),
(7, 'Oliver', 'Queen', 'arrow', 'green', '1985-03-25', 'Starling City', '0000', 'arrow@dc.us', 'Patient'),
(8, 'Kajal', 'Pal', 'kajal', '123', '1995-11-07', 'NO Address', '0000', 'nomail@example.com', 'Patient'),
(9, 'Vipul', 'Gupta', 'vipul', '1', '1993-10-14', 'Jalandhar City', '+9100000', 'nomail@example.com', 'Doctor'),
(10, 'Vishal', 'Behal', 'vb', '1', '1992-07-23', 'Doaba Chowk', '+9111111', 'nomail@example.com', 'Patient'),
(11, 'Pardeep', 'Jain', 'pardeep', '1', '1965-09-25', 'Jalandhar Cantt', '+910015', 'nomail@example.com', 'Doctor'),
(12, 'ABC', 'XYZ', 'abc', '123', '1993-10-12', '.', '12345', '123@456.789', 'Patient'),
(13, 'gagan', 'deep', 'gagan', 'dp', '1993-10-14', 'Jal', '12345', '123@456.doc', 'Doctor');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `AppointmentOF` FOREIGN KEY (`patient`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `AppointmentWith` FOREIGN KEY (`doctor`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `specialization`
--
ALTER TABLE `specialization`
  ADD CONSTRAINT `SpecializationFor` FOREIGN KEY (`doctor`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
