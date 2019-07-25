-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2019 at 08:58 AM
-- Server version: 5.6.43-84.3-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wwwnitid_inventory_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_id` int(10) NOT NULL,
  `financial_year_begins_from` date NOT NULL,
  `financial_year_valid_to` date NOT NULL,
  `books_beginning_from` date NOT NULL,
  `address` text NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `fax_no` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gstin` varchar(20) NOT NULL,
  `pan` varchar(20) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_branch` varchar(50) NOT NULL,
  `bank_address` varchar(255) NOT NULL,
  `account_number` varchar(15) NOT NULL,
  `ifsc` varchar(15) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `state_id`, `financial_year_begins_from`, `financial_year_valid_to`, `books_beginning_from`, `address`, `phone_no`, `mobile`, `fax_no`, `email`, `gstin`, `pan`, `bank_name`, `bank_branch`, `bank_address`, `account_number`, `ifsc`, `logo`) VALUES
(1, 'J.K. INSTITUTE OF TECHNOLOGY', 46, '2019-03-01', '2020-03-31', '0000-00-00', 'Kailash Nagar, NIMBAHERA, Dist. Chittorgarh (Raj.)', '', '', '', '', '', '', '', '', '', '', '', '');

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
(1, 'ADMIN ( MAIN STORE )', 0),
(4, 'MMV', 0),
(5, 'AOCP', 0),
(6, 'RAC', 0);

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
(1, 'Super Admin', 'admin', '$2y$10$rg61cBlo66vJL.MdAGhokuGiyDaLF9BN34gyy38..aPZRvl39.jSG', 'admin@jkit.com', '9664100138', 1, '', 'Nimbahera', 5, '2019-07-20 05:33:35', 1, '0000-00-00 00:00:00', 0, 0, 0),
(8, 'f', 'fdfd', '$2y$10$5qS/2HLXMtMp3hTmxMW2hedmf8yowATIsbhgfrfjjjHLXCeoMcGw2', 'fdf', 'df', 0, '', '', 0, '2019-07-20 10:24:40', 1, '0000-00-00 00:00:00', 0, 0, 0);

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
(1, 1, 1, '2019-07-20', '123', 'Auto', 1, 'Pass', '2019-07-20 11:36:19', 1, '0000-00-00 00:00:00', 0, 0);

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
(1, 1, 1, 5, '15', '20.00', '300.00');

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
(1, 1, 2, '2019-07-13', '2019-07-13 06:34:44', 1, '0000-00-00 00:00:00', 0, 0),
(2, 2, 2, '2019-07-15', '2019-07-15 07:09:37', 1, '0000-00-00 00:00:00', 0, 0),
(3, 3, 2, '2019-07-16', '2019-07-16 04:19:23', 1, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `issue_slip_rows`
--

CREATE TABLE `issue_slip_rows` (
  `id` int(20) NOT NULL,
  `issue_slip_id` int(20) NOT NULL,
  `row_material_category_id` int(11) NOT NULL,
  `row_material_id` int(20) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_slip_rows`
--

INSERT INTO `issue_slip_rows` (`id`, `issue_slip_id`, `row_material_category_id`, `row_material_id`, `quantity`, `description`) VALUES
(1, 1, 0, 1, '5.00', '5 issue 10 '),
(2, 2, 0, 1, '1.00', '11'),
(3, 3, 0, 1, '2.00', 'to MMV');

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
(23, 'Request Slips', NULL, 145, 150, '', '', 'fa fa-paw', 'N', '', ''),
(24, 'Create', 26, 64, 65, 'MaterialTransferSlips', 'add', 'fa fa-plus', 'Y', '', ''),
(25, 'View', 26, 66, 67, 'MaterialTransferSlips', 'index', 'fa fa-list', 'N', '', ''),
(26, 'Material Transfer Slips', NULL, 63, 76, '', '', 'fa fa-exchange', 'N', '', ''),
(27, 'Material transfer slips', 37, 68, 71, 'MaterialTransferSlips', 'report', '', 'N', '', ''),
(28, 'Issue Slips', NULL, 77, 86, '', '', 'fa fa-fw fa-mail-forward', 'N', '', ''),
(29, 'Create', 28, 78, 79, 'IssueSlips', 'add', 'fa fa-plus', 'N', '', ''),
(30, 'View', 28, 80, 81, 'IssueSlips', 'index', 'fa fa-list', 'N', '', ''),
(31, 'Issue slips', 37, 82, 83, 'IssueSlips', 'report', '', 'N', '', ''),
(32, 'Return Slips', NULL, 87, 98, '', '', 'fa fa-fw fa-mail-reply', 'N', '', ''),
(33, 'Create', 32, 88, 89, 'ReturnSlips', 'returnSearchEmp', 'fa fa-plus', 'N', '', ''),
(34, 'View', 32, 90, 91, 'ReturnSlips', 'index', 'fa fa-list', 'N', '', ''),
(35, 'Return slips', 37, 92, 93, 'ReturnSlips', 'report', '', 'N', '', ''),
(36, 'Vendors', 2, 14, 15, 'Vendors', 'index', '', 'N', '', ''),
(37, 'Reports', NULL, 99, 114, '', '', 'fa fa-fw fa-file-excel-o', 'N', '', ''),
(38, 'Scrap Items', 37, 100, 101, 'ReturnSlips', 'scrabMaterialReport', '', 'N', '', ''),
(39, 'Disposed Items', 37, 69, 70, 'ReturnSlips', 'disposedMaterialReport', '', 'N', '', ''),
(40, 'Approval', NULL, 115, 126, '', '', 'fa fa-check', 'N', '', ''),
(41, 'Scap ', 40, 116, 117, 'ReturnSlips', 'scrabApproval', '', 'N', '', ''),
(42, 'Requisition Slips', 40, 118, 119, 'RequisitionSlips', 'reqListApproval', '', 'N', '', ''),
(43, 'Employee Stock', 37, 110, 111, 'Employees', 'employeeStock', '', 'N', '', ''),
(44, 'Department Stock', 37, 112, 113, 'Employees', 'mainStock', '', 'N', '', ''),
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
(62, 'Edit', 23, 74, 75, 'MaterialTransferSlips', 'edit', '', 'Y', '', ''),
(63, 'Edit', 28, 84, 85, 'IssueSlips', 'edit', '', 'Y', '', ''),
(64, 'Edit', 32, 94, 95, 'ReturnSlips', 'edit', '', 'Y', '', ''),
(66, 'Consumable Report', 37, 106, 107, 'RequisitionSlips', 'file', '', 'N', '', ''),
(67, 'Stock Register', 37, 108, 109, 'ReturnSlips', 'stockRegisterReport', '', 'N', '', ''),
(68, 'Admin Edit', 11, 38, 39, 'RequisitionSlips', 'adminEdit', '', 'Y', '', ''),
(69, 'Reqslip For PO', 11, 40, 41, 'RequisitionSlips', 'reqslipList', '', 'Y', '', ''),
(70, 'Detail View', 16, 52, 53, 'PurchaseOrders', 'view', '', 'Y', '', ''),
(71, 'Return Search Employee', 32, 96, 97, 'ReturnSlips', 'add', '', 'Y', '', ''),
(72, 'PO Request', 40, 120, 121, 'PurchaseOrders', 'poApproval', '', 'N', '', ''),
(74, 'add', 23, 146, 147, 'RequestSlips', 'add', '', 'N', '', ''),
(75, 'view', 23, 148, 149, 'RequestSlips', 'index', '', 'N', '', ''),
(76, 'Transfer Approval', 40, 122, 123, 'RequestSlips', 'requestApprovalEmployee', '', 'N', '', ''),
(77, 'Final Approval', 40, 124, 125, 'RequestSlips', 'requestApprovalAdmin', '', 'N', '', ''),
(78, 'View', 11, 30, 31, 'RequisitionSlips', 'index', 'fa fa-list', 'N', '', '');

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
(1, 1, '1', 1, '2019-07-20', '300.00', '2', '20', 'JKITI', '2', 'Cash', '2019-07-20', '2019-07-20 11:35:04', 1, '2019-07-20 11:35:37', 0, 0, 1, 1, '2019-07-20 11:35:37', 'ac');

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
(1, 1, 1, 2, 5, '15.00', '20', '300.00', '15.00');

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
(1, 1, 8, '2019-07-20', '2019-07-20 12:08:46', 1, '0000-00-00 00:00:00', 0, 3, '0000-00-00 00:00:00', '', 3, '0000-00-00 00:00:00', '', 0, 0);

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
(1, 1, 1, '1.00');

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
(1, 1, '2019-07-20 11:32:58', 1, '2019-07-20 11:35:04', 1, '2019-07-20', 'Approved', '2019-07-20 11:34:13', 1, 'a', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `requisition_slip_rows`
--

CREATE TABLE `requisition_slip_rows` (
  `id` int(20) NOT NULL,
  `requisition_slip_id` int(20) NOT NULL,
  `row_material_category_id` int(11) NOT NULL,
  `row_material_id` int(20) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `po_flag` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisition_slip_rows`
--

INSERT INTO `requisition_slip_rows` (`id`, `requisition_slip_id`, `row_material_category_id`, `row_material_id`, `quantity`, `description`, `po_flag`) VALUES
(2, 1, 0, 5, '15.00', '10mtr', 1);

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

--
-- Dumping data for table `return_slips`
--

INSERT INTO `return_slips` (`id`, `voucher_no`, `employee_id`, `transaction_date`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`) VALUES
(1, 1, 2, '2019-07-13', '2019-07-13 06:43:10', 1, '0000-00-00 00:00:00', 0, 0),
(2, 2, 2, '2019-07-13', '2019-07-13 06:46:15', 1, '0000-00-00 00:00:00', 0, 0);

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

--
-- Dumping data for table `return_slip_rows`
--

INSERT INTO `return_slip_rows` (`id`, `return_slip_id`, `row_material_id`, `quantity`, `return_scrab`, `description`) VALUES
(1, 1, 1, '3.00', 'Return', 'not required'),
(2, 2, 1, '1.00', 'Scrape', 'scrap');

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
(1, 'ADMIN', 0, '2019-07-10 11:26:18'),
(2, 'DEPARTMENT STORE INCHARGE', 0, '2019-07-10 11:26:02');

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
(1, 'item 12', 1, 2, 'No', '2019-07-13 06:23:33', 2, '2019-07-22 08:46:19', 1, 0),
(2, 'item 2', 1, 4, 'Yes', '2019-07-16 03:59:03', 1, '0000-00-00 00:00:00', 0, 0),
(3, 'pens', 3, 8, 'No', '2019-07-16 04:00:10', 1, '0000-00-00 00:00:00', 0, 0),
(4, 'material 2', 1, 1, 'Yes', '2019-07-16 04:39:14', 1, '0000-00-00 00:00:00', 0, 0),
(5, 'rope', 2, 2, 'Yes', '2019-07-20 10:56:54', 1, '0000-00-00 00:00:00', 0, 0);

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
(1, 'Fixed Items', 0),
(2, 'Raw Materials reusable ', 0),
(3, 'Consumable', 0),
(4, 'Scrap items', 0);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `state_code`) VALUES
(39, 'JAMMU AND KASHMIR', 1),
(40, 'HIMACHAL PRADESH', 2),
(41, 'PUNJAB', 3),
(42, 'CHANDIGARH', 4),
(43, 'UTTARAKHAND', 5),
(44, 'HARYANA', 6),
(45, 'DELHI', 7),
(46, 'RAJASTHAN', 8),
(47, 'UTTAR  PRADESH', 9),
(48, 'BIHAR', 10),
(49, 'SIKKIM', 11),
(50, 'ARUNACHAL PRADESH', 12),
(51, 'NAGALAND', 13),
(52, 'MANIPUR', 14),
(53, 'MIZORAM', 15),
(54, 'TRIPURA', 16),
(55, 'MEGHLAYA', 17),
(56, 'ASSAM', 18),
(57, 'WEST BENGAL', 19),
(58, 'JHARKHAND', 20),
(59, 'ODISHA', 21),
(60, 'CHATTISGARH', 22),
(61, 'MADHYA PRADESH', 23),
(62, 'GUJARAT', 24),
(63, 'DAMAN AND DIU', 25),
(64, 'DADRA AND NAGAR HAVELI', 26),
(65, 'MAHARASHTRA', 27),
(66, 'ANDHRA PRADESH(BEFORE DIVISION)', 28),
(67, 'KARNATAKA', 29),
(68, 'GOA', 30),
(69, 'LAKSHWADEEP', 31),
(70, 'KERALA', 32),
(71, 'TAMIL NADU', 33),
(72, 'PUDUCHERRY', 34),
(73, 'ANDAMAN AND NICOBAR ISLANDS', 35),
(74, 'TELANGANA', 36),
(75, 'ANDHRA PRADESH (NEW)', 37);

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
(1, 1, '2019-07-13', 'yes', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', NULL, 'In', 0, 0, 0, '2019-07-13 06:23:34', 2, '0000-00-00 00:00:00', 0, 0, ''),
(4, 1, '2019-07-13', 'no', 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, '5.00', NULL, 'Out', 0, 0, 0, '2019-07-13 06:34:46', 1, '0000-00-00 00:00:00', 0, 0, '5 issue 10 '),
(5, 1, '2019-07-13', 'no', 0, 0, 2, 2, 1, 1, 0, 0, 0, 0, '5.00', NULL, 'In', 0, 0, 0, '2019-07-13 06:34:46', 1, '0000-00-00 00:00:00', 0, 0, '5 issue 10 '),
(6, 1, '2019-07-13', 'no', 0, 0, 1, 1, 0, 0, 1, 1, 0, 0, '3.00', NULL, 'In', 0, 0, 0, '2019-07-13 06:43:11', 1, '0000-00-00 00:00:00', 0, 0, 'not required'),
(7, 1, '2019-07-13', 'no', 0, 0, 2, 2, 0, 0, 1, 1, 0, 0, '3.00', NULL, 'Out', 0, 0, 0, '2019-07-13 06:43:11', 1, '0000-00-00 00:00:00', 0, 0, 'not required'),
(8, 1, '2019-07-13', 'no', 0, 0, 1, 1, 0, 0, 2, 2, 0, 0, '1.00', NULL, 'In', 1, 0, 0, '2019-07-13 06:46:15', 1, '0000-00-00 00:00:00', 0, 0, 'scrap'),
(9, 1, '2019-07-13', 'no', 0, 0, 2, 2, 0, 0, 2, 2, 0, 0, '1.00', NULL, 'Out', 1, 1, 1, '2019-07-13 06:58:37', 1, '2019-07-13 06:58:37', 0, 0, 'scrap'),
(10, 1, '2019-07-15', 'no', 0, 0, 1, 1, 2, 2, 0, 0, 0, 0, '1.00', NULL, 'Out', 0, 0, 0, '2019-07-15 07:09:38', 1, '0000-00-00 00:00:00', 0, 0, '11'),
(11, 1, '2019-07-15', 'no', 0, 0, 2, 2, 2, 2, 0, 0, 0, 0, '1.00', NULL, 'In', 0, 0, 0, '2019-07-15 07:09:38', 1, '0000-00-00 00:00:00', 0, 0, '11'),
(12, 2, '2019-07-16', 'yes', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '20.00', NULL, 'In', 0, 0, 0, '2019-07-16 03:59:04', 1, '0000-00-00 00:00:00', 0, 0, ''),
(13, 3, '2019-07-16', 'yes', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10.00', NULL, 'In', 0, 0, 0, '2019-07-16 04:00:10', 1, '0000-00-00 00:00:00', 0, 0, ''),
(14, 1, '2019-07-16', 'no', 3, 3, 1, 1, 0, 0, 0, 0, 0, 0, '17.00', NULL, 'In', 0, 0, 0, '2019-07-16 04:18:18', 1, '0000-00-00 00:00:00', 0, 0, ''),
(15, 2, '2019-07-16', 'no', 3, 4, 1, 1, 0, 0, 0, 0, 0, 0, '2.00', NULL, 'In', 0, 0, 0, '2019-07-16 04:18:18', 1, '0000-00-00 00:00:00', 0, 0, ''),
(16, 1, '2019-07-16', 'no', 0, 0, 1, 1, 3, 3, 0, 0, 0, 0, '2.00', NULL, 'Out', 0, 0, 0, '2019-07-16 04:19:23', 1, '0000-00-00 00:00:00', 0, 0, 'to MMV'),
(17, 1, '2019-07-16', 'no', 0, 0, 2, 2, 3, 3, 0, 0, 0, 0, '2.00', NULL, 'In', 0, 0, 0, '2019-07-16 04:19:23', 1, '0000-00-00 00:00:00', 0, 0, 'to MMV'),
(18, 4, '2019-07-16', 'yes', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '20.00', NULL, 'In', 0, 0, 0, '2019-07-16 04:39:14', 1, '0000-00-00 00:00:00', 0, 0, ''),
(19, 5, '2019-07-20', 'yes', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '200.00', NULL, 'In', 0, 0, 0, '2019-07-20 10:56:55', 1, '0000-00-00 00:00:00', 0, 0, ''),
(21, 3, '2019-07-20', 'no', 3, 3, 1, 1, 0, 0, 0, 0, 0, 0, '10.00', NULL, 'In', 0, 0, 0, '2019-07-20 11:25:19', 1, '0000-00-00 00:00:00', 0, 0, ''),
(22, 5, '2019-07-20', 'no', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, '15.00', NULL, 'In', 0, 0, 0, '2019-07-20 11:36:20', 1, '0000-00-00 00:00:00', 0, 0, ''),
(23, 1, '2019-07-22', 'yes', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '100.00', NULL, 'In', 0, 0, 0, '2019-07-22 08:46:20', 1, '0000-00-00 00:00:00', 0, 0, '');

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
(1, 'KG', 0),
(2, 'METER', 0),
(4, 'NUMBER', 0),
(5, 'LITER', 0),
(6, 'SQ. METER', 0),
(7, 'SET', 0),
(8, 'PCS', 0),
(9, 'BOX', 0),
(10, 'PAIR', 0),
(11, 'KIT', 0);

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
(3, 1, 5, '1,45,2,3,4,5,6,7,36,8,9,10,54,11,12,13,59,68,69,16,17,18,60,70,20,21,22,53,61,23,24,25,62,28,29,30,63,32,33,34,64,71,37,15,26,31,35,38,39,46,47,66,67,40,41,42,72,77,43,44,48,49,55,56,57,58,52,73,74,75'),
(7, 1, NULL, '1,45,11,12,13,59,68,69,23,24,25,62,37,15,26,31,35,38,39,43,52'),
(8, 7, NULL, '1,45,11,12,13,59,68,69,23,24,25,62,37,15,26,31,35,38,39,43,52'),
(9, NULL, 9, ''),
(10, NULL, 7, ''),
(11, NULL, 11, ''),
(12, NULL, 10, ''),
(13, NULL, 4, ''),
(14, 6, NULL, '1,45,11,12,13,59,16,17,18,60,23,25,43,44,73,74,75'),
(15, 4, NULL, '1,45,2,3,4,5,6,7,36,8,9,10,54,11,12,13,59,68,69,16,17,18,60,70,20,21,22,53,61,23,24,25,62,26,74,75,28,29,30,63,32,33,34,64,71,37,15,27,31,35,38,39,43,44,46,47,66,67,40,41,42,72,76,77,48,49,55,56,57,58,52'),
(16, 5, NULL, '1,11,12,13,59,23,25,28,30,32,33,34,64,37,15,52'),
(17, NULL, 6, '1,45,11,12,13,59,23,25,32,33,34,64,37,15,26,31,35,38,39');

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
(1, 'Demo Vendor', 'Udaipur', '9876543210', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `states`
--
ALTER TABLE `states`
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
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `issue_slip_rows`
--
ALTER TABLE `issue_slip_rows`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `material_transfer_slips`
--
ALTER TABLE `material_transfer_slips`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_transfer_slip_rows`
--
ALTER TABLE `material_transfer_slip_rows`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `return_slips`
--
ALTER TABLE `return_slips`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `return_slip_rows`
--
ALTER TABLE `return_slip_rows`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `row_materials`
--
ALTER TABLE `row_materials`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `row_material_categories`
--
ALTER TABLE `row_material_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `stock_ledgers`
--
ALTER TABLE `stock_ledgers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
