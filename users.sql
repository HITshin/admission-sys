-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 11:56 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(111) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Local Address` varchar(255) NOT NULL,
  `Local City` varchar(255) NOT NULL,
  `Local State` varchar(255) NOT NULL,
  `Local Zip` int(255) NOT NULL,
  `Permeant Address` varchar(255) NOT NULL,
  `Permeant City` varchar(255) NOT NULL,
  `Permeant State` varchar(255) NOT NULL,
  `Permeant Zip` int(25) NOT NULL,
  `Enrollmeant No` int(25) NOT NULL,
  `DTE_Id_No` varchar(255) NOT NULL,
  `Admission_Category` varchar(255) NOT NULL,
  `Admission_Centre` varchar(255) NOT NULL,
  `Domicile_State` varchar(255) NOT NULL,
  `Date_Of_Birth` int(255) NOT NULL,
  `Aadhar_Card_No` int(255) NOT NULL,
  `Father_PAN_Card_No` varchar(255) NOT NULL,
  `Cast` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Place_Of_Birth` varchar(255) NOT NULL,
  `Student_Name` varchar(255) NOT NULL,
  `Student_Mobile_No` bigint(255) NOT NULL,
  `Student_Email_Address` varchar(225) NOT NULL,
  `Student_Father_Name` varchar(255) NOT NULL,
  `Father_Mobile_No` bigint(225) NOT NULL,
  `Father_Email_Address` varchar(225) NOT NULL,
  `Student_Mother_Name` varchar(225) NOT NULL,
  `Mother_Mobile_No` bigint(225) NOT NULL,
  `Mother_Email_Address` varchar(225) NOT NULL,
  `Student_Local_Guardian_Name` varchar(225) NOT NULL,
  `Guardian_Mobile_No` bigint(225) NOT NULL,
  `Guardian_Email_Address` varchar(225) NOT NULL,
  `Select_Branch` varchar(225) NOT NULL,
  `Upload_your_Photo` varchar(225) NOT NULL,
  `Upload_10th_OR_12th_Result` varchar(225) NOT NULL,
  `Upload_Diploma_Result` varchar(225) NOT NULL,
  `Created at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
