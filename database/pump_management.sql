-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2024 at 11:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pump_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `area_id` int(11) NOT NULL,
  `pincode` int(6) NOT NULL,
  `area_name` varchar(30) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area_id`, `pincode`, `area_name`, `city_id`) VALUES
(1, 380001, 'Gandhi Road', 1),
(3, 380009, 'Ashram road', 1),
(5, 380026, 'Amraiwadi', 1),
(6, 380058, 'Bopal', 1),
(9, 380027, 'Chandkheda', 1),
(10, 380006, 'Ambawadi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `QTY` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(1, 'Ahmedabad');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `GSTIN_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_rating`
--

CREATE TABLE `feedback_rating` (
  `f_r_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `star` int(11) NOT NULL,
  `feedback_titles` varchar(45) NOT NULL,
  `f_comments` text NOT NULL,
  `f_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_rating`
--

INSERT INTO `feedback_rating` (`f_r_id`, `user_id`, `product_id`, `star`, `feedback_titles`, `f_comments`, `f_date`) VALUES
(2, 45, 14, 5, 'Good', 'Great Product', '2023-03-27 22:14:28');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `QOH` int(11) NOT NULL,
  `price` float NOT NULL,
  `img` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `product_cate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `QOH`, `price`, `img`, `description`, `status`, `product_cate_id`) VALUES
(11, 'Flanged Bareshaft Type', 9, 3000, 'Flanged Bareshaft Type.png', '1 Hp, 3ph, 40x40 size,\n2800 RPM', 0, 108),
(12, 'Threaded Bareshaft Type', -1, 3500, 'Threaded Bareshaft Type.png', '1 Hp, 3ph, 40x40 size, \n2800 RPM', 1, 108),
(13, 'SS Pump', 4, 3200, 'SS-Self-Priming-Pump2.png', '1 Hp, 3ph, 40x40 size,\n2800 RPM', 1, 108),
(14, 'Bareshaft Type', -4, 4000, 'Bareshaft Type.png', '1 Hp, 3ph, 40x40 size,\n2800 RPM', 1, 109),
(15, 'Monoblock Type', 4, 2500, 'SS-Self-Priming-Pump.png', '1 Hp,3ph,40x40 size\n2800 RPM', 1, 109),
(16, 'Bareshaft PP Type', 12, 3900, 'Centrifugalpp-Pump.png', '1 Hp,3ph,40x40 size\n2800 RPM', 1, 115),
(17, 'Monoblock PP Type', 15, 4300, 'Monoblock Type.png', '1 Hp,3ph,40x40 size\n2800 RPM', 1, 115),
(18, 'C.I. Rotary Gear Pump', 17, 5000, 'External-Gear-Pump.png', '1 Hp,3ph,40x40 size\n2800 RPM', 1, 116),
(19, 'S.S. Rotary Gear Pump', 7, 4800, 'S.S. Rotary Gear Pump.png', '1 Hp,3ph,40x40 size\n2800 RPM', 1, 116),
(20, 'Couple Type', 12, 4200, 'Split-Couple-Vertical-Inline-Pump.png', '1 Hp,3ph,40x40 size\n2800 RPM', 1, 117),
(22, 'Monoblock Inline Type', 7, 4500, 'inline_type.png', '1 Hp,3ph,40x40 size\n2800 RPM', 1, 117);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `production_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`production_id`, `start_date`, `end_date`, `product_id`) VALUES
(1, '2023-03-27', '2023-03-27', 14);

-- --------------------------------------------------------

--
-- Table structure for table `production_details`
--

CREATE TABLE `production_details` (
  `production_production_id` int(11) NOT NULL,
  `rawmaterial_rawmaterial_id` int(11) NOT NULL,
  `QTY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `production_details`
--

INSERT INTO `production_details` (`production_production_id`, `rawmaterial_rawmaterial_id`, `QTY`) VALUES
(1, 15, 1),
(1, 16, 1),
(1, 17, 1),
(1, 18, 1),
(1, 20, 1),
(1, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_cate_id` int(11) NOT NULL,
  `cate_name` varchar(35) NOT NULL,
  `img` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_cate_id`, `cate_name`, `img`, `status`) VALUES
(108, 'SS Centrifugal Pump(fabricated)', 'SS-Centrifugal-Pump-Fabricated2.png', 1),
(109, 'SS Self Priming Pump', 'SS-Self-Priming-Pump.png', 1),
(115, 'Centrifugal PP Pump', 'Centrifugalpp-Pump.png', 1),
(116, 'External Gear Pump', 'External-Gear-Pump.png', 1),
(117, 'Inline Centrifugal Pump', 'Split-Couple-Vertical-Inline-Pump.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_feature`
--

CREATE TABLE `product_feature` (
  `performance` varchar(45) DEFAULT NULL,
  `applications` varchar(100) DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `total_amt` float NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amt` float NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `CGST` varchar(5) NOT NULL,
  `SGST` varchar(5) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `purchase_date`, `total_amt`, `payment_date`, `payment_amt`, `payment_type`, `CGST`, `SGST`, `supplier_id`) VALUES
(51, '2023-02-07', 2360, '2023-02-10', 2000, 'Cash', '9', '9', 5),
(52, '2023-02-08', 1416, '2023-02-10', 1200, 'Cash', '9', '9', 7),
(53, '2023-02-10', 3540, '2023-02-10', 3000, 'Check', '9', '9', 6),
(54, '2023-02-18', 1416, '2023-02-19', 1200, 'UPI', '9', '9', 6),
(55, '2023-02-12', 3540, '2023-02-13', 3000, 'Cash', '9', '9', 5),
(56, '2023-03-04', 2360, '2023-03-04', 2000, 'Cash', '9', '9', 5);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `purchase_purchase_id` int(11) NOT NULL,
  `rawmaterial_rawmaterial_id` int(11) NOT NULL,
  `QTY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`purchase_purchase_id`, `rawmaterial_rawmaterial_id`, `QTY`) VALUES
(51, 18, 5),
(52, 20, 8),
(53, 17, 8),
(54, 15, 3),
(55, 21, 10),
(56, 15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return`
--

CREATE TABLE `purchase_return` (
  `purchase_return_id` int(11) NOT NULL,
  `return_date` date NOT NULL,
  `return_amt` float NOT NULL,
  `purchase_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_return`
--

INSERT INTO `purchase_return` (`purchase_return_id`, `return_date`, `return_amt`, `purchase_id`) VALUES
(22, '2023-02-13', 2300, 55),
(23, '2023-02-08', 500, 52);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_details`
--

CREATE TABLE `purchase_return_details` (
  `purchase_return_purchase_return_id` int(11) NOT NULL,
  `rawmaterial_rawmaterial_id` int(11) NOT NULL,
  `QTY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_return_details`
--

INSERT INTO `purchase_return_details` (`purchase_return_purchase_return_id`, `rawmaterial_rawmaterial_id`, `QTY`) VALUES
(22, 21, 3),
(23, 20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rawmaterial`
--

CREATE TABLE `rawmaterial` (
  `rawmaterial_id` int(11) NOT NULL,
  `rawmaterial_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rawmaterial`
--

INSERT INTO `rawmaterial` (`rawmaterial_id`, `rawmaterial_name`) VALUES
(15, 'Impeller'),
(16, 'Diffuser'),
(17, 'Bearing'),
(18, 'Suction'),
(20, 'Strainer'),
(21, 'Rotor');

-- --------------------------------------------------------

--
-- Table structure for table `rawmaterial_details`
--

CREATE TABLE `rawmaterial_details` (
  `rawmaterial_rawmaterial_id` int(11) NOT NULL,
  `supplier_supplier_id` int(11) NOT NULL,
  `QTY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rawmaterial_details`
--

INSERT INTO `rawmaterial_details` (`rawmaterial_rawmaterial_id`, `supplier_supplier_id`, `QTY`) VALUES
(15, 5, 32),
(16, 7, 24),
(17, 6, 27),
(18, 5, 19),
(20, 7, 9),
(21, 6, 31);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `Is_cancel` tinyint(1) DEFAULT 0,
  `sale_date` date NOT NULL,
  `total_amt` float NOT NULL,
  `payment_date` date NOT NULL,
  `d_address` varchar(150) NOT NULL,
  `d_status` tinyint(4) NOT NULL DEFAULT 0,
  `payment_type` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `Is_cancel`, `sale_date`, `total_amt`, `payment_date`, `d_address`, `d_status`, `payment_type`, `user_id`) VALUES
(25, 0, '2023-03-30', 10000, '2023-03-30', 'hythtyhtyh', 1, 'COD', 45),
(27, 0, '2023-03-31', 3000, '2023-03-31', '', 1, 'ONLINE', 45),
(32, 0, '2023-03-31', 4000, '2023-03-31', 'grttrgrtgrt', 1, 'COD', 45),
(34, 0, '2023-03-31', 3500, '2023-03-31', 'yhythythty', 0, 'ONLINE', 45),
(35, 0, '2023-03-31', 3500, '2023-03-31', 'rhtyhythhtrhyth', 0, 'ONLINE', 45),
(36, 0, '2023-03-31', 3500, '2023-03-31', 'fnernfjrenf', 1, 'ONLINE', 45),
(37, 0, '2023-03-31', 3500, '2023-03-31', 'thythtyt', 0, 'ONLINE', 45),
(38, 0, '2023-03-31', 3200, '2023-03-31', 'grtggitgtr', 1, 'ONLINE', 45),
(46, 1, '2023-04-01', 2500, '2023-04-01', 'rttrv', 0, 'ONLINE', 45),
(47, 1, '2023-04-01', 4200, '2023-04-01', 'crgtbhbhb', 0, 'ONLINE', 45),
(48, 1, '2023-04-01', 2500, '2023-04-01', 'megh', 0, 'ONLINE', 45),
(49, 0, '2023-04-02', 3500, '2023-04-02', 'AHMEDABAD', 1, 'COD', 45),
(50, 0, '2023-04-20', 5000, '2023-04-20', 'fvdfv', 0, 'ONLINE', 45),
(51, 0, '2023-04-24', 2500, '0000-00-00', 'aaaaa', 0, 'COD', 47);

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `sales_sales_id` int(11) NOT NULL,
  `product_product_id` int(11) NOT NULL,
  `QTY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`sales_sales_id`, `product_product_id`, `QTY`) VALUES
(25, 11, 2),
(25, 14, 1),
(27, 11, 1),
(32, 14, 1),
(34, 12, 1),
(35, 12, 1),
(36, 12, 1),
(37, 12, 1),
(38, 13, 1),
(46, 15, 1),
(47, 20, 1),
(48, 15, 1),
(49, 12, 1),
(50, 18, 1),
(51, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_return`
--

CREATE TABLE `sales_return` (
  `sales_return_id` int(11) NOT NULL,
  `return_date` date NOT NULL,
  `reason` varchar(45) DEFAULT NULL,
  `sales_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_details`
--

CREATE TABLE `sales_return_details` (
  `sales_return_sales_return_id` int(11) NOT NULL,
  `product_product_id` int(11) NOT NULL,
  `QTY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(30) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `GSTIN_no` varchar(15) NOT NULL,
  `area_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `contact_no`, `email`, `address`, `GSTIN_no`, `area_id`) VALUES
(5, 'Megh', '6353834310', 'meghmehta02@gmail.com', 'Gandhi Road', '12ABCDE1234M7ZA', 1),
(6, 'Dhawal', '6353834311', 'dhawaldabagr02@gmail.com', 'Amraiwadi', '13ABCDE1234M7ZS', 5),
(7, 'Jaydeep', '6353434310', 'jaydeepmehariya02@gmail.com', 'Bopal', '13ABCDE1234E7ZW', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `Is_Admin` tinyint(1) DEFAULT 0,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mob_no` varchar(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `Is_Admin`, `fname`, `lname`, `email`, `password`, `mob_no`, `address`, `area_id`) VALUES
(1, 1, 'Megh', 'Mehta', 'meghmehta02@gmail.com', '1111', '6353834310', NULL, 0),
(44, 1, 'dhawal', 'dabgar', 'dhawal@gmail.com', '1111', '1234568902', NULL, NULL),
(45, 0, 'dhawal', 'kd', 'dhawal345@gmail.com', '123456', '8659865989', NULL, 0),
(47, 0, 'Kashish', 'shah', 'kashishshah2121@gmail.com', 'Gst@2103', '9574886446', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `u_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`u_id`, `name`, `email`, `mobile`) VALUES
(1, 'megha', 'megha123@gmail.com', '2147483647'),
(2, 'dhawal', 'dhawal@gmail.com', '2147483647'),
(6, 'jaydeep', 'jaydeep123@gmail.com', '2147483647'),
(7, 'Dhawal Kumar Dabgar', 'dhawal345@gmail.com', '89865659889');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`),
  ADD UNIQUE KEY `pincode` (`pincode`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `product_id_idx` (`product_id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `feedback_rating`
--
ALTER TABLE `feedback_rating`
  ADD PRIMARY KEY (`f_r_id`),
  ADD KEY `product_product_id_id` (`product_id`),
  ADD KEY `user_user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_cat_id` (`product_cate_id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`production_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `production_details`
--
ALTER TABLE `production_details`
  ADD PRIMARY KEY (`production_production_id`,`rawmaterial_rawmaterial_id`),
  ADD KEY `fk_production_has_rawmaterial_rawmaterial1_idx` (`rawmaterial_rawmaterial_id`),
  ADD KEY `fk_production_has_rawmaterial_production1_idx` (`production_production_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_cate_id`);

--
-- Indexes for table `product_feature`
--
ALTER TABLE `product_feature`
  ADD KEY `product_id_idx` (`product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `supplier_id_idx` (`supplier_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`purchase_purchase_id`,`rawmaterial_rawmaterial_id`),
  ADD KEY `fk_purchase_has_rawmaterial_rawmaterial1_idx` (`rawmaterial_rawmaterial_id`),
  ADD KEY `fk_purchase_has_rawmaterial_purchase1_idx` (`purchase_purchase_id`);

--
-- Indexes for table `purchase_return`
--
ALTER TABLE `purchase_return`
  ADD PRIMARY KEY (`purchase_return_id`),
  ADD KEY `purchase_id_idx` (`purchase_id`);

--
-- Indexes for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  ADD PRIMARY KEY (`purchase_return_purchase_return_id`,`rawmaterial_rawmaterial_id`),
  ADD KEY `fk_purchase_return_has_rawmaterial_rawmaterial1_idx` (`rawmaterial_rawmaterial_id`),
  ADD KEY `fk_purchase_return_has_rawmaterial_purchase_return1_idx` (`purchase_return_purchase_return_id`);

--
-- Indexes for table `rawmaterial`
--
ALTER TABLE `rawmaterial`
  ADD PRIMARY KEY (`rawmaterial_id`);

--
-- Indexes for table `rawmaterial_details`
--
ALTER TABLE `rawmaterial_details`
  ADD PRIMARY KEY (`rawmaterial_rawmaterial_id`,`supplier_supplier_id`),
  ADD KEY `fk_rawmaterial_has_supplier_supplier1_idx` (`supplier_supplier_id`),
  ADD KEY `fk_rawmaterial_has_supplier_rawmaterial1_idx` (`rawmaterial_rawmaterial_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`sales_sales_id`,`product_product_id`),
  ADD KEY `fk_sales_has_product_product1_idx` (`product_product_id`),
  ADD KEY `fk_sales_has_product_sales1_idx` (`sales_sales_id`);

--
-- Indexes for table `sales_return`
--
ALTER TABLE `sales_return`
  ADD PRIMARY KEY (`sales_return_id`),
  ADD KEY `sales_id_idx` (`sales_id`);

--
-- Indexes for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  ADD PRIMARY KEY (`sales_return_sales_return_id`,`product_product_id`),
  ADD KEY `fk_sales_return_has_product_product1_idx` (`product_product_id`),
  ADD KEY `fk_sales_return_has_product_sales_return1_idx` (`sales_return_sales_return_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_rating`
--
ALTER TABLE `feedback_rating`
  MODIFY `f_r_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `production_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `purchase_return`
--
ALTER TABLE `purchase_return`
  MODIFY `purchase_return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `rawmaterial`
--
ALTER TABLE `rawmaterial`
  MODIFY `rawmaterial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `city_id` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product_product_id_id_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_user_id_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feedback_rating`
--
ALTER TABLE `feedback_rating`
  ADD CONSTRAINT `product_product_id_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_cat_id` FOREIGN KEY (`product_cate_id`) REFERENCES `product_category` (`product_cate_id`);

--
-- Constraints for table `production`
--
ALTER TABLE `production`
  ADD CONSTRAINT `product_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `production_details`
--
ALTER TABLE `production_details`
  ADD CONSTRAINT `fk_production_has_rawmaterial_production1` FOREIGN KEY (`production_production_id`) REFERENCES `production` (`production_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_production_has_rawmaterial_rawmaterial1` FOREIGN KEY (`rawmaterial_rawmaterial_id`) REFERENCES `rawmaterial` (`rawmaterial_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_feature`
--
ALTER TABLE `product_feature`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `fk_purchase_has_rawmaterial_purchase1` FOREIGN KEY (`purchase_purchase_id`) REFERENCES `purchase` (`purchase_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_purchase_has_rawmaterial_rawmaterial1` FOREIGN KEY (`rawmaterial_rawmaterial_id`) REFERENCES `rawmaterial` (`rawmaterial_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_return`
--
ALTER TABLE `purchase_return`
  ADD CONSTRAINT `purchase_id` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  ADD CONSTRAINT `fk_purchase_return_has_rawmaterial_purchase_return1` FOREIGN KEY (`purchase_return_purchase_return_id`) REFERENCES `purchase_return` (`purchase_return_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_purchase_return_has_rawmaterial_rawmaterial1` FOREIGN KEY (`rawmaterial_rawmaterial_id`) REFERENCES `rawmaterial` (`rawmaterial_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rawmaterial_details`
--
ALTER TABLE `rawmaterial_details`
  ADD CONSTRAINT `fk_rawmaterial_has_supplier_rawmaterial1` FOREIGN KEY (`rawmaterial_rawmaterial_id`) REFERENCES `rawmaterial` (`rawmaterial_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rawmaterial_has_supplier_supplier1` FOREIGN KEY (`supplier_supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD CONSTRAINT `fk_sales_has_product_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_sales_id` FOREIGN KEY (`sales_sales_id`) REFERENCES `sales` (`sales_id`);

--
-- Constraints for table `sales_return`
--
ALTER TABLE `sales_return`
  ADD CONSTRAINT `sales_sales_id_id` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`sales_id`);

--
-- Constraints for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  ADD CONSTRAINT `fk_sales_return_has_product_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sales_return_has_product_sales_return1` FOREIGN KEY (`sales_return_sales_return_id`) REFERENCES `sales_return` (`sales_return_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `area_id` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
