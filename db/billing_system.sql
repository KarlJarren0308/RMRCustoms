-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2015 at 06:05 PM
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
('AlyssInWonderland', 'asd123456', 'Clerk', 'Alyssa Marie', 'Pielago', 'Yaun', 'Female', 'Active', 'alyssa.jpg'),
('admin', 'admin', 'Administrator', 'Akihiko', '', 'Kayaba', 'Male', 'Active', 'kayaba.jpg'),
('dummy', 'dummy', 'Clerk', 'dummy', 'dummy', 'dummy', 'Male', 'Active', 'unknown.png'),
('KaaruMakuzo', 'jinjinko', 'President', 'Kaaru', '', 'Makuzo', 'Male', 'Active', 'sulli.png');

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
  `Company_ID` int(10) NOT NULL,
  `Added_By` char(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Date_Added` date NOT NULL,
  `Updated_By` char(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Date_Updated` date NOT NULL,
  `Status` char(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`Client_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Address`, `Email_Address`, `Contact_Number`, `Company_ID`, `Added_By`, `Date_Added`, `Updated_By`, `Date_Updated`, `Status`) VALUES
(1, 'Karl Jarren', 'Tolentino', 'Macadangdang', 'Sampaloc, Manila', 'karl.macz@gmail.com', '', 7, 'admin', '2015-04-06', 'admin', '2015-05-19', 'Active'),
(2, 'Bill Christian', 'Mercado', 'Sychua', 'Retiro, Quezon City', '', '', -1, 'admin', '2015-04-11', 'admin', '2015-04-27', 'Active'),
(3, 'Ric Christopher', 'Escueta', 'Vega', 'Tayuman Street, Quezon City', '', '', -1, 'admin', '2015-04-11', 'admin', '2015-04-27', 'Active'),
(4, 'Francis', 'Sagibo', 'Dy', 'Novaliches, Quezon City', '', '', -1, 'admin', '2015-04-11', '', '0000-00-00', 'Active'),
(5, 'Jean', 'Terre', 'Ocampo', 'Adelita Chioco Street, ParaÃ±aque City', '', '', -1, 'admin', '2015-04-11', '', '0000-00-00', 'Active'),
(6, 'Emilio', 'Pandy', 'Bautista', 'Project 8, Quezon City', '', '', -1, 'admin', '2015-04-11', '', '0000-00-00', 'Active'),
(7, 'Kyle', 'Manotoc', 'Flores', 'Amoranto Ipo Street, Quezon City', '', '', -1, 'admin', '2015-04-11', '', '0000-00-00', 'Active'),
(8, 'Billy', 'Santos', 'Roque', 'Sampaloc, Manila', '', '', -1, 'admin', '2015-04-12', '', '0000-00-00', 'Active'),
(9, 'Anna Clarise', 'Mayo', 'Dizon', 'Tondo, Manila', '', '', -1, 'admin', '2015-04-12', '', '0000-00-00', 'Active'),
(10, 'Dianna Marie', 'Valdez', 'Dela Cruz', 'Tondo, Manila', '', '', -1, 'admin', '2015-04-12', 'admin', '2015-05-03', 'Active'),
(13, 'Not Available', 'Not Available', 'Not Available', '', '', '', 4, 'AlyssInWonderland', '2015-05-13', 'admin', '2015-05-20', 'Active'),
(14, 'Not Available', 'Not Available', 'Not Available', '', '', '', 8, 'admin', '2015-05-19', '', '0000-00-00', 'Inactive'),
(15, 'Kaaru', '', 'Makuzo', 'Tokyo, Japan', 'makuzo.kaaru@gmailu.com', '', 0, 'admin', '2015-05-25', '', '0000-00-00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
`Company_ID` int(10) NOT NULL,
  `Company_Name` char(100) NOT NULL,
  `Company_Address` char(255) NOT NULL,
  `Company_Contact_Number` char(12) NOT NULL,
  `Company_Head_Office_Address` char(250) NOT NULL,
  `Company_Email_Address` char(50) NOT NULL,
  `Zip_Code` char(10) NOT NULL,
  `Primary_Contact` char(150) NOT NULL,
  `Primary_Contact_Company_Position` char(50) NOT NULL,
  `Primary_Contact_Email` char(50) NOT NULL,
  `Primary_Contact_Phone_Number` char(15) NOT NULL,
  `Main_Business_Activities` char(50) NOT NULL,
  `Country` char(50) NOT NULL,
  `Corporate_Currency` char(15) NOT NULL,
  `Default_Language` char(50) NOT NULL,
  `Default_Time_Zone` char(50) NOT NULL,
  `Fax` char(15) NOT NULL,
  `Phone_Number` char(15) NOT NULL,
  `Established` char(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`Company_ID`, `Company_Name`, `Company_Address`, `Company_Contact_Number`, `Company_Head_Office_Address`, `Company_Email_Address`, `Zip_Code`, `Primary_Contact`, `Primary_Contact_Company_Position`, `Primary_Contact_Email`, `Primary_Contact_Phone_Number`, `Main_Business_Activities`, `Country`, `Corporate_Currency`, `Default_Language`, `Default_Time_Zone`, `Fax`, `Phone_Number`, `Established`) VALUES
(4, 'Tambay Society', 'Tondo, Manila', '1234567', 'Tondo, Manila', 'master.tambz@tambaysociety.com', '1234', 'Master Tamby', 'President', 'master.tambz@gmail.com', '1234560', 'Retailer', 'Philippines', 'Peso', 'Tagalog', 'Asia/Manila', '1234567890', '0000001', 'Tondo, Manila'),
(7, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, '1', '1', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 'Kotaku', 'Tokyo, Japan', '123-4567', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ladings`
--

CREATE TABLE IF NOT EXISTS `ladings` (
  `Bill_of_Lading_ID` char(15) NOT NULL,
  `Consignee` char(250) NOT NULL,
  `Export_References` char(250) NOT NULL,
  `Item_Mark` varchar(2500) NOT NULL,
  `Item_Quantity` varchar(2500) NOT NULL,
  `Item_Description` varchar(2500) NOT NULL,
  `Date_of_Transaction` date NOT NULL,
  `Status` char(8) NOT NULL DEFAULT 'Active',
  `Date_Added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ladings`
--

INSERT INTO `ladings` (`Bill_of_Lading_ID`, `Consignee`, `Export_References`, `Item_Mark`, `Item_Quantity`, `Item_Description`, `Date_of_Transaction`, `Status`, `Date_Added`) VALUES
('TESTLADING001', 'Jinri Choi', 'No Export References Available', '[]', '[]', '[]', '2015-06-02', 'Active', '2015-06-02'),
('TESTLADING002', 'Jinri Choi', 'No Export References', '[]', '[]', '[]', '2015-06-02', 'Active', '2015-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
`Log_ID` int(10) NOT NULL,
  `Account_Username` char(10) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Log` char(255) NOT NULL,
  `Log_Datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`Log_ID`, `Account_Username`, `Log`, `Log_Datetime`) VALUES
(1, 'admin', 'accessed the Bill of Lading Module.', '2015-06-02 19:43:07'),
(2, 'admin', 'has logged in.', '2015-06-02 22:46:38'),
(3, 'admin', 'accessed the Transactions Module.', '2015-06-02 22:46:43'),
(4, 'admin', 'accessed the Trucks Module.', '2015-06-02 22:46:46'),
(5, 'admin', 'accessed the Transactions Module.', '2015-06-02 22:51:57'),
(6, 'admin', 'accessed the Bill of Lading Module.', '2015-06-02 23:03:08'),
(7, 'admin', 'accessed the Transactions Module.', '2015-06-02 23:03:09'),
(8, 'admin', 'accessed the Bill of Lading Module.', '2015-06-02 23:40:04'),
(9, 'admin', 'accessed the Transactions Module.', '2015-06-02 23:40:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trucks`
--

INSERT INTO `trucks` (`Truck_ID`, `Truck_Name`, `IMEI_Number`, `Current_Location`, `Status`) VALUES
(1, 'TR02-28497', '358899052528497', '', 'Inactive');

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
  `Cheque_Number` varchar(2500) NOT NULL DEFAULT '[]',
  `Bank_Name` varchar(2500) NOT NULL DEFAULT '[]',
  `Cheque_Date` varchar(2500) NOT NULL DEFAULT '[]',
  `Credit` double NOT NULL DEFAULT '0',
  `Debit` double NOT NULL DEFAULT '0',
  `Delivery_Status` char(8) NOT NULL DEFAULT 'Inactive',
  `Bill_of_Lading_ID` char(15) NOT NULL DEFAULT '-1',
  `Client_ID` int(10) NOT NULL DEFAULT '-1',
  `Truck_ID` int(10) NOT NULL DEFAULT '-1',
  `Status` char(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waybills`
--

INSERT INTO `waybills` (`Waybill_Number`, `Description`, `Transaction_Date`, `Mode_of_Transaction`, `Container_Size`, `Pickup_Location`, `Datetime_Picked`, `Delivery_Location`, `Datetime_Delivered`, `Cheque_Number`, `Bank_Name`, `Cheque_Date`, `Credit`, `Debit`, `Delivery_Status`, `Bill_of_Lading_ID`, `Client_ID`, `Truck_ID`, `Status`) VALUES
('2015060208662', 'Test Transaction 001', '2015-06-02', 'Door to Door', '20 feet', '', '0000-00-00 00:00:00', 'Sampaloc, Manila', '0000-00-00 00:00:00', '[]', '[]', '[]', 500000, 500000, 'Complied', 'TESTLADING001', 1, 1, 'Active'),
('2015060229583', 'Test Transaction 002', '2015-06-02', 'Warehouse', '40 feet', '', '0000-00-00 00:00:00', 'Tondo, Manila', '0000-00-00 00:00:00', '[]', '[]', '[]', 0, 0, 'Complied', 'TESTLADING002', 13, 1, 'Inactive');

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
 ADD PRIMARY KEY (`Bill_of_Lading_ID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
 ADD PRIMARY KEY (`Log_ID`);

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
MODIFY `Client_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
MODIFY `Company_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
MODIFY `Log_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `trucks`
--
ALTER TABLE `trucks`
MODIFY `Truck_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
