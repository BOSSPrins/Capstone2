-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 08:13 PM
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
-- Database: `mabuhay_mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `news_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`news_id`, `title`, `description`, `start_date`, `end_date`, `images`) VALUES
(1, 'testingers', 'test', '2024-12-08T16:31', '2024-12-09T16:31', 'arle.png,awtlas.png,bebetime.jpg'),
(2, 'testing', 'test', '2024-12-09T16:33', '2024-12-19T16:33', 'arcana.png,bebetime.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `complaint_number` int(11) NOT NULL,
  `complaint_type` varchar(50) NOT NULL,
  `complainee` varchar(50) NOT NULL,
  `complaint` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `proof` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `filed_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `complaineeAddress` varchar(20) NOT NULL,
  `ComplaineeEmail` varchar(255) NOT NULL,
  `complainantUID` int(11) NOT NULL,
  `complainantName` varchar(255) NOT NULL,
  `complainantAddress` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `processed_date` varchar(50) NOT NULL,
  `Remark1` varchar(255) NOT NULL,
  `RemarkBy1` varchar(20) NOT NULL,
  `status1` varchar(20) NOT NULL,
  `RemarkDate1` varchar(50) NOT NULL,
  `escaLetter` varchar(255) NOT NULL,
  `Remark2` varchar(255) NOT NULL,
  `RemarkBy2` varchar(20) NOT NULL,
  `status2` varchar(20) NOT NULL,
  `RemarkDate2` varchar(50) NOT NULL,
  `resolveLetter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `complaint_number`, `complaint_type`, `complainee`, `complaint`, `description`, `proof`, `pdf`, `filed_date`, `complaineeAddress`, `ComplaineeEmail`, `complainantUID`, `complainantName`, `complainantAddress`, `status`, `processed_date`, `Remark1`, `RemarkBy1`, `status1`, `RemarkDate1`, `escaLetter`, `Remark2`, `RemarkBy2`, `status2`, `RemarkDate2`, `resolveLetter`) VALUES
(1, 111111, '', 'Mooda', 'Blocking the Driveway', 'Laging nakaharang yung kotse nya sa gate ko', '[\"bossing.jpg\"]', '', '2024-09-19 12:07:15', 'Blk 54 Lot 1', '', 0, 'Mark', 'Blk 78 Lot 10', 'Escalated', '', '', 'admin', 'In-Process', '2024-11-10 23:00:38', '', 'Turn over to barangay', 'admin', 'Escalated', '2024-11-10 23:12:40', ''),
(2, 222222, '', 'Raul', 'Blocking the Driveway', 'Yung tricycle nya dinikit sa kotse ko', '[\"bossing.jpg\"]', '', '2024-09-19 12:07:35', 'Blk 3 Lot 6', '', 0, 'Sgup', 'Blk 100 Lot 6', 'Escalated', '', 'Processing na po', 'admin', 'In-Process', '2024-11-10 22:52:21', '', 'This Complaint will be turn over to the barangay', 'admin', 'Escalated', '2024-11-10 22:54:21', ''),
(3, 333333, '', 'Nigs', 'Pet Issues', 'Aso nya laging galit', '[\"awtlas.png\"]', '', '2024-11-08 19:34:38', 'Blk 54 Lot 1', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Resolved', '', 'Change to in process', 'admin', 'In-Process', '2024-11-10 02:39:52', '', 'Resolved na', 'admin', 'Resolved', '2024-11-10 21:42:27', ''),
(4, 444444, '', 'Pat Anoyab', 'Noise Complaint', 'Ingay nila mag asawa', '[\"boss.jpg\"]', '', '2024-11-10 14:57:37', 'Blk 123 Lot 56', '', 821155870, 'Jhonrenz Berbano', 'Blk 1 Lot 1', 'Resolved', '2024-11-11 21:59:35', 'Done na po', 'admin', 'Resolved', '2024-11-11 22:21:17', '', '', '', '', '', ''),
(5, 555555, '', '', 'Property Maintenance', 'Yung bintana nya sa third floor tumusok sa bubong ko', '[\"malupiton.png\"]', '', '2024-11-11 14:30:11', 'Blk 9 Lot 6', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Escalated', '2024-11-11 22:31:57', 'Turn over na po sa barangay di na namin kaya', 'admin', 'Escalated', '2024-11-11 22:32:16', '', '', '', '', '', ''),
(6, 1142799674, '', '', 'Noise Complaint', 'Ingay ng aso nila kahit madaling araw nagwawala', '[\"meow.jpg\"]', '', '2024-11-12 15:34:45', 'Blk 60 Lot 60', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Resolved', '2024-11-13 00:00:52', 'Okay na po tinapon na namin yung aso', 'admin', 'Resolved', '2024-11-13 00:27:55', '', '', '', '', '', ''),
(7, 1546759430, '', '', 'Property Maintenance', 'Yung puno nya tumumba sa gate ko', '[\"malupiton.png\"]', '', '2024-11-12 18:35:21', 'Blk 61 Lot 61', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'In-Process', '2024-11-13 02:38:23', '', '', '', '', '', '', '', '', '', ''),
(8, 1502036937, '', 'Di ko alam', 'Noise Complaint', 'ingay', '[\"bike.jpg\"]', '', '2024-11-14 17:14:04', 'Blk 6 lot 7', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Pending', '', '', '', '', '', '', '', '', '', '', ''),
(9, 316398639, '', '', 'Noise Complaint', 'Ingay', '[\"673773a2b3bbf_malupiton.png\",\"673773a2b3dc0_malupiton2.png\"]', '', '2024-11-15 16:15:30', 'Blk 0 Lot 1', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Pending', '', '', '', '', '', '', '', '', '', '', ''),
(10, 1310202046, '', '', 'Pet Issues', 'Aso nya di nakatali', '[\"673777811631c_boss.jpg\",\"67377781164ee_bossing.jpg\"]', '', '2024-11-15 16:32:01', 'Blk 9 Lot 9', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Pending', '', '', '', '', '', '', '', '', '', '', ''),
(11, 287290528, '', '', 'Noise Complaint', 'test', '[\"67377976c6b1b_boss.jpg\",\"67377976c6d23_bossing.jpg\"]', '', '2024-11-15 16:40:22', 'test', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Pending', '', '', '', '', '', '', '', '', '', '', ''),
(12, 802553249, '', '', 'Property Maintenance', 'Pagong', '[\"malupiton.png\",\"malupiton2.png\"]', '', '2024-11-15 17:02:21', 'Blk 6 lot 0', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Pending', '', '', '', '', '', '', '', '', '', '', ''),
(13, 644834543, '', '', 'Rule Violation', 'aw', '[\"malupiton.png\",\"malupiton2.png\",\"malupiton3.jpg\",\"meow.jpg\"]', '', '2024-11-15 17:03:25', 'Blk 0 lot 0 ', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Resolved', '2024-11-19 01:59:22', 'Dili na kaya', 'admin', 'Escalated', '2024-11-19 01:59:46', '', 'Gg\'s na', 'barangay', 'Resolved', '2024-11-19 02:01:45', ''),
(14, 709666182, '', '', 'Rule Violation', 'test', '[\"boss.jpg\",\"bossing.jpg\",\"malupiton.png\",\"malupiton2.png\",\"malupiton3.jpg\"]', '', '2024-11-15 17:04:42', 'Test', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Pending', '', '', '', '', '', '', '', '', '', '', ''),
(15, 799350189, 'Direct Complaint', 'test', 'Parking Problems ', 'test', '[\"meow.jpg\"]', '', '2024-11-15 17:13:50', 'test', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Pending', '', '', '', '', '', '', '', '', '', '', ''),
(16, 1341459227, 'Direct Complaint', 'test', 'Parking Problems ', 'test', '[\"re4.png\"]', '', '2024-11-15 17:25:42', 'test', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Pending', '', '', '', '', '', '', '', '', '', '', ''),
(17, 401542834, 'Direct Complaint', 'test', 'Parking Problems ', 'test', '[\"re4.png\"]', '', '2024-11-15 17:33:37', 'test', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'In-Process', '2024-11-30 19:22:08', '', '', '', '', '', '', '', '', '', ''),
(18, 751353843, 'Direct Complaint', 'qwer', 'Parking Problems ', 'qwer', '[\"boss.jpg\"]', '', '2024-11-15 17:36:03', 'qwer', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'In-Process', '2024-11-16 21:48:34', '', '', '', '', '', '', '', '', '', ''),
(19, 1264254659, 'Direct Complaint', 'waea', 'Parking Problems ', 'adawdad', '[\"vote.png\"]', '', '2024-11-15 17:53:05', 'adawda', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'In-Process', '2024-11-27 05:43:34', '', '', '', '', '', '', '', '', '', ''),
(20, 446038163, 'Direct Complaint', 'test', 'Parking Problems', 'test', '[\"re4.png\"]', '', '2024-11-15 18:15:09', 'test', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'In-Process', '2024-11-27 05:21:41', '', '', '', '', '', '', '', '', '', ''),
(21, 1080101548, 'General Complaint', '', 'Noise Complaint', 'test', '[\"Eternity.jpg\"]', '', '2024-11-16 12:46:19', '', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'In-Process', '2024-11-27 04:26:43', '', '', '', '', '', '', '', '', '', ''),
(22, 999220120, 'Direct Complaint', 'nice', 'Noise Complaint', 'good job', '[\"malupiton.png\",\"malupiton3.jpg\",\"meow.jpg\"]', '', '2024-11-16 14:18:03', 'one', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Resolved', '2024-11-18 22:38:24', 'Okay na pi', 'barangay', 'Resolved', '2024-11-18 22:48:10', '', '', '', '', '', ''),
(23, 866088832, 'General Complaint', '', 'Noise Complaint', 'nice', '[\"arkana.png\",\"arle.png\",\"awtlas.png\",\"bebetime.jpg\"]', '', '2024-11-16 14:18:42', '', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Resolved', '2024-11-18 22:37:21', 'Test', 'admin', 'Escalated', '2024-11-18 22:52:06', '', 'oki na pi', 'barangay', 'Resolved', '2024-11-18 22:55:42', ''),
(31, 918316644, 'Direct Complaint', 'Test', 'Pet Issues', 'Test', '[\"bike.jpg\"]', '[\"Complaint-999220120.pdf\",\"Complaint-866088832.pdf\"]', '2024-11-22 12:27:56', 'Test', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Resolved', '2024-11-22 22:39:53', 'Turn over na ekis na', 'admin', 'Escalated', '2024-11-23 01:31:07', '', 'All goods na', 'barangay', 'Resolved', '2024-11-23 01:53:10', ''),
(32, 883927647, 'Direct Complaint', '', 'Property Maintenance', 'Yung gate nya umabot na sa gate ko', '[\"boss.jpg\",\"bossing.jpg\",\"malupiton.png\",\"malupiton2.png\",\"malupiton3.jpg\"]', '[\"Complaint-999220120.pdf\",\"Complaint-866088832.pdf\"]', '2024-11-23 15:17:28', 'Blk 10 Lot 78', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Resolved', '2024-11-23 23:24:24', 'Turn over ko na to makulit na e ', 'admin', 'Escalated', '2024-11-23 23:25:16', 'Turn-Over-Letter-883927647.pdf', 'Eto na talaga pramis okay na to', 'barangay', 'Resolved', '2024-11-24 04:45:28', 'Settled-Letter-883927647.pdf'),
(33, 1643921437, 'General Complaint', '', 'Noise Complaint', 'Ingay po', '[\"malupiton2.png\",\"malupiton3.jpg\",\"malupiton4.jpg\"]', '', '2024-11-24 13:57:02', '', '', 916555761, 'Tanjiro Dela Cruz', 'Blk 78 Lot 10', 'Resolved', '2024-11-25 06:13:43', 'Lipat na sa barangay', 'admin', 'Escalated', '2024-11-25 07:47:08', 'Turn-Over-Letter-1643921437.pdf', 'Oks na', 'barangay', 'Resolved', '2024-11-25 07:53:07', 'Settled-Letter-1643921437.pdf'),
(34, 1208717079, 'General Complaint', '', 'Noise Complaint', '123123', '[\"bebetime.jpg\"]', '', '2024-11-26 21:44:13', '', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Escalated', '2024-11-27 05:44:25', '123123', 'admin', 'Escalated', '2024-11-27 14:10:02', 'Turn-Over-Letter-1208717079.pdf', '', '', '', '', ''),
(35, 425320484, 'General Complaint', '', 'Noise Complaint', 'ingay naman kasi', '[\"bebetime.jpg\"]', '', '2024-11-26 21:46:03', '', 'vardump007@gmail.com', 916555761, 'Tanjiro Dela Cruz', 'Blk 78 Lot 10', 'Resolved', '2024-11-30 15:24:37', '', 'admin', 'Escalated', '2024-11-30 15:32:03', '', '', 'barangay', 'Resolved', '2024-11-30 15:56:23', ''),
(36, 1645727274, 'Direct Complaint', 'Test lang sa email', 'Parking Problems', 'Test', '[\"malupiton4.jpg\"]', '', '0000-00-00 00:00:00', '2024-11-28 18:51:56', 'vardump007@gmail.com', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Pending', '', '', '', '', '', '', '', '', '', '', ''),
(37, 1395802853, 'Direct Complaint', 'Test lang ulet sa email', 'Parking Problems', 'Tricycle nya sa gate ko binangga', '[\"malupiton4.jpg\"]', '', '0000-00-00 00:00:00', '2024-11-28 20:51:53', 'vardump007@gmail.com', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Pending', '', '', '', '', '', '', '', '', '', '', ''),
(38, 1604739286, 'Direct Complaint', 'Test sa notify', 'Property Maintenance', 'Kalat nya', '[\"malupiton4.jpg\"]', '', '0000-00-00 00:00:00', '2024-11-28 21:04:51', 'vardump007@gmail.com', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Pending', '', '', '', '', '', '', '', '', '', '', ''),
(39, 1053648047, 'General Complaint', '', 'Noise Complaint', 'test nasira yung filed date', '[\"malupiton4.jpg\"]', '', '2024-11-28 22:15:27', '', '', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'In-Process', '2024-11-30 13:10:55', '', '', '', '', '', '', '', '', '', ''),
(40, 1430726902, 'Direct Complaint', 'Test sa notice', 'Parking Problems', 'cutie', '[\"malupiton2.png\"]', '', '2024-11-28 22:16:51', 'Blk 78 Lot 10', 'vardump007@gmail.com', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'In-Process', '2024-11-30 13:14:59', 'Turn over na po di ko na kaya', 'admin', 'Escalated', '2024-11-29 06:42:20', '', '', '', '', '', ''),
(41, 349112476, 'General Complaint', '', 'Noise Complaint', 'Maingay', '[\"Penetration Testing.png\"]', '', '2025-01-24 15:38:13', '', '', 1486934929, 'Prince Cervantes', 'Blk 79 Lot 11', 'Resolved', '2025-01-24 23:39:17', 'Turn over na po di na namin kaya', 'admin', 'Escalated', '2025-01-24 23:40:57', 'Turn-Over-Letter-349112476.pdf', 'okay na po', 'barangay', 'Resolved', '2025-01-24 23:42:45', 'Settled-Letter-349112476.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `forms_id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `block` varchar(255) NOT NULL,
  `lot` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`forms_id`, `unique_id`, `form_name`, `first_name`, `middle_name`, `last_name`, `block`, `lot`, `status`) VALUES
(1, '', 'Move Out', 'Prince ', 'Cutie ', 'Cervantes', '2', '2', 'Verifying'),
(2, '', 'Move Out', 'Prince', 'Cutie', 'Cervantes', '1', '18', 'Verifying'),
(3, '', 'Move Out', 'Prince', 'Cutie', 'Cervantes', '1', '18', 'Verifying'),
(4, '', 'Move Out', 'Prince', 'Cutie', 'Cervantes', '11', '18', 'Verifying'),
(5, '', 'Move Out', 'Prince', 'Cutie', 'Cervantes', '1', '18', 'Verifying'),
(6, '', 'Move Out', 'Prince', 'Cutie', 'Cervantes', '1', '18', 'Verifying'),
(7, '', 'Move Out', 'Prince', 'Cutie', 'Cervantes', '1', '18', 'Verifying'),
(8, '', 'Move Out', 'Prince', 'Cutie', 'Cervantes', '1', '18', 'Verifying'),
(9, '', 'Move Out', 'Prince', 'Cutie', 'Cervantes', '111', '18', 'Verifying'),
(10, '', 'Move Out', 'Prince', 'Cutie', 'Cervantes', '1', '18', 'Verifying'),
(11, '', 'Move Out', 'Prince', 'Cutie', 'Cervantes', '1', '18', 'Verifying'),
(12, '', 'Move Out', 'Prince', 'Cutie', 'Cervantes', '1', '18', 'Verifying'),
(13, '1357825271', 'Move Out', 'Wela', 'Aguilar', 'Magsino', '3', '23', 'Verifying'),
(14, '1357825271', 'Move Out', 'Wela', 'Aguilar', 'Magsino', '3', '23', 'Verifying'),
(15, '1357825271', 'Move Out', 'Wela', 'Aguilar', 'Magsino', '3', '23', 'Verifying');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `datetime`) VALUES
(3, 730027935, 1589571584, 'hello\r\n', '2024-05-09 19:05:55'),
(4, 1357825271, 1589571584, 'Hi idol', '2024-05-09 19:05:55'),
(5, 1589571584, 1357825271, 'Hi din ', '2024-05-09 19:05:55'),
(6, 1589571584, 1357825271, 'hi', '2024-05-09 19:05:55'),
(7, 1357825271, 1589571584, 'sige', '2024-05-09 19:05:55'),
(8, 1357825271, 1589571584, 'hi\r\n', '2024-05-09 19:05:55'),
(9, 1357825271, 1589571584, 'hello', '2024-05-09 19:05:55'),
(10, 1357825271, 1589571584, 'hi', '2024-05-09 19:05:55'),
(11, 1357825271, 1589571584, 'heloooo', '2024-05-09 19:05:55'),
(12, 1357825271, 1589571584, '1223', '2024-05-09 19:05:55'),
(13, 1589571584, 1357825271, 'heloo', '2024-05-09 19:05:55'),
(14, 1357825271, 1589571584, 'oki piiii', '2024-05-09 19:05:55'),
(15, 1589571584, 1357825271, '13121312', '2024-05-09 19:05:55'),
(16, 1357825271, 1589571584, '123312312313131313131       13131313131311313 1 23 1 123 123 1 3 31 31 31 3 31 31 31 31 3 13 1 13 1 3 1 31 31 31 31 31 31 31 312 31 3131 1 31 3', '2024-05-09 19:05:55'),
(18, 1589571584, 1357825271, 'qwe', '2024-05-09 19:05:55'),
(19, 1357825271, 1589571584, 'hello', '2024-05-09 19:05:55'),
(20, 1589571584, 1357825271, '123', '2024-05-09 19:05:55'),
(21, 1589571584, 1357825271, 'qwe', '2024-05-09 19:05:55'),
(22, 1357825271, 1589571584, 'qwe', '2024-05-09 19:05:55'),
(23, 1357825271, 1589571584, 'qwe', '2024-05-09 19:05:55'),
(24, 1357825271, 1589571584, 'qwe', '2024-05-09 19:05:55'),
(25, 1357825271, 1589571584, 'qwe', '2024-05-09 19:05:55'),
(26, 1357825271, 1589571584, 'qwe', '2024-05-09 19:05:55'),
(27, 1357825271, 1589571584, 'qwe', '2024-05-09 19:05:55'),
(28, 1357825271, 1589571584, 'qwe', '2024-05-09 19:05:55'),
(29, 1357825271, 1589571584, 'qwe', '2024-05-09 19:05:55'),
(30, 1357825271, 1589571584, 'qwe', '2024-05-09 19:05:55'),
(31, 1589571584, 1357825271, 'qwe', '2024-05-09 19:05:55'),
(32, 1357825271, 1589571584, '123', '2024-05-09 19:05:55'),
(33, 1589571584, 1357825271, '123', '2024-05-09 19:05:55'),
(34, 1357825271, 1589571584, '123', '2024-05-09 19:05:55'),
(35, 1589571584, 1357825271, '123', '2024-05-09 19:05:55'),
(36, 1589571584, 1357825271, '123', '2024-05-09 19:05:55'),
(37, 1357825271, 1589571584, '213', '2024-05-09 19:05:55'),
(38, 1589571584, 1357825271, '123', '2024-05-09 19:05:55'),
(39, 1357825271, 1589571584, '123', '2024-05-09 19:05:55'),
(40, 1357825271, 1589571584, 'qqqqqqqq', '2024-05-09 19:05:55'),
(41, 1357825271, 1589571584, 'qwe', '2024-05-09 19:05:55'),
(42, 1357825271, 1589571584, 'gegege ', '2024-05-09 19:05:55'),
(43, 1589571584, 1357825271, '123', '2024-05-09 19:05:55'),
(44, 1589571584, 1357825271, 'qwe', '2024-05-09 19:05:55'),
(45, 1357825271, 1589571584, 'qwqeqe', '2024-05-09 19:05:55'),
(46, 1589571584, 1357825271, 'qwe', '2024-05-09 19:05:55'),
(47, 1589571584, 1357825271, '12312313', '2024-05-09 19:05:55'),
(48, 1589571584, 1357825271, '123123', '2024-05-09 19:05:55'),
(49, 1589571584, 1357825271, '123', '2024-05-09 19:05:55'),
(50, 1589571584, 1357825271, 'qweqweqweqwe', '2024-05-09 19:05:55'),
(51, 1357825271, 1589571584, '123\r\n', '2024-05-09 19:37:00'),
(52, 1357825271, 1589571584, 'qwe', '2024-05-09 19:37:08'),
(53, 1357825271, 1589571584, 'poui', '2024-05-09 19:38:37'),
(54, 1589571584, 1357825271, '123\r\n', '2024-05-09 19:40:14'),
(55, 1357825271, 1357825271, 'qwe', '2024-05-10 15:50:41'),
(56, 1589571584, 1589571584, 'qwe', '2024-05-10 15:52:00'),
(57, 730027935, 1589571584, 'awdasdawd', '2024-05-11 06:12:58'),
(58, 1589571584, 1357825271, 'dawda\r\ndawdawda\r\ndadada\r\ndAd\r\naDAD\r\nADA\r\nD\r\nAD\r\nADAD\r\nADA\r\nDA\r\nD\r\nADADAD\r\nAA\r\nA\r\nDADW\r\nDA\r\nD\r\nASD\r\nAD\r\nAD\r\nAWA\r\nd', '2024-05-11 08:28:07'),
(59, 1589571584, 1357825271, 'dadaadwdasd\r\n\r\nADD\r\nAWAD\r\nWA\r\nWD\r\nAAWD\r\nAWD\r\nADW\r\nADW\r\nADW\r\nAWD\r\nADW\r\nAWD\r\nADW\r\nAWD\r\nAWD\r\nADW\r\nAW\r\nADW\r\nAD\r\nAWD\r\nADW\r\nAWD\r\n\r\nAWDAWDADW\r\ndawwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddwwwwwwwddddddddddddddwdwwdwdwdawdadadadadaddadadadada', '2024-05-11 08:28:42'),
(60, 1589571584, 1357825271, 'adadawdasddrithyiwu5hwiyhwyh39y20y2yh249hg28g2h0g2hg2h8g2hh8gh8g28hg28hg24h9g8h2gh82h82gh25g4h8254gh89254gh89254gh8924g5h89254gh8245gh8245h8452gh894g52h809g542h80924g5h8024g5h804g5h4g5h8904g5h894gh4g5h4g52h894g5h894gh84gh84gh8g4h89g42h4g5hg4h8g45h84g5h84g5h4g52h4g5h84g52h854gh8g45h8g54h45g2h845gh84g52h84g5h845h845g2h8094g52h4g52h0g45h8g452h4g52hg452h94g52h4g5hg45h94g52h9845g2h45g2h945g2h45g2h9845g2h4g52h45g2h98452gh9845g2h98452gh9845g29h845g2h89g54298h24g598h4g258h94g5289h4g52h984g589hg4528h9g548h945g28h94g52h9845g2h8942g598h4g528h954g2h894g52h845g2h8954g28h945g2h845g2h4g58h9g452h8945g2h8945g28h945g2h8945g2h8945g2h89g452h894g52h89452g8h945g28h9425gh89425g89h45g289h4g52hgerquhebrubieqvunieqrvniopvqermiqvwmiotbop[mebymopeynrmpohtrmiotrgwjig8jt349jt3j5t389jt34289jt349jt3t9ij3k90tj9g34j9gionegrqinoebrnioebtwnioberinoebfwino', '2024-05-11 08:29:21'),
(61, 1357825271, 1589571584, 'qwe', '2024-05-11 08:47:14'),
(62, 1357825271, 1589571584, 'qwe', '2024-05-11 08:52:43'),
(63, 1357825271, 1589571584, 'dsadasasd', '2024-05-11 08:52:46'),
(64, 1357825271, 1589571584, 'qweqwe', '2024-05-11 08:52:51'),
(65, 1589571584, 1357825271, 'qwe', '2024-05-11 15:59:13'),
(66, 1357825271, 1589571584, 'qweqwe', '2024-05-11 16:10:38'),
(67, 1357825271, 1589571584, '123123', '2024-05-11 16:10:43'),
(68, 1589571584, 1357825271, 'qweqweeq', '2024-05-11 16:11:06'),
(69, 1357825271, 1589571584, 'qwe', '2024-05-11 16:41:42'),
(70, 1589571584, 1357825271, '1231231', '2024-05-11 16:43:06'),
(71, 1357825271, 1589571584, 'awdadwdaad-4vytnvnnvv-my3588v81823nv5y8935ynv8285vy8ynv89yv89y38vy538vyn583y40v0y48vn06236y928vy438v6yn48v6y234v6n834y68v903486vy2n34y6nv923ny468v2n3846v2394n6v234y6v8n346v2346v08346v83246vn246v82346v8', '2024-05-11 16:51:37'),
(72, 1589571584, 1357825271, 'qwe', '2024-05-11 17:13:40'),
(73, 1357825271, 1589571584, '123', '2024-05-11 17:18:40'),
(74, 1589571584, 1357825271, 'qwe', '2024-05-11 17:22:14'),
(75, 1589571584, 1357825271, '123', '2024-05-11 17:22:19'),
(76, 1357825271, 1589571584, 'qweqwe', '2024-05-11 17:24:55'),
(77, 1589571584, 1357825271, 'kjyfkjydd\\]\r\n', '2024-05-11 17:50:27'),
(78, 1589571584, 1357825271, 'pakiss', '2024-05-11 18:00:59'),
(79, 1589571584, 1357825271, 'shesssh\r\n', '2024-05-11 18:05:33'),
(80, 1589571584, 1357825271, 'abc', '2024-05-14 08:39:08'),
(81, 1357825271, 1589571584, 'qwe', '2024-05-15 14:09:47'),
(82, 1474265465, 1357825271, 'How to enroll', '2024-05-16 07:39:52'),
(83, 1357825271, 1474265465, 'secret', '2024-05-16 07:40:14'),
(84, 1589571584, 1357825271, 'hi\r\n', '2024-06-01 15:57:42'),
(85, 1357825271, 1589571584, 'hello', '2024-06-01 15:59:04'),
(86, 1589571584, 1357825271, 'test', '2024-06-01 16:03:42'),
(87, 1357825271, 1589571584, 'nice one', '2024-06-01 16:03:52'),
(88, 1589571584, 1357825271, 'test', '2024-06-01 16:12:54'),
(89, 1357825271, 1589571584, '123 ', '2024-06-01 16:13:14'),
(90, 1589571584, 1357825271, 'hello po ', '2024-06-04 19:06:06'),
(91, 1589571584, 1357825271, 'heelo', '2024-06-05 13:20:44'),
(92, 1589571584, 1662732210, 'Test', '2024-06-07 02:56:40'),
(93, 1662732210, 1589571584, 'Test 123', '2024-06-07 02:57:08'),
(94, 1662732210, 1589571584, 'test', '2024-06-07 02:57:23'),
(95, 1357825271, 1589571584, 'Test', '2024-07-01 06:11:02'),
(96, 1589571584, 1357825271, 'Complaints \r\n', '2024-07-01 14:48:14'),
(97, 1589571584, 1357825271, 'Concern', '2024-07-01 14:48:18'),
(98, 1486934929, 1589571584, 'Hilu Gudmurneng', '2025-01-24 15:44:36'),
(99, 1589571584, 1486934929, 'Hilow', '2025-01-24 15:45:05'),
(100, 1133085945, 1589571584, 'Testing', '2025-02-08 14:55:03'),
(101, 1589571584, 1133085945, 'Test', '2025-02-08 15:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `bod_id` int(11) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`bod_id`, `roles`, `name`, `img`) VALUES
(1, 'President', 'John Doe', 'ble.png'),
(2, 'VicePresident', 'Rose Winters', '183726533_469980844255676_8094931697298234118_n.jpg'),
(3, 'Secretary', 'Jane Doe', 'wolXdead.jpg'),
(4, 'Treasurer', 'Jane  Doe', 'wolXdead.jpg'),
(5, 'Auditor', 'Jane  Doe', 'wolXdead.jpg'),
(6, 'PeaceInOrder', 'John  Doe', 'ble.png'),
(7, 'Director1', 'Rose  Winters', '183726533_469980844255676_8094931697298234118_n.jpg'),
(8, 'Director2 ', 'Paolo M Murillo', 'malupiton.png'),
(9, 'Director3', 'Mia  Winters', 'boss.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `otp_verifications`
--

CREATE TABLE `otp_verifications` (
  `otp_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_verifications`
--

INSERT INTO `otp_verifications` (`otp_id`, `email`, `otp`, `expiry`) VALUES
(1, 'vardump007@gmail.com', '593512', '2024-11-30 19:05:24'),
(12, 'wela@gmail.com', '329966', '2024-11-28 12:26:27'),
(16, 'tnjrdlcrz@gmail.com', '972352', '2024-11-28 16:12:28'),
(21, 'prnccrvnts@gmail.com', '544814', '2024-12-02 09:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `due_id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `month_due` decimal(10,2) NOT NULL,
  `water_bill` decimal(10,2) NOT NULL,
  `pending` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `overdue` date NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `proof` varchar(255) NOT NULL,
  `paydate` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `ref_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`due_id`, `unique_id`, `month_due`, `water_bill`, `pending`, `due_date`, `total`, `overdue`, `money`, `proof`, `paydate`, `status`, `ref_no`) VALUES
(6, '1357825271', 100.00, 100.00, 444.00, '2024-06-03', 67.00, '0000-00-00', 10.00, '664868852c1141.57617082_1_2_3_4.png', '2024-06-10', 'Good Standing', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `old_pending` decimal(10,2) NOT NULL,
  `new_pending` decimal(10,2) NOT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`id`, `unique_id`, `old_pending`, `new_pending`, `changed_at`) VALUES
(14, '1357825271', 3201.00, 3401.00, '2024-06-07 19:00:43'),
(15, '1357825271', 3401.00, 3601.00, '2024-06-07 19:00:53'),
(16, '1357825271', 3601.00, 3801.00, '2024-06-07 21:49:30'),
(17, '1357825271', 3801.00, 4001.00, '2024-06-07 21:52:25'),
(18, '1357825271', 4001.00, 4201.00, '2024-06-07 21:53:00'),
(19, '1357825271', 4201.00, 4401.00, '2024-06-07 21:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `access` varchar(255) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `naughty_list` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`user_id`, `unique_id`, `email`, `password`, `img`, `status`, `role`, `access`, `otp`, `naughty_list`) VALUES
(2, 1589571584, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'malupiton4.jpg', 'Active now', 'admin', 'Approved', 'Verified', 0),
(4, 1357825271, 'senpai@gmail.com', '1e5db03ce967cfef4e21ada16da09b06', '1715105349271713718_1999144396919159_608519389647854942_n.jpg', 'Offline now', 'user', 'Rejected', 'Verified', 0),
(19, 112466338, 'Prins@gmail.com', '0a9e0db6e95c394ee792ecbc6e510791', '1717745936pitikvermo.jpg', 'Offline now', 'user', 'Approved', '', 0),
(21, 1017731196, 'tnjrdlcr@gmail.com', '202cb962ac59075b964b07152d234b70', '1717937589pitikvermo.jpg', 'Offline now', 'user', 'Approved', 'Verified', 0),
(22, 1593518745, 'aawafawf@gmail.com', '2310553235ab181ae0c551c242988734', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Pending', '', 0),
(23, 1469021725, 'adadawda@gmail.com', '32db117b68ab7598389c18b68f721116', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Pending', '', 0),
(24, 1433443368, 'waeaewea@gmail.com', '458e5a124f7ed72d143d837a9a3bd76e', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Pending', '', 0),
(25, 1095492376, 'daadaaw@gmail.com', 'f2a85c6878e7978563609d089ee1173a', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Pending', '', 0),
(26, 911851766, 'aSbkghjgsghj@gmail.com', '4e3b9566b4b9abfd8f6671f7b4e423a7', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Pending', '', 0),
(27, 509858760, 'Tiklop@gmail.com', '9f4a66a0bac35d6f7f25b5fd931c7abe', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Pending', '', 0),
(28, 1581632830, 'wela@gmail.com', 'f9395f741e6f4da0f873c08008ed5760', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved', 'Verified', 0),
(29, 821155870, 'Renz@gmail.com', 'b55dc472db84256de67972b96657e7b9', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved', 'Verified', 0),
(30, 776313154, 'Pat@gmail.com', '532762fa5a5b7169aa4dd24717ba9df9', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved', 'Verified', 0),
(31, 1590469844, 'Pao@gmail.com', '1b6203e2e1b7e63e7b3677cdd932001f', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved', 'Verified', 0),
(32, 1308040957, 'John@gmail.com', '61409aa1fd47d4a5332de23cbf59a36f', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved', 'Verified', 0),
(33, 931588206, 'Jane@gmail.com', '2b95993380f8be6bd4bd46bf44f98db9', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved', 'Verified', 0),
(34, 662462528, 'Hev@gmail.com', '84f60ea382314109784cb42b9b4b8e42', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved', 'Verified', 0),
(35, 499733408, 'Ethan@gmail.com', 'e05699b45eae134804f4419d3fbb3139', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved', 'Verified', 0),
(36, 1434008263, 'Rose@gmail.com', '0df4dccc4aac3f6f36e00ef2a6a4bfac', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved', 'Verified', 0),
(37, 1195874011, 'Mia@gmail.com', '46e6f8781dd60e2635430b61db511262', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved', 'Verified', 0),
(38, 724357114, 'barangay@gmail.com', '1ee0fa80acf1af702cf55d07704548f6', 'Mabuhay_Logo.png', 'Offline now', 'barangay', 'Approved', 'Verified', 0),
(39, 916555761, 'vardump007@gmail.com', 'b2145aac704ce76dbe1ac7adac535b23', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved', 'Verified', 4),
(47, 939514278, 'vardump07@gmail.com', 'ceb232a461e38a2ed16aae9ab58671a8', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Pending', '', 0),
(48, 809272943, 'vardump0007@gmail.com', '202cb962ac59075b964b07152d234b70', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Pending', '', 0),
(50, 317446215, 'prnccrvnts@gmail.com', '9ea90f1142ff0bdf6b410d0a6b23aacb', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Pending', 'Verified', 0),
(73, 1133085945, 'tnjrdlcrz@gmail.com', 'c87a4d79950c2a243197daa635ed7e5f', 'default_Image.png', 'Offline now', 'user', 'Approved', 'Verified', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblresident`
--

CREATE TABLE `tblresident` (
  `user_id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `access` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `pwd_id` varchar(255) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `birthplace` varchar(150) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `block` int(11) NOT NULL,
  `lot` int(11) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `ec_name` varchar(255) NOT NULL,
  `ec_phone_num` bigint(20) NOT NULL,
  `ec_relship` varchar(255) NOT NULL,
  `ec_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblresident`
--

INSERT INTO `tblresident` (`user_id`, `unique_id`, `access`, `first_name`, `middle_name`, `last_name`, `suffix`, `sex`, `age`, `pwd`, `pwd_id`, `birthday`, `birthplace`, `citizenship`, `block`, `lot`, `street_name`, `phone_number`, `ec_name`, `ec_phone_num`, `ec_relship`, `ec_address`) VALUES
(3, '1589571584', 'Approved', 'Welacakes', 'Magsino', 'Cervantes', 'N/A', 'Female', 20, 'No', '', 'N/A', '', '', 3, 18, 'N/A', 9434763913, 'Prince Jefferson P. Cervantes', 9666676033, 'N/A', 'BLK 9 LOT 18 Ville de Palme Brgy. Santiago, General Trias, Cavite'),
(4, '1357825271', 'Rejected', 'Wela', 'Aguilar', 'Magsino', '', 'Male', 21, '', '', '', '', '', 3, 23, '', 9434763913, 'Arlenin', 24357345745, 'Secret', 'Blk 9 Lot 18 Anahaw St.'),
(19, '112466338', 'Approved', 'Prins', 'P', 'Cervs', '', 'Male', 23, '', '', '', '', '', 4, 3, '', 123, '', 0, '', ''),
(21, '1017731196', 'Approved', 'bago', 'bago', 'bago', '', 'Rather not say', 123, '', '', '', '', '', 1, 2, '', 123123, '', 0, '', ''),
(23, '1593518745', 'Pending', 'eae', 'eaeaea', 'eaeaawea', 'eaweae', 'male', 3, 'Yes', '', '2021-02-02', '', '', 2132, 131, 'aweaeaweaea', 1312131313131, '', 0, '', ''),
(24, '1469021725', 'Pending', 'adwdad', 'daddaddwd', 'adadadad', 'eawdadadasd', 'male', 5, 'Yes', '', '2019-02-18', '', '', 123, 123, 'dadadadad', 31231331, '', 0, '', ''),
(25, '1433443368', 'Pending', 'sakses', 'qew', 'qweqwe', 'qwe', 'female', 8, 'Yes', '', '2016-02-18', '', '', 213, 1231, 'wdadsdasd', 12131313, '', 0, '', ''),
(26, '1095492376', 'Pending', 'eaaeaaea', 'aaeaaea', 'aeaeaaea', 'awe', 'male', 12, 'No', '', '2012-02-25', '', '', 132, 132, 'aweaeaa', 131213312, '', 0, '', ''),
(27, '911851766', 'Pending', 'waedsdadadadwadadada', 'ddadadadada', 'dadadadadada', 'dadadaddada', 'male', 8, 'No', '', '2016-02-18', '', '', 123, 123, 'awdadadadasdada', 1231313123, '', 0, '', ''),
(28, '509858760', 'Pending', 'New ', 'Bagong', 'Account', 'Wala', 'male', 29, 'Yes', '', '1995-02-20', '', '', 1, 1, 'Test', 123123123, '', 0, '', ''),
(30, '1581632830', 'Approved', 'Wela', 'A', 'Magsino', 'N/A', 'female', 21, 'No', '', '2003-05-21', '', '', 9, 18, 'Mabolo', 9123412313, '', 0, '', ''),
(31, '821155870', 'Approved', 'Jhonrenz', '', 'Berbano', '', 'Male', 1, 'Yes', '', '2023-07-24', '', '', 1, 1, '', 2131231, '', 0, '', ''),
(32, '776313154', 'Approved', 'Patrick', 'B', 'Bayona', '', 'Male', 4, 'Yes', '', '2020-01-20', '', '', 2, 2, '', 12313133, '', 0, '', ''),
(33, '1590469844', 'Approved', 'Paolo', 'M', 'Murillo', '', 'Male', 21, 'Yes', '', '2003-01-11', '', '', 3, 3, '', 123123123, '', 0, '', ''),
(34, '1308040957', 'Approved', 'John', '', 'Doe', '', 'Male', 1, 'No', '', '2023-06-14', '', '', 4, 4, '', 1231231231, '', 0, '', ''),
(35, '931588206', 'Approved', 'Jane', '', 'Doe', '', 'Female', 3, 'Yes', '', '2021-08-20', '', '', 5, 5, '', 112312313, '', 0, '', ''),
(36, '662462528', 'Approved', 'Hev', '', 'Alvin', '', 'Male', 4, 'No', '', '2020-02-24', '', '', 6, 6, '', 1231312313, '', 0, '', ''),
(37, '499733408', 'Approved', 'Ethan', '', 'Winters', '', 'Male', 7, 'Yes', '', '2017-02-24', '', '', 1, 1, '', 131132123, '', 0, '', ''),
(38, '1434008263', 'Approved', 'Rose', '', 'Winters', '', 'Female', 3, 'No', '', '2021-02-25', '', '', 2, 2, '', 123123123, '', 0, '', ''),
(39, '1195874011', 'Approved', 'Mia', '', 'Winters', '', 'Female', 5, 'Yes', '', '2019-03-01', '', '', 6, 6, 'Mold', 312313132313, '', 0, '', ''),
(40, '724357114', 'Approved', 'N/A', 'N/A', 'N/A', 'N/A', 'Preferred not to say', 1, 'No', '', '2023-11-18', '', '', 0, 0, 'N/A', 0, '', 0, '', ''),
(41, '916555761', 'Approved', 'Tanjiro', '', 'Dela Cruz', '', 'Male', 32, 'No', '', '1992-05-20', '', '', 78, 10, '', 909090909, '', 0, '', ''),
(49, '939514278', 'Pending', '1', '1', '1', '', 'Male', 34, 'No', '', '1990-03-14', '', '', 1, 1, '', 132312313131313, '', 0, '', ''),
(50, '809272943', 'Pending', '1', '1', '1', '', 'Male', 26, 'No', '', '1998-02-10', '', '', 1, 1, '', 12331123123123121, '', 0, '', ''),
(52, '317446215', 'Pending', 'Prince', '1', '1', '1', 'Male', 43, 'No', '', '1981-11-25', '', '', 1232, 1, '', 111311, '', 0, '', ''),
(75, '1133085945', 'Approved', 'Prince', '', 'Cervantes', '', 'Male', 42, 'No', 'N/A', '1982-07-01', '', '', 1, 20, '', 12411511115, '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sessions`
--

CREATE TABLE `tbl_sessions` (
  `session_id` varchar(255) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `device_ip` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sessions`
--

INSERT INTO `tbl_sessions` (`session_id`, `unique_id`, `last_activity`, `device_ip`, `status`) VALUES
('08f91hjpc2ulfaeo0g57v88s0j', 1589571584, '2024-12-22 12:23:18', '::1', 'inactive'),
('1nde3b4afhrmb70ps0j21gg492', 1589571584, '2024-11-30 05:09:06', '::1', 'inactive'),
('49q5r4vdqbvm72gh5meb29tpsg', 1581632830, '2024-12-01 06:08:34', '::1', 'inactive'),
('56htq7vh3dcstor8pubar342gh', 1581632830, '2024-11-25 07:55:33', '::1', 'inactive'),
('6ah1jt2t6mt8s732i5qkv2tgru', 1133085945, '2025-02-08 08:53:22', '::1', 'inactive'),
('77u9luim9024hbt0k2k0oigjci', 1581632830, '2024-11-27 21:28:46', '::1', 'inactive'),
('806gfh10fgskgvdcr4bm69855o', 1589571584, '2024-11-26 02:26:15', '::1', 'inactive'),
('aednmgjgvt25veqqc3sjfdkvn6', 1589571584, '2025-01-24 13:58:58', '::1', 'inactive'),
('avdlcnc21i5846mk7jg0dhpuoq', 724357114, '2024-11-26 20:12:26', '::1', 'inactive'),
('cvgvrrj20ab5uoa9u84i2cgv4f', 1589571584, '2024-12-10 05:31:13', '::1', 'inactive'),
('d6b5nvbh55qrvt2rdb6iiuf0ec', 1581632830, '2025-02-01 11:21:41', '::1', 'inactive'),
('dckfggtj6q9qoothuat1pd9qce', 1589571584, '2024-12-23 09:47:50', '::1', 'inactive'),
('e35bng9v3gnt04ndngrer6g8ec', 1589571584, '2024-11-27 22:08:25', '::1', 'inactive'),
('e7c9deh2ro5nc0gqg525i24tkl', 1589571584, '2025-02-09 11:23:26', '::1', 'active'),
('fo1sqp561i2qu33pod063bt7tu', 1589571584, '2025-01-13 19:42:55', '::1', 'inactive'),
('fptp5hdvi6om2gjmjm2oju6af9', 1589571584, '2024-11-28 21:52:55', '::1', 'inactive'),
('hd8hrbllvtejbd453pdvqtd52q', 1589571584, '2024-12-09 16:53:26', '::1', 'inactive'),
('icj7dmhl3g0haj32bh1qk08cb3', 1589571584, '2024-11-29 12:09:35', '::1', 'inactive'),
('jrsdp4em90angoisbm694npi0b', 1581632830, '2024-11-25 07:57:10', '::1', 'inactive'),
('k0l000115t4gtiqapaqh3l90h2', 1589571584, '2025-02-01 08:18:17', '::1', 'inactive'),
('ka47tdf26ea1r3edk7uf3sqcfk', 1133085945, '2025-02-09 11:17:18', '::1', 'inactive'),
('mdcoqvn1bs9ootgfvrsh09ph95', 1589571584, '2025-02-08 07:33:43', '::1', 'inactive'),
('oniu1v844a1a2cgbjoul7sp34k', 1581632830, '2024-12-08 05:35:22', '::1', 'inactive'),
('p3g5la4sf4q1j2hdl7q8s92b6o', 1581632830, '2024-12-22 11:29:52', '::1', 'inactive'),
('q4bra76vjgujp2lnu7fk4ttc7l', 1589571584, '2025-01-10 17:16:10', '::1', 'inactive'),
('r70l72u2lce0sipvnk6b7kspr5', 1581632830, '2024-12-01 23:19:23', '::1', 'inactive'),
('sf6v5ha52s75s9fhpi6i5aus6b', 1589571584, '2024-12-22 12:16:20', '::1', 'inactive'),
('smrpil2bg3udr2muskhqplc659', 1581632830, '2024-11-29 12:07:56', '::1', 'inactive'),
('u8ts71fn1jb160mq0m719bjbba', 1589571584, '2024-11-26 15:42:33', '::1', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `user_votes`
--

CREATE TABLE `user_votes` (
  `vote_id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `candidate` varchar(255) NOT NULL,
  `votes` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `won_date` varchar(20) NOT NULL,
  `fail_date` varchar(20) NOT NULL,
  `access` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_votes`
--

INSERT INTO `user_votes` (`vote_id`, `unique_id`, `candidate`, `votes`, `status`, `won_date`, `fail_date`, `access`) VALUES
(74, 776313154, 'Patrick B Bayona', 1, 'Winner', '2025-01-24 23:50:05', '2024-11-28 08:20:02', 'Declared'),
(75, 1590469844, 'Paolo M Murillo', 2, 'Winner', '2024-11-28 08:20:02', '', 'Declared'),
(76, 821155870, 'Jhonrenz  Berbano', 2, 'Winner', '2024-11-28 08:20:02', '', 'Declared'),
(77, 1308040957, 'John  Doe', 2, 'Winner', '2024-11-28 08:20:02', '', 'Declared'),
(78, 931588206, 'Jane  Doe', 2, 'Winner', '2024-11-28 08:20:02', '', 'Declared'),
(79, 916555761, 'Tanjiro  Dela Cruz', 3, 'Winner', '2024-11-28 08:20:02', '', 'Declared'),
(81, 499733408, 'Ethan  Winters', 3, 'Winner', '2024-11-28 08:20:02', '', 'Declared'),
(82, 1434008263, 'Rose  Winters', 3, 'Winner', '2024-11-28 08:20:02', '', 'Declared'),
(83, 1195874011, 'Mia  Winters', 3, 'Winner', '2024-11-28 08:20:02', '', 'Declared'),
(84, 821155870, 'Jhonrenz  Berbano', 1, 'Winner', '2025-01-24 23:50:05', '', 'Declared'),
(85, 1308040957, 'John  Doe', 1, 'Winner', '2025-01-24 23:50:05', '', 'Declared'),
(86, 931588206, 'Jane  Doe', 1, 'Winner', '2025-01-24 23:50:05', '', 'Declared'),
(87, 776313154, 'Patrick B Bayona', 1, 'Winner', '2025-01-24 23:50:05', '', 'Declared'),
(88, 1590469844, 'Paolo M Murillo', 1, 'Winner', '2025-01-24 23:50:05', '', 'Declared'),
(90, 499733408, 'Ethan  Winters', 1, 'Winner', '2025-01-24 23:50:05', '', 'Declared'),
(91, 1434008263, 'Rose  Winters', 1, 'Winner', '2025-01-24 23:50:05', '', 'Declared'),
(92, 1195874011, 'Mia  Winters', 1, 'Winner', '2025-01-24 23:50:05', '', 'Declared'),
(93, 662462528, 'Hev  Alvin', 1, 'Winner', '2025-01-24 23:50:05', '', 'Declared'),
(94, 1486934929, 'Prince  Cervantes', 0, 'Failure', '', '2025-01-24 23:50:05', 'Declared'),
(95, 821155870, 'Jhonrenz  Berbano', 0, 'Winner', '2025-02-01 20:24:02', '2025-02-01 19:31:03', 'Declared'),
(96, 1308040957, 'John  Doe', 0, 'Winner', '2025-02-01 19:31:03', '', 'Declared'),
(97, 662462528, 'Hev  Alvin', 0, 'Winner', '2025-02-01 19:31:03', '', 'Declared'),
(98, 499733408, 'Ethan  Winters', 0, 'Winner', '2025-02-01 19:31:03', '', 'Declared'),
(100, 1195874011, 'Mia  Winters', 0, 'Winner', '2025-02-01 19:31:03', '', 'Declared'),
(101, 1434008263, 'Rose  Winters', 0, 'Winner', '2025-02-01 19:31:03', '', 'Declared'),
(102, 1590469844, 'Paolo M Murillo', 0, 'Winner', '2025-02-01 19:31:03', '', 'Declared'),
(103, 776313154, 'Patrick B Bayona', 0, 'Winner', '2025-02-01 19:31:03', '', 'Declared'),
(104, 1133085945, 'Prince  Cervantes', 0, 'Winner', '2025-02-01 20:24:02', '2025-02-01 19:31:03', 'Declared'),
(105, 931588206, 'Jane  Doe', 0, 'Winner', '2025-02-01 19:31:03', '', 'Declared'),
(106, 499733408, 'Ethan  Winters', 0, 'Winner', '2025-02-01 20:44:01', '2025-02-01 20:24:02', 'Declared'),
(107, 1434008263, 'Rose  Winters', 0, 'Winner', '2025-02-01 20:24:02', '', 'Declared'),
(108, 1195874011, 'Mia  Winters', 0, 'Winner', '2025-02-01 20:24:02', '', 'Declared'),
(109, 1133085945, 'Prince  Cervantes', 0, 'Winner', '2025-02-01 20:24:02', '', 'Declared'),
(110, 1590469844, 'Paolo M Murillo', 0, 'Winner', '2025-02-01 20:24:02', '', 'Declared'),
(111, 776313154, 'Patrick B Bayona', 0, 'Winner', '2025-02-01 20:24:02', '', 'Declared'),
(112, 1308040957, 'John  Doe', 0, 'Winner', '2025-02-01 20:24:02', '', 'Declared'),
(113, 931588206, 'Jane  Doe', 0, 'Winner', '2025-02-01 20:24:02', '', 'Declared'),
(114, 662462528, 'Hev  Alvin', 0, 'Winner', '2025-02-01 20:24:02', '', 'Declared'),
(116, 821155870, 'Jhonrenz  Berbano', 0, 'Winner', '2025-02-01 20:24:02', '', 'Declared'),
(208, 821155870, 'Jhonrenz  Berbano', 1, 'Winner', '2025-02-08 17:03:25', '', 'Declared'),
(209, 1308040957, 'John  Doe', 1, 'Winner', '2025-02-08 17:03:25', '', 'Declared'),
(210, 931588206, 'Jane  Doe', 1, 'Winner', '2025-02-08 17:03:25', '', 'Declared'),
(211, 776313154, 'Patrick B Bayona', 1, 'Winner', '2025-02-08 17:03:25', '', 'Declared'),
(212, 1590469844, 'Paolo M Murillo', 1, 'Winner', '2025-02-08 17:03:25', '', 'Declared'),
(213, 1133085945, 'Prince  Cervantes', 0, 'Failure', '', '2025-02-08 17:03:25', 'Declared'),
(214, 499733408, 'Ethan  Winters', 1, 'Winner', '2025-02-08 17:03:25', '', 'Declared'),
(215, 1434008263, 'Rose  Winters', 1, 'Winner', '2025-02-08 17:03:25', '', 'Declared'),
(216, 1195874011, 'Mia  Winters', 1, 'Winner', '2025-02-08 17:03:25', '', 'Declared'),
(217, 662462528, 'Hev  Alvin', 1, 'Winner', '2025-02-08 17:03:25', '', 'Declared');

-- --------------------------------------------------------

--
-- Table structure for table `verified_email`
--

CREATE TABLE `verified_email` (
  `email_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verified_email`
--

INSERT INTO `verified_email` (`email_id`, `email`, `status`) VALUES
(1, 'prnccrvnts@gmail.com', 'Verified'),
(2, 'prnccrvnts@gmail.com', 'Verified'),
(3, 'prnccrvnts@gmail.com', 'Verified'),
(4, 'prnccrvnts@gmail.com', 'Verified'),
(5, 'prnccrvnts@gmail.com', 'Verified'),
(6, 'prnccrvnts@gmail.com', 'Verified'),
(7, 'prnccrvnts@gmail.com', 'Verified'),
(8, 'prnccrvnts@gmail.com', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `vote_id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `position` varchar(20) NOT NULL,
  `votes` int(11) NOT NULL,
  `add_date` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `won_date` varchar(20) NOT NULL,
  `fail_date` varchar(20) NOT NULL,
  `access` varchar(20) NOT NULL,
  `status2` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`vote_id`, `unique_id`, `candidate_name`, `img`, `position`, `votes`, `add_date`, `status`, `won_date`, `fail_date`, `access`, `status2`) VALUES
(95, 776313154, 'Patrick B Bayona', 'meow.jpg', 'Secretary', 0, '2024-11-28 07:15:38', 'Winner', '2025-01-24 23:50:05', '2024-11-28 08:20:02', 'Declared', ''),
(96, 1590469844, 'Paolo M Murillo', 'default_Image.png', 'Halimaw Ma inlove', 0, '2024-11-28 07:15:40', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(97, 821155870, 'Jhonrenz  Berbano', 'default_Image.png', 'Peace in Order', 0, '2024-11-28 07:15:54', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(98, 1308040957, 'John  Doe', 'Mabuhay_Logo.png', 'Secretary', 0, '2024-11-28 07:15:56', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(99, 931588206, 'Jane  Doe', 'Mabuhay_Logo.png', '', 0, '2024-11-28 07:15:58', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(100, 916555761, 'Tanjiro  Dela Cruz', 'Mabuhay_Logo.png', '', 0, '2024-11-28 07:16:00', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(102, 499733408, 'Ethan  Winters', 'Mabuhay_Logo.png', '', 0, '2024-11-28 07:16:36', 'Winner', '2024-11-28 08:20:02', '2025-02-01 20:24:02', 'Declared', ''),
(103, 1434008263, 'Rose  Winters', 'Mabuhay_Logo.png', '', 0, '2024-11-28 07:16:37', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(104, 1195874011, 'Mia  Winters', 'Logo-ni-bebecakes.png', 'Secretary', 0, '2024-11-28 07:16:39', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(105, 821155870, 'Jhonrenz  Berbano', 'default_Image.png', 'Peace in Order', 0, '2025-01-24 23:46:31', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(106, 1308040957, 'John  Doe', 'Mabuhay_Logo.png', 'Secretary', 0, '2025-01-24 23:46:34', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(107, 931588206, 'Jane  Doe', 'Mabuhay_Logo.png', '', 0, '2025-01-24 23:46:36', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(108, 776313154, 'Patrick B Bayona', 'meow.jpg', 'Secretary', 0, '2025-01-24 23:46:41', 'Winner', '2025-01-24 23:50:05', '', 'Declared', ''),
(109, 1590469844, 'Paolo M Murillo', 'Mabuhay_Logo.png', '', 0, '2025-01-24 23:46:44', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(111, 499733408, 'Ethan  Winters', 'Mabuhay_Logo.png', '', 0, '2025-01-24 23:46:55', 'Winner', '2024-11-28 08:20:02', '2025-02-01 20:24:02', 'Declared', ''),
(112, 1434008263, 'Rose  Winters', 'Mabuhay_Logo.png', '', 0, '2025-01-24 23:46:57', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(113, 1195874011, 'Mia  Winters', 'Logo-ni-bebecakes.png', 'Secretary', 0, '2025-01-24 23:46:58', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(114, 662462528, 'Hev  Alvin', 'Mabuhay_Logo.png', '', 0, '2025-01-24 23:47:16', 'Failure', '2025-01-24 23:50:05', '2025-02-01 21:35:01', 'Declared', ''),
(115, 1486934929, 'Prince  Cervantes', 'default_Image.png', '', 0, '2025-01-24 23:47:43', 'Failure', '', '2025-01-24 23:50:05', 'Declared', ''),
(116, 821155870, 'Jhonrenz  Berbano', 'default_Image.png', 'Peace in Order', 0, '2025-02-01 19:27:41', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(117, 1308040957, 'John  Doe', 'Mabuhay_Logo.png', 'Secretary', 0, '2025-02-01 19:27:43', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(118, 662462528, 'Hev  Alvin', 'Mabuhay_Logo.png', '', 0, '2025-02-01 19:27:46', 'Failure', '2025-01-24 23:50:05', '2025-02-01 21:35:01', 'Declared', ''),
(119, 499733408, 'Ethan  Winters', 'Mabuhay_Logo.png', '', 0, '2025-02-01 19:27:47', 'Winner', '2024-11-28 08:20:02', '2025-02-01 20:24:02', 'Declared', ''),
(121, 1195874011, 'Mia  Winters', 'Logo-ni-bebecakes.png', 'Secretary', 0, '2025-02-01 19:28:03', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(122, 1434008263, 'Rose  Winters', 'Mabuhay_Logo.png', '', 0, '2025-02-01 19:28:05', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(123, 1590469844, 'Paolo M Murillo', 'Mabuhay_Logo.png', '', 0, '2025-02-01 19:28:17', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(124, 776313154, 'Patrick B Bayona', 'Mabuhay_Logo.png', '', 0, '2025-02-01 19:28:19', 'Winner', '2025-01-24 23:50:05', '', 'Declared', ''),
(125, 1133085945, 'Prince  Cervantes', 'default_Image.png', 'President', 0, '2025-02-01 19:28:26', 'Winner', '2025-02-01 21:35:01', '2025-02-01 19:31:03', 'Declared', ''),
(126, 931588206, 'Jane  Doe', 'Mabuhay_Logo.png', '', 0, '2025-02-01 19:28:36', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(127, 499733408, 'Ethan  Winters', 'Mabuhay_Logo.png', '', 0, '2025-02-01 20:21:37', 'Winner', '2024-11-28 08:20:02', '2025-02-01 20:24:02', 'Declared', ''),
(128, 1434008263, 'Rose  Winters', 'Mabuhay_Logo.png', '', 0, '2025-02-01 20:21:38', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(129, 1195874011, 'Mia  Winters', 'Logo-ni-bebecakes.png', 'Secretary', 0, '2025-02-01 20:21:40', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(130, 1133085945, 'Prince  Cervantes', 'default_Image.png', 'President', 0, '2025-02-01 20:22:11', 'Winner', '2025-02-01 21:35:01', '2025-02-01 21:10:01', 'Declared', ''),
(131, 1590469844, 'Paolo M Murillo', 'Mabuhay_Logo.png', '', 0, '2025-02-01 20:22:13', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(132, 776313154, 'Patrick B Bayona', 'Mabuhay_Logo.png', '', 0, '2025-02-01 20:22:14', 'Winner', '2025-01-24 23:50:05', '', 'Declared', ''),
(133, 1308040957, 'John  Doe', 'Mabuhay_Logo.png', 'Secretary', 0, '2025-02-01 20:22:21', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(134, 931588206, 'Jane  Doe', 'Mabuhay_Logo.png', '', 0, '2025-02-01 20:22:23', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(135, 662462528, 'Hev  Alvin', 'Mabuhay_Logo.png', '', 0, '2025-02-01 20:22:31', 'Failure', '2025-01-24 23:50:05', '2025-02-01 21:35:01', 'Declared', ''),
(137, 821155870, 'Jhonrenz  Berbano', 'default_Image.png', 'Peace in Order', 0, '2025-02-01 20:23:05', 'Winner', '2024-11-28 08:20:02', '', 'Declared', ''),
(229, 821155870, 'Jhonrenz  Berbano', 'default_Image.png', 'Peace in Order', 1, '2025-02-08 16:51:29', 'Winner', '2025-02-08 17:03:25', '', 'Declared', ''),
(230, 1308040957, 'John  Doe', 'Mabuhay_Logo.png', 'Secretary', 1, '2025-02-08 16:51:31', 'Winner', '2025-02-08 17:03:25', '', 'Declared', ''),
(231, 931588206, 'Jane  Doe', 'Mabuhay_Logo.png', '', 1, '2025-02-08 16:51:33', 'Winner', '2025-02-08 17:03:25', '', 'Declared', ''),
(232, 776313154, 'Patrick B Bayona', 'Mabuhay_Logo.png', '', 1, '2025-02-08 16:52:25', 'Winner', '2025-02-08 17:03:25', '', 'Declared', ''),
(233, 1590469844, 'Paolo M Murillo', 'Mabuhay_Logo.png', '', 1, '2025-02-08 16:52:27', 'Winner', '2025-02-08 17:03:25', '', 'Declared', ''),
(234, 1133085945, 'Prince  Cervantes', 'default_Image.png', '', 0, '2025-02-08 16:52:29', 'Failure', '', '2025-02-08 17:03:25', 'Declared', ''),
(235, 499733408, 'Ethan  Winters', 'Mabuhay_Logo.png', '', 1, '2025-02-08 16:52:36', 'Winner', '2025-02-08 17:03:25', '', 'Declared', ''),
(236, 1434008263, 'Rose  Winters', 'Mabuhay_Logo.png', '', 1, '2025-02-08 16:52:37', 'Winner', '2025-02-08 17:03:25', '', 'Declared', ''),
(237, 1195874011, 'Mia  Winters', 'Mabuhay_Logo.png', '', 1, '2025-02-08 16:52:39', 'Winner', '2025-02-08 17:03:25', '', 'Declared', ''),
(238, 662462528, 'Hev  Alvin', 'Mabuhay_Logo.png', '', 1, '2025-02-08 16:52:43', 'Winner', '2025-02-08 17:03:25', '', 'Declared', '');

-- --------------------------------------------------------

--
-- Table structure for table `voting_countdown`
--

CREATE TABLE `voting_countdown` (
  `countdown_id` int(11) NOT NULL,
  `start_id` int(11) NOT NULL,
  `start_time` varchar(20) NOT NULL,
  `end_id` int(11) NOT NULL,
  `end_time` datetime NOT NULL,
  `voting_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting_countdown`
--

INSERT INTO `voting_countdown` (`countdown_id`, `start_id`, `start_time`, `end_id`, `end_time`, `voting_status`) VALUES
(2, 0, '2024-09-08 10:00:00', 0, '2024-09-08 18:00:00', 'VotingEnded'),
(120, 8712, '2024-11-28 08:19:22', 8712, '2024-11-28 08:20:00', 'VotingEnded'),
(123, 6891, '2025-01-24 23:48:48', 6891, '2025-01-24 23:50:00', 'VotingEnded'),
(124, 7026, '2025-02-01 19:29:10', 7026, '2025-02-01 19:31:00', 'VotingEnded'),
(125, 4102, '2025-02-01 20:23:13', 4102, '2025-02-01 20:24:00', 'VotingEnded'),
(126, 7149, '2025-02-01 20:43:45', 7149, '2025-02-01 20:44:00', 'VotingEnded'),
(127, 9908, '2025-02-01 21:09:17', 9908, '2025-02-01 21:10:00', 'VotingEnded'),
(128, 5315, '2025-02-01 21:19:35', 5315, '2025-02-01 21:20:00', 'VotingEnded'),
(129, 1258, '2025-02-01 21:34:34', 1258, '2025-02-01 21:35:00', 'VotingEnded'),
(130, 5086, '2025-02-01 21:49:21', 5086, '2025-02-01 21:50:00', 'VotingEnded'),
(131, 4576, '2025-02-01 23:12:54', 4576, '2025-02-01 23:13:00', 'VotingEnded'),
(132, 5058, '2025-02-02 01:17:45', 5058, '2025-02-02 01:18:00', 'VotingEnded'),
(133, 9966, '2025-02-02 01:21:28', 9966, '2025-02-02 01:24:00', 'VotingEnded'),
(134, 6745, '2025-02-02 02:36:49', 6745, '2025-02-02 02:37:00', 'VotingEnded'),
(135, 9535, '2025-02-08 16:59:35', 9535, '2025-02-08 17:03:00', 'VotingEnded');

-- --------------------------------------------------------

--
-- Table structure for table `voting_history`
--

CREATE TABLE `voting_history` (
  `vote_id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `candidate1` int(11) NOT NULL,
  `candidate2` int(11) NOT NULL,
  `candidate3` int(11) NOT NULL,
  `candidate4` int(11) NOT NULL,
  `candidate5` int(11) NOT NULL,
  `candidate6` int(11) NOT NULL,
  `candidate7` int(11) NOT NULL,
  `candidate8` int(11) NOT NULL,
  `candidate9` int(11) NOT NULL,
  `vote_status` varchar(20) NOT NULL,
  `vote_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting_history`
--

INSERT INTO `voting_history` (`vote_id`, `unique_id`, `candidate1`, `candidate2`, `candidate3`, `candidate4`, `candidate5`, `candidate6`, `candidate7`, `candidate8`, `candidate9`, `vote_status`, `vote_date`) VALUES
(57, 1581632830, 1195874011, 1434008263, 499733408, 916555761, 0, 0, 0, 0, 0, 'UnderVote', '2024-11-28 07:56:19'),
(58, 776313154, 1195874011, 1434008263, 499733408, 1581632830, 821155870, 1308040957, 931588206, 916555761, 1590469844, 'Voted', '2024-11-28 07:56:46'),
(59, 1486934929, 662462528, 1195874011, 1434008263, 499733408, 1308040957, 931588206, 1590469844, 821155870, 776313154, 'Voted', '2025-01-24 23:49:36'),
(60, 1581632830, 776313154, 1590469844, 1195874011, 931588206, 1133085945, 662462528, 499733408, 1434008263, 821155870, 'Voted', '2025-02-02 01:21:43'),
(61, 1133085945, 662462528, 1195874011, 1434008263, 1308040957, 931588206, 499733408, 776313154, 1590469844, 821155870, 'Voted', '2025-02-08 16:59:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`forms_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`bod_id`);

--
-- Indexes for table `otp_verifications`
--
ALTER TABLE `otp_verifications`
  ADD PRIMARY KEY (`otp_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`due_id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tblresident`
--
ALTER TABLE `tblresident`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_sessions`
--
ALTER TABLE `tbl_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `user_votes`
--
ALTER TABLE `user_votes`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indexes for table `verified_email`
--
ALTER TABLE `verified_email`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indexes for table `voting_countdown`
--
ALTER TABLE `voting_countdown`
  ADD PRIMARY KEY (`countdown_id`);

--
-- Indexes for table `voting_history`
--
ALTER TABLE `voting_history`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `forms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `bod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `otp_verifications`
--
ALTER TABLE `otp_verifications`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `due_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tblresident`
--
ALTER TABLE `tblresident`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `user_votes`
--
ALTER TABLE `user_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `verified_email`
--
ALTER TABLE `verified_email`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `voting_countdown`
--
ALTER TABLE `voting_countdown`
  MODIFY `countdown_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `voting_history`
--
ALTER TABLE `voting_history`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
