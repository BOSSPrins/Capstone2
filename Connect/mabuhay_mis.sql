-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 12:00 AM
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
  `context` text NOT NULL,
  `start_date` date NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_date` date NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`news_id`, `title`, `context`, `start_date`, `start_time`, `end_date`, `end_time`, `img`) VALUES
(16, 'kalaguyowwa', 'whgrszbfxv ', '2024-05-19', '02:48', '2024-05-19', '02:48', ''),
(19, 'GWRVFS', 'gwevrSD', '2024-05-19', '02:49', '2024-05-19', '02:49', 'pusi.jpg'),
(21, 'ETO', 'tqgsbf', '2024-05-19', '03:23', '2024-05-19', '03:23', ''),
(22, 'kakakakakak', 'qweq', '2024-05-22', '18:52', '2024-05-23', '17:52', ''),
(24, '1', '1', '2024-05-22', '22:14', '2024-05-23', '20:14', 'arle.png,bike.jpg'),
(25, 'kimera', 'antsss', '2024-05-22', '17:15', '2024-05-22', '19:15', 'Eternity.jpg,ella.png,arle.png'),
(26, 'qwez', 'qwea', '2024-05-22', '19:20', '2024-05-22', '20:20', 'arle.png,bike.jpg'),
(27, 'qwdasfx', 'erfWADc', '2024-05-22', '20:32', '2024-05-22', '21:32', 'arle.png,bike.jpg'),
(28, 'nice', 'nice', '2024-05-22', '01:48', '2024-05-22', '00:48', 'arle.png,bike.jpg'),
(29, 'qweads', 'wqweasd', '2024-05-22', '00:52', '2024-05-22', '03:52', 'arle.png,arle.png'),
(30, 'gggg', 'ggggg', '2024-05-23', '00:16', '2024-05-23', '02:16', ''),
(31, 'ETO DIN ', 'wdadawa', '2024-05-23', '04:23', '2024-05-24', '02:23', 'ella.png,ella.png'),
(34, 'mimanahal', 'ikaw lang \r\n', '2024-05-23', '04:33', '2024-05-25', '03:33', ''),
(37, 'EETO NA', 'ufvuyfkuvghb', '2024-05-23', '08:38', '2024-05-23', '07:38', 'Calcu.png,arle.png,arle.png,Calcu.png'),
(39, 'testingi', 'tye', '2024-05-23', '16:16', '2024-05-24', '16:16', ''),
(40, 'BAGO TO ', 'kiss mo ko ', '2024-06-02', '02:05', '2024-06-03', '04:05', 'vermo1.jpg,vermo2.jpg,pusi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `complaint_number` int(11) NOT NULL,
  `complainee` varchar(50) NOT NULL,
  `complaint` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `proof` varchar(255) NOT NULL,
  `filed_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `complaineeAddress` varchar(20) NOT NULL,
  `complainantUID` int(11) NOT NULL,
  `complainantName` varchar(255) NOT NULL,
  `complainantAddress` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `processed_date` varchar(50) NOT NULL,
  `Remark1` varchar(255) NOT NULL,
  `RemarkBy1` varchar(20) NOT NULL,
  `status1` varchar(20) NOT NULL,
  `RemarkDate1` varchar(50) NOT NULL,
  `Remark2` varchar(255) NOT NULL,
  `RemarkBy2` varchar(20) NOT NULL,
  `status2` varchar(20) NOT NULL,
  `RemarkDate2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `complaint_number`, `complainee`, `complaint`, `description`, `proof`, `filed_date`, `complaineeAddress`, `complainantUID`, `complainantName`, `complainantAddress`, `status`, `processed_date`, `Remark1`, `RemarkBy1`, `status1`, `RemarkDate1`, `Remark2`, `RemarkBy2`, `status2`, `RemarkDate2`) VALUES
(1, 0, 'Mooda', 'Blocking the Driveway', 'Laging nakaharang yung kotse nya sa gate ko', 'bossing.jpg', '2024-09-19 12:07:15', 'Blk 54 Lot 1', 0, 'Mark', 'Blk 78 Lot 10', 'Escalated', '', '', 'admin', 'In-Process', '2024-11-10 23:00:38', 'Turn over to barangay', 'admin', 'Escalated', '2024-11-10 23:12:40'),
(2, 0, 'Raul', 'Blocking the Driveway', 'Yung tricycle nya dinikit sa kotse ko', 'bossing.jpg', '2024-09-19 12:07:35', 'Blk 3 Lot 6', 0, 'Sgup', 'Blk 100 Lot 6', 'Escalated', '', 'Processing na po', 'admin', 'In-Process', '2024-11-10 22:52:21', 'This Complaint will be turn over to the barangay', 'admin', 'Escalated', '2024-11-10 22:54:21'),
(3, 0, 'Nigs', 'Pet Issues', 'Aso nya laging galit', 'awtlas.png', '2024-11-08 19:34:38', 'Blk 54 Lot 1', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Resolved', '', 'Change to in process', 'admin', 'In-Process', '2024-11-10 02:39:52', 'Resolved na', 'admin', 'Resolved', '2024-11-10 21:42:27'),
(4, 0, 'Pat Anoyab', 'Noise Complaint', 'Ingay nila mag asawa', 'boss.jpg', '2024-11-10 14:57:37', 'Blk 123 Lot 56', 821155870, 'Jhonrenz Berbano', 'Blk 1 Lot 1', 'Resolved', '2024-11-11 21:59:35', 'Done na po', 'admin', 'Resolved', '2024-11-11 22:21:17', '', '', '', ''),
(5, 0, '', 'Property Maintenance', 'Yung bintana nya sa third floor tumusok sa bubong ko', 'malupiton.png', '2024-11-11 14:30:11', 'Blk 9 Lot 6', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Escalated', '2024-11-11 22:31:57', 'Turn over na po sa barangay di na namin kaya', 'admin', 'Escalated', '2024-11-11 22:32:16', '', '', '', ''),
(6, 1142799674, '', 'Noise Complaint', 'Ingay ng aso nila kahit madaling araw nagwawala', 'meow.jpg', '2024-11-12 15:34:45', 'Blk 60 Lot 60', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'Resolved', '2024-11-13 00:00:52', 'Okay na po tinapon na namin yung aso', 'admin', 'Resolved', '2024-11-13 00:27:55', '', '', '', ''),
(7, 1546759430, '', 'Property Maintenance', 'Yung puno nya tumumba sa gate ko', 'malupiton.png', '2024-11-12 18:35:21', 'Blk 61 Lot 61', 1581632830, 'Wela A Magsino', 'Blk 9 Lot 18', 'In-Process', '2024-11-13 02:38:23', '', '', '', '', '', '', '', '');

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
(97, 1589571584, 1357825271, 'Concern', '2024-07-01 14:48:18');

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
  `access` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`user_id`, `unique_id`, `email`, `password`, `img`, `status`, `role`, `access`) VALUES
(2, 1589571584, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1715091144pusi.jpg', 'Offline now', 'admin', 'Approved'),
(4, 1357825271, 'senpai@gmail.com', '1e5db03ce967cfef4e21ada16da09b06', '1715105349271713718_1999144396919159_608519389647854942_n.jpg', 'Offline now', 'user', 'Rejected'),
(19, 112466338, 'Prins@gmail.com', '0a9e0db6e95c394ee792ecbc6e510791', '1717745936pitikvermo.jpg', 'Pending', 'user', 'Approved'),
(21, 1017731196, 'tnjrdlcrz@gmail.com', '202cb962ac59075b964b07152d234b70', '1717937589pitikvermo.jpg', 'Pending', 'user', 'Approved'),
(22, 1593518745, 'aawafawf@gmail.com', '2310553235ab181ae0c551c242988734', 'Mabuhay_Logo.png', 'Pending', 'user', 'Pending'),
(23, 1469021725, 'adadawda@gmail.com', '32db117b68ab7598389c18b68f721116', 'Mabuhay_Logo.png', 'Pending', 'user', 'Pending'),
(24, 1433443368, 'waeaewea@gmail.com', '458e5a124f7ed72d143d837a9a3bd76e', 'Mabuhay_Logo.png', 'Pending', 'user', 'Pending'),
(25, 1095492376, 'daadaaw@gmail.com', 'f2a85c6878e7978563609d089ee1173a', 'Mabuhay_Logo.png', 'Pending', 'user', 'Pending'),
(26, 911851766, 'aSbkghjgsghj@gmail.com', '4e3b9566b4b9abfd8f6671f7b4e423a7', 'Mabuhay_Logo.png', 'Pending', 'user', 'Pending'),
(27, 509858760, 'Tiklop@gmail.com', '9f4a66a0bac35d6f7f25b5fd931c7abe', 'Mabuhay_Logo.png', 'Pending', 'user', 'Pending'),
(28, 1581632830, 'wela@gmail.com', 'f9395f741e6f4da0f873c08008ed5760', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved'),
(29, 821155870, 'Renz@gmail.com', 'b55dc472db84256de67972b96657e7b9', 'Mabuhay_Logo.png', 'Active now', 'user', 'Approved'),
(30, 776313154, 'Pat@gmail.com', '532762fa5a5b7169aa4dd24717ba9df9', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved'),
(31, 1590469844, 'Pao@gmail.com', '1b6203e2e1b7e63e7b3677cdd932001f', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved'),
(32, 1308040957, 'John@gmail.com', '61409aa1fd47d4a5332de23cbf59a36f', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved'),
(33, 931588206, 'Jane@gmail.com', '2b95993380f8be6bd4bd46bf44f98db9', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved'),
(34, 662462528, 'Hev@gmail.com', '84f60ea382314109784cb42b9b4b8e42', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved'),
(35, 499733408, 'Ethan@gmail.com', 'e05699b45eae134804f4419d3fbb3139', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved'),
(36, 1434008263, 'Rose@gmail.com', '0df4dccc4aac3f6f36e00ef2a6a4bfac', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved'),
(37, 1195874011, 'Mia@gmail.com', '46e6f8781dd60e2635430b61db511262', 'Mabuhay_Logo.png', 'Offline now', 'user', 'Approved');

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

INSERT INTO `tblresident` (`user_id`, `unique_id`, `access`, `first_name`, `middle_name`, `last_name`, `suffix`, `sex`, `age`, `pwd`, `birthday`, `birthplace`, `citizenship`, `block`, `lot`, `street_name`, `phone_number`, `ec_name`, `ec_phone_num`, `ec_relship`, `ec_address`) VALUES
(3, '1589571584', 'Approved', 'Welacakes', 'Magsino', 'Cervantes', '', 'Female', 20, '', '', '', '', 3, 18, '', 9434763913, 'Prince Jefferson P. Cervantes', 9666676033, 'Asawa', 'BLK 9 LOT 18 Ville de Palme Brgy. Santiago, General Trias, Cavite'),
(4, '1357825271', 'Rejected', 'Wela', 'Aguilar', 'Magsino', '', 'Male', 21, '', '', '', '', 3, 23, '', 9434763913, 'Arlenin', 24357345745, 'Secret', 'Blk 9 Lot 18 Anahaw St.'),
(19, '112466338', 'Approved', 'Prins', 'P', 'Cervs', '', 'Male', 23, '', '', '', '', 4, 3, '', 123, '', 0, '', ''),
(21, '1017731196', 'Approved', 'bago', 'bago', 'bago', '', 'Rather not say', 123, '', '', '', '', 1, 2, '', 123123, '', 0, '', ''),
(23, '1593518745', 'Pending', 'eae', 'eaeaea', 'eaeaawea', 'eaweae', 'male', 3, 'Yes', '2021-02-02', '', '', 2132, 131, 'aweaeaweaea', 1312131313131, '', 0, '', ''),
(24, '1469021725', 'Pending', 'adwdad', 'daddaddwd', 'adadadad', 'eawdadadasd', 'male', 5, 'Yes', '2019-02-18', '', '', 123, 123, 'dadadadad', 31231331, '', 0, '', ''),
(25, '1433443368', 'Pending', 'sakses', 'qew', 'qweqwe', 'qwe', 'female', 8, 'Yes', '2016-02-18', '', '', 213, 1231, 'wdadsdasd', 12131313, '', 0, '', ''),
(26, '1095492376', 'Pending', 'eaaeaaea', 'aaeaaea', 'aeaeaaea', 'awe', 'male', 12, 'No', '2012-02-25', '', '', 132, 132, 'aweaeaa', 131213312, '', 0, '', ''),
(27, '911851766', 'Pending', 'waedsdadadadwadadada', 'ddadadadada', 'dadadadadada', 'dadadaddada', 'male', 8, 'No', '2016-02-18', '', '', 123, 123, 'awdadadadasdada', 1231313123, '', 0, '', ''),
(28, '509858760', 'Pending', 'New ', 'Bagong', 'Account', 'Wala', 'male', 29, 'Yes', '1995-02-20', '', '', 1, 1, 'Test', 123123123, '', 0, '', ''),
(30, '1581632830', 'Approved', 'Wela', 'A', 'Magsino', 'N/A', 'female', 21, 'No', '2003-05-21', '', '', 9, 18, 'Mabolo', 9123412313, '', 0, '', ''),
(31, '821155870', 'Approved', 'Jhonrenz', '', 'Berbano', '', 'Male', 1, 'Yes', '2023-07-24', '', '', 1, 1, '', 2131231, '', 0, '', ''),
(32, '776313154', 'Approved', 'Patrick', 'B', 'Bayona', '', 'Male', 4, 'Yes', '2020-01-20', '', '', 2, 2, '', 12313133, '', 0, '', ''),
(33, '1590469844', 'Approved', 'Paolo', 'M', 'Murillo', '', 'Male', 21, 'Yes', '2003-01-11', '', '', 3, 3, '', 123123123, '', 0, '', ''),
(34, '1308040957', 'Approved', 'John', '', 'Doe', '', 'Male', 1, 'No', '2023-06-14', '', '', 4, 4, '', 1231231231, '', 0, '', ''),
(35, '931588206', 'Approved', 'Jane', '', 'Doe', '', 'Female', 3, 'Yes', '2021-08-20', '', '', 5, 5, '', 112312313, '', 0, '', ''),
(36, '662462528', 'Approved', 'Hev', '', 'Alvin', '', 'Male', 4, 'No', '2020-02-24', '', '', 6, 6, '', 1231312313, '', 0, '', ''),
(37, '499733408', 'Approved', 'Ethan', '', 'Winters', '', 'Male', 7, 'Yes', '2017-02-24', '', '', 1, 1, '', 131132123, '', 0, '', ''),
(38, '1434008263', 'Approved', 'Rose', '', 'Winters', '', 'Female', 3, 'No', '2021-02-25', '', '', 2, 2, '', 123123123, '', 0, '', ''),
(39, '1195874011', 'Approved', 'Mia', '', 'Winters', '', 'Female', 5, 'Yes', '2019-03-01', '', '', 6, 6, 'Mold', 312313132313, '', 0, '', '');

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
(3, 821155870, 'Jhonrenz Berbano', 9, '', '2024-10-04 17:40:11', '', 'Declared'),
(4, 776313154, 'Patrick B Bayona', 12, '', '2024-10-04 17:40:11', '', 'Declared'),
(5, 1590469844, 'Paolo M Murillo', 14, '', '2024-10-04 17:40:11', '', 'Declared'),
(6, 1308040957, 'John Doe', 13, '', '2024-10-04 17:40:11', '', 'Declared'),
(7, 931588206, 'Jane Doe', 13, '', '2024-10-04 17:40:11', '', 'Declared'),
(8, 662462528, 'Hev Alvin', 12, '', '2024-10-04 17:40:11', '', 'Declared'),
(10, 1434008263, 'Rose Winters', 19, '', '2024-10-04 17:40:11', '', 'Declared'),
(11, 1195874011, 'Mia Winters', 14, '', '2024-10-04 17:40:11', '', 'Declared'),
(31, 931588206, 'Jane  Doe', 9, '', '2024-10-08 21:47:57', '', 'Declared'),
(32, 776313154, 'Patrick B Bayona', 7, 'Winner', '2024-10-18 13:33:01', '2024-10-08 21:47:57', 'Declared'),
(34, 821155870, 'Jhonrenz  Berbano', 7, '', '2024-10-08 21:47:57', '', 'Declared'),
(35, 1590469844, 'Paolo M Murillo', 9, '', '2024-10-08 21:47:57', '', 'Declared'),
(36, 1308040957, 'John  Doe', 9, '', '2024-10-08 21:47:57', '', 'Declared'),
(37, 662462528, 'Hev  Alvin', 7, '', '2024-10-08 21:47:57', '', 'Declared'),
(38, 1434008263, 'Rose  Winters', 9, '', '2024-10-08 21:47:57', '', 'Declared'),
(39, 1357825271, 'Wela Aguilar Magsino', 8, '', '2024-10-08 21:47:57', '', 'Declared'),
(40, 1195874011, 'Mia  Winters', 9, '', '2024-10-08 21:47:57', '', 'Declared'),
(41, 776313154, 'Patrick B Bayona', 2, 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(42, 499733408, 'Ethan  Winters', 0, 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(43, 1195874011, 'Mia  Winters', 0, 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(44, 1434008263, 'Rose  Winters', 0, 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(45, 662462528, 'Hev  Alvin', 0, 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(49, 662462528, 'Hev  Alvin', 0, 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(50, 1434008263, 'Rose  Winters', 0, 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(51, 1357825271, 'Wela Aguilar Magsino', 0, 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(52, 1195874011, 'Mia  Winters', 0, 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(53, 776313154, 'Patrick B Bayona', 0, 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(54, 499733408, 'Ethan  Winters', 0, 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(55, 1308040957, 'John  Doe', 0, 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(56, 931588206, 'Jane  Doe', 0, 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(57, 821155870, 'Jhonrenz  Berbano', 0, 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(58, 1590469844, 'Paolo M Murillo', 0, 'Failure', '', '2024-11-04 21:37:01', 'Declared'),
(59, 821155870, 'Jhonrenz  Berbano', 1, '', '', '', ''),
(60, 776313154, 'Patrick B Bayona', 1, '', '', '', ''),
(61, 1590469844, 'Paolo M Murillo', 1, '', '', '', ''),
(62, 499733408, 'Ethan  Winters', 1, '', '', '', ''),
(63, 1434008263, 'Rose  Winters', 1, '', '', '', ''),
(64, 1195874011, 'Mia  Winters', 1, '', '', '', ''),
(65, 662462528, 'Hev  Alvin', 1, '', '', '', ''),
(67, 1308040957, 'John  Doe', 1, '', '', '', ''),
(68, 931588206, 'Jane  Doe', 1, '', '', '', ''),
(71, 1581632830, 'Wela A Magsino', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `vote_id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `add_date` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `won_date` varchar(20) NOT NULL,
  `fail_date` varchar(20) NOT NULL,
  `access` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`vote_id`, `unique_id`, `candidate_name`, `img`, `add_date`, `status`, `won_date`, `fail_date`, `access`) VALUES
(11, 821155870, 'Jhonrenz Berbano', 'bossing.jpg', '', 'Winner', '2024-10-08 21:24:01', '', 'Declared'),
(12, 776313154, 'Patrick B Bayona', 'malupiton2.png', '', 'Winner', '2024-10-08 21:24:01', '', 'Declared'),
(13, 1590469844, 'Paolo M Murillo', 'malupiton.png', '', 'Winner', '2024-10-08 21:24:01', '', 'Declared'),
(14, 1308040957, 'John Doe', 'ble.png', '', 'Winner', '2024-10-08 21:24:01', '', 'Declared'),
(15, 931588206, 'Jane Doe', 'wolXdead.jpg', '', 'Winner', '2024-10-08 21:24:01', '', 'Declared'),
(16, 662462528, 'Hev Alvin', 'maxresdefault.jpg', '', 'Winner', '2024-10-08 21:24:01', '', 'Declared'),
(18, 1434008263, 'Rose Winters', '183726533_469980844255676_8094931697298234118_n.jpg', '', 'Winner', '2024-10-08 21:24:01', '', 'Declared'),
(19, 1195874011, 'Mia Winters', 'Screenshot 2023-10-03 215143.png', '', 'Winner', '2024-10-08 21:24:01', '', 'Declared'),
(39, 931588206, 'Jane  Doe', 'bossing.jpg', '2024-10-02 22:21:24', 'Winner', '2024-10-08 21:47:57', '', 'Declared'),
(40, 776313154, 'Patrick B Bayona', 'malupiton3.jpg', '2024-10-02 22:22:19', 'Failure', '', '2024-10-08 21:47:57', 'Declared'),
(42, 821155870, 'Jhonrenz  Berbano', 'malupiton.png', '2024-10-02 22:23:44', 'Winner', '2024-10-08 21:47:57', '', 'Declared'),
(43, 1590469844, 'Paolo M Murillo', 'malupiton2.png', '2024-10-02 22:24:15', 'Winner', '2024-10-08 21:47:57', '', 'Declared'),
(44, 1308040957, 'John  Doe', 'dora-miming.jpg', '2024-10-02 22:25:16', 'Winner', '2024-10-08 21:47:57', '', 'Declared'),
(45, 662462528, 'Hev  Alvin', 'received_831848847916169.jpg', '2024-10-02 22:25:51', 'Winner', '2024-10-08 21:47:57', '', 'Declared'),
(46, 1434008263, 'Rose  Winters', 'tracing.png', '2024-10-02 22:26:27', 'Winner', '2024-10-08 21:47:57', '', 'Declared'),
(47, 1357825271, 'Wela Aguilar Magsino', 'dora-miming.jpg', '2024-10-02 22:36:42', 'Winner', '2024-10-08 21:47:57', '', 'Declared'),
(48, 1195874011, 'Mia  Winters', 'dora-miming.jpg', '2024-10-05 12:23:02', 'Winner', '2024-10-08 21:47:57', '', 'Declared'),
(49, 776313154, 'Patrick B Bayona', 'boss.jpg', '2024-10-18 13:15:18', 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(50, 499733408, 'Ethan  Winters', 'bossing.jpg', '2024-10-18 13:30:02', 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(51, 1195874011, 'Mia  Winters', 'pakyu.png', '2024-10-18 13:30:18', 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(52, 1434008263, 'Rose  Winters', 'malupiton.png', '2024-10-18 13:31:43', 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(53, 662462528, 'Hev  Alvin', 'meow.jpg', '2024-10-18 13:32:18', 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(70, 662462528, 'Hev  Alvin', 'Mabuhay_Logo.png', '2024-11-04', 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(71, 1434008263, 'Rose  Winters', 'Mabuhay_Logo.png', '2024-11-04', 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(72, 1357825271, 'Wela Aguilar Magsino', '1715105349271713718_1999144396919159_608519389647854942_n.jpg', '2024-11-04', 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(73, 1195874011, 'Mia  Winters', 'Mabuhay_Logo.png', '2024-11-04', 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(74, 776313154, 'Patrick B Bayona', 'Mabuhay_Logo.png', '2024-11-04', 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(75, 499733408, 'Ethan  Winters', 'Mabuhay_Logo.png', '2024-11-04', 'Winner', '2024-10-18 13:33:01', '', 'Declared'),
(76, 1308040957, 'John  Doe', 'Mabuhay_Logo.png', '2024-11-04', 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(77, 931588206, 'Jane  Doe', 'Mabuhay_Logo.png', '2024-11-04', 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(78, 821155870, 'Jhonrenz  Berbano', 'Mabuhay_Logo.png', '2024-11-04', 'Winner', '2024-11-04 21:37:01', '', 'Declared'),
(79, 1590469844, 'Paolo M Murillo', 'Mabuhay_Logo.png', '2024-11-04', 'Failure', '', '2024-11-04 21:37:01', 'Declared'),
(80, 821155870, 'Jhonrenz  Berbano', 'Mabuhay_Logo.png', '2024-11-04 22:01:23', '', '', '', ''),
(81, 776313154, 'Patrick B Bayona', 'Mabuhay_Logo.png', '2024-11-13 21:17:46', '', '', '', ''),
(82, 1590469844, 'Paolo M Murillo', 'Mabuhay_Logo.png', '2024-11-13 21:17:50', '', '', '', ''),
(83, 499733408, 'Ethan  Winters', 'Mabuhay_Logo.png', '2024-11-13 21:18:17', '', '', '', ''),
(84, 1434008263, 'Rose  Winters', 'Mabuhay_Logo.png', '2024-11-13 21:18:19', '', '', '', ''),
(85, 1195874011, 'Mia  Winters', 'Mabuhay_Logo.png', '2024-11-13 21:18:26', '', '', '', ''),
(86, 662462528, 'Hev  Alvin', 'Mabuhay_Logo.png', '2024-11-13 21:18:40', '', '', '', ''),
(88, 1308040957, 'John  Doe', 'Mabuhay_Logo.png', '2024-11-13 21:27:42', '', '', '', ''),
(89, 931588206, 'Jane  Doe', 'Mabuhay_Logo.png', '2024-11-13 21:27:44', '', '', '', ''),
(92, 1581632830, 'Wela A Magsino', 'Mabuhay_Logo.png', '2024-11-13 21:57:20', '', '', '', '');

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
(45, 1330, '2024-09-27 20:19:24', 1330, '2024-09-27 20:20:00', 'VotingEnded'),
(46, 2541, '2024-09-27 20:22:14', 2541, '2024-09-28 20:22:00', 'VotingEnded'),
(47, 6043, '2024-09-29 19:32:03', 6043, '2024-09-29 19:33:00', 'VotingEnded'),
(48, 8983, '2024-09-29 19:48:09', 8983, '2024-09-29 19:49:00', 'VotingEnded'),
(58, 5572, '2024-10-01 02:40:40', 5572, '2024-10-01 02:41:00', 'VotingEnded'),
(60, 2440, '2024-10-02 15:10:27', 2440, '2024-10-02 15:11:00', 'VotingEnded'),
(65, 3479, '2024-10-04 17:39:24', 3479, '2024-10-04 17:40:00', 'VotingEnded'),
(66, 4628, '2024-10-04 19:16:59', 4628, '2024-10-04 19:17:00', 'VotingEnded'),
(67, 2478, '2024-10-04 19:35:40', 2478, '2024-10-04 19:36:00', 'VotingEnded'),
(68, 2218, '2024-10-04 19:39:52', 2218, '2024-10-04 19:40:00', 'VotingEnded'),
(69, 4511, '2024-10-04 19:50:29', 4511, '2024-10-04 19:51:00', 'VotingEnded'),
(70, 7837, '2024-10-04 20:08:09', 7837, '2024-10-04 20:09:00', 'VotingEnded'),
(71, 2014, '2024-10-04 20:09:40', 2014, '2024-10-04 20:10:00', 'VotingEnded'),
(72, 5854, '2024-10-04 20:31:40', 5854, '2024-10-04 20:32:00', 'VotingEnded'),
(73, 3380, '2024-10-04 20:32:55', 3380, '2024-10-04 20:33:00', 'VotingEnded'),
(74, 2547, '2024-10-04 20:35:32', 2547, '2024-10-04 20:36:00', 'VotingEnded'),
(75, 7564, '2024-10-04 21:01:24', 7564, '2024-10-04 21:02:00', 'VotingEnded'),
(76, 8100, '2024-10-04 21:20:10', 8100, '2024-10-04 21:21:00', 'VotingEnded'),
(81, 7804, '2024-10-07 00:31:43', 7804, '2024-10-07 00:32:00', 'VotingEnded'),
(83, 9282, '2024-10-07 01:15:30', 9282, '2024-10-07 01:16:00', 'VotingEnded'),
(85, 5000, '2024-10-07 01:39:07', 5000, '2024-10-07 01:40:00', 'VotingEnded'),
(86, 4837, '2024-10-07 12:15:53', 4837, '2024-10-07 12:16:00', 'VotingEnded'),
(87, 3070, '2024-10-07 12:31:05', 3070, '2024-10-07 12:32:00', 'VotingEnded'),
(88, 9344, '2024-10-07 20:38:41', 9344, '2024-10-07 20:39:00', 'VotingEnded'),
(89, 6739, '2024-10-08 21:01:21', 6739, '2024-10-08 21:02:00', 'VotingEnded'),
(90, 8688, '2024-10-08 21:15:19', 8688, '2024-10-08 21:16:00', 'VotingEnded'),
(91, 2306, '2024-10-08 21:16:28', 2306, '2024-10-08 21:17:00', 'VotingEnded'),
(92, 1341, '2024-10-08 21:23:09', 1341, '2024-10-08 21:24:00', 'VotingEnded'),
(93, 3691, '2024-10-08 21:41:05', 3691, '2024-10-08 21:42:00', 'VotingEnded'),
(94, 7412, '2024-10-08 21:46:44', 7412, '2024-10-08 21:47:00', 'VotingEnded'),
(100, 2167, '2024-10-18 13:32:56', 2167, '2024-10-18 13:33:00', 'VotingEnded'),
(105, 7867, '2024-11-04 21:36:07', 7867, '2024-11-04 21:37:00', 'VotingEnded');

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
(47, 821155870, 1195874011, 1357825271, 1434008263, 662462528, 776313154, 1581632830, 1590469844, 1308040957, 931588206, 'Voted', '2024-10-07 01:36:35'),
(48, 1581632830, 1195874011, 1357825271, 1434008263, 662462528, 776313154, 821155870, 1590469844, 1308040957, 931588206, 'Voted', '2024-10-07 01:37:20'),
(49, 776313154, 1195874011, 1357825271, 1434008263, 662462528, 1581632830, 1590469844, 821155870, 1308040957, 931588206, 'Voted', '2024-10-07 01:37:50'),
(50, 662462528, 1195874011, 1357825271, 1434008263, 1308040957, 776313154, 1581632830, 821155870, 1590469844, 931588206, 'Voted', '2024-10-07 01:38:27'),
(51, 1357825271, 1434008263, 1195874011, 821155870, 1590469844, 1581632830, 662462528, 1308040957, 776313154, 931588206, 'Voted', '2024-10-07 01:38:44'),
(52, 1581632830, 776313154, 0, 0, 0, 0, 0, 0, 0, 0, 'UnderVote', '2024-10-18 13:25:08'),
(53, 1581632830, 776313154, 0, 0, 0, 0, 0, 0, 0, 0, 'UnderVote', '2024-10-18 13:26:17'),
(54, 1581632830, 931588206, 1308040957, 499733408, 1434008263, 662462528, 1590469844, 1195874011, 776313154, 821155870, 'Voted', '2024-11-13 21:28:57');

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
-- Indexes for table `user_votes`
--
ALTER TABLE `user_votes`
  ADD PRIMARY KEY (`vote_id`);

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
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `forms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `bod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tblresident`
--
ALTER TABLE `tblresident`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_votes`
--
ALTER TABLE `user_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `voting_countdown`
--
ALTER TABLE `voting_countdown`
  MODIFY `countdown_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `voting_history`
--
ALTER TABLE `voting_history`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
