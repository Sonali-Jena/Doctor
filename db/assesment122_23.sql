-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 11:36 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assesment122_23`
--

-- --------------------------------------------------------

--
-- Table structure for table `disease_master`
--

CREATE TABLE `disease_master` (
  `disease_id` int(11) NOT NULL,
  `disease_Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disease_master`
--

INSERT INTO `disease_master` (`disease_id`, `disease_Name`) VALUES
(1, 'Diarrhea'),
(2, 'Headaches'),
(3, 'Allergies');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_appointment`
--

CREATE TABLE `doctor_appointment` (
  `Doctor_Appointment_id` int(11) NOT NULL,
  `Doctor_id` int(11) DEFAULT NULL,
  `Patient_Name` varchar(50) DEFAULT NULL,
  `Patient_Phone` varchar(50) DEFAULT NULL,
  `Date_Of_appointment` date DEFAULT NULL,
  `Patient_Status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_appointment`
--

INSERT INTO `doctor_appointment` (`Doctor_Appointment_id`, `Doctor_id`, `Patient_Name`, `Patient_Phone`, `Date_Of_appointment`, `Patient_Status`) VALUES
(1, 1, 'Rama Barik', '9861298612', '2023-04-29', 'A'),
(2, 1, 'Rosa Sahoo', '9861398613', '2023-04-29', 'A'),
(3, 2, 'Rabi Muduli', '9861498614', '2023-04-28', 'P'),
(4, 2, 'Rupa Mohanty', '9861598615', '2023-04-28', 'P'),
(5, 2, 'Raju Pattanaik', '9861698616', '2023-04-29', 'A'),
(6, 2, 'Rupali Mishra', '9861798617', '2023-04-29', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_master`
--

CREATE TABLE `doctor_master` (
  `Doctor_id` int(11) NOT NULL,
  `Doctor_Name` varchar(50) DEFAULT NULL,
  `Doctor_Phone` varchar(50) DEFAULT NULL,
  `Doctor_Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_master`
--

INSERT INTO `doctor_master` (`Doctor_id`, `Doctor_Name`, `Doctor_Phone`, `Doctor_Email`) VALUES
(1, 'Dr. Sunil Choudhury', '9861098610', 'sunil@gmail.com'),
(2, 'Dr. Hara Mohan Mohanty', '9771497714', 'hara@gmail.com'),
(3, 'Dr. Manoj Singh', '9861198611', 'manoj@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_master`
--

CREATE TABLE `medicine_master` (
  `medicine_id` int(11) NOT NULL,
  `medicine_Name` varchar(50) DEFAULT NULL,
  `disease_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_master`
--

INSERT INTO `medicine_master` (`medicine_id`, `medicine_Name`, `disease_id`) VALUES
(1, ' Sulfatrim', 1),
(2, ' Bactrim', 1),
(3, ' Lomotil', 1),
(4, ' Aspirin', 2),
(5, ' Acetaminophen', 2),
(6, ' Prochlorperazine', 2),
(7, ' Cetirizine', 3),
(8, ' Desloratadine', 3),
(9, ' Loratadine', 3);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `slno` int(11) NOT NULL,
  `Doctor_Appointment_id` int(11) DEFAULT NULL,
  `disease_id` int(11) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `prescription` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`slno`, `Doctor_Appointment_id`, `disease_id`, `medicine_id`, `prescription`) VALUES
(1, 1, 3, 2, 'Prescription details-1'),
(2, 2, 4, 3, 'Prescription details-2'),
(3, 1, 2, 6, 'ok'),
(4, 1, 1, 3, 'ok'),
(5, 2, 2, 6, 'thjfythnfdt'),
(6, 1, 1, 2, 'ok'),
(7, 1, 3, 9, 'ok');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disease_master`
--
ALTER TABLE `disease_master`
  ADD PRIMARY KEY (`disease_id`);

--
-- Indexes for table `doctor_appointment`
--
ALTER TABLE `doctor_appointment`
  ADD PRIMARY KEY (`Doctor_Appointment_id`);

--
-- Indexes for table `doctor_master`
--
ALTER TABLE `doctor_master`
  ADD PRIMARY KEY (`Doctor_id`);

--
-- Indexes for table `medicine_master`
--
ALTER TABLE `medicine_master`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`slno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disease_master`
--
ALTER TABLE `disease_master`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor_appointment`
--
ALTER TABLE `doctor_appointment`
  MODIFY `Doctor_Appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctor_master`
--
ALTER TABLE `doctor_master`
  MODIFY `Doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicine_master`
--
ALTER TABLE `medicine_master`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
