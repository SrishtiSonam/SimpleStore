-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 05:55 PM
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
-- Database: `marketmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` varchar(10) NOT NULL,
  `categoryname` varchar(100) NOT NULL,
  `availability` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categoryname`, `availability`) VALUES
('C1', 'packaged food', 'Y'),
('C2', 'beverages', 'Y'),
('C3', 'cereals', 'Y'),
('C4', 'stationary', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `paymentmode` varchar(100) NOT NULL,
  `productname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `email`, `status`, `price`, `quantity`, `date`, `time`, `paymentmode`, `productname`) VALUES
('O1', 'ojaswi@gmail.com', 'Confirmed', 50, 3, '2024-05-27', '14:19:16', '', 'oats'),
('O2', 'ojaswi@gmail.com', 'Confirmed', 40, 4, '2024-05-27', '14:19:30', '', 'wheat');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` varchar(10) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `categoryid` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `productname`, `categoryid`, `description`, `price`, `quantity`, `image`) VALUES
('P1', 'scissors', 'C4', 'High-quality stainless steel scissors.', 25, 0, 'scissors.jpg'),
('P10', 'juice', 'C2', 'Freshly squeezed fruit juice.', 55, 95, 'juice.jpg'),
('P11', 'maagi', 'C1', 'Quick and tasty instant noodles.', 25, 96, 'maagi.jpg'),
('P12', 'milktea', 'C2', 'Creamy and sweet milk tea.', 35, 98, 'milktea.jpg'),
('P13', 'millet', 'C3', 'Nutritious and organic millet.', 60, 100, 'millet.jpg'),
('P14', 'nachos', 'C1', 'Crispy and cheesy nachos.', 40, 100, 'nachos.jpg'),
('P15', 'notebook', 'C4', 'Spiral-bound ruled notebook.', 30, 94, 'notebook.jpg'),
('P16', 'oats', 'C3', 'Healthy and organic oats.', 50, 97, 'oats.jpg'),
('P17', 'penpencil', 'C4', 'Set of pen and pencil.', 20, 100, 'penpencil.jpg'),
('P18', 'rice', 'C3', 'Premium quality basmati rice.', 65, 0, 'rice.jpg'),
('P2', 'softdrink', 'C2', 'Refreshing and fizzy soft drink.', 30, 100, 'softdrink.jpg'),
('P3', 'tape', 'C4', 'Strong adhesive tape for all uses.', 20, 100, 'tape.jpg'),
('P4', 'wheat', 'C3', 'Organic whole wheat grains.', 40, 96, 'wheat.jpg'),
('P5', 'chips', 'C1', 'Crunchy and tasty potato chips.', 35, 100, 'chips.jpg'),
('P6', 'chocolates', 'C1', 'Delicious assorted chocolates.', 50, 100, 'chocolates.jpg'),
('P7', 'coffee', 'C2', 'Rich and aromatic coffee beans.', 70, 100, 'coffee.jpg'),
('P8', 'colddrink', 'C2', 'Chilled and refreshing cold drink.', 30, 100, 'colddrink.jpg'),
('P9', 'greentee', 'C2', 'Healthy and refreshing green tea.', 45, 100, 'greentee.jpg'),
('P99', 'premium card', 'C5', 'Card to become Premium Customer', 20000, 50, 'premiumcard.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `type` char(10) NOT NULL,
  `phoneno` varchar(20) NOT NULL,
  `gender` char(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `username`, `firstname`, `lastname`, `dob`, `type`, `phoneno`, `gender`, `password`) VALUES
('admin1@gmail.com', 'admin1', 'Aman', 'Kumar', '1989-03-12', 'admin', '8787878787', 'Male', 'admin12345'),
('ojaswi@gmail.com', 'ojas', 'ojaswi', 'chauhan', '2003-05-27', 'customer', '9897969594', 'female', '$2y$10$pwUcs1mBIZjOg/RboO1Kte58.AR81DyCiy2dkns2ZccUonBkf8JqC'),
('owner1@gmail.com', 'owner1', 'Dev', 'Aggarwal', '0000-00-00', 'owner', '5656565656', 'Male', 'owner12345'),
('shreya@gmail.com', 'staff2', 'Shreya', 'Gupta', '2000-07-11', 'customer', '2345234566', 'female', '$2y$10$mkwbBpyo4Pvs3VOe7luLv.2mjNzh7ZO66t2qZuAMdomVCf2/wNV3i'),
('srishti@gmail.com', 'srishti1107', 'srishti', 'sharma', '2004-01-01', 'customer', '9876543210', 'female', '$2y$10$voS/evtcm9Vx/VYS0lFaVuu2i2FVkbPErQojOGKbnNjIOb65Vy.A6'),
('staff1@gmail.com', 'staff1', 'Priyal', 'Goyal', '0000-00-00', 'staff', '2342342341', 'Female', 'staff12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`),
  ADD UNIQUE KEY `productname` (`productname`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
