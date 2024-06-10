-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 09:20 PM
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
(94, 1662732210, 1589571584, 'test', '2024-06-07 02:57:23');

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
(1, 'President', 'Presi', 'gin.png'),
(2, 'VicePresident', 'vice', 'flrmeouv.png'),
(3, 'Secretary', 'Sec', 'received_737091231046329.jpg'),
(4, 'Treasurer', 'Trea', '271713718_1999144396919159_608519389647854942_n.jpg'),
(5, 'Auditor', 'Aud', 'pusi.jpg'),
(6, 'PeaceInOrder', 'pis', 'ble.png'),
(7, 'Director1', 'Dir', 'ble.png'),
(8, 'Director2 ', 'Dir', 'ble.png'),
(9, 'Director3', 'Director ', 'ble.png');

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
(1, 1173092218, 'master@gmail.com', 'eb0a191797624dd3a48fa681d3061212', '1715083895flrmeouv.png', 'Offline now', '', 'Rejected'),
(2, 1589571584, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1715091144pusi.jpg', 'Offline now', 'admin', 'Approved'),
(3, 730027935, 'welacakes@gmail.com', 'f9395f741e6f4da0f873c08008ed5760', '1715100256330940285_2340469369455107_2269788843175983818_n.jpg', 'Offline now', '', 'Approved'),
(4, 1357825271, 'senpai@gmail.com', '1e5db03ce967cfef4e21ada16da09b06', '1715105349271713718_1999144396919159_608519389647854942_n.jpg', 'Active now', 'user', 'Rejected'),
(5, 1474265465, 'mamako@gmail.com', 'eeafbf4d9b3957b139da7b7f2e7f2d4a', '1715845102bike.jpg', 'Offline now', '', 'Rejected'),
(6, 1163083331, 'pr@gmail.com', '4297f44b13955235245b2497399d7a93', '1715849553bike.jpg', 'Offline now', '', ''),
(7, 1079432394, 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '1717432294bike.jpg', 'Offline now', '', ''),
(8, 754920518, 'test2@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '1717432677ble.png', 'Offline now', 'pending', ''),
(9, 1445165714, 'Chap@gmail.com', '79bdc2757415b12d9f62183d6e60b657', '1717589216Calcu.png', 'Offline now', 'user', ''),
(10, 757420171, 'first@gmail.com', '8b04d5e3775d298e78455efc5ca404d5', '1717589824ef25eb26e652151992087d450fa721e2.jpg', 'Offline now', 'user', ''),
(11, 1356008498, 'cutie@gmail.com', '05f3672ba34409136aa71b8d00070d1b', '1717593202pitikvermo.jpg', 'Offline now', 'user', 'Approved'),
(12, 755154771, 'bakit@gmail.com', 'abc1f79e5a5db78b137c663f8fa8c037', '1717595059ble.png', 'Offline now', 'user', ''),
(13, 373821860, 'bago@gmail.com', '002fd9bc0b24de3b80ce1efd7bc4dc19', '1717595498pitikvermo.jpg', 'Offline now', 'user', 'Pending'),
(14, 446429328, 'New@gmail.com', '03c2e7e41ffc181a4e84080b4710e81e', '1717600789kandes.png', 'Pending', 'user', 'Approved'),
(15, 638234533, 'Mas@gmail.com', 'b58c2d4a810e07b2d853f8b6f565c630', '1717619258flrmeouv.png', 'Offline now', 'user', 'Approved'),
(16, 643959833, 'prnccrvnts@gmail.com', '783bd6100dfaefa4cf08a47010bd9537', '1717619611received_737091231046329.jpg', 'Offline now', 'user', 'Rejected'),
(18, 1662732210, 'PRINCE@gmail.com', 'a63b03e7579810222265eb0e0db35fdc', '1717728951catto.jpg', 'Offline now', 'user', 'Pending'),
(19, 112466338, 'Prins@gmail.com', '0a9e0db6e95c394ee792ecbc6e510791', '1717745936pitikvermo.jpg', 'Pending', 'user', 'Approved'),
(21, 1017731196, 'tnjrdlcrz@gmail.com', '202cb962ac59075b964b07152d234b70', '1717937589pitikvermo.jpg', 'Pending', 'user', 'Approved');

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
(1, '', 'Rejected', 'Prince', 'Cutie', 'Cervantes', '', 'Male', 0, '', '09-02-2002', 'Las Pinas ', 'Filipino', 1, 18, 'Mabolo', 912345678, 'Leng Cervantes', 24357345745, 'Mother', 'Blk 9 Lot 18 Mabolo St.'),
(2, '', 'Approved', 'Prince', 'P.', 'Cervantes', '', 'Female', 0, '', '05-21-2003', 'Manila', 'Filipino', 1, 9, 'Mabolo', 912345678, 'Tita nels', 4357345773, 'Mother', 'Blk 18 Lot 9 Kamagong St.'),
(3, '', 'Approved', 'Welacakes', 'Magsino', 'Cervantes', '', 'Female', 20, '', '', '', '', 3, 18, '', 9434763913, 'Prince Jefferson P. Cervantes', 9666676033, 'Asawa', 'BLK 9 LOT 18 Ville de Palme Brgy. Santiago, General Trias, Cavite'),
(4, '1357825271', 'Rejected', 'Wela', 'Aguilar', 'Magsino', '', 'Male', 21, '', '', '', '', 3, 23, '', 9434763913, 'Arlenin', 24357345745, 'Secret', 'Blk 9 Lot 18 Anahaw St.'),
(5, '', 'Rejected', 'Franky', 'Minskie', 'Skirt', '', 'Male', 99, '', '', '', '', 9, 99, '', 123132, 'Mama mo', 1231123, 'Mama ko', 'Sa bahay'),
(6, '', '', 'Prins', 'Midname', 'Cervantes', '', 'Male', 21, '', '', '', '', 9, 18, '', 909090909, 'Mother', 9090909, 'Mother', 'BLK 9 LOT 18 Ville de Palme Brgy. Santiago, General Trias, Cavite'),
(7, '', '', 'p', 'p', 'p', 'pp', 'pp', 0, '', '', '', '', 0, 0, '', 0, 'p', 0, 'p', 'p'),
(8, '', '', 'p', 'p', 'p', 'p', 'p', 0, '', '', '', '', 0, 0, '', 0, 'Prince Jefferson P. Cervantes', 0, 'p', 'p'),
(9, '', '', 'Chap', 'oks', 'cats', 'jr', 'male', 33, '', '', '', '', 1, 1, '', 123123, 'Madir', 123123, 'Mother', 'BLK 9 LOT 18 Ville de Palme Brgy. Santiago, General Trias, Cavite'),
(10, '', '', 'First', 'Midname', 'Last', 'Suff', 'SEx', 18, '', '', '', '', 3, 3, '', 123123, 'emer', 0, 'Brader', 'Test strreett blk 9 '),
(11, '', 'Approved', 'p', 'p', 'p', '', 'male', 33, '', '', '', '', 0, 0, '', 0, 'p', 0, 'p', 'p'),
(12, '', '', 'pers ', 'mid ', 'secs', '', 'male', 33, '', '', '', '', 1, 1, '', 123123, '', 0, '', ''),
(13, '', '', 'bago', 'bago', 'bago', '', 'Preferred Not to Say', 33, '', '', '', '', 33, 33, '', 33, '', 0, '', ''),
(14, '', 'Approved', 'New', 'New', 'New', '', 'Male', 123, '', '', '', '', 123, 123, '', 123, '', 0, '', ''),
(15, '', 'Approved', 'Mas ', 'Bago ', 'pa', '', 'Others', 11, '', '', '', '', 2, 2, '', 123, '', 0, '', ''),
(16, '', 'Rejected', 'Etona', 'talagang ', 'talaga', '', 'Male', 13, '', '', '', '', 3, 3, '', 909, '', 0, '', ''),
(18, '', 'Approved', 'PRINCE JEFFERSON', 'PAGAOA', 'CERVANTES', '', 'Male', 21, '', '', '', '', 9, 18, '', 9123123123123, '', 0, '', ''),
(19, '112466338', 'Approved', 'Prins', 'P', 'Cervs', '', 'Male', 23, '', '', '', '', 4, 3, '', 123, '', 0, '', ''),
(20, '1509850339', 'Approved', 'TEst', 'TEst', 'TEst', '', 'Female', 123, '', '', '', '', 1, 1, '', 123, '', 0, '', ''),
(21, '1017731196', 'Approved', 'bago', 'bago', 'bago', '', 'Rather not say', 123, '', '', '', '', 1, 2, '', 123123, '', 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`news_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `forms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblresident`
--
ALTER TABLE `tblresident`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
