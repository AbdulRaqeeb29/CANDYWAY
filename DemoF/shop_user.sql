-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 29, 2023 at 03:27 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `candies`
--

CREATE TABLE `candies` (
  `cand_id` int NOT NULL,
  `cand_name` varchar(20) NOT NULL,
  `cand_img` varchar(100) NOT NULL,
  `cand_price` float NOT NULL,
  `user_rating` int NOT NULL,
  `unit` int NOT NULL,
  `total_candies` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `candies`
--

INSERT INTO `candies` (`cand_id`, `cand_name`, `cand_img`, `cand_price`, `user_rating`, `unit`, `total_candies`) VALUES
(1, 'Blue Snowflake', 'Candyblue.png', 1.6, 4, 2, 100),
(2, 'Caramel Almonds', 'CandyAlmond.png', 0.95, 4, 2, 16),
(3, 'Chocolate Brazil Nut', 'CandyChoco.png', 1.2, 4, 2, 91),
(4, 'Oro Regaliz', 'oro_regaliz.png', 2.2, 4, 2, 100),
(5, 'King\'s Marshmallow', 'marshmallow.png', 3.5, 5, 1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `userid` varchar(6) NOT NULL,
  `cand_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`userid`, `cand_id`, `quantity`) VALUES
('625211', 2, 1),
('625211', 3, 1),
('625211', 4, 1),
('122', 3, 3),
('122', 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `userid` varchar(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `product` varchar(25) NOT NULL,
  `query` varchar(300) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`userid`, `name`, `country`, `product`, `query`, `Timestamp`) VALUES
('122', 'nnn', 'united states', 'chocolate brazil nut', 'very good keep it up!!!', '2023-03-28 12:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `my_orders`
--

CREATE TABLE `my_orders` (
  `trans_id` bigint NOT NULL,
  `cand_id` int NOT NULL,
  `qnt` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `my_orders`
--

INSERT INTO `my_orders` (`trans_id`, `cand_id`, `qnt`) VALUES
(1224830, 3, 9),
(1227911, 5, 10),
(1227911, 1, 1),
(1223922, 2, 2),
(1221823, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Payment`
--

CREATE TABLE `Payment` (
  `trans_id` bigint NOT NULL,
  `userid` varchar(6) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pincode` varchar(5) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Payment`
--

INSERT INTO `Payment` (`trans_id`, `userid`, `total_price`, `timestamp`, `name`, `email`, `address`, `pincode`, `phone`) VALUES
(1221823, '122', '4.18', '2023-03-21 17:02:50', 'Abdul Raqeeb', 'abdulraqeeb4466@gmail.com', 'via palatucci 13', '98168', '3296770503'),
(1223922, '122', '2.09', '2023-03-21 16:57:20', 'Abdul Raqeeb', 'abdulraqeeb4466@gmail.com', 'via palatucci 13', '98168', '3296770503'),
(1224830, '122', '11.88', '2023-03-17 16:14:09', 'Abdul Raqeeb', 'abdulraqeeb4466@gmail.com', 'via palatucci 13', '98168', '3296770503'),
(1227911, '122', '40.26', '2023-03-21 12:56:31', 'Abdul Raqeeb', 'abdulraqeeb4466@gmail.com', 'via palatucci 13', '98168', '3296770503');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL,
  `userid` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `userid`) VALUES
('admin', 'reachme@ytf.com', 'pass123', '122'),
('fg', 'by@32.com', 'nabeel', '163133'),
('admin2', 'admin2@gm.com', 'pass123', '170579'),
('geek', 'geek2@yh.com', '123123', '184543'),
('fgf', 'vv@dm.com', 'fgf123', '19267'),
('ashish', 'ash12@gmail.com', '111111', '292992'),
('admin1', 'abdulraqeeb4466@gf.com', '123456', '330689'),
('admin5', 'admin5@gmail.com', '123456', '425695'),
('admin3', 'bb@gg.com', 'nabeel9191', '591198'),
('armando', 'armando@ff.com', '123456', '625211'),
('admin4', 'admin4@gmail.com', '123456', '886419');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candies`
--
ALTER TABLE `candies`
  ADD PRIMARY KEY (`cand_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD KEY `userid constraint` (`userid`),
  ADD KEY `candid constraint` (`cand_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD KEY `userid const contact` (`userid`);

--
-- Indexes for table `my_orders`
--
ALTER TABLE `my_orders`
  ADD KEY `candid cons_trans` (`cand_id`),
  ADD KEY `candid cons_trans_2` (`trans_id`);

--
-- Indexes for table `Payment`
--
ALTER TABLE `Payment`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `userid const contact` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `my_orders`
--
ALTER TABLE `my_orders`
  ADD CONSTRAINT `candid cons_trans` FOREIGN KEY (`cand_id`) REFERENCES `candies` (`cand_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `candid cons_trans_2` FOREIGN KEY (`trans_id`) REFERENCES `Payment` (`trans_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
