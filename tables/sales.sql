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
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_on_date` varchar(100) NOT NULL,
  `student_id` int(50) NOT NULL,
  `sale_info` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `pay_mode` varchar(100) NOT NULL,
  `transaction_no` varchar(100) NOT NULL,
  `remark` tinytext NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `sale_on_date`, `student_id`, `sale_info`, `total_price`, `pay_mode`, `transaction_no`, `remark`, `is_active`, `deleted`, `created_on`, `updated_on`) VALUES
(1, '2019-12-17', 180002, '{"items":[{"inventory_id":"1","item_id":"1","item_name":"Book","quantity":"20","unit_price":"65.00","sub_price":"1300"},{"inventory_id":"2","item_id":"2","item_name":"Pen","quantity":"10","unit_price":"20.00","sub_price":"200"}]}', '1500.00', '2', 'sbi2019', 'demo', '1', '0', '2019-12-17 14:07:37', '2019-12-17 14:07:37'),
(2, '2019-12-17', 180003, '{"items":[{"inventory_id":"1","item_id":"1","item_name":"Book","quantity":"20","unit_price":"65.00","sub_price":"1300"},{"inventory_id":"2","item_id":"2","item_name":"Pen","quantity":"10","unit_price":"20.00","sub_price":"200"}]}', '1500.00', '1', 'cheque2019', 'demo', '1', '0', '2019-12-17 17:24:53', '2019-12-17 17:24:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
