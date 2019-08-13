-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2018 at 04:35 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id2833730_dblgbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblannouncement`
--

CREATE TABLE `tblannouncement` (
  `id` int(11) NOT NULL,
  `an_uid` varchar(25) NOT NULL,
  `an_username` varchar(50) NOT NULL,
  `an_announce` varchar(500) NOT NULL,
  `an_date` varchar(25) NOT NULL,
  `an_title` varchar(50) NOT NULL,
  `an_studno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblannouncement`
--

INSERT INTO `tblannouncement` (`id`, `an_uid`, `an_username`, `an_announce`, `an_date`, `an_title`, `an_studno`) VALUES
(1, '1', 'king', 'Sample announcement', '2018-07-12', 'Sample Title', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbanuser`
--

CREATE TABLE `tblbanuser` (
  `id` int(11) NOT NULL,
  `user_studno` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_bday` varchar(25) NOT NULL,
  `user_uid` varchar(11) NOT NULL,
  `user_cstudno` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblchatlogs`
--

CREATE TABLE `tblchatlogs` (
  `id` int(11) NOT NULL,
  `chat_userid` varchar(11) NOT NULL,
  `chat_userstudno` varchar(25) NOT NULL,
  `chat_username` varchar(50) NOT NULL,
  `chat_message` varchar(200) NOT NULL,
  `chat_date` varchar(25) NOT NULL,
  `chat_imagepath` varchar(500) NOT NULL,
  `chat_time` varchar(50) NOT NULL,
  `chat_studno` varchar(25) DEFAULT NULL,
  `chat_fname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblchatlogs`
--

INSERT INTO `tblchatlogs` (`id`, `chat_userid`, `chat_userstudno`, `chat_username`, `chat_message`, `chat_date`, `chat_imagepath`, `chat_time`, `chat_studno`, `chat_fname`) VALUES
(35, '1', '140255', 'king', 'testing . .. . .. .', '2017-10-05', 'images/profileimages/trueme.jpg', '07:54:31 am', NULL, ''),
(36, '3', '434343', 'soul', 'testing', '2017-10-07', 'images/profileimages/100x100px.jpg', '03:18:10 am', NULL, 'soulll'),
(37, '1', '140255', 'king', '.....', '2018-04-25', 'images/profileimages/trueme.jpg', '02:02:05 pm', NULL, 'king'),
(38, '6', '1234567', 'atlas03', 'lmao', '2018-06-07', '', '12:49:22 am', NULL, ''),
(39, '6', '1234567', 'atlas03', 'lmao', '2018-06-07', '', '12:49:25 am', NULL, ''),
(40, '6', '1234567', 'atlas03', 'lmao', '2018-06-07', '', '12:49:28 am', NULL, ''),
(41, '6', '1234567', 'atlas03', '.', '2018-06-07', '', '12:49:36 am', NULL, ''),
(42, '6', '1234567', 'atlas03', '.', '2018-06-07', '', '12:49:38 am', NULL, ''),
(43, '1', '140255', 'king', 'Sample Game', '2018-07-13', 'images/profileimages/trueme.jpg', '07:56:03 am', NULL, 'king');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomment`
--

CREATE TABLE `tblcomment` (
  `id` int(11) NOT NULL,
  `ct_studno` varchar(25) NOT NULL,
  `ct_studusername` varchar(50) NOT NULL,
  `ct_title` varchar(50) NOT NULL,
  `ct_comment` varchar(500) NOT NULL,
  `ct_topicid` varchar(25) NOT NULL,
  `ct_author` varchar(25) NOT NULL,
  `ct_uid` varchar(25) NOT NULL,
  `ct_cstudno` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcomment`
--

INSERT INTO `tblcomment` (`id`, `ct_studno`, `ct_studusername`, `ct_title`, `ct_comment`, `ct_topicid`, `ct_author`, `ct_uid`, `ct_cstudno`) VALUES
(1, '140255', 'king', 'dsad', 'dsadsa', '1', 'hunter', '1', NULL),
(2, '140255', 'king', 'dsad', 'ewasdsa', '1', 'hunter', '1', NULL),
(3, '140255', 'king', 'dsad', 'dsa', '1', 'hunter', '1', NULL),
(4, '140255', 'king', 'Unity 3D', 'hey', '5', 'king', '1', NULL),
(5, '140255', 'king', 'Quantum', 'dsads', '6', 'king', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblfriends`
--

CREATE TABLE `tblfriends` (
  `id` int(11) NOT NULL,
  `f_uid` varchar(50) NOT NULL,
  `f_studno` varchar(50) NOT NULL,
  `f_username` varchar(100) NOT NULL,
  `f_afuid` varchar(50) NOT NULL,
  `f_afstudno` varchar(50) NOT NULL,
  `f_afusername` varchar(50) NOT NULL,
  `f_cstudno` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfriends`
--

INSERT INTO `tblfriends` (`id`, `f_uid`, `f_studno`, `f_username`, `f_afuid`, `f_afstudno`, `f_afusername`, `f_cstudno`) VALUES
(1, '1', '140255', 'king', '2', '22222', 'hunter', NULL),
(2, '1', '140255', 'king', '3', '434343', 'soul', NULL),
(3, '2', '22222', 'hunter', '3', '434343', 'soul', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblfriendsrequest`
--

CREATE TABLE `tblfriendsrequest` (
  `id` int(11) NOT NULL,
  `f_uid` varchar(50) NOT NULL,
  `f_studno` varchar(50) NOT NULL,
  `f_username` varchar(100) NOT NULL,
  `f_confirmed` varchar(50) NOT NULL,
  `f_touid` varchar(50) NOT NULL,
  `f_tostudno` varchar(50) NOT NULL,
  `f_tousername` varchar(50) NOT NULL,
  `f_isadd` varchar(50) NOT NULL,
  `f_cstudno` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfriendsrequest`
--

INSERT INTO `tblfriendsrequest` (`id`, `f_uid`, `f_studno`, `f_username`, `f_confirmed`, `f_touid`, `f_tostudno`, `f_tousername`, `f_isadd`, `f_cstudno`) VALUES
(1, '2', '22222', 'hunter', 'confirmed', '1', '140255', 'king', 'added', NULL),
(2, '3', '434343', 'soul', 'confirmed', '1', '140255', 'king', 'added', NULL),
(3, '3', '434343', 'soul', 'confirmed', '2', '22222', 'hunter', 'added', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblinboxmessage`
--

CREATE TABLE `tblinboxmessage` (
  `id` int(11) NOT NULL,
  `im_senderuserid` varchar(25) NOT NULL,
  `im_senderstudno` varchar(25) NOT NULL,
  `im_sender` varchar(25) NOT NULL,
  `im_message` varchar(500) NOT NULL,
  `im_reicever` varchar(25) NOT NULL,
  `im_date` varchar(25) NOT NULL,
  `im_isread` varchar(25) NOT NULL,
  `im_studno` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsentmessage`
--

CREATE TABLE `tblsentmessage` (
  `id` int(11) NOT NULL,
  `sm_userid` varchar(25) NOT NULL,
  `sm_studno` varchar(25) NOT NULL,
  `sm_username` varchar(25) NOT NULL,
  `sm_message` varchar(500) NOT NULL,
  `sm_to` varchar(25) NOT NULL,
  `sm_date` varchar(25) NOT NULL,
  `sm_cstudno` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltopics`
--

CREATE TABLE `tbltopics` (
  `t_id` int(11) NOT NULL,
  `t_title` varchar(25) NOT NULL,
  `t_description` varchar(100) NOT NULL,
  `t_author` varchar(25) NOT NULL,
  `t_content` varchar(500) NOT NULL,
  `t_uid` varchar(25) NOT NULL,
  `t_date` varchar(25) NOT NULL,
  `t_studno` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltopics`
--

INSERT INTO `tbltopics` (`t_id`, `t_title`, `t_description`, `t_author`, `t_content`, `t_uid`, `t_date`, `t_studno`) VALUES
(5, 'Unity 3D', 'Powerful Engine for Game Development', 'king', 'Unity is a cross-platform game engine developed by Unity Technologies, which is primarily used to develop video games and simulations for computers consoles and mobile devices.', '1', '2017-10-05', NULL),
(6, 'Quantum', 'what is Quantum', 'king', 'Quantum mechanics, including quantum field theory, is a fundamental theory in physics which describes nature at the smallest scales of energy levels of atoms and subatomic particles.', '1', '2017-12-21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `stud_uno` varchar(50) NOT NULL,
  `stud_uusername` varchar(50) NOT NULL,
  `stud_upassword` varchar(50) NOT NULL,
  `stud_uemail` varchar(50) NOT NULL,
  `stud_ugender` varchar(50) NOT NULL,
  `stud_birthday` varchar(25) NOT NULL,
  `stud_firstname` varchar(100) NOT NULL,
  `stud_lastname` varchar(100) NOT NULL,
  `stud_mi` varchar(100) NOT NULL,
  `stud_position` varchar(100) NOT NULL,
  `stud_yearlevel` varchar(100) NOT NULL,
  `stud_campus` varchar(100) NOT NULL,
  `stud_course` varchar(100) NOT NULL,
  `stud_profilepath` varchar(50) NOT NULL,
  `stud_ifban` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `stud_uno`, `stud_uusername`, `stud_upassword`, `stud_uemail`, `stud_ugender`, `stud_birthday`, `stud_firstname`, `stud_lastname`, `stud_mi`, `stud_position`, `stud_yearlevel`, `stud_campus`, `stud_course`, `stud_profilepath`, `stud_ifban`) VALUES
(1, '140255', 'king', 'admin', 'admin@gmail.com', 'Lesbian', '2016-10-29', 'king', 'king', 'k', 'admin', 'First Year', 'Gen Tino', 'College Of Engeneering', 'images/profileimages/trueme.jpg', ''),
(2, '22222', 'hunter', 'hunter', 'hunter@gmail.com', 'Gay', '2016-10-30', 'hunter', 'hunter', 'h', '', 'Third Year', 'San Isidro', 'Bachelor Of Science in Information And Technology', 'images/profileimages/Joke.jpg', ''),
(3, '434343', 'soul', 'admin', 'soul@gmail.com', 'Gay', '2016-10-28', 'soulll', 'Soul', 'S', '', 'Third Year', 'Atate', 'College of Nursing', 'images/profileimages/100x100px.jpg', ''),
(4, '2014100666', 'rey', 'Up56sv13', 'rey@gmail.com', 'Gay', '1990-01-01', '', '', '', '', '', '', '', '', ''),
(5, '123456', 'mack', 'Up56sv13', 'mark@gmail.com', 'Bisexual', '1990-12-11', '', '', '', '', '', '', '', '', ''),
(6, '1234567', 'atlas03', 'Abcdefghijklm', 'gilarce022@gmail.com', 'Bisexual', '1994-08-02', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblannouncement`
--
ALTER TABLE `tblannouncement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `an_studno` (`an_studno`);

--
-- Indexes for table `tblbanuser`
--
ALTER TABLE `tblbanuser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_cstudno` (`user_cstudno`);

--
-- Indexes for table `tblchatlogs`
--
ALTER TABLE `tblchatlogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chat_studno` (`chat_studno`);

--
-- Indexes for table `tblcomment`
--
ALTER TABLE `tblcomment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ct_cstudno` (`ct_cstudno`);

--
-- Indexes for table `tblfriends`
--
ALTER TABLE `tblfriends`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `f_cstudno` (`f_cstudno`);

--
-- Indexes for table `tblfriendsrequest`
--
ALTER TABLE `tblfriendsrequest`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `f_cstudno` (`f_cstudno`);

--
-- Indexes for table `tblinboxmessage`
--
ALTER TABLE `tblinboxmessage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `im_studno` (`im_studno`);

--
-- Indexes for table `tblsentmessage`
--
ALTER TABLE `tblsentmessage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sm_cstudno` (`sm_cstudno`);

--
-- Indexes for table `tbltopics`
--
ALTER TABLE `tbltopics`
  ADD PRIMARY KEY (`t_id`),
  ADD UNIQUE KEY `t_studno` (`t_studno`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stud_uno` (`stud_uno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblannouncement`
--
ALTER TABLE `tblannouncement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbanuser`
--
ALTER TABLE `tblbanuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblchatlogs`
--
ALTER TABLE `tblchatlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tblcomment`
--
ALTER TABLE `tblcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblfriends`
--
ALTER TABLE `tblfriends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblfriendsrequest`
--
ALTER TABLE `tblfriendsrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblinboxmessage`
--
ALTER TABLE `tblinboxmessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblsentmessage`
--
ALTER TABLE `tblsentmessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbltopics`
--
ALTER TABLE `tbltopics`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblannouncement`
--
ALTER TABLE `tblannouncement`
  ADD CONSTRAINT `tblannouncement_ibfk_1` FOREIGN KEY (`an_studno`) REFERENCES `tbluser` (`stud_uno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblbanuser`
--
ALTER TABLE `tblbanuser`
  ADD CONSTRAINT `tblbanuser_ibfk_1` FOREIGN KEY (`user_cstudno`) REFERENCES `tbluser` (`stud_uno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblchatlogs`
--
ALTER TABLE `tblchatlogs`
  ADD CONSTRAINT `tblchatlogs_ibfk_1` FOREIGN KEY (`chat_studno`) REFERENCES `tbluser` (`stud_uno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblcomment`
--
ALTER TABLE `tblcomment`
  ADD CONSTRAINT `tblcomment_ibfk_1` FOREIGN KEY (`ct_cstudno`) REFERENCES `tbluser` (`stud_uno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblfriends`
--
ALTER TABLE `tblfriends`
  ADD CONSTRAINT `tblfriends_ibfk_1` FOREIGN KEY (`f_cstudno`) REFERENCES `tbluser` (`stud_uno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblfriendsrequest`
--
ALTER TABLE `tblfriendsrequest`
  ADD CONSTRAINT `tblfriendsrequest_ibfk_1` FOREIGN KEY (`f_cstudno`) REFERENCES `tbluser` (`stud_uno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblinboxmessage`
--
ALTER TABLE `tblinboxmessage`
  ADD CONSTRAINT `tblinboxmessage_ibfk_1` FOREIGN KEY (`im_studno`) REFERENCES `tbluser` (`stud_uno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblsentmessage`
--
ALTER TABLE `tblsentmessage`
  ADD CONSTRAINT `tblsentmessage_ibfk_1` FOREIGN KEY (`sm_cstudno`) REFERENCES `tbluser` (`stud_uno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbltopics`
--
ALTER TABLE `tbltopics`
  ADD CONSTRAINT `tbltopics_ibfk_1` FOREIGN KEY (`t_studno`) REFERENCES `tbluser` (`stud_uno`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
