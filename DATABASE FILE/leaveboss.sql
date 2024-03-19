-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 07:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leaveboss`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(55) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `fullname`, `email`, `updationDate`) VALUES
(1, 'admin', 'd00f5d5217896fb7fd601412cb890830', 'Racheal Mbeyu', 'racheal003@gmail.com', '2024-02-05 10:31:06'),
(2, 'evanik', '4aae4db785a8bc351d44761e57e781f7', 'Evans Ngebe', 'evanskatana7025@gmail.com', '2024-02-12 07:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `DepartmentCode` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`, `DepartmentCode`, `CreationDate`) VALUES
(1, 'Health and Sanitation Services', 'HSS', 'HSS001', '2024-02-06 06:38:18'),
(2, 'Quality Education', 'QE', 'QE002', '2024-02-06 06:38:33'),
(3, 'Water & Agriculture', 'WA', 'WA003', '2024-02-06 06:38:46'),
(4, 'Tourism & Culture', 'TC', 'TC004', '2024-02-06 06:39:00'),
(5, 'Commerce & Industry', 'CI', 'CI005', '2024-02-06 06:39:14'),
(6, 'Women & Youth empowerment', 'WY', 'WY006', '2024-02-06 06:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `id` int(11) NOT NULL,
  `EmpId` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(200) NOT NULL,
  `County` varchar(150) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`id`, `EmpId`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Dob`, `Department`, `Address`, `City`, `County`, `Phonenumber`, `Status`, `RegDate`) VALUES
(1, 'ASTR001245', 'John', 'Mwachiro', 'johnny@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Male', '1996-06-12', 'Tourism & Culture', '2 Kilifi', 'Kilifi', 'Kilifi', '0754785477', 1, '2024-02-06 08:18:10'),
(2, 'ASTR001369', 'Milton', 'Wanje', 'milt@mail.com', 'f925916e2754e5e03f75dd58a5733251', 'Male', '1990-02-02', 'Health and Sanitation Services', '15 Kibaoni Road', 'Kilifi', 'Kilifi', '0701234567', 1, '2024-02-06 08:18:56'),
(3, 'ASTR004699', 'Shawn', 'Den', 'Shawnden@mail.com', '3b87c97d15e8eb11e51aa25e9a5770e9', 'Male', '1995-03-22', 'Quality Education', '239 Desert Court', 'Wayne', 'US', '0758887169', 1, '2024-02-06 08:19:26'),
(4, 'ASTR002996', 'Carol', 'Mwamburi', 'carol@mail.com', '723e1489a45d2cbaefec82eee410abd5', 'Female', '1989-03-23', 'Health and Sanitation Services', '11:21:20', 'Charo Wa Mae', 'Kilifi', '0754448550', 1, '2024-02-06 08:21:20'),
(5, 'ASTR001439', 'Danny', 'Chala', 'danny@mail.com', 'b7bee6b36bd35b773132d4e3a74c2bb5', 'Male', '1986-03-12', 'Women & Youth empowerment', '11 Rardin Drive', 'Kinango', 'Kwale', '0787777744', 1, '2024-02-06 08:23:05'),
(6, 'ASTR006946', 'Shawn', 'Mwamburi', 'shawn@mail.com', 'a3cceba83235dc95f750108d22c14731', 'Male', '1992-08-28', 'Tourism & Culture', '3259 Ray Court', 'Voi', 'Taita-Taveta', '0720259670', 1, '2024-02-06 08:24:17'),
(7, 'ASTR000084', 'Jennifer', 'Mwango', 'jennifer@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Female', '1992-12-11', 'Commerce & Industry', '977 Smithfield Avenue', 'Malindi', 'Kilifi', '0701256696', 1, '2024-02-06 08:25:30'),
(8, 'ASTR012447', 'Williams', 'Ngala', 'williams@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Male', '1992-02-15', 'Water & Agriculture', '366 Cemetery Street', 'Kaloleni', 'Kilifi', '0754000065', 1, '2024-02-06 08:27:21'),
(10, 'QER4496', 'Grace', 'Kazungu', 'gracekazungu@gmail.com', '8a473bf96ae3b5332a6ae6b99073c931', 'Female', '1997-09-06', 'Quality Education', '999 Sea Breeze Lane', 'Kwale', 'Kwale', '0723456789', 1, '2024-02-06 09:44:44'),
(11, 'WAW5621', 'David ', 'Mwandikwa ', 'davidmwandikwa@gmail.com', '9f5dc74b740e86dd30f57768f3d3e257', 'Male', '1994-02-08', 'Water & Agriculture', '111 Oceanic Avenue', 'Kilifi', 'Kilifi', '0723456789', 1, '2024-02-06 09:46:41'),
(12, 'HSS0115', 'Rachel ', 'Mwajuma ', 'rachelmwajuma@gmail.com', 'fa935f0558515ca7743060944bf555d4', 'Female', '1991-12-22', 'Health and Sanitation Services', '222 Sandy Beach', 'Malindi', 'Kilifi', '0723456789', 1, '2024-02-06 09:49:51'),
(13, 'QER1198', 'Andrew', 'Wamalwa', 'andrewwamalwa@gmail.com', 'b4ce1e078d5ac47434d0dda3f0dd62fd', 'Male', '1985-08-06', 'Quality Education', '333 Seaview Drive', 'Mombasa', 'Mombasa', '0723456789', 1, '2024-02-06 10:04:49'),
(14, 'TCR2276', 'Lucy', ' Mwakirunge ', 'lucymwakirunge@gmail.com', '6c33baf84fc7f2f8f0dc297d90083340', 'Female', '1969-09-02', 'Tourism & Culture', ' 444 Coastal Hola', 'Hola', 'Tana River', '0723456789', 1, '2024-02-06 10:07:24'),
(15, 'CIR3419', 'Patrick ', 'Mwalimu', 'patrickmwalimu@gmail.com', '812d0c62d36309276de8b60be6e5ef37', 'Male', '1988-08-12', 'Commerce & Industry', '666 Kisauni Avenue', 'Kisauni', 'Mombasa', ' 072345678', 1, '2024-02-06 10:09:36'),
(16, 'CIR3419', 'Patrick ', 'Mwalimu', 'patrickmwalimu@gmail.com', '812d0c62d36309276de8b60be6e5ef37', 'Male', '1988-08-12', 'Commerce & Industry', '666 Kisauni Avenue', 'Kisauni', 'Mombasa', ' 072345678', 1, '2024-02-06 10:10:06'),
(17, 'WYR4805 ', 'Esther ', 'Mwanahamisi ', 'esthermwanahamisi@gmail.com', 'a83bfc7288dfe2e081093f70234166ee', 'Female', '1995-09-09', 'Women & Youth empowerment', '5 Kaloleni Rd', 'Kaloleni', 'Kilifi', ' 072345678', 1, '2024-02-06 10:12:01'),
(18, 'CII5982', 'Peter ', 'Mwarabu', 'petermwarabu@gmail.com', '687ff4379a05f9741e0874eda25bec2e', 'Male', '1991-06-02', 'Commerce & Industry', '122 Mariakani Rd', 'Mariakani', 'Kilifi', ' 072345678', 1, '2024-02-06 10:14:10'),
(19, 'CII5982', 'Peter ', 'Mwarabu', 'petermwarabu@gmail.com', '687ff4379a05f9741e0874eda25bec2e', 'Male', '1991-06-02', 'Commerce & Industry', '122 Mariakani Rd', 'Mariakani', 'Kilifi', ' 072345678', 1, '2024-02-06 10:14:28'),
(20, 'WYR4805 ', 'Esther ', 'Mwanahamisi ', 'esthermwanahamisi@gmail.com', 'a83bfc7288dfe2e081093f70234166ee', 'Female', '1995-09-09', 'Women & Youth empowerment', '5 Kaloleni Rd', 'Kaloleni', 'Kilifi', ' 072345678', 1, '2024-02-06 10:14:35'),
(21, 'WAE6753', 'Susan  ', 'Mwangala', 'susanmwangala@gmail.com', '11ea86edf8455a3d709aeecc661ec756', 'Female', '1995-06-12', 'Water & Agriculture', '456 Ukunda Rd', 'Ukunda', 'Kwale', '0723456789', 1, '2024-02-06 10:16:19'),
(22, 'WYR7150', 'John ', 'Munyazi', 'johnmunyazi@gmail.com', '56aeba194326d86e0ffd389f610feaae', 'Male', '1989-09-12', 'Women & Youth empowerment', '45 Mwatate', 'Voi', 'Taita-Taveta ', '0723456789', 1, '2024-02-06 10:18:24'),
(23, 'TCR8446', 'Mary ', 'Marere', 'marymarere@gmail.com', 'c3edf6d094f2187123ad077b61dae1d5', 'Female', '1978-08-05', 'Tourism & Culture', '222 Garsen ', 'Garsen', 'Tana River', ' 072345678', 1, '2024-02-06 10:21:57'),
(24, 'CIR9283 ', 'Joshua ', 'Mbiri', 'joshuambiri@gmail.com', 'c6adcf303d9726cce44a65cfa006dafa', 'Male', '1992-01-07', 'Commerce & Industry', ' 333 Miritini', 'Mombasa', 'Mombasa', '0723456789', 1, '2024-02-06 10:24:40'),
(25, 'HSS2873', 'Alice', ' Mwanaidi ', 'alicemwanaidi@gmail.com', '24681af6d41279775136453a9a894a10', 'Female', '1990-12-25', 'Health and Sanitation Services', '12 Jomvu', 'Jomvu', 'Mombasa', '0723456789', 1, '2024-02-06 17:22:46'),
(26, ' QER4820', 'Joseph ', 'Mwanaisha', 'josephmwanaisha@gmail.com', 'a7ec5143e68a90b84fc6401cb2e36688', 'Male', '1986-07-08', 'Quality Education', '555 Kwale', 'Kwale', 'Kwale', '0723456789', 1, '2024-02-06 17:26:34'),
(27, 'WAE5732', 'Victoria ', 'Mwangeka', 'victoriamwangeka@gmail.com', 'bf0feb71a2591e92ffd7c850ac4c06d7', 'Female', '1993-02-23', 'Water & Agriculture', '34 Kaloleni', 'Kaloleni', 'Kilifi', '0723456789', 1, '2024-02-06 17:29:28'),
(28, 'TCR6281', 'Thomas ', 'Mwamba', 'thomasmwamba@gmail.com', 'aa57e509286089d8c11d9558e9f1e178', 'Male', '1978-05-23', 'Tourism & Culture', '777  Bura', 'Bura', 'Tana River', '0723456789', 1, '2024-02-06 17:32:00'),
(29, 'HSS7302', 'Hannah ', 'Mwajuma', 'hannahmwajuma@gmail.com', 'c88d8acad162fe2a07e7b53648fd172c', 'Female', '1988-09-05', 'Health and Sanitation Services', '45 Malindi', 'Malindi', 'Kilifi', '0723456789', 1, '2024-02-06 17:33:49'),
(30, 'HSS7302', 'Hannah ', 'Mwajuma', 'hannahmwajuma@gmail.com', 'c88d8acad162fe2a07e7b53648fd172c', 'Female', '1988-09-05', 'Health and Sanitation Services', '45 Malindi', 'Malindi', 'Kilifi', '0723456789', 1, '2024-02-06 17:34:02'),
(31, 'CII8594', 'Simon ', 'Mwabwoga', 'simonmwabwoga@gmail.com', '010eedd14443538fe4660031e0ae6c1b', 'Male', '1987-12-07', 'Commerce & Industry', '23 Tezo', 'Kilifi', 'Kilifi', '0723456789', 1, '2024-02-06 17:35:56'),
(32, 'WYR9147 ', 'Naomi ', 'Mwadziwa', 'naomimwadziwa@gmail.com', '723433c42ff682ac0d10fe4bd7d81a80', 'Female', '1985-05-06', 'Commerce & Industry', '101 Malindi', 'Malindi', 'Kilifi', ' 072345678', 1, '2024-02-06 17:37:52'),
(33, 'QER3712 ', 'Mark', 'Mwajuma', 'markmwajuma@gmail.com', '0defaa15829ea778ae3b49f969792f53', 'Male', '1984-06-05', 'Quality Education', '202 Mshomoroni', 'Mombasa', 'Mombasa', '0723456789', 1, '2024-02-06 17:39:32'),
(34, 'QER3712 ', 'Mark', 'Mwajuma', 'markmwajuma@gmail.com', '0defaa15829ea778ae3b49f969792f53', 'Male', '1984-06-05', 'Quality Education', '202 Mshomoroni', 'Mombasa', 'Mombasa', '0723456789', 1, '2024-02-06 17:39:45'),
(35, ' WAE4298 ', 'Priscilla ', 'Mwanajuma', 'priscillamwanajuma@gmail.com', '8fda5fe93ebe367967236cfa43d1a6a3', 'Female', '1982-06-05', 'Women & Youth empowerment', '54 Kinango', 'Kwale', 'Kwale', '0723456789', 1, '2024-02-06 17:41:16'),
(36, 'TCR5203 ', 'Stephen ', 'Mwangaza', 'stephenmwangaza@gmail.com', '7e797b33e601c0d32621e056865a328f', 'Male', '1982-05-08', 'Tourism & Culture', '582 Hola', 'Tana River', 'Tana River', '0723456789', 1, '2024-02-06 17:43:09'),
(37, ' WAE4298 ', 'Priscilla ', 'Mwanajuma', 'priscillamwanajuma@gmail.com', '8fda5fe93ebe367967236cfa43d1a6a3', 'Female', '1982-06-05', 'Women & Youth empowerment', '54 Kinango', 'Kwale', 'Kwale', '0723456789', 1, '2024-02-06 17:43:22'),
(38, 'CIR2391 ', 'Diana ', 'Mwangole', 'dianamwangole@gmail.com', '9fd3238a29816e2ef919a10cfd5470dc', 'Male', '1997-09-08', 'Commerce & Industry', '98 Kilifi', 'Kilifi', 'Kilifi', ' 072345678', 1, '2024-02-06 17:44:41'),
(39, 'HSS6824', 'Brian ', 'Mwatsefu', 'brianmwatsefu@gmail.com', 'c3f8c0e5da8ed6c39bffa17ecef1402c', 'Male', '1991-08-07', 'Health and Sanitation Services', '46 Malindi', 'Malindi', 'Kilifi', '0723456789', 1, '2024-02-06 17:46:12'),
(40, '-CII5628 ', 'Joshua', ' Kamau ', 'joshuakamau@gmail.com', '2ab5b6817fdf336851ee782831525f1a', 'Male', '1989-04-05', 'Commerce & Industry', '45 Thika', 'Thika', 'Kiambu', ' 072345678', 1, '2024-02-06 17:47:58'),
(41, 'WAE7394 ', 'Mary ', 'Wanjiku', 'marywanjiku@gmail.com', '625713584b99f5be479019097338144c', 'Female', '1979-09-08', 'Water & Agriculture', '456 Elm Avenue', 'Nakuru ', 'Nakuru ', '0723456789', 1, '2024-02-06 17:49:24'),
(42, 'QER6281', 'Peter ', 'Kiprop', 'peterkiprop@gmail.com', '228238a24f6ee79385adfd46cff1de70', 'Male', '1986-09-08', 'Quality Education', '789 Eldoret', 'Eldoret', 'Uasin Gishu ', '0723456789', 1, '2024-02-06 17:50:59'),
(43, 'HSS8492', 'Sarah', ' Chebet', 'sarahchebet@gmail.com', 'ac9ff2c55f2e87fbb0c62401ec355a3e', 'Female', '1988-08-07', 'Health and Sanitation Services', '679 Kisumu', 'Kisumu', 'Kisumu', '0723456789', 1, '2024-02-06 17:52:42'),
(44, 'TCR2937', 'Daniel', ' Ochieng', 'danielochieng@gmail.com', '53291ff5b6cf5d1e7d6f721c6db6776a', 'Male', '1983-03-04', 'Tourism & Culture', '321 Pine Street', 'Nakuru', 'Nakuru', '0723456789', 1, '2024-02-06 17:54:39'),
(45, 'CIR4839', 'Grace', 'Njeri', 'gracenjeri@gmail.com', 'c85d951fdd532404f6194bf202d1c501', 'Female', '1990-06-07', 'Commerce & Industry', '555 Cedar Road', ' Nyeri', ' Nyeri', '0723456789', 1, '2024-02-06 17:56:11'),
(46, 'WYR7301', 'Joseph ', 'Kipchirchir', 'josephkipchirchir@gmail.com', '03cc93eaa12ccf2a43df15eedf14a51e', 'Male', '1984-05-06', 'Women & Youth empowerment', '777 Eldoret', 'Eldoret', 'Uasin Gishu', ' 072345678', 1, '2024-02-06 17:57:46'),
(47, 'CII3948', 'Lucy ', 'Auma', 'lucyauma@gmail.com', '9864eef54498438260f3c5a27dfd4d6b', 'Female', '1974-04-05', 'Commerce & Industry', '458 Kakamega', 'Kakamega', 'Kakamega', ' 072345678', 1, '2024-02-06 17:59:53'),
(48, 'CII2937', 'Esther', ' Chemutai', 'estherchemutai@gmail.com', 'd51ec3c496f4be0cf49cad7e811d4f91', 'Female', '1979-05-06', 'Tourism & Culture', '567 Eldoret', 'Eldoret', ' Uasin Gishu ', '0723456789', 1, '2024-02-06 18:03:09'),
(49, ' HSS2459', 'Sarah ', 'Wanje', 'sarahwanje@gmail.com', 'c9e5db13c471273319616c33ec561519', 'Female', '1990-04-05', 'Health and Sanitation Services', '122 Kaloleni', 'Kilifi', 'Kilifi', '0723456789', 1, '2024-02-06 18:05:07'),
(50, ' WYR1078 ', 'Jennifer ', 'Charo', 'jennifercharo@gmail.com', 'c3ce3906f4c00ae93b26c50d4ab1228c', 'Female', '1975-04-05', 'Women & Youth empowerment', '123 Kilifi', 'Kilifi', 'Kilifi', '0723456789', 1, '2024-02-06 18:06:57'),
(51, 'HSS0001', 'Evans', 'Ngebe', 'evanskatana7025@gmail.com', '4aae4db785a8bc351d44761e57e781f7', 'Male', '2001-09-03', 'Health and Sanitation Services', '5 Kaloleni', 'Kilifi', 'Kilifi', '0759284042', 1, '2024-02-06 18:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `tblleaves`
--

CREATE TABLE `tblleaves` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(110) NOT NULL,
  `ToDate` varchar(120) NOT NULL,
  `FromDate` varchar(120) NOT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

CREATE TABLE `tblleavetype` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `CreationDate`) VALUES
(1, 'Casual Leave', 'Provided for urgent or unforeseen matters to the employees.', '2024-01-15 05:49:21'),
(2, 'Medical Leave', 'Related to Health Problems of Employee', '2024-01-15 05:49:35'),
(3, 'Restricted Holiday', 'Holiday that is optional', '2024-01-15 05:49:48'),
(5, 'Paternity Leave', 'To take care of newborns', '2024-01-14 21:00:00'),
(6, 'Bereavement Leave', 'Grieve their loss of losing loved ones', '2024-01-15 05:50:31'),
(7, 'Compensatory Leave', 'For Overtime workers', '2024-01-15 05:50:49'),
(8, 'Maternity Leave', 'Taking care of newborn ,recoveries', '2024-01-15 05:51:31'),
(9, 'Religious Holidays', 'Based on employee\'s followed religion', '2024-01-15 05:51:45'),
(10, 'Adverse Weather Leave', 'In terms of extreme weather conditions', '2024-01-15 05:51:59'),
(11, 'Voting Leave', 'For official election day', '2024-01-15 05:52:52'),
(12, 'Personal Time Off', 'To manage some private matters', '2024-01-15 05:52:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`empid`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
