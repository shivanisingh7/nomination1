-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 08:23 AM
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
-- Database: `nomination_db`
--
CREATE DATABASE IF NOT EXISTS `nomination_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `nomination_db`;

-- --------------------------------------------------------

--
-- Table structure for table `nominations`
--

DROP TABLE IF EXISTS `nominations`;
CREATE TABLE `nominations` (
  `id` int(11) NOT NULL,
  `nomination` varchar(50) NOT NULL,
  `your_title` varchar(10) NOT NULL,
  `your_name` varchar(100) NOT NULL,
  `your_email` varchar(100) NOT NULL,
  `your_phone` varchar(15) NOT NULL,
  `your_role` varchar(50) DEFAULT NULL,
  `nominee_title` varchar(50) NOT NULL,
  `nominee_name` varchar(100) NOT NULL,
  `nominee_email` varchar(100) NOT NULL,
  `nominee_phone` varchar(15) NOT NULL,
  `program` varchar(50) NOT NULL,
  `graduation_year` int(11) NOT NULL,
  `organisation` varchar(150) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `self_reason` text NOT NULL,
  `criteria` text DEFAULT NULL,
  `accomplishments` text NOT NULL,
  `projects` text NOT NULL,
  `publications` text NOT NULL,
  `talks` text NOT NULL,
  `awards` text NOT NULL,
  `services` text NOT NULL,
  `patents` text NOT NULL,
  `research_projects` text NOT NULL,
  `innovation_awards` text NOT NULL,
  `impact_projects` text NOT NULL,
  `community_work` text NOT NULL,
  `alma_mater_contribution` text NOT NULL,
  `community_awards` text NOT NULL,
  `leadership_initiatives` text NOT NULL,
  `ventures` text NOT NULL,
  `business_usp` text NOT NULL,
  `startup_valuation` text NOT NULL,
  `startup_investments` text NOT NULL,
  `testimonies_file` varchar(255) DEFAULT NULL,
  `nominee_documents_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `nominations`
--

TRUNCATE TABLE `nominations`;
--
-- Dumping data for table `nominations`
--

INSERT DELAYED IGNORE INTO `nominations` (`id`, `nomination`, `your_title`, `your_name`, `your_email`, `your_phone`, `your_role`, `nominee_title`, `nominee_name`, `nominee_email`, `nominee_phone`, `program`, `graduation_year`, `organisation`, `designation`, `linkedin`, `self_reason`, `criteria`, `accomplishments`, `projects`, `publications`, `talks`, `awards`, `services`, `patents`, `research_projects`, `innovation_awards`, `impact_projects`, `community_work`, `alma_mater_contribution`, `community_awards`, `leadership_initiatives`, `ventures`, `business_usp`, `startup_valuation`, `startup_investments`, `testimonies_file`, `nominee_documents_file`) VALUES
(1, 'yourself', 'Mrs', 'Shivani', 'shivanisingh.kvh@gmail.com', '9008415889', 'student', '', '', '', '', 'btech', 2023, 'IIITD', 'SDE', 'https://www.linkedin.com/in/shivani-singh-2011a1261/', '', 'contribution_field', 'h', 'h', 'h', 'h', 'h', 'h', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL),
(2, 'someone_else', 'Mr', 'Shivansh', 'shivanshkvh@gmail.com', '9008415884', 'faculty', 'Mrs', 'Shivani', 'shivanisingh.kvh@gmail.com', '9008415889', 'btech', 2023, 'IIITD', 'SDE', 'https://www.linkedin.com/in/shivani-singh-2011a1261/', 'hh', NULL, 'h', 'h', 'h', 'h', 'h', 'h', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL),
(3, 'someone_else', 'Mrs', 'helem', 'a@gmail.com', '9008415887', 'faculty', 'Mrs', 'b', 'b@gmail.com', '9008415878', 'btech', 2020, 'IIT', 'SDE', 'https://www.linkedin.com/in/shivani-singh-2011a1261/', 'HHHH', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL),
(4, 'yourself', 'Mrs', 'ab', 'ab@gmail.com', '9008415834', 'student', '', '', '', '', 'btech', 2018, 'abc', 'abc', 'https://www.linkedin.com/in/shivani-singh-2011a1261/', '', 'contribution_society', 'a', 'b', 'c', 'c', 'd', 'e', '', '', '', 'd', 'f', 'g', 'h', '', '', '', '', '', 'uploads/HOST MERN APP FOR FREE.pdf', NULL),
(5, 'yourself', 'Mrs', 'A', 'test1@gmail.com', '9008411993', NULL, '', '', '', '', 'mtech', 2022, 'B', 'ABC', 'https://www.linkedin.com/in/shivani-singh-2011a1261/', 'jbsdfmhkjfds kjbjk fdxjgjjlkf kjbn', 'contribution_field', 'kbjsdf jkdfsn', ' mfcn  fe,mnf', 'jvhdhmsfb kjbhef', 'jhasdh bjkdkj', 'bfkaj bkkdwh', 'bjkjaf bkdqwjk', '', '', '', '', '', '', '', '', '', '', '', '', 'uploads/pay.pdf', NULL),
(6, 'yourself', 'Miss', 'ABCD', 'test11@gmail.com', '9008415888', NULL, '', '', '', '', 'mtech', 2020, 'abc', 'abc', 'https://www.linkedin.com', 'kjbdjw ', 'contribution_society', 'kndcnnksd', 'skbj', 'bdc', 'bjhsd', 'cjs', 'bs', '', '', '', 'jbwd', 's nk', ' sx', 'sadvhjdw', '', '', '', '', '', 'uploads/R519Z28ApplicationForm (1).pdf', NULL),
(7, 'yourself', 'Miss', 'TEST1', 'test11@gmail.com', '9008415888', NULL, '', '', '', '', 'mtech', 2020, 'B', 'ABC', 'https://www.linkedin.com', 'ljrekl', 'contribution_field', 'x', 'ss', 's', 's', 's', 's', '', '', '', '', '', '', '', '', '', '', '', '', 'uploads/GATE _CS_2025_Syllabus.pdf', NULL),
(8, 'someone_else', 'Miss', 'test22', 'test22@gmail.com', '9008415884', 'staff', 'Mrs', 'test23', 'test23@gmail.com', '9008415878', 'mtech', 2019, 'abc', 'abc', 'https://www.linkedin.com', 'dwfew', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 'uploads/pay.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nominations`
--
ALTER TABLE `nominations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nominations`
--
ALTER TABLE `nominations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
