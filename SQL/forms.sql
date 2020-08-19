-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2020 at 09:16 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forms`
--

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `response_id` int(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `contactno` varchar(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`response_id`, `name`, `age`, `gender`, `email`, `address`, `contactno`, `image`) VALUES
(1, 'Tom Cruise', 53, 'male', 'tomcruise@gmail.com', 'Dona paula,panjim-goa.', '9764236783', 'IMG_9764236783.jpg'),
(2, 'Leonardo Dicaprio', 47, 'male', 'leocapri@yahoo.com', 'Farmadgudi ,Ponda-Goa', '7030672573', 'IMG_7030672573.jpg'),
(3, 'Jenifer Aniston', 35, 'female', 'jenifer.aniston@gmail.com', 'Muncipalty garden,Margao-Goa', '9420979458', 'IMG_9420979458.jpg'),
(4, 'Bill Gates', 72, 'male', 'bill@microsoft.com', 'Dabolim, Vasco-Goa', '8085252997', 'IMG_8085252997.jpg'),
(5, 'Rio Ferdinand', 43, 'male', 'rioferdi@gmail.com', 'Thane, Mumbai-India.', '8972547789', 'IMG_8972547789.jpg'),
(6, 'Emma watson', 27, 'female', 'watsonem@gmail.com', 'Bangalore,Karnataka-India.', '9567346889', 'IMG_9567346889.jpg'),
(7, 'Mark Zukerberg', 36, 'male', 'mark@facebook.com', 'Tisk,Ponda-Goa', '7903848758', 'IMG_7903848758.jpg'),
(8, 'Chris Hemsworth', 39, 'male', 'chrish@gmail.com', 'xyz street ,Kochi-India', '8952802163', 'IMG_8952802163.jpg'),
(9, 'Sharukh khan', 59, 'male', 'srk@gmail.com', 'Abc Street,Mumbai-India', '6903728292', 'IMG_6903728292.jpg'),
(10, 'Muskesh Ambani', 63, 'male', 'muskeshjio@gmail.com', 'qwr street , Mumbai-India', '7869293884', 'IMG_7869293884.jpg'),
(11, 'Kirsten dunnc', 43, 'female', 'kirsten@gmail.com', 'Jkl Steet,Delhi-India', '8378302002', 'IMG_8378302002.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`) VALUES
(1, 'rumanmulla911@gmail.com', 'iamruman', 'Ruman Mulla'),
(2, 'marcus10@yahoo.com', 'rashy10', 'Marcus Rashford'),
(3, 'martial9@gmail.com', 'tonyscoresagain', 'Antony Martial');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`response_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `response_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
