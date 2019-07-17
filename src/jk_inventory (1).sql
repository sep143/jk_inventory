-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2019 at 12:34 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jk_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `is_deleted`) VALUES
(1, 'Admin', 0),
(2, 'MMV', 0),
(3, 'ADM. OFFICE', 0),
(4, 'ICTSM', 0),
(5, 'ELECTRICIAN', 0),
(6, 'ELECTRONICS MECHANIC', 0),
(7, 'RAC', 0),
(8, 'LIBRARY', 0),
(9, 'FITTER', 0),
(10, 'WELDER', 0),
(11, 'AOCP', 0),
(12, 'COPA', 0),
(13, 'DM', 0),
(14, 'MAIN STORE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `department_id` int(10) NOT NULL,
  `signature` varchar(50) NOT NULL,
  `address` varchar(300) NOT NULL,
  `role_id` int(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `edited_by` tinyint(4) NOT NULL,
  `forgot_code` int(10) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `username`, `password`, `email`, `mobile_no`, `department_id`, `signature`, `address`, `role_id`, `created_on`, `created_by`, `edited_on`, `edited_by`, `forgot_code`, `is_deleted`) VALUES
(1, 'Yash Menariya', 'yash', '$2y$10$MjDtsEgLzoMtVpgfPPWQpeu71j7lsMF/aQcz1vk6wa2ymW4CuwONG', 'prakash@gmail.com', '9664100138', 1, 'prakash', 'nimbahera', 1, '2019-01-11 05:54:04', 1, '0000-00-00 00:00:00', 4, 0, 0),
(2, 'Ashish Bohara', 'ashu', '$2y$10$t9Nh5zqn0QhVWtltmCnY9uCJvt335TJdxpT6uNspECd4AU7u5MUr.', 'ashu@yahoo.com', '8005826504', 3, '', 'mavli', 3, '2019-02-25 15:29:38', 0, '0000-00-00 00:00:00', 4, 477435, 0),
(3, 'Prakash Menariya', 'prakash', '$2y$10$zIep5Pv.ViTaCGrTMD7.buNOVC12wtWJp1kY3w8WaVFCVGUY1bdx2', 'yash@gmail.com', '9664100138', 4, '', 'Udaipur', 4, '2019-02-25 15:29:33', 1, '0000-00-00 00:00:00', 4, 3635, 0),
(4, 'Super Admin', 'admin', '$2y$10$mAiAkkZ3hY.Dmghx8xY1gesiR708h2soYqBNY8AjeW/vQ3fLS5Kmm', 'admin@jkit.com', '9664100138', 1, '', 'Nimbahera', 5, '2018-12-20 05:55:29', 1, '0000-00-00 00:00:00', 0, 0, 0),
(5, 'dsu menaria', 'dsu', '$2y$10$LBw39Eo8AlJHq.YrhqXPtu.gwDwbps7JhaHOBq0VyM55NTOzF2fmK', 'dsu@gmail.com', '8878985560', 2, '', 'Menar', 4, '2018-12-24 05:38:00', 1, '0000-00-00 00:00:00', 0, 0, 0),
(6, 'SHAILENDRA VAISHNAV', 'SHAILENDRA', '$2y$10$1LN/e0lqvmDC.yDscRvK5.b8dNnch482YbQGrG.VKU8MpJ2pU05bm', 'gopal@ggmail.com', '123465858', 4, '', 'SV\r\n', 7, '2019-01-30 05:12:59', 1, '0000-00-00 00:00:00', 4, 0, 0),
(7, 'H R PARLIA ', 'HR', '$2y$10$59whbGRaBLdd3Z9QT6mRtu1UPs1d9mMQGX4q9HkfOxwQdFLTzDE3m', 'hridayparlia@gmail.com', '9001999655', 1, '', 'aaaa', 3, '2018-12-26 00:01:56', 4, '0000-00-00 00:00:00', 0, 0, 0),
(8, 'Naresh Pushkarna', 'NARESHPUSHKARNA', '$2y$10$kEoHhDnfaSrjm7gg3uYU0eE/Td43q4CkeYULv8ZUP0yjUAL0bwltW', 'naresh@gmail.com', '9001999658', 5, '', 'NP', 4, '2018-12-27 01:14:44', 4, '0000-00-00 00:00:00', 4, 0, 0),
(9, 'PRIYANKA BHADORIYA', 'PRIYANKA', '$2y$10$/L4OMuTOW5IFmpAaZF9UIeEsf0CaYft1nSAJmB508itoNiYxTN5uW', 'PRIYANKA123@GMAIL.COM', '987654', 12, '', 'E 115\r\nJ K COLONY\r\nKAILASH NAGAR 2', 11, '2019-01-30 05:46:28', 4, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `good_receive_notes`
--

CREATE TABLE `good_receive_notes` (
  `id` int(20) NOT NULL,
  `voucher_no` int(20) NOT NULL,
  `purchase_order_id` int(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `bill_no` varchar(100) NOT NULL,
  `transport` varchar(100) NOT NULL,
  `inspection_by` int(11) NOT NULL,
  `inspection_remark` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `edited_by` tinyint(4) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `good_receive_notes`
--

INSERT INTO `good_receive_notes` (`id`, `voucher_no`, `purchase_order_id`, `transaction_date`, `bill_no`, `transport`, `inspection_by`, `inspection_remark`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`) VALUES
(1, 1, 1, '2019-02-25', '1212313', 'bus', 1, 'dgdgds', '2019-02-25 15:26:19', 4, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `good_receive_note_rows`
--

CREATE TABLE `good_receive_note_rows` (
  `id` int(20) NOT NULL,
  `good_receive_note_id` int(20) NOT NULL,
  `purchase_order_row_id` int(20) NOT NULL,
  `row_material_id` int(20) NOT NULL,
  `quantity` decimal(10,0) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `good_receive_note_rows`
--

INSERT INTO `good_receive_note_rows` (`id`, `good_receive_note_id`, `purchase_order_row_id`, `row_material_id`, `quantity`, `rate`, `amount`) VALUES
(1, 1, 1, 1, '30', '10.00', '300.00');

-- --------------------------------------------------------

--
-- Table structure for table `issue_slips`
--

CREATE TABLE `issue_slips` (
  `id` int(20) NOT NULL,
  `voucher_no` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `edited_by` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_slips`
--

INSERT INTO `issue_slips` (`id`, `voucher_no`, `employee_id`, `transaction_date`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`) VALUES
(1, 1, 3, '2019-02-25', '2019-02-25 15:27:05', 4, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `issue_slip_rows`
--

CREATE TABLE `issue_slip_rows` (
  `id` int(20) NOT NULL,
  `issue_slip_id` int(20) NOT NULL,
  `row_material_id` int(20) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_slip_rows`
--

INSERT INTO `issue_slip_rows` (`id`, `issue_slip_id`, `row_material_id`, `quantity`, `description`) VALUES
(1, 1, 1, '10.00', 'hello test\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `material_transfer_slips`
--

CREATE TABLE `material_transfer_slips` (
  `id` int(20) NOT NULL,
  `voucher_no` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `edited_by` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_transfer_slips`
--

INSERT INTO `material_transfer_slips` (`id`, `voucher_no`, `employee_id`, `transaction_date`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`) VALUES
(1, 1, 2, '2019-02-27', '2019-02-27 11:30:21', 3, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `material_transfer_slip_rows`
--

CREATE TABLE `material_transfer_slip_rows` (
  `id` int(20) NOT NULL,
  `material_transfer_slip_id` int(20) NOT NULL,
  `row_material_id` int(20) NOT NULL,
  `quantity` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_transfer_slip_rows`
--

INSERT INTO `material_transfer_slip_rows` (`id`, `material_transfer_slip_id`, `row_material_id`, `quantity`) VALUES
(1, 1, 1, '7.00');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `controller` varchar(40) NOT NULL,
  `action` varchar(40) NOT NULL,
  `icon_class_name` varchar(50) NOT NULL,
  `is_hidden` enum('Y','N') NOT NULL DEFAULT 'N',
  `query_string` varchar(30) NOT NULL,
  `target` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_name`, `parent_id`, `lft`, `rght`, `controller`, `action`, `icon_class_name`, `is_hidden`, `query_string`, `target`) VALUES
(1, 'Dashboard', 0, 1, 2, 'Employees', 'dashboard', 'fa fa-dashboard', 'N', '', ''),
(2, 'Masters', NULL, 3, 16, '', '', 'fa fa-fw fa-hand-o-right', 'N', '', ''),
(3, 'Roles', 2, 4, 5, 'Roles', 'index', '', 'N', '', ''),
(4, 'Units', 2, 6, 7, 'Units', 'index', '', 'N', '', ''),
(5, 'Departments', 2, 8, 9, 'Departments', 'index', '', 'N', '', ''),
(6, 'Material Category', 2, 10, 11, 'RowMaterialCategories', 'index', '', 'N', '', ''),
(7, 'Material', 2, 12, 13, 'RowMaterials', 'index', '', 'N', '', ''),
(8, 'Employees', NULL, 17, 24, '', '', 'fa fa-users', 'N', '', ''),
(9, 'Create', 8, 18, 19, 'Employees', 'add', 'fa fa-plus', 'N', '', ''),
(10, 'View', 8, 20, 21, 'Employees', 'index', 'fa fa-list', 'N', '', ''),
(11, 'Requisition Slips', NULL, 25, 42, '', '', 'fa fa-file', 'N', '', ''),
(12, 'Create', 11, 26, 27, 'RequisitionSlips', 'add', 'fa fa-plus', 'N', '', ''),
(13, 'View', 11, 28, 29, 'RequisitionSlips', 'index', 'fa fa-list', 'N', '', ''),
(15, 'Requisition slips', 37, 32, 33, 'RequisitionSlips', 'report', '', 'N', '', ''),
(16, 'Purchase Orders', NULL, 43, 54, '', '', 'fa fa-fw fa-file-powerpoint-o', 'N', '', ''),
(17, 'Create', 16, 44, 45, 'PurchaseOrders', 'add', 'fa fa-plus', 'N', '', ''),
(18, 'View', 16, 46, 47, 'PurchaseOrders', 'index', 'fa fa-list', 'N', '', ''),
(20, 'GRN', NULL, 55, 62, '', '', 'fa fa-fw fa-truck', 'N', '', ''),
(21, 'Create', 20, 58, 59, 'PurchaseOrders', 'poList', 'fa fa-plus', 'N', '', ''),
(22, 'View', 20, 56, 57, 'GoodReceiveNotes', 'index', 'fa fa-list', 'N', '', ''),
(23, 'Material Transfer Slips', NULL, 63, 76, '', '', 'fa fa-exchange', 'N', '', ''),
(25, 'View', 23, 64, 65, 'MaterialTransferSlips', 'index', 'fa fa-list', 'N', '', ''),
(26, 'Material transfer slips', 37, 66, 69, 'MaterialTransferSlips', 'report', '', 'N', '', ''),
(28, 'Issue Slips', NULL, 77, 86, '', '', 'fa fa-fw fa-mail-forward', 'N', '', ''),
(29, 'Create', 28, 78, 79, 'IssueSlips', 'add', 'fa fa-plus', 'N', '', ''),
(30, 'View', 28, 80, 81, 'IssueSlips', 'index', 'fa fa-list', 'N', '', ''),
(31, 'Issue slips', 37, 82, 83, 'IssueSlips', 'report', '', 'N', '', ''),
(32, 'Return Slips', NULL, 87, 98, '', '', 'fa fa-fw fa-mail-reply', 'N', '', ''),
(33, 'Create', 32, 88, 89, 'ReturnSlips', 'returnSearchEmp', 'fa fa-plus', 'N', '', ''),
(34, 'View', 32, 90, 91, 'ReturnSlips', 'index', 'fa fa-list', 'N', '', ''),
(35, 'Return slips', 37, 92, 93, 'ReturnSlips', 'report', '', 'N', '', ''),
(36, 'Vendors', 2, 14, 15, 'Vendors', 'index', '', 'N', '', ''),
(37, 'Reports', NULL, 99, 110, '', '', 'fa fa-fw fa-file-excel-o', 'N', '', ''),
(38, 'Scrap Items', 37, 100, 101, 'ReturnSlips', 'scrabMaterialReport', '', 'N', '', ''),
(39, 'Disposed Items', 37, 67, 68, 'ReturnSlips', 'disposedMaterialReport', '', 'N', '', ''),
(40, 'Approval', NULL, 111, 122, '', '', 'fa fa-check', 'N', '', ''),
(41, 'Scap ', 40, 112, 113, 'ReturnSlips', 'scrabApproval', '', 'N', '', ''),
(42, 'Requisition Slips', 40, 114, 115, 'RequisitionSlips', 'reqListApproval', '', 'N', '', ''),
(43, 'Employee Stock', NULL, 123, 124, 'Employees', 'employeeStock', 'fa fa-shopping-cart', 'N', '', ''),
(44, 'Department Stock', NULL, 125, 126, 'Employees', 'mainStock', 'fa fa-shopping-cart', 'N', '', ''),
(45, 'item Consumptions', 0, 0, 0, 'Employees', 'itemConsumptions', 'fa fa-flask', 'N', '', ''),
(46, 'Purchase Orders', 37, 102, 103, 'PurchaseOrders', 'report', '', 'N', '', ''),
(47, 'GRNs ', 37, 104, 105, 'GoodReceiveNotes', 'report', '', 'N', '', ''),
(48, 'Settings', NULL, 133, 144, '', '', 'fa fa-cog', 'N', '', ''),
(49, 'User rights', 48, 134, 135, 'UserRights', 'add', 'fa fa-key', 'N', '', ''),
(52, 'Change Password', NULL, 0, 0, 'Employees', 'changePassword', '', 'Y', '', ''),
(53, 'Create', 20, 0, 0, 'GoodReceiveNotes', 'add', '', 'Y', '', ''),
(54, 'Edit', 8, 22, 23, 'Employees', 'edit', '', 'Y', '', ''),
(55, 'Menus', 48, 136, 143, 'Menus', 'add', '', 'N', '', ''),
(56, 'View', 55, 137, 138, 'Menus', 'index', '', 'N', '', ''),
(57, 'Edit', 55, 139, 140, 'Menus', 'edit', '', 'Y', '', ''),
(58, 'Create', 55, 141, 142, 'Menus', 'add', '', 'N', '', ''),
(59, 'Edit', 11, 34, 35, 'RequisitionSlips', 'edit', '', 'Y', '', ''),
(60, 'Edit', 16, 50, 51, 'PurchaseOrders', 'edit', '', 'Y', '', ''),
(61, 'Edit', 20, 60, 61, 'GoodReceiveNotes', 'edit', '', 'Y', '', ''),
(62, 'Edit', 23, 72, 73, 'MaterialTransferSlips', 'edit', '', 'Y', '', ''),
(63, 'Edit', 28, 84, 85, 'IssueSlips', 'edit', '', 'Y', '', ''),
(64, 'Edit', 32, 94, 95, 'ReturnSlips', 'edit', '', 'Y', '', ''),
(66, 'Receipt Register', 37, 106, 107, 'GoodReceiveNotes', 'report', '', 'N', '', ''),
(67, 'Stock Register', 37, 108, 109, 'ReturnSlips', 'stockRegisterReport', '', 'N', '', ''),
(68, 'Admin Edit', 11, 38, 39, 'RequisitionSlips', 'adminEdit', '', 'Y', '', ''),
(69, 'Reqslip For PO', 11, 40, 41, 'RequisitionSlips', 'reqslipList', '', 'Y', '', ''),
(70, 'Detail View', 16, 52, 53, 'PurchaseOrders', 'view', '', 'Y', '', ''),
(71, 'Return Search Employee', 32, 96, 97, 'ReturnSlips', 'add', '', 'Y', '', ''),
(72, 'PO Request', 40, 116, 117, 'PurchaseOrders', 'poApproval', '', 'N', '', ''),
(73, 'Request Slips', NULL, 145, 150, '', '', 'fa fa-paw', 'N', '', ''),
(74, 'Create', 73, 146, 147, 'RequestSlips', 'add', '', 'N', '', ''),
(75, 'View', 73, 148, 149, 'RequestSlips', 'index', '', 'N', '', ''),
(76, 'Employee Approval ', 40, 118, 119, 'RequestSlips', 'requestApprovalEmployee', '', 'N', '', ''),
(77, 'Admin Request', 40, 120, 121, 'RequestSlips', 'requestApprovalAdmin', '', 'N', '', ''),
(78, 'add', 23, 74, 75, 'MaterialTransferSlips', 'add', '', 'Y', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(20) NOT NULL,
  `voucher_no` int(20) NOT NULL,
  `requisition_slip_id` varchar(100) NOT NULL,
  `vendor_id` int(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount_per` varchar(50) NOT NULL,
  `packing_forwarding_charges` varchar(50) NOT NULL,
  `delivery_location` varchar(100) NOT NULL,
  `gst_charges` varchar(50) NOT NULL,
  `payment_terms` varchar(100) NOT NULL,
  `delivery_date` date NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `edited_by` tinyint(4) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `approve_flag` tinyint(2) NOT NULL,
  `approve_by` tinyint(2) NOT NULL,
  `approved_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approve_comment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `voucher_no`, `requisition_slip_id`, `vendor_id`, `transaction_date`, `total`, `discount_per`, `packing_forwarding_charges`, `delivery_location`, `gst_charges`, `payment_terms`, `delivery_date`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `approve_flag`, `approve_by`, `approved_on`, `approve_comment`) VALUES
(1, 1, '1', 5, '2019-02-25', '300.00', '', '', '', '', '', '2019-03-07', '2019-02-25 07:17:16', 4, '2019-02-25 10:02:06', 0, 0, 1, 4, '2019-02-25 10:02:06', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_rows`
--

CREATE TABLE `purchase_order_rows` (
  `id` int(20) NOT NULL,
  `purchase_order_id` int(20) NOT NULL,
  `requisition_slip_id` int(11) NOT NULL,
  `requisition_slip_row_id` int(11) NOT NULL,
  `row_material_id` int(20) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,0) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `received_qty` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order_rows`
--

INSERT INTO `purchase_order_rows` (`id`, `purchase_order_id`, `requisition_slip_id`, `requisition_slip_row_id`, `row_material_id`, `quantity`, `rate`, `amount`, `received_qty`) VALUES
(1, 1, 1, 5, 1, '30.00', '10', '300.00', '30.00');

-- --------------------------------------------------------

--
-- Table structure for table `request_slips`
--

CREATE TABLE `request_slips` (
  `id` int(20) NOT NULL,
  `voucher_no` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `edited_by` tinyint(4) NOT NULL,
  `emp_approve_flag` tinyint(2) NOT NULL DEFAULT '3',
  `emp_approved_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `emp_comment` text NOT NULL,
  `admin_approve_flag` tinyint(2) NOT NULL DEFAULT '3',
  `admin_approve_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `admin_comment` text NOT NULL,
  `admin_id` tinyint(2) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_slips`
--

INSERT INTO `request_slips` (`id`, `voucher_no`, `employee_id`, `transaction_date`, `created_on`, `created_by`, `edited_on`, `edited_by`, `emp_approve_flag`, `emp_approved_on`, `emp_comment`, `admin_approve_flag`, `admin_approve_on`, `admin_comment`, `admin_id`, `is_deleted`) VALUES
(1, 1, 2, '2019-02-27', '2019-02-27 11:23:11', 3, '2019-02-27 11:30:14', 0, 1, '2019-02-27 11:27:23', '', 1, '2019-02-27 11:30:14', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `request_slip_rows`
--

CREATE TABLE `request_slip_rows` (
  `id` int(20) NOT NULL,
  `request_slip_id` int(20) NOT NULL,
  `row_material_id` int(20) NOT NULL,
  `quantity` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_slip_rows`
--

INSERT INTO `request_slip_rows` (`id`, `request_slip_id`, `row_material_id`, `quantity`) VALUES
(1, 1, 1, '7.00');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_slips`
--

CREATE TABLE `requisition_slips` (
  `id` int(20) NOT NULL,
  `voucher_no` int(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `edited_by` tinyint(4) NOT NULL,
  `transaction_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `approved_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approved_by` tinyint(4) NOT NULL,
  `admin_comment` text NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `po_flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisition_slips`
--

INSERT INTO `requisition_slips` (`id`, `voucher_no`, `created_on`, `created_by`, `edited_on`, `edited_by`, `transaction_date`, `status`, `approved_on`, `approved_by`, `admin_comment`, `is_deleted`, `po_flag`) VALUES
(1, 1, '2019-02-25 06:57:49', 4, '2019-02-25 07:06:53', 4, '2019-02-25', 'Approved', '2019-02-25 07:06:53', 4, 'approved', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `requisition_slip_rows`
--

CREATE TABLE `requisition_slip_rows` (
  `id` int(20) NOT NULL,
  `requisition_slip_id` int(20) NOT NULL,
  `row_material_id` int(20) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `po_flag` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisition_slip_rows`
--

INSERT INTO `requisition_slip_rows` (`id`, `requisition_slip_id`, `row_material_id`, `quantity`, `description`, `po_flag`) VALUES
(4, 1, 5, '20.00', 'urgent', 0),
(5, 1, 1, '30.00', 'urgent', 1),
(6, 1, 3, '40.00', 'urgent', 0);

-- --------------------------------------------------------

--
-- Table structure for table `return_slips`
--

CREATE TABLE `return_slips` (
  `id` int(20) NOT NULL,
  `voucher_no` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `edited_by` tinyint(4) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return_slip_rows`
--

CREATE TABLE `return_slip_rows` (
  `id` int(20) NOT NULL,
  `return_slip_id` int(20) NOT NULL,
  `row_material_id` int(20) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `return_scrab` varchar(10) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `is_deleted`, `created_on`) VALUES
(1, 'PRINCIPAL', 0, '2018-12-26 08:25:43'),
(2, 'MAIN STORE INCHARGE', 0, '2018-12-26 08:26:11'),
(3, 'Admin Block', 1, '2018-12-26 09:54:42'),
(4, 'CI  EL IA', 0, '2018-12-27 06:38:03'),
(5, 'Super Admin', 0, '2018-12-20 11:10:33'),
(6, 'Main Store', 1, '2018-12-26 09:55:04'),
(7, 'ICTSM 1', 0, '2018-12-27 06:46:54'),
(8, 'SECTION INCHARGE', 0, '2018-12-26 09:53:10'),
(9, 'CI EL1B', 0, '2018-12-27 06:38:22'),
(10, 'CI  EL 1C', 0, '2018-12-27 06:38:44'),
(11, 'COPA', 0, '2019-01-30 11:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `row_materials`
--

CREATE TABLE `row_materials` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `row_material_category_id` int(10) NOT NULL,
  `unit_id` int(10) NOT NULL,
  `reuseable` varchar(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `edited_by` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `row_materials`
--

INSERT INTO `row_materials` (`id`, `name`, `row_material_category_id`, `unit_id`, `reuseable`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`) VALUES
(1, 'register paper type 10 ohm', 1, 4, 'Yes', '2018-12-25 23:58:29', 4, '0000-00-00 00:00:00', 0, 0),
(2, 'smps', 1, 4, 'No', '2018-12-25 23:59:28', 4, '2019-01-30 05:22:02', 4, 1),
(3, 'CAPACITOR', 1, 4, 'Yes', '2018-12-26 06:07:02', 4, '0000-00-00 00:00:00', 0, 0),
(4, 'PAPER A4 SIZE', 2, 4, 'No', '2018-12-26 06:08:26', 4, '0000-00-00 00:00:00', 0, 0),
(5, 'WIRE FLEXIBLE 1SQ.MM  INSULATED ', 3, 2, 'Yes', '2018-12-27 01:01:07', 4, '0000-00-00 00:00:00', 0, 0),
(6, 'GI WIRE 24 GAUGE ', 3, 2, 'Yes', '2018-12-27 01:01:54', 4, '0000-00-00 00:00:00', 0, 0),
(7, 'PLATE  MS 6MM THICK', 5, 6, 'No', '2018-12-27 01:03:54', 4, '0000-00-00 00:00:00', 0, 0),
(8, 'ANGLE MS EQ.  40 MM', 5, 2, 'No', '2018-12-27 01:05:03', 4, '0000-00-00 00:00:00', 0, 0),
(9, 'smps', 1, 4, 'No', '2019-01-30 05:20:29', 4, '2019-01-30 05:29:50', 4, 1),
(10, 'antivirus software', 1, 4, 'No', '2019-01-30 05:23:53', 4, '0000-00-00 00:00:00', 0, 0),
(11, 'bond quick', 2, 4, 'No', '2019-01-30 05:24:58', 4, '2019-01-30 05:28:43', 4, 1),
(12, 'fevi stick', 2, 4, 'No', '2019-01-30 05:27:03', 4, '2019-01-30 05:30:50', 4, 1),
(13, 'ERASER', 2, 4, 'Yes', '2019-01-30 05:34:28', 4, '0000-00-00 00:00:00', 0, 0),
(14, 'ENVELOP', 2, 4, 'Yes', '2019-01-30 05:36:42', 4, '0000-00-00 00:00:00', 0, 0),
(15, 'ELECTRIC BELL', 1, 4, 'Yes', '2019-01-30 05:38:15', 4, '0000-00-00 00:00:00', 0, 0),
(16, 'CONNECTOR RJ 45', 1, 4, 'Yes', '2019-01-30 05:39:41', 4, '0000-00-00 00:00:00', 0, 0),
(17, 'CELL AA', 2, 4, 'No', '2019-01-30 05:40:47', 4, '0000-00-00 00:00:00', 0, 0),
(18, 'HACKSAW BLADES', 1, 4, 'Yes', '2019-01-30 05:41:49', 4, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `row_material_categories`
--

CREATE TABLE `row_material_categories` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `row_material_categories`
--

INSERT INTO `row_material_categories` (`id`, `name`, `is_deleted`) VALUES
(1, 'Fixed', 0),
(2, 'Raw Material', 0),
(3, 'Scape', 0),
(5, 'Consumable', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_ledgers`
--

CREATE TABLE `stock_ledgers` (
  `id` int(20) NOT NULL,
  `row_material_id` int(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `opening_balence` varchar(20) NOT NULL DEFAULT 'no',
  `good_receive_note_id` int(20) NOT NULL,
  `good_receive_note_row_id` int(20) NOT NULL,
  `department_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `issue_slip_id` int(20) NOT NULL,
  `issue_slip_row_id` int(20) NOT NULL,
  `return_slip_id` int(20) NOT NULL,
  `return_slip_row_id` int(20) NOT NULL,
  `material_transfer_slip_id` int(20) NOT NULL,
  `material_transfer_slip_row_id` int(20) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `is_scrab` tinyint(2) NOT NULL,
  `disposed_status` tinyint(1) NOT NULL,
  `disposed_by` tinyint(4) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL,
  `disposed_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_transfered` tinyint(1) NOT NULL,
  `is_used` tinyint(2) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_ledgers`
--

INSERT INTO `stock_ledgers` (`id`, `row_material_id`, `transaction_date`, `opening_balence`, `good_receive_note_id`, `good_receive_note_row_id`, `department_id`, `employee_id`, `issue_slip_id`, `issue_slip_row_id`, `return_slip_id`, `return_slip_row_id`, `material_transfer_slip_id`, `material_transfer_slip_row_id`, `quantity`, `rate`, `status`, `is_scrab`, `disposed_status`, `disposed_by`, `created_on`, `created_by`, `disposed_on`, `is_transfered`, `is_used`, `description`) VALUES
(1, 1, '2019-02-25', 'no', 1, 1, 1, 4, 0, 0, 0, 0, 0, 0, '30.00', NULL, 'In', 0, 0, 0, '2019-02-25 15:26:20', 4, '0000-00-00 00:00:00', 0, 0, ''),
(2, 1, '2019-02-25', 'no', 0, 0, 1, 4, 1, 1, 0, 0, 0, 0, '10.00', NULL, 'Out', 0, 0, 0, '2019-02-25 15:27:05', 4, '0000-00-00 00:00:00', 0, 0, 'hello test\r\n'),
(3, 1, '2019-02-25', 'no', 0, 0, 4, 3, 1, 1, 0, 0, 0, 0, '10.00', NULL, 'In', 0, 0, 0, '2019-02-25 15:27:06', 4, '0000-00-00 00:00:00', 0, 0, 'hello test\r\n'),
(16, 1, '2019-02-27', 'no', 0, 0, 4, 3, 0, 0, 0, 0, 1, 1, '7.00', NULL, 'Out', 0, 0, 0, '2019-02-27 11:30:21', 3, '0000-00-00 00:00:00', 1, 0, ''),
(17, 1, '2019-02-27', 'no', 0, 0, 3, 2, 0, 0, 0, 0, 1, 1, '7.00', NULL, 'In', 0, 0, 0, '2019-02-27 11:30:21', 3, '0000-00-00 00:00:00', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `is_deleted`) VALUES
(1, 'Kg', 0),
(2, 'METER', 0),
(4, 'number', 0),
(5, 'LITER', 0),
(6, 'SQ. METER', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE `user_rights` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_ids` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`id`, `employee_id`, `role_id`, `menu_ids`) VALUES
(3, NULL, 5, '1,2,3,4,5,6,7,36,8,9,10,54,11,12,13,59,68,69,16,17,18,60,70,20,21,22,53,61,23,25,62,78,28,29,30,63,32,33,34,64,71,37,15,26,31,35,38,39,46,47,66,67,40,41,42,72,77,48,49,55,56,57,58,52,73,74,75'),
(4, 3, NULL, '1,45,11,12,13,59,23,24,25,62,37,15,26,31,35,38,39,46,47,66,67,40,76,43,52,73,74,75'),
(5, 2, NULL, '1,45,11,12,13,59,23,24,25,62,37,15,26,31,35,38,39,46,47,66,67,40,76,43,52,73,74,75');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `mobile`, `is_deleted`) VALUES
(2, 'Eltronics', 'jaipur', '9001999659', 0),
(3, 'shakti sales', 'udaipur', '9001999655', 0),
(4, 'SWASTIK ELECTRICALS', 'NIMBAHERA', '0000000000', 0),
(5, 'PATWARI BROTHERS', 'NIMBAHERA\r\n', '0000000000', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `good_receive_notes`
--
ALTER TABLE `good_receive_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `good_receive_note_rows`
--
ALTER TABLE `good_receive_note_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_slips`
--
ALTER TABLE `issue_slips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_slip_rows`
--
ALTER TABLE `issue_slip_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_transfer_slips`
--
ALTER TABLE `material_transfer_slips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_transfer_slip_rows`
--
ALTER TABLE `material_transfer_slip_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_rows`
--
ALTER TABLE `purchase_order_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_slips`
--
ALTER TABLE `request_slips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_slip_rows`
--
ALTER TABLE `request_slip_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition_slips`
--
ALTER TABLE `requisition_slips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition_slip_rows`
--
ALTER TABLE `requisition_slip_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_slips`
--
ALTER TABLE `return_slips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_slip_rows`
--
ALTER TABLE `return_slip_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `row_materials`
--
ALTER TABLE `row_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `row_material_categories`
--
ALTER TABLE `row_material_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_ledgers`
--
ALTER TABLE `stock_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rights`
--
ALTER TABLE `user_rights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `good_receive_notes`
--
ALTER TABLE `good_receive_notes`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `good_receive_note_rows`
--
ALTER TABLE `good_receive_note_rows`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `issue_slips`
--
ALTER TABLE `issue_slips`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `issue_slip_rows`
--
ALTER TABLE `issue_slip_rows`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `material_transfer_slips`
--
ALTER TABLE `material_transfer_slips`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `material_transfer_slip_rows`
--
ALTER TABLE `material_transfer_slip_rows`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `purchase_order_rows`
--
ALTER TABLE `purchase_order_rows`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `request_slips`
--
ALTER TABLE `request_slips`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `request_slip_rows`
--
ALTER TABLE `request_slip_rows`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `requisition_slips`
--
ALTER TABLE `requisition_slips`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `requisition_slip_rows`
--
ALTER TABLE `requisition_slip_rows`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `return_slips`
--
ALTER TABLE `return_slips`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `return_slip_rows`
--
ALTER TABLE `return_slip_rows`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `row_materials`
--
ALTER TABLE `row_materials`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `row_material_categories`
--
ALTER TABLE `row_material_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `stock_ledgers`
--
ALTER TABLE `stock_ledgers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
