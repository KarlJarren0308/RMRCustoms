-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2015 at 11:21 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `billing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `Account_Username` char(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Account_Password` char(15) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Account_Type` char(15) NOT NULL,
  `First_Name` char(50) NOT NULL,
  `Middle_Name` char(50) NOT NULL,
  `Last_Name` char(50) NOT NULL,
  `Gender` char(6) NOT NULL,
  `Status` char(8) NOT NULL DEFAULT 'Active',
  `User_Image` char(255) NOT NULL DEFAULT 'unknown.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Account_Username`, `Account_Password`, `Account_Type`, `First_Name`, `Middle_Name`, `Last_Name`, `Gender`, `Status`, `User_Image`) VALUES
('admin', 'brokerage', 'Administrator', 'Raquel', '', 'Oller', 'Female', 'Active', 'unknown.png'),
('pres', 'rmrcustoms', 'President', 'Manuelito', '', 'Oller', 'Male', 'Active', 'unknown.png');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
`Client_ID` int(10) NOT NULL,
  `First_Name` char(50) NOT NULL,
  `Middle_Name` char(50) NOT NULL,
  `Last_Name` char(50) NOT NULL,
  `Address` char(255) NOT NULL,
  `Email_Address` char(255) NOT NULL,
  `Contact_Number` char(11) NOT NULL,
  `Fax` char(25) NOT NULL,
  `Business_Type` char(255) NOT NULL,
  `Company_ID` int(10) NOT NULL,
  `Added_By` char(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Date_Added` date NOT NULL,
  `Updated_By` char(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Date_Updated` date NOT NULL,
  `Status` char(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`Client_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Address`, `Email_Address`, `Contact_Number`, `Fax`, `Business_Type`, `Company_ID`, `Added_By`, `Date_Added`, `Updated_By`, `Date_Updated`, `Status`) VALUES
(1, 'test', 'test', 'test', 'Recto, Manila', 'test.test@gmail.com', '', '123456789', '', 17, 'admin', '2015-04-06', 'admin', '2015-09-15', 'Active'),
(2, 'Bill Christian', 'Mercado', 'Sychua', 'Retiro, Quezon City', '', '', '', '', -1, 'admin', '2015-04-11', 'admin', '2015-04-27', 'Active'),
(3, 'Ric Christopher', 'Escueta', 'Vega', 'Tayuman Street, Quezon City', '', '', '', '', -1, 'admin', '2015-04-11', 'admin', '2015-04-27', 'Active'),
(4, 'Francis', 'Sagibo', 'Dy', 'Novaliches, Quezon City', '', '', '', '', -1, 'admin', '2015-04-11', '', '0000-00-00', 'Active'),
(5, 'Jean', 'Terre', 'Ocampo', 'Adelita Chioco Street, ParaÃ±aque City', '', '', '', '', -1, 'admin', '2015-04-11', '', '0000-00-00', 'Active'),
(6, 'Emilio', 'Pandy', 'Bautista', 'Project 8, Quezon City', '', '', '', '', -1, 'admin', '2015-04-11', '', '0000-00-00', 'Active'),
(7, 'Kyle', 'Manotoc', 'Flores', 'Amoranto Ipo Street, Quezon City', '', '', '', '', -1, 'admin', '2015-04-11', '', '0000-00-00', 'Active'),
(8, 'Billy', 'Santos', 'Roque', 'Sampaloc, Manila', '', '', '', '', -1, 'admin', '2015-04-12', '', '0000-00-00', 'Active'),
(9, 'Anna Clarise', 'Mayo', 'Dizon', 'Tondo, Manila', '', '', '', '', -1, 'admin', '2015-04-12', '', '0000-00-00', 'Active'),
(10, 'Dianna Marie', 'Valdez', 'Dela Cruz', 'Tondo, Manila', '', '', '', '', -1, 'admin', '2015-04-12', 'admin', '2015-05-03', 'Active'),
(14, 'Not Available', 'Not Available', 'Not Available', '', '', '', '', '', 4, 'admin', '2015-05-19', 'admin', '2015-07-10', 'Active'),
(16, 'Jinri', '', 'Choi', 'Seoul, South Korea', 'choi.jinri@sm.com', '', '', '', 0, 'admin', '2015-06-15', '', '0000-00-00', 'Active'),
(17, 'Not Available', 'Not Available', 'Not Available', '', '', '', '', '', 16, 'admin', '2015-07-10', 'admin', '2015-07-10', 'Inactive'),
(18, 'Kaaru', '', 'Makuzo', 'Sampalocu, Manilau', 'makuzo.kaaru08@gmailu.com', '', '123456789', 'Hardware and Lumber', 17, 'admin', '2015-08-18', 'admin', '2015-08-19', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
`Company_ID` int(10) NOT NULL,
  `Company_Name` char(100) NOT NULL,
  `Company_Address` char(255) NOT NULL,
  `Company_Number` char(12) NOT NULL,
  `Company_Email_Address` char(50) NOT NULL,
  `Zip_Code` char(10) NOT NULL,
  `Company_Contact_Person` char(150) NOT NULL,
  `Company_Contact_Person_Position` char(50) NOT NULL,
  `Company_Contact_Person_Email` char(50) NOT NULL,
  `Company_Contact_Person_Number` char(15) NOT NULL,
  `Main_Business_Activities` char(50) NOT NULL,
  `Country` char(50) NOT NULL,
  `Default_Time_Zone` char(50) NOT NULL,
  `Fax` char(15) NOT NULL,
  `Phone_Number` char(15) NOT NULL,
  `Established` char(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`Company_ID`, `Company_Name`, `Company_Address`, `Company_Number`, `Company_Email_Address`, `Zip_Code`, `Company_Contact_Person`, `Company_Contact_Person_Position`, `Company_Contact_Person_Email`, `Company_Contact_Person_Number`, `Main_Business_Activities`, `Country`, `Default_Time_Zone`, `Fax`, `Phone_Number`, `Established`) VALUES
(4, 'Tambay Society', 'Tondo, Manila', '1234567', 'master.tambz@tambaysociety.com', '1234', 'Master Tamby', 'President', 'master.tambz@gmail.com', '1234560', 'Retailer', 'Philippines', 'Asia/Manila', '1234567890', '0000001', 'Tondo, Manila'),
(14, 'Tambay', 'Tondo, Manila', '1234567', 'master.tambz@tambaysociety.com', '1234', 'Master Tamby', 'President', 'master.tambz@gmail.com', '1234560', 'Retailer', 'Philippines', 'Asia/Manila', '1234567890', '0000001', 'Tondo, Manila'),
(16, 'Siga League', 'Tondo, Manila', '1234567', 'siga.league@gmail.com', '', '', '', '', '', 'Hardware and Lumber', '', '', '', '', ''),
(17, '', '', '', '', '', '', '', '', '', '', '', '', '123456789', '', ''),
(18, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ladings`
--

CREATE TABLE IF NOT EXISTS `ladings` (
  `Bill_of_Lading_Number` char(25) NOT NULL,
  `Bill_of_Lading_ID` char(15) NOT NULL,
  `Shipping_Line` char(150) NOT NULL,
  `Consignee` char(250) NOT NULL,
  `Export_References` char(250) NOT NULL,
  `Item_Mark` varchar(2500) NOT NULL DEFAULT '[]',
  `Item_Quantity` varchar(2500) NOT NULL DEFAULT '[]',
  `Item_Description` varchar(2500) NOT NULL DEFAULT '[]',
  `Date_of_Transaction` date NOT NULL,
  `Status` char(8) NOT NULL DEFAULT 'Active',
  `Date_Added` date NOT NULL,
  `Gross_Weight` char(15) NOT NULL,
  `Measurement` char(15) NOT NULL,
  `Package_Count` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ladings`
--

INSERT INTO `ladings` (`Bill_of_Lading_Number`, `Bill_of_Lading_ID`, `Shipping_Line`, `Consignee`, `Export_References`, `Item_Mark`, `Item_Quantity`, `Item_Description`, `Date_of_Transaction`, `Status`, `Date_Added`, `Gross_Weight`, `Measurement`, `Package_Count`) VALUES
('345345234', '3', 'efvretgrtg', 'erfer', '3434', '["kanin"]', '["102934214"]', '["d pa nasasaing"]', '2015-09-15', 'Active', '2015-09-15', '50kg', '126', '123'),
('test', '1', 'test', 'test', 'test', '[]', '[]', '[]', '2015-09-12', 'Active', '2015-09-12', '123', '50', '123'),
('TESTLADING101', '1', 'LBC', 'Jinri Choi', 'None', '["1"]', '["2"]', '["3"]', '2015-08-19', 'Active', '2015-08-19', '50', '15', '10'),
('TESTLADING102', '1', '', 'Jinri Choi', 'None', '["10"]', '["20"]', '["30"]', '2015-08-19', 'Active', '2015-08-19', '150', '115', '110');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
`Log_ID` int(10) NOT NULL,
  `Account_Username` char(10) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Log` char(255) NOT NULL,
  `Log_Datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=370 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`Log_ID`, `Account_Username`, `Log`, `Log_Datetime`) VALUES
(1, 'admin', 'has logged in.', '2015-06-11 20:31:26'),
(2, 'admin', 'accessed the Companies Module.', '2015-06-11 20:36:44'),
(3, 'admin', 'accessed the Transactions Module.', '2015-06-11 20:37:15'),
(4, 'admin', 'accessed the Bill of Lading Module.', '2015-06-11 20:46:58'),
(5, 'admin', 'accessed the Transactions Module.', '2015-06-11 21:00:35'),
(6, 'admin', 'accessed the Clients Module.', '2015-06-11 22:25:27'),
(7, 'admin', 'accessed the Trucks Module.', '2015-06-11 22:33:55'),
(8, 'admin', 'accessed the Companies Module.', '2015-06-11 22:57:52'),
(9, 'admin', 'accessed the Clients Module.', '2015-06-11 23:01:28'),
(10, 'admin', 'accessed the Companies Module.', '2015-06-12 00:46:14'),
(11, 'admin', 'accessed the Clients Module.', '2015-06-12 01:26:15'),
(12, 'admin', 'accessed the Transactions Module.', '2015-06-12 01:56:02'),
(13, 'admin', 'accessed the Companies Module.', '2015-06-12 02:07:35'),
(14, 'admin', 'accessed the Transactions Module.', '2015-06-12 02:07:42'),
(15, 'admin', 'accessed the Bill of Lading Module.', '2015-06-12 02:07:50'),
(16, 'admin', 'accessed the Trucks Module.', '2015-06-12 02:07:52'),
(17, 'admin', 'accessed the Finances Module.', '2015-06-12 02:07:57'),
(18, 'admin', 'accessed the Finances Module.', '2015-06-12 02:25:14'),
(19, 'admin', 'accessed the Transactions Module.', '2015-06-12 02:51:31'),
(20, 'admin', 'accessed the Finances Module.', '2015-06-12 15:23:12'),
(21, 'admin', 'accessed the Finances Module.', '2015-06-12 16:44:15'),
(22, 'admin', 'accessed the Transactions Module.', '2015-06-12 19:08:39'),
(23, 'admin', 'accessed the Transactions Module.', '2015-06-12 19:20:28'),
(24, 'admin', 'accessed the Clients Module.', '2015-06-13 03:19:35'),
(25, 'admin', 'has logged out.', '2015-06-13 03:34:23'),
(26, 'admin', 'has logged in.', '2015-06-14 20:53:42'),
(27, 'admin', 'accessed the Transactions Module.', '2015-06-14 20:53:47'),
(28, 'admin', 'has logged in.', '2015-06-14 21:57:52'),
(29, 'admin', 'accessed the Transactions Module.', '2015-06-14 21:57:57'),
(30, 'admin', 'has logged in.', '2015-06-14 23:48:01'),
(31, 'admin', 'accessed the Transactions Module.', '2015-06-15 00:57:57'),
(32, 'admin', 'accessed the Trucks Module.', '2015-06-15 01:23:55'),
(33, 'admin', 'accessed the Clients Module.', '2015-06-15 01:30:06'),
(34, 'admin', 'accessed the Companies Module.', '2015-06-15 01:37:34'),
(35, 'admin', 'accessed the Trucks Module.', '2015-06-15 01:37:36'),
(36, 'admin', 'accessed the Transactions Module.', '2015-06-15 01:58:58'),
(37, 'admin', 'accessed the Trucks Module.', '2015-06-15 04:45:59'),
(38, 'admin', 'accessed the Clients Module.', '2015-06-15 05:00:09'),
(39, 'admin', 'accessed the Companies Module.', '2015-06-15 05:00:10'),
(40, 'admin', 'accessed the Bill of Lading Module.', '2015-06-15 05:00:12'),
(41, 'admin', 'accessed the Transactions Module.', '2015-06-15 05:00:13'),
(42, 'admin', 'accessed the Trucks Module.', '2015-06-15 05:00:14'),
(43, 'admin', 'accessed the Finances Module.', '2015-06-15 05:00:15'),
(44, 'admin', 'accessed the Trucks Module.', '2015-06-15 05:00:17'),
(45, 'admin', 'accessed the Finances Module.', '2015-06-15 05:00:18'),
(46, 'admin', 'accessed the Trucks Module.', '2015-06-15 05:00:20'),
(47, 'admin', 'accessed the Finances Module.', '2015-06-15 05:00:21'),
(48, 'admin', 'accessed the Global Positioning System Module.', '2015-06-15 05:00:22'),
(49, 'admin', 'accessed the Users Module.', '2015-06-15 05:00:24'),
(50, 'admin', 'accessed the Company Fix Rate Charges Module.', '2015-06-15 05:00:25'),
(51, 'admin', 'accessed the Users Module.', '2015-06-15 05:00:27'),
(52, 'admin', 'has logged in.', '2015-06-17 00:49:48'),
(53, 'admin', 'accessed the Transactions Module.', '2015-06-17 01:01:49'),
(54, 'admin', 'has logged in.', '2015-06-17 11:28:43'),
(55, 'admin', 'accessed the Transactions Module.', '2015-06-17 11:28:52'),
(56, 'admin', 'has logged in.', '2015-06-18 11:15:33'),
(57, 'admin', 'accessed the Transactions Module.', '2015-06-18 11:15:52'),
(58, 'admin', 'accessed the Bill of Lading Module.', '2015-06-18 11:15:58'),
(59, 'admin', 'has logged out.', '2015-06-18 11:27:03'),
(60, 'admin', 'has logged in.', '2015-06-18 15:18:32'),
(61, 'admin', 'accessed the Transactions Module.', '2015-06-18 15:18:47'),
(62, 'admin', 'has logged out.', '2015-06-18 15:19:12'),
(63, 'admin', 'has logged in.', '2015-06-24 01:28:53'),
(64, 'admin', 'accessed the Finances Module.', '2015-06-24 01:29:19'),
(65, 'admin', 'accessed the Transactions Module.', '2015-06-24 01:30:09'),
(66, 'admin', 'accessed the Trucks Module.', '2015-06-24 01:30:11'),
(67, 'admin', 'accessed the Transactions Module.', '2015-06-24 01:30:17'),
(68, 'admin', 'accessed the Bill of Lading Module.', '2015-06-24 01:30:19'),
(69, 'admin', 'accessed the Transactions Module.', '2015-06-24 01:30:22'),
(70, 'admin', 'accessed the Global Positioning System Module.', '2015-06-24 01:30:37'),
(71, 'admin', 'accessed the Finances Module.', '2015-06-24 01:30:38'),
(72, 'admin', 'accessed the Transactions Module.', '2015-06-24 01:30:41'),
(73, 'admin', 'accessed the Trucks Module.', '2015-06-24 01:30:47'),
(74, 'admin', 'accessed the Transactions Module.', '2015-06-24 01:31:02'),
(75, 'admin', 'accessed the Bill of Lading Module.', '2015-06-24 01:31:05'),
(76, 'admin', 'accessed the Trucks Module.', '2015-06-24 01:31:07'),
(77, 'admin', 'accessed the Finances Module.', '2015-06-24 01:31:35'),
(78, 'admin', 'accessed the Transactions Module.', '2015-06-24 01:36:53'),
(79, 'admin', 'accessed the Finances Module.', '2015-06-24 01:54:39'),
(80, 'admin', 'accessed the Transactions Module.', '2015-06-24 01:58:13'),
(81, 'admin', 'accessed the Finances Module.', '2015-06-24 02:13:10'),
(82, 'admin', 'accessed the Trucks Module.', '2015-06-24 02:13:13'),
(83, 'admin', 'accessed the Transactions Module.', '2015-06-24 02:14:00'),
(84, 'admin', 'accessed the Bill of Lading Module.', '2015-06-24 02:14:02'),
(85, 'admin', 'accessed the Transactions Module.', '2015-06-24 03:17:55'),
(86, 'admin', 'accessed the Bill of Lading Module.', '2015-06-24 03:17:56'),
(87, 'admin', 'has logged out.', '2015-06-24 03:18:00'),
(88, 'admin', 'has logged in.', '2015-06-24 03:21:56'),
(89, 'admin', 'has logged in.', '2015-06-24 03:21:57'),
(90, 'admin', 'accessed the Transactions Module.', '2015-06-24 03:22:01'),
(91, 'admin', 'accessed the Bill of Lading Module.', '2015-06-24 03:22:05'),
(92, 'admin', 'has logged out.', '2015-06-24 03:23:20'),
(93, 'admin', 'has logged in.', '2015-06-24 04:23:31'),
(94, 'admin', 'accessed the Transactions Module.', '2015-06-24 04:23:40'),
(95, 'admin', 'accessed the Finances Module.', '2015-06-24 04:33:58'),
(96, 'admin', 'accessed the Transactions Module.', '2015-06-24 15:22:39'),
(97, 'admin', 'accessed the Finances Module.', '2015-06-24 15:49:31'),
(98, 'admin', 'accessed the Bill of Lading Module.', '2015-06-24 20:57:40'),
(99, 'admin', 'accessed the Transactions Module.', '2015-06-24 21:50:23'),
(100, 'admin', 'has logged out.', '2015-06-24 21:51:17'),
(101, 'admin', 'has logged in.', '2015-06-25 21:17:06'),
(102, 'admin', 'accessed the Transactions Module.', '2015-06-25 21:17:09'),
(103, 'admin', 'accessed the Trucks Module.', '2015-06-25 21:17:12'),
(104, 'admin', 'accessed the Transactions Module.', '2015-06-25 21:17:14'),
(105, 'admin', 'accessed the Bill of Lading Module.', '2015-06-25 21:17:14'),
(106, 'admin', 'accessed the Transactions Module.', '2015-06-25 21:17:17'),
(107, 'admin', 'accessed the Trucks Module.', '2015-06-25 21:17:30'),
(108, 'admin', 'accessed the Bill of Lading Module.', '2015-06-25 21:17:30'),
(109, 'admin', 'accessed the Transactions Module.', '2015-06-25 21:28:04'),
(110, 'admin', 'accessed the Bill of Lading Module.', '2015-06-25 21:28:13'),
(111, 'admin', 'accessed the Transactions Module.', '2015-06-25 21:55:49'),
(112, 'admin', 'accessed the Bill of Lading Module.', '2015-06-25 21:55:50'),
(113, 'admin', 'accessed the Trucks Module.', '2015-06-25 21:55:52'),
(114, 'admin', 'accessed the Transactions Module.', '2015-06-25 21:56:42'),
(115, 'admin', 'accessed the Bill of Lading Module.', '2015-06-25 21:56:51'),
(116, 'admin', 'has logged in.', '2015-07-01 11:18:40'),
(117, 'admin', 'accessed the Transactions Module.', '2015-07-01 11:18:49'),
(118, 'admin', 'has logged in.', '2015-07-03 21:56:12'),
(119, 'admin', 'accessed the Transactions Module.', '2015-07-03 21:56:16'),
(120, 'admin', 'accessed the Clients Module.', '2015-07-03 21:56:23'),
(121, 'admin', 'has logged in.', '2015-07-08 20:34:51'),
(122, 'admin', 'accessed the Transactions Module.', '2015-07-08 21:07:51'),
(123, 'admin', 'accessed the Trucks Module.', '2015-07-08 21:07:53'),
(124, 'admin', 'accessed the Transactions Module.', '2015-07-08 21:08:34'),
(125, 'admin', 'has logged in.', '2015-07-09 22:57:57'),
(126, 'admin', 'accessed the Transactions Module.', '2015-07-09 23:00:13'),
(127, 'admin', 'accessed the Companies Module.', '2015-07-10 00:12:24'),
(128, 'admin', 'accessed the Clients Module.', '2015-07-10 01:12:01'),
(129, 'admin', 'has logged out.', '2015-07-10 01:24:09'),
(130, 'admin', 'has logged in.', '2015-07-10 01:24:30'),
(131, 'admin', 'accessed the Companies Module.', '2015-07-10 01:24:35'),
(132, 'admin', 'accessed the Clients Module.', '2015-07-10 01:28:29'),
(133, 'admin', 'has logged in.', '2015-07-16 14:01:35'),
(134, 'admin', 'accessed the Transactions Module.', '2015-07-16 14:01:39'),
(135, 'admin', 'has logged out.', '2015-07-16 14:45:19'),
(136, 'admin', 'has logged in.', '2015-07-19 14:13:22'),
(137, 'admin', 'accessed the Transactions Module.', '2015-07-19 14:13:26'),
(138, 'admin', 'accessed the Bill of Lading Module.', '2015-07-19 14:22:16'),
(139, 'admin', 'accessed the Trucks Module.', '2015-07-19 14:29:38'),
(140, 'admin', 'accessed the Transactions Module.', '2015-07-19 14:30:09'),
(141, 'admin', 'accessed the Clients Module.', '2015-07-19 14:53:08'),
(142, 'admin', 'accessed the Companies Module.', '2015-07-19 14:59:44'),
(143, 'admin', 'accessed the Transactions Module.', '2015-07-19 15:02:15'),
(144, 'admin', 'accessed the Bill of Lading Module.', '2015-07-19 15:31:42'),
(145, 'admin', 'accessed the Companies Module.', '2015-07-19 15:34:53'),
(146, 'admin', 'accessed the Transactions Module.', '2015-07-19 17:17:03'),
(147, 'admin', 'accessed the Company Fix Rate Charges Module.', '2015-07-19 17:22:07'),
(148, 'admin', 'has logged in.', '2015-07-31 18:53:33'),
(149, 'admin', 'accessed the Users Module.', '2015-07-31 18:54:17'),
(150, 'admin', 'accessed the Companies Module.', '2015-07-31 18:54:57'),
(151, 'admin', 'has logged in.', '2015-08-04 16:53:13'),
(152, 'admin', 'accessed the Finances Module.', '2015-08-04 16:53:17'),
(153, 'admin', 'accessed the Finances Module.', '2015-08-05 01:03:41'),
(154, 'admin', 'has logged in.', '2015-08-13 14:50:52'),
(155, 'admin', 'accessed the Clients Module.', '2015-08-13 14:50:56'),
(156, 'admin', 'accessed the Companies Module.', '2015-08-13 14:51:59'),
(157, 'admin', 'accessed the Companies Module.', '2015-08-13 14:52:36'),
(158, 'admin', 'accessed the Clients Module.', '2015-08-13 14:52:37'),
(159, 'admin', 'has logged in.', '2015-08-18 15:09:22'),
(160, 'admin', 'accessed the Transactions Module.', '2015-08-18 15:09:27'),
(161, 'admin', 'accessed the Trucks Module.', '2015-08-18 15:09:30'),
(162, 'admin', 'accessed the Companies Module.', '2015-08-18 15:09:33'),
(163, 'admin', 'accessed the Bill of Lading Module.', '2015-08-18 15:09:34'),
(164, 'admin', 'accessed the Companies Module.', '2015-08-18 15:09:35'),
(165, 'admin', 'accessed the Clients Module.', '2015-08-18 15:11:00'),
(166, 'admin', 'accessed the Bill of Lading Module.', '2015-08-18 15:11:04'),
(167, 'admin', 'accessed the Bill of Lading Module.', '2015-08-18 15:11:15'),
(168, 'admin', 'accessed the Clients Module.', '2015-08-18 15:11:15'),
(169, 'admin', 'accessed the Companies Module.', '2015-08-18 15:11:42'),
(170, 'admin', 'accessed the Companies Module.', '2015-08-18 15:13:11'),
(171, 'admin', 'accessed the Clients Module.', '2015-08-18 15:13:27'),
(172, 'admin', 'accessed the Companies Module.', '2015-08-18 15:23:03'),
(173, 'admin', 'accessed the Clients Module.', '2015-08-18 15:23:16'),
(174, 'admin', 'accessed the Companies Module.', '2015-08-18 15:23:18'),
(175, 'admin', 'accessed the Clients Module.', '2015-08-18 15:23:24'),
(176, 'admin', 'accessed the Bill of Lading Module.', '2015-08-18 15:27:55'),
(177, 'admin', 'accessed the Transactions Module.', '2015-08-18 15:31:45'),
(178, 'admin', 'accessed the Bill of Lading Module.', '2015-08-18 15:33:33'),
(179, 'admin', 'accessed the Clients Module.', '2015-08-18 15:33:35'),
(180, 'admin', 'accessed the Transactions Module.', '2015-08-18 15:33:57'),
(181, 'admin', 'accessed the Transactions Module.', '2015-08-18 17:15:45'),
(182, 'admin', 'accessed the Clients Module.', '2015-08-18 20:24:48'),
(183, 'admin', 'accessed the Companies Module.', '2015-08-18 20:26:38'),
(184, 'admin', 'accessed the Clients Module.', '2015-08-18 20:26:41'),
(185, 'admin', 'accessed the Companies Module.', '2015-08-18 20:26:44'),
(186, 'admin', 'accessed the Clients Module.', '2015-08-18 20:26:53'),
(187, 'admin', 'accessed the Clients Module.', '2015-08-18 22:11:42'),
(188, 'admin', 'accessed the Companies Module.', '2015-08-18 22:23:08'),
(189, 'admin', 'accessed the Clients Module.', '2015-08-18 22:23:10'),
(190, 'admin', 'accessed the Companies Module.', '2015-08-18 22:23:10'),
(191, 'admin', 'accessed the Clients Module.', '2015-08-18 22:23:14'),
(192, 'admin', 'accessed the Companies Module.', '2015-08-18 22:41:13'),
(193, 'admin', 'accessed the Clients Module.', '2015-08-18 22:43:49'),
(194, 'admin', 'accessed the Companies Module.', '2015-08-18 22:43:50'),
(195, 'admin', 'accessed the Clients Module.', '2015-08-18 22:44:00'),
(196, 'admin', 'accessed the Transactions Module.', '2015-08-18 22:47:19'),
(197, 'admin', 'accessed the Clients Module.', '2015-08-18 23:12:54'),
(198, 'admin', 'accessed the Transactions Module.', '2015-08-18 23:58:59'),
(199, 'admin', 'accessed the Clients Module.', '2015-08-19 00:00:12'),
(200, 'admin', 'accessed the Users Module.', '2015-08-19 00:26:29'),
(201, 'admin', 'accessed the Bill of Lading Module.', '2015-08-19 00:27:15'),
(202, 'admin', 'accessed the Clients Module.', '2015-08-19 00:27:16'),
(203, 'admin', 'accessed the Bill of Lading Module.', '2015-08-19 00:28:58'),
(204, 'admin', 'accessed the Company Fix Rate Charges Module.', '2015-08-19 00:29:09'),
(205, 'admin', 'accessed the Users Module.', '2015-08-19 00:29:12'),
(206, 'admin', 'accessed the Global Positioning System Module.', '2015-08-19 00:29:13'),
(207, 'admin', 'accessed the Finances Module.', '2015-08-19 00:29:15'),
(208, 'admin', 'accessed the Transactions Module.', '2015-08-19 00:29:45'),
(209, 'admin', 'accessed the Bill of Lading Module.', '2015-08-19 00:29:45'),
(210, 'admin', 'accessed the Companies Module.', '2015-08-19 00:30:04'),
(211, 'admin', 'accessed the Clients Module.', '2015-08-19 00:30:10'),
(212, 'admin', 'accessed the Companies Module.', '2015-08-19 00:30:11'),
(213, 'admin', 'accessed the Clients Module.', '2015-08-19 00:30:43'),
(214, 'admin', 'accessed the Companies Module.', '2015-08-19 00:31:24'),
(215, 'admin', 'accessed the Clients Module.', '2015-08-19 00:31:26'),
(216, 'admin', 'accessed the Bill of Lading Module.', '2015-08-19 01:02:19'),
(217, 'admin', 'accessed the Transactions Module.', '2015-08-19 01:04:00'),
(218, 'admin', 'has logged out.', '2015-08-19 01:21:22'),
(219, 'admin', 'has logged in.', '2015-08-19 01:22:00'),
(220, 'admin', 'accessed the Transactions Module.', '2015-08-19 01:22:12'),
(221, 'admin', 'accessed the Bill of Lading Module.', '2015-08-19 01:24:44'),
(222, 'admin', 'accessed the Clients Module.', '2015-08-19 01:45:27'),
(223, 'admin', 'accessed the Transactions Module.', '2015-08-19 02:11:45'),
(224, 'admin', 'accessed the Bill of Lading Module.', '2015-08-19 02:23:25'),
(225, 'admin', 'accessed the Trucks Module.', '2015-08-19 02:23:27'),
(226, 'admin', 'accessed the Bill of Lading Module.', '2015-08-19 02:23:32'),
(227, 'admin', 'accessed the Transactions Module.', '2015-08-19 02:23:35'),
(228, 'admin', 'accessed the Companies Module.', '2015-08-19 02:23:40'),
(229, 'admin', 'accessed the Clients Module.', '2015-08-19 02:23:52'),
(230, 'admin', 'accessed the Transactions Module.', '2015-08-19 02:24:41'),
(231, 'admin', 'has logged out.', '2015-08-19 02:35:10'),
(232, 'admin', 'has logged in.', '2015-08-19 15:54:14'),
(233, 'admin', 'accessed the Transactions Module.', '2015-08-19 15:54:30'),
(234, 'admin', 'accessed the Bill of Lading Module.', '2015-08-19 16:04:38'),
(235, 'admin', 'accessed the Clients Module.', '2015-08-19 17:03:24'),
(236, 'admin', 'accessed the Transactions Module.', '2015-08-19 17:03:33'),
(237, 'admin', 'accessed the Bill of Lading Module.', '2015-08-19 17:12:46'),
(238, 'admin', 'accessed the Transactions Module.', '2015-08-19 17:33:50'),
(239, 'admin', 'has logged out.', '2015-08-19 17:34:19'),
(240, 'admin', 'has logged in.', '2015-08-19 18:16:12'),
(241, 'admin', 'accessed the Clients Module.', '2015-08-19 18:16:16'),
(242, 'admin', 'accessed the Companies Module.', '2015-08-19 18:17:08'),
(243, '', 'has logged out.', '2015-08-19 19:02:41'),
(244, 'admin', 'has logged in.', '2015-08-19 19:20:48'),
(245, 'admin', 'accessed the Clients Module.', '2015-08-19 19:20:52'),
(246, '', 'has logged out.', '2015-08-19 20:38:05'),
(247, 'admin', 'has logged in.', '2015-08-23 17:31:14'),
(248, 'admin', 'accessed the Transactions Module.', '2015-08-23 17:31:18'),
(249, 'admin', 'accessed the Bill of Lading Module.', '2015-08-23 17:31:19'),
(250, 'admin', 'accessed the Transactions Module.', '2015-08-23 17:31:20'),
(251, 'admin', 'has logged out.', '2015-08-23 17:31:42'),
(252, 'admin', 'has logged in.', '2015-08-25 02:58:56'),
(253, 'admin', 'accessed the Transactions Module.', '2015-08-25 02:59:03'),
(254, 'admin', 'has logged in.', '2015-08-25 16:17:39'),
(255, 'admin', 'accessed the Transactions Module.', '2015-08-25 16:21:12'),
(256, 'admin', 'has logged in.', '2015-08-31 17:05:00'),
(257, 'admin', 'has logged in.', '2015-09-01 20:49:13'),
(258, 'admin', 'has logged in.', '2015-09-01 21:04:37'),
(259, 'admin', 'accessed the Transactions Module.', '2015-09-01 21:16:27'),
(260, 'admin', 'accessed the Company Fix Rate Charges Module.', '2015-09-02 09:08:41'),
(261, 'admin', 'accessed the Transactions Module.', '2015-09-02 09:09:24'),
(262, 'admin', 'accessed the Transactions Module.', '2015-09-02 18:41:29'),
(263, 'admin', 'has logged in.', '2015-09-08 19:26:28'),
(264, 'admin', 'has logged in.', '2015-09-08 19:28:15'),
(265, 'admin', 'has logged out.', '2015-09-08 19:57:27'),
(266, 'admin', 'has logged in.', '2015-09-09 06:57:53'),
(267, 'admin', 'accessed the Company Fix Rate Charges Module.', '2015-09-09 07:02:42'),
(268, 'admin', 'accessed the Users Module.', '2015-09-09 09:03:05'),
(269, 'admin', 'accessed the Company Fix Rate Charges Module.', '2015-09-09 09:03:06'),
(270, 'admin', 'accessed the Transactions Module.', '2015-09-09 09:35:29'),
(271, 'admin', 'accessed the Company Fix Rate Charges Module.', '2015-09-09 09:42:19'),
(272, 'admin', 'has logged out.', '2015-09-09 09:57:05'),
(273, 'admin', 'has logged in.', '2015-09-09 17:44:53'),
(274, 'admin', 'accessed the Finances Module.', '2015-09-09 17:45:03'),
(275, 'admin', 'accessed the Transactions Module.', '2015-09-09 17:46:12'),
(276, 'admin', 'has logged in.', '2015-09-11 01:02:55'),
(277, 'admin', 'accessed the Users Module.', '2015-09-11 01:02:58'),
(278, 'admin', 'has logged out.', '2015-09-11 01:59:07'),
(279, 'admin', 'has logged in.', '2015-09-11 01:59:11'),
(280, '', 'has logged out.', '2015-09-11 03:23:11'),
(281, 'admin', 'has logged in.', '2015-09-11 03:23:15'),
(282, 'admin', 'has logged out.', '2015-09-11 03:27:59'),
(283, 'admin', 'has logged in.', '2015-09-11 03:28:32'),
(284, 'admin', 'has logged out.', '2015-09-11 04:16:27'),
(285, 'admin', 'has logged in.', '2015-09-11 04:16:29'),
(286, 'admin', 'has logged out.', '2015-09-11 04:17:25'),
(287, 'admin', 'has logged in.', '2015-09-11 04:17:28'),
(288, 'admin', 'has logged out.', '2015-09-11 04:18:46'),
(289, 'admin', 'has logged in.', '2015-09-11 04:18:49'),
(290, 'admin', 'has logged out.', '2015-09-11 04:19:30'),
(291, 'admin', 'has logged in.', '2015-09-11 04:19:33'),
(292, 'admin', 'has logged out.', '2015-09-11 04:20:13'),
(293, 'admin', 'has logged in.', '2015-09-11 04:20:15'),
(294, 'admin', 'has logged out.', '2015-09-11 04:21:27'),
(295, 'admin', 'has logged in.', '2015-09-11 04:24:08'),
(296, 'admin', 'accessed the Finances Module.', '2015-09-11 04:24:13'),
(297, 'admin', 'has logged out.', '2015-09-11 04:28:00'),
(298, 'admin', 'has logged in.', '2015-09-11 04:28:04'),
(299, 'admin', 'accessed the Finances Module.', '2015-09-11 04:28:10'),
(300, 'admin', 'accessed the Transactions Module.', '2015-09-11 04:30:23'),
(301, 'admin', 'accessed the Clients Module.', '2015-09-11 04:30:43'),
(302, 'admin', 'accessed the Transactions Module.', '2015-09-11 06:49:16'),
(303, '', 'has logged out.', '2015-09-11 07:16:50'),
(304, 'admin', 'has logged in.', '2015-09-11 08:56:10'),
(305, 'admin', 'accessed the Finances Module.', '2015-09-11 09:03:05'),
(306, 'admin', 'has logged in.', '2015-09-11 10:51:16'),
(307, 'admin', 'accessed the Transactions Module.', '2015-09-11 10:51:29'),
(308, 'admin', 'has logged out.', '2015-09-11 12:30:32'),
(309, 'admin', 'has logged in.', '2015-09-12 08:51:33'),
(310, 'admin', 'accessed the Transactions Module.', '2015-09-12 08:51:35'),
(311, 'admin', 'accessed the Transactions Module.', '2015-09-12 08:52:00'),
(312, 'admin', 'has logged out.', '2015-09-12 09:00:42'),
(313, 'admin', 'has logged in.', '2015-09-12 11:50:54'),
(314, 'admin', 'accessed the Finances Module.', '2015-09-12 11:51:03'),
(315, 'admin', 'accessed the Trucks Module.', '2015-09-12 18:23:42'),
(316, 'admin', 'accessed the Bill of Lading Module.', '2015-09-12 18:24:26'),
(317, 'admin', 'accessed the Finances Module.', '2015-09-12 18:25:11'),
(318, 'admin', 'accessed the Transactions Module.', '2015-09-12 18:25:48'),
(319, 'admin', 'has logged out.', '2015-09-12 18:27:15'),
(320, 'admin', 'has logged in.', '2015-09-15 20:40:13'),
(321, 'admin', 'accessed the Transactions Module.', '2015-09-15 20:40:17'),
(322, 'admin', 'accessed the Bill of Lading Module.', '2015-09-15 20:40:18'),
(323, 'admin', 'accessed the Clients Module.', '2015-09-15 20:40:19'),
(324, 'admin', 'has logged out.', '2015-09-15 20:41:14'),
(325, 'admin', 'has logged in.', '2015-09-15 20:44:20'),
(326, 'admin', 'accessed the Users Module.', '2015-09-15 20:44:24'),
(327, 'admin', 'accessed the Users Module.', '2015-09-15 20:47:41'),
(328, 'admin', 'accessed the Transactions Module.', '2015-09-15 20:48:27'),
(329, 'admin', 'accessed the Bill of Lading Module.', '2015-09-15 20:51:41'),
(330, 'admin', 'accessed the Clients Module.', '2015-09-15 20:51:43'),
(331, 'admin', 'accessed the Bill of Lading Module.', '2015-09-15 20:52:08'),
(332, 'admin', 'accessed the Transactions Module.', '2015-09-15 20:52:10'),
(333, 'admin', 'accessed the Trucks Module.', '2015-09-15 20:53:24'),
(334, 'admin', 'accessed the Finances Module.', '2015-09-15 20:54:27'),
(335, 'admin', 'accessed the Global Positioning System Module.', '2015-09-15 20:55:19'),
(336, 'admin', 'accessed the Users Module.', '2015-09-15 20:58:53'),
(337, 'admin', 'accessed the Company Fix Rate Charges Module.', '2015-09-15 20:59:00'),
(338, 'admin', 'has logged in.', '2015-09-15 14:42:35'),
(339, 'admin', 'accessed the Transactions Module.', '2015-09-15 14:42:42'),
(340, 'admin', 'accessed the Finances Module.', '2015-09-15 14:44:49'),
(341, 'admin', 'accessed the Transactions Module.', '2015-09-15 14:45:09'),
(342, 'admin', 'accessed the Finances Module.', '2015-09-15 14:46:18'),
(343, 'admin', 'accessed the Transactions Module.', '2015-09-15 14:54:46'),
(344, 'admin', 'accessed the Bill of Lading Module.', '2015-09-15 14:54:48'),
(345, 'admin', 'accessed the Transactions Module.', '2015-09-15 14:54:54'),
(346, 'admin', 'accessed the Bill of Lading Module.', '2015-09-15 14:56:10'),
(347, 'admin', 'accessed the Transactions Module.', '2015-09-15 14:56:48'),
(348, 'admin', 'accessed the Finances Module.', '2015-09-15 14:58:40'),
(349, 'admin', 'accessed the Transactions Module.', '2015-09-15 14:58:53'),
(350, 'admin', 'accessed the Finances Module.', '2015-09-15 15:18:09'),
(351, 'admin', 'accessed the Transactions Module.', '2015-09-15 15:18:12'),
(352, 'admin', 'accessed the Finances Module.', '2015-09-15 15:24:08'),
(353, 'admin', 'accessed the Transactions Module.', '2015-09-15 15:24:15'),
(354, 'admin', 'accessed the Bill of Lading Module.', '2015-09-15 15:24:18'),
(355, 'admin', 'accessed the Transactions Module.', '2015-09-15 15:25:22'),
(356, 'admin', 'accessed the Finances Module.', '2015-09-15 15:26:16'),
(357, 'admin', 'accessed the Transactions Module.', '2015-09-15 15:26:18'),
(358, 'admin', 'accessed the Finances Module.', '2015-09-15 15:27:00'),
(359, 'admin', 'accessed the Bill of Lading Module.', '2015-09-15 15:32:28'),
(360, 'admin', 'accessed the Transactions Module.', '2015-09-15 15:33:35'),
(361, 'admin', 'has logged in.', '2015-12-05 06:20:16'),
(362, 'admin', 'accessed the Company Fix Rate Charges Module.', '2015-12-05 06:20:19'),
(363, 'admin', 'accessed the Users Module.', '2015-12-05 06:20:20'),
(364, 'admin', 'accessed the Global Positioning System Module.', '2015-12-05 06:20:21'),
(365, 'admin', 'accessed the Finances Module.', '2015-12-05 06:20:22'),
(366, 'admin', 'accessed the Trucks Module.', '2015-12-05 06:20:22'),
(367, 'admin', 'accessed the Finances Module.', '2015-12-05 06:20:23'),
(368, 'admin', 'accessed the Clients Module.', '2015-12-05 06:20:38'),
(369, 'admin', 'has logged out.', '2015-12-05 06:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `misc`
--

CREATE TABLE IF NOT EXISTS `misc` (
`Miscellaneous_ID` int(10) NOT NULL,
  `Waybill_Number` char(13) NOT NULL,
  `Miscellaneous` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `misc`
--

INSERT INTO `misc` (`Miscellaneous_ID`, `Waybill_Number`, `Miscellaneous`) VALUES
(1, '2015070194844', 10000),
(2, '2015070194844', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `Payment_ID` char(10) NOT NULL,
  `Bank_Name` varchar(150) NOT NULL,
  `Cheque_Number` varchar(50) NOT NULL,
  `Cheque_Date` date NOT NULL,
  `Amount` double NOT NULL,
  `Mode_of_Payment` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Bank_Name`, `Cheque_Number`, `Cheque_Date`, `Amount`, `Mode_of_Payment`) VALUES
('2576093043', 'Banko De Oro', '1DG68D53SB1X', '2015-08-18', 250000, 'Cheque'),
('3655908888', '', '', '2015-09-15', 0, 'Cash'),
('4491143745', '', '', '2015-09-15', 0, 'Cash'),
('5882644891', '', '', '2015-09-02', 556824.181, 'Cash'),
('6814838790', '', '', '2015-09-15', 0, 'Cash'),
('7985805463', '', '', '2015-08-18', 50000, 'Cash'),
('8221112187', '', '', '2015-08-18', 50000, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `Payment_ID` char(10) NOT NULL,
  `Waybill_Number` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`Payment_ID`, `Waybill_Number`) VALUES
('2576093043', '2015070194844'),
('7985805463', '2015070194844'),
('8221112187', '2015070194844'),
('', '2015070194844'),
('5882644891', '2015070194844'),
('', '2015070194844'),
('4491143745', '2015082325413'),
('3655908888', '2015091501597'),
('6814838790', '2015091520891');

-- --------------------------------------------------------

--
-- Table structure for table `trucks`
--

CREATE TABLE IF NOT EXISTS `trucks` (
`Truck_ID` int(10) NOT NULL,
  `Truck_Name` char(50) NOT NULL,
  `IMEI_Number` char(50) NOT NULL,
  `Current_Location` char(255) NOT NULL,
  `Status` char(8) NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trucks`
--

INSERT INTO `trucks` (`Truck_ID`, `Truck_Name`, `IMEI_Number`, `Current_Location`, `Status`) VALUES
(1, 'TR02-28497', '358899052528497', '', 'Active'),
(2, 'TR-28796', '358899052528653', '', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `waybills`
--

CREATE TABLE IF NOT EXISTS `waybills` (
  `Waybill_Number` char(13) NOT NULL,
  `Description` char(255) NOT NULL,
  `Transaction_Date` date NOT NULL,
  `Mode_of_Transaction` char(12) NOT NULL,
  `Container_Size` char(10) NOT NULL,
  `Pickup_Location` char(255) NOT NULL,
  `Datetime_Picked` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Delivery_Location` char(255) NOT NULL,
  `Datetime_Delivered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Credit` double NOT NULL DEFAULT '0',
  `Debit` double NOT NULL DEFAULT '0',
  `Delivery_Status` char(8) NOT NULL DEFAULT 'Inactive',
  `Datetime_Complied` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Display` char(4) NOT NULL DEFAULT 'Show',
  `Bill_of_Lading_ID` char(15) NOT NULL DEFAULT '-1',
  `Client_ID` int(10) NOT NULL DEFAULT '-1',
  `Truck_ID` int(10) NOT NULL DEFAULT '-1',
  `Status` char(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waybills`
--

INSERT INTO `waybills` (`Waybill_Number`, `Description`, `Transaction_Date`, `Mode_of_Transaction`, `Container_Size`, `Pickup_Location`, `Datetime_Picked`, `Delivery_Location`, `Datetime_Delivered`, `Credit`, `Debit`, `Delivery_Status`, `Datetime_Complied`, `Display`, `Bill_of_Lading_ID`, `Client_ID`, `Truck_ID`, `Status`) VALUES
('2015070194844', 'Test', '2015-08-01', 'Warehouse', '20 feet', '', '0000-00-00 00:00:00', 'Sampaloc, Manila', '0000-00-00 00:00:00', 443175.82, 556824.18, 'Active', '0000-00-00 00:00:00', 'Hide', 'TESTLADING101', 1, 1, 'Active'),
('2015082325413', '', '2015-08-23', 'Door to Door', '40 feet', '', '0000-00-00 00:00:00', 'asd', '0000-00-00 00:00:00', 0, 101234, 'Active', '0000-00-00 00:00:00', 'Show', 'TESTLADING102', 1, 1, 'Active'),
('2015091501597', 'rgbrbr', '2015-09-15', 'Door to Door', '20 feet', '', '0000-00-00 00:00:00', 'dfvfdv', '0000-00-00 00:00:00', 0, 0, 'Inactive', '0000-00-00 00:00:00', 'Show', 'test', 2, -1, 'Active'),
('2015091520891', 'gjgjhg', '2015-09-15', 'Door to Door', '40 feet', '', '0000-00-00 00:00:00', 'sampaloc manila', '0000-00-00 00:00:00', 0, 200000, 'Inactive', '0000-00-00 00:00:00', 'Show', '345345234', 3, -1, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`Account_Username`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
 ADD PRIMARY KEY (`Client_ID`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
 ADD PRIMARY KEY (`Company_ID`);

--
-- Indexes for table `ladings`
--
ALTER TABLE `ladings`
 ADD PRIMARY KEY (`Bill_of_Lading_Number`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
 ADD PRIMARY KEY (`Log_ID`);

--
-- Indexes for table `misc`
--
ALTER TABLE `misc`
 ADD PRIMARY KEY (`Miscellaneous_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`Payment_ID`);

--
-- Indexes for table `trucks`
--
ALTER TABLE `trucks`
 ADD PRIMARY KEY (`Truck_ID`);

--
-- Indexes for table `waybills`
--
ALTER TABLE `waybills`
 ADD PRIMARY KEY (`Waybill_Number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
MODIFY `Client_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
MODIFY `Company_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
MODIFY `Log_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=370;
--
-- AUTO_INCREMENT for table `misc`
--
ALTER TABLE `misc`
MODIFY `Miscellaneous_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `trucks`
--
ALTER TABLE `trucks`
MODIFY `Truck_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
