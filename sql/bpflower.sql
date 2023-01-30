-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2023 at 11:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpflower`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'df24e65daf886d3a55de0e4c9446fd03', '2022-12-01 20:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Price` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qty` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `Price`, `qty`) VALUES
(81, 0, '16', '39.99', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `method` varchar(50) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `Price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'in progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `method`, `product_id`, `Price`, `qty`, `date`, `status`) VALUES
(1, 'OlYEu6BGfBjhlCsVRlTc', 'mo', '1111111111', 'a@gmail.com', 'jan, jan, Enkhuizen, NL', 'ideal>ideal\r\n                  ', '13', '39.99', '1', '2023-01-14', 'in progress'),
(2, 'OlYEu6BGfBjhlCsVRlTc', 'test', '0634058133', 'af@gmail.com', 'jjjj61, sdfadf, enkhuizen, NL - 11111', 'credit or debit card', '14', '39.99', '1', '2023-01-14', 'in progress'),
(3, 'OlYEu6BGfBjhlCsVRlTc', 'test', '0634058133', 'af@gmail.com', 'jjjj61, sdfadf, enkhuizen, NL - 11111', 'credit or debit card', '13', '39.99', '1', '2023-01-14', 'in progress'),
(4, 'eSWgtlKtOsdhgmS7PcuO', 'mo', '1111111111', 'a@gmail.com', 'jan, jan, Enkhuizen, NL', 'Paypal', '13', '39.99', '1', '2023-01-15', 'in progress'),
(5, 'eSWgtlKtOsdhgmS7PcuO', 'mo', '1111111111', 'a@gmail.com', 'jan, jan, Enkhuizen, NL', 'ideal>ideal\r\n                  ', '19', '39.99', '1', '2023-01-15', 'in progress');

-- --------------------------------------------------------

--
-- Table structure for table `postproducer`
--

CREATE TABLE `postproducer` (
  `id` int(11) NOT NULL,
  `FlowerBrand` int(11) NOT NULL,
  `BrandName` varchar(120) NOT NULL,
  `FlowerOverview` longtext NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `aantal` int(11) NOT NULL,
  `Vimage1` varchar(120) NOT NULL DEFAULT '',
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postproducer`
--

INSERT INTO `postproducer` (`id`, `FlowerBrand`, `BrandName`, `FlowerOverview`, `Price`, `aantal`, `Vimage1`, `UpdationDate`) VALUES
(13, 4, '', 'De mooiste rozen die je kan geven aan iemand waarvan je houdt!', '39.99', 10, 'Romantic_Red.webp', '2022-12-31 20:34:44'),
(14, 3, '', 'Misschien wel de mooiste rozen ter wereld, deze witte rozen zijn puur', '39.99', 10, 'Platinum_White.webp', '2022-12-31 21:21:36'),
(16, 6, '', 'Maak iemand blij met een kleurrijke bos rozen van topkwaliteit!', '39.99', 10, 'Pastelmix.webp', '2023-01-01 03:43:52'),
(19, 6, '', 'test', '39.99', 10, 'SophiaLoren.webp', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbrands`
--

CREATE TABLE `tblbrands` (
  `id` int(11) NOT NULL,
  `BrandName` varchar(120) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbrands`
--

INSERT INTO `tblbrands` (`id`, `BrandName`, `CreationDate`) VALUES
(3, 'PLATINUM WHITE', '2022-12-31 19:20:49'),
(4, 'ROMANTIC RED', '2022-12-31 20:00:16'),
(5, 'PERFECT PINK', '2022-12-31 20:06:05'),
(6, 'LOVELY COLOURS', '2023-01-01 01:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `FullName` varchar(128) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FullName`, `EmailId`, `Password`, `ContactNo`, `dob`, `Address`, `City`, `Country`, `RegDate`) VALUES
(1, 'mohammedali', 'Mo@gmail.com', 'df24e65daf886d3a55de0e4c9446fd03', '0634058133', NULL, NULL, NULL, NULL, NULL),
(2, 'MohammedAli', 'mo@outlook.com', 'e9ea90857363708afc42938a00719e76', '0612345678', NULL, NULL, NULL, '', '2022-12-08 20:59:07'),
(3, 'aaaa', 'mo1996@gmail.com', '6f04f0d75f6870858bae14ac0b6d9f73', '1111111111', NULL, NULL, NULL, NULL, '2022-12-08 23:15:46'),
(4, 'moo', 'mooo@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '1111111111', NULL, 'city', 'city', 'city', '2022-12-08 23:25:32'),
(5, 'mo', 'a@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1111111111', '04-07-1996', 'jan', 'Enkhuizen', 'NL', '2022-12-25 23:00:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postproducer`
--
ALTER TABLE `postproducer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbrands`
--
ALTER TABLE `tblbrands`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `BrandName` (`BrandName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `postproducer`
--
ALTER TABLE `postproducer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblbrands`
--
ALTER TABLE `tblbrands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
