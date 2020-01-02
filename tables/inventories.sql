-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2019 at 07:21 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ganga_college`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE IF NOT EXISTS `inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_on_date` varchar(25) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `available_quantity` int(100) NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `pay_mode` varchar(25) NOT NULL,
  `transaction_no` varchar(25) NOT NULL,
  `remark` tinytext NOT NULL,
  `agency_name` varchar(255) NOT NULL,
  `bill_ref_no` varchar(50) NOT NULL,
  `bill_add` varchar(1000) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `item_on_date`, `item_id`, `quantity`, `available_quantity`, `purchase_price`, `sale_price`, `total_amount`, `pay_mode`, `transaction_no`, `remark`, `agency_name`, `bill_ref_no`, `bill_add`, `is_active`, `deleted`, `created_on`, `updated_on`) VALUES
(1, '2019-12-14', 1, 800, 760, '60.00', '65.00', '48000.00', '1', 'cheque2019', 'Demo', 'fillip technology', 'fillip12345678', '', '1', '0', '2019-12-14 12:20:16', '2019-12-17 17:24:53'),
(2, '2019-12-14', 2, 500, 480, '15.00', '20.00', '7500.00', '2', 'sbi2019', 'Demo', 'fillip technology', 'fillip12345678', 'beb1d0dde3bcd4c7e9bf582f04667cb9.png', '1', '0', '2019-12-14 15:48:03', '2019-12-17 17:24:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
