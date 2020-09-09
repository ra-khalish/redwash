-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 09, 2020 at 09:52 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_redwash`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_typemotor`
--

CREATE TABLE `tbl_typemotor` (
  `id` int(11) NOT NULL,
  `motor_type` varchar(24) NOT NULL,
  `price` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_typemotor`
--

INSERT INTO `tbl_typemotor` (`id`, `motor_type`, `price`) VALUES
(1, 'Bebek/Matic', 20000),
(2, 'Sport', 40000),
(3, 'Super Sport', 80000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_washing`
--

CREATE TABLE `tbl_washing` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nm_consumer` varchar(64) NOT NULL,
  `contact` varchar(16) NOT NULL,
  `code_booking` varchar(24) NOT NULL,
  `noplat` varchar(16) NOT NULL,
  `pay` int(16) NOT NULL,
  `tot_cost` int(16) NOT NULL,
  `ch_cost` int(16) NOT NULL,
  `status` varchar(12) NOT NULL,
  `cashier` varchar(32) NOT NULL,
  `ctime` datetime NOT NULL,
  `etime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_washing`
--

INSERT INTO `tbl_washing` (`id`, `user_id`, `nm_consumer`, `contact`, `code_booking`, `noplat`, `pay`, `tot_cost`, `ch_cost`, `status`, `cashier`, `ctime`, `etime`) VALUES
(7, 1, 'Rafi', '085783339662', 'RWB-005', 'B3526ABC', 0, 85000, 0, 'Completed', 'admin', '2019-12-11 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 'Rafi', '085783339662', 'RWB-007', 'B3526EEE', 0, 25000, 0, 'Completed', 'admin', '2020-01-11 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 'Khalish', '085783339662', 'RWB-008', 'B3526ADD', 0, 40000, 0, 'Completed', 'admin', '2020-02-11 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 'Khalish', '13213', 'RWB-009', 'B3526EDA', 0, 20000, 0, 'Completed', 'admin', '2020-02-11 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 'Asta', '085783339662', 'RWB-010', 'B3526EEA', 0, 20000, 0, 'Completed', 'admin', '2020-02-11 00:00:00', '0000-00-00 00:00:00'),
(17, 1, 'Rafi', '085783339662', 'RWB-014', 'B3526XXX', 0, 45000, 0, 'Completed', 'admin', '2020-02-13 00:00:00', '0000-00-00 00:00:00'),
(22, 1, 'Akuyglain', '085783339662', 'RWB-018', 'B3526POL', 50000, 45000, 5000, 'Paid', 'admin', '2020-02-17 00:00:00', '2020-02-26 21:20:02'),
(23, 1, 'Laulagi', '085783339662', 'RWB-019', 'B3526GIT', 0, 20000, 0, 'Processed', 'admin', '2020-02-17 00:00:00', '0000-00-00 00:00:00'),
(28, 1, 'Rafi', '085783339662', 'RWB-020', 'B3526TSY', 40000, 40000, 0, 'Paid', 'admin', '2020-02-19 00:00:00', '2020-02-26 23:23:24'),
(29, 1, 'Rafi nih', '085783339662', 'RWB-021', 'B1234EDC', 0, 25000, 0, 'Processed', 'admin', '2020-02-20 00:00:00', '0000-00-00 00:00:00'),
(33, 1, 'Rafi', '085783339662', 'RWB-024', 'B3526RFS', 50000, 25000, 25000, 'Paid', 'admin', '2020-02-24 00:00:00', '0000-00-00 00:00:00'),
(34, 1, 'Rafi', '085783339662', 'RWB-025', 'B3526DRT', 20000, 20000, 0, 'Paid', 'admin', '2020-02-24 00:00:00', '0000-00-00 00:00:00'),
(35, 1, 'Aku', '085783339662', 'RWB-026', 'B3526EDC', 30000, 25000, 5000, 'Paid', 'admin', '2020-02-24 00:00:00', '0000-00-00 00:00:00'),
(36, 1, 'candra', '085783339662', 'RWB-027', 'B1294ECD', 50000, 25000, 25000, 'Paid', 'admin', '2020-02-26 00:00:00', '2020-02-26 21:36:12'),
(37, 1, 'Rafi', '085783339662', 'RWB-028', 'B3526DRT', 40000, 40000, 0, 'Paid', 'admin', '2020-02-26 00:00:00', '2020-02-26 23:19:41'),
(38, 1, 'Rafi', '085783339662', 'RWB-029', 'B3526RFR', 100000, 80000, 20000, 'Paid', 'admin', '2020-02-26 00:00:00', '2020-02-26 23:20:09'),
(39, 1, 'Khalish', '085783339662', 'RWB-030', 'B3526ERP', 30000, 25000, 5000, 'Paid', 'admin', '2020-02-26 00:00:00', '2020-02-26 23:20:28'),
(40, 1, 'Asta', '085783339663', 'RWB-031', 'B3526AST', 50000, 20000, 30000, 'Paid', 'admin', '2020-02-26 00:00:00', '2020-02-26 23:26:29'),
(41, 1, 'Fahri', '085783339662', 'RWB-032', 'B3526FHR', 30000, 20000, 0, 'Queue', 'admin', '2020-02-26 23:11:31', '0000-00-00 00:00:00'),
(49, 1, 'Akulagini', '085783339662', 'RWB-040', 'B3564EDC', 20000, 20000, 0, 'Paid', 'admin', '2020-03-03 08:59:03', '2020-03-03 20:47:07'),
(52, 1, 'RafiKha', '085783339662', 'RWB-043', 'B1235ERK', 0, 20000, 0, 'Processed', 'admin', '2020-03-05 20:40:30', '2020-03-05 20:45:21'),
(54, 29, 'Siapalagi nih', '085783339662', 'RWB-045', 'B2349APC', 0, 20000, 0, 'Processed', 'admin', '2020-03-05 20:45:00', '2020-03-05 21:05:01'),
(59, 2, 'Rafi khaalish', '085683339662', 'RWB-047', 'B2984EPC', 20000, 20000, 0, 'Paid', 'adminRK', '2020-03-12 10:25:42', '2020-03-12 12:57:10'),
(65, 13, 'RafiKha', '085783339662', 'RWB-048', 'B3030CBA', 20000, 20000, 0, 'Paid', 'adminRK', '2020-03-12 10:52:58', '2020-03-12 13:54:00'),
(77, 13, 'RafiKha', '085783339662', 'RWB-049', 'B3030EDC', 20000, 20000, 0, 'Paid', 'adminRK', '2020-03-12 11:17:17', '2020-03-12 13:54:05'),
(78, 1, 'Test2', '085783339662', 'RWB-050', 'B2020EDC', 20000, 20000, 0, 'Paid', 'adminRK', '2020-03-12 11:23:12', '2020-03-12 13:54:10'),
(79, 13, 'Kha lish', '085783339662', 'RWB-051', 'B3564EDC', 100000, 80000, 20000, 'Paid', 'superadmin', '2020-03-12 19:29:05', '2020-03-12 20:37:03'),
(81, 1, 'Coba', '085783339662', 'RWB-053', 'B3030EDC', 20000, 20000, 0, 'Paid', 'superadmin', '2020-03-15 14:50:59', '2020-03-15 14:55:35'),
(82, 2, 'Rafi Khalish', '085683339662', 'RWB-054', 'B3526DCE', 50000, 20000, 30000, 'Paid', 'Karyawan1', '2020-03-15 15:04:26', '2020-03-15 15:07:20'),
(83, 2, 'Rafi Khalish', '085683339662', 'RWB-055', 'B3456EDC', 20000, 20000, 0, 'Paid', 'superadmin', '2020-04-03 13:09:09', '2020-04-03 17:23:00'),
(84, 29, 'Rafigamer', '085782229662', 'RWB-056', 'B2020RTC', 50000, 40000, 10000, 'Paid', 'superadmin', '2020-04-03 13:39:43', '2020-04-05 17:56:26'),
(90, 1, 'Rafi Khalish', '085783339662', 'RWB-057', 'B3232EDC', 20000, 20000, 0, 'Paid', 'superadmin', '2020-04-13 14:27:45', '2020-04-13 22:46:44'),
(93, 2, 'Rafi Khalish', '085683339662', 'RWB-059', 'B4235EDC', 50000, 40000, 10000, 'Paid', 'Karyawan1', '2020-07-02 11:34:00', '2020-07-02 11:35:37'),
(94, 2, 'Rafi Khalish', '085683339662', 'RWB-060', 'B2349APC', 50000, 20000, 30000, 'Paid', 'Karyawan1', '2020-08-04 21:52:01', '2020-08-04 21:52:45'),
(95, 2, 'Rafi Khalish', '085683339662', 'RWB-061', 'B1235ERD', 50000, 20000, 30000, 'Paid', 'Karyawan1', '2020-08-05 22:27:38', '2020-08-05 22:29:20'),
(96, 2, 'Rafi Khalish', '085683339662', 'RWB-062', 'B1234EDC', 20000, 20000, 0, 'Paid', 'Karyawan1', '2020-08-06 12:13:31', '2020-08-06 12:14:37'),
(98, 2, 'Rafi Khalish', '085683339662', 'RWB-063', 'B3256ETF', 50000, 40000, 10000, 'Paid', 'superadmin', '2020-08-08 22:17:43', '2020-08-08 23:48:49'),
(99, 2, 'Rafi Khalish', '085683339662', 'RWB-064', 'B3256ETF', 50000, 20000, 30000, 'Paid', 'Karyawan1', '2020-08-10 12:43:39', '2020-08-10 12:44:48'),
(100, 1, 'Siapanihbooking', '085738459314', 'RWB-065', 'B4982ERD', 100000, 80000, 20000, 'Paid', 'Karyawan1', '2020-08-10 15:40:43', '2020-08-10 20:59:53'),
(101, 18, 'Pelanggan', '085734231673', 'RWB-066', 'B2425ITE', 50000, 40000, 10000, 'Paid', 'Karyawan1', '2020-08-10 21:16:34', '2020-08-10 23:36:18'),
(102, 2, 'Rafi Khalish', '085683339662', 'RWB-067', 'B3256ETF', 0, 80000, 0, 'Queue', '', '2020-09-07 14:40:33', '0000-00-00 00:00:00'),
(103, 2, 'Rafi Khalish', '085683339662', 'RWB-068', 'B3256ETF', 0, 40000, 0, 'Queue', '', '2020-09-07 14:44:40', '0000-00-00 00:00:00'),
(104, 2, 'Rafi Khalish', '085683339662', 'RWB-069', 'B3256ETF', 0, 40000, 0, 'Queue', '', '2020-09-07 14:45:09', '0000-00-00 00:00:00'),
(128, 13, 'Khalish2', '085783339662', 'RWB-070', 'B3252WOR', 0, 20000, 0, 'Queue', '', '2020-09-07 20:37:40', '0000-00-00 00:00:00'),
(129, 13, 'Khalish2', '085783339662', 'RWB-071', 'B3252WOR', 0, 20000, 0, 'Queue', '', '2020-09-07 20:39:28', '0000-00-00 00:00:00'),
(130, 13, 'Khalish2', '085783339662', 'RWB-072', 'B3252WOR', 0, 20000, 0, 'Queue', '', '2020-09-07 20:45:09', '0000-00-00 00:00:00'),
(131, 13, 'Khalish2', '085783339662', 'RWB-073', 'B3252WOR', 0, 20000, 0, 'Queue', '', '2020-09-07 20:45:24', '0000-00-00 00:00:00'),
(132, 13, 'Khalish2', '085783339662', 'RWB-074', 'B3252WOR', 0, 20000, 0, 'Queue', '', '2020-09-07 20:58:04', '0000-00-00 00:00:00'),
(133, 13, 'Khalish2', '085783339662', 'RWB-075', 'B3252WOR', 0, 20000, 0, 'Queue', '', '2020-09-07 20:58:53', '0000-00-00 00:00:00'),
(134, 13, 'Khalish2', '085783339662', 'RWB-076', 'B3252WOR', 0, 20000, 0, 'Queue', '', '2020-09-07 22:54:26', '0000-00-00 00:00:00'),
(135, 13, 'Khalish2', '085783339662', 'RWB-077', 'B3526E', 0, 20000, 0, 'Queue', '', '2020-09-09 09:24:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `user_username` varchar(24) NOT NULL,
  `user_email` varchar(128) DEFAULT NULL,
  `user_contact` varchar(32) NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_role_id` int(3) NOT NULL,
  `user_is_active` int(1) NOT NULL,
  `user_ctime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_username`, `user_email`, `user_contact`, `user_password`, `user_role_id`, `user_is_active`, `user_ctime`) VALUES
(1, 'superadmin', 'admin', 'admin@redwash.com', '085783339633', '$2y$10$1E2srR742LUHZqcnuIis8uxdcCj4qEDkPDp/uhl/cZhTgQBpgHPdS', 1, 1, '2020-01-05'),
(2, 'Rafi Khalish', 'khalish', 'rafikhalish@gmail.com', '085683339662', '$2y$10$lvKBoYsjkTpCSL9ptH8tIueD.N7N597TiwCz1gqiu.ggt2OFko0eO', 2, 1, '2020-01-05'),
(13, 'Khalish2', 'indodram', 'berbagiya2@gmail.com', '085783339662', '$2y$10$/iyJyRzubKf5b19mtJFZZuRCg.jyBEk1xzwpsRu0WtUTnIowoeMuy', 2, 1, '2020-02-02'),
(18, 'Karyawan1', 'karyawan1', NULL, '085783234944', '$2y$10$bdpua2t7eIh4sLxjSmBxP.RYqZJZFaUXNGmTI6A4DoB2KckdbBcGC', 3, 1, '2020-03-09'),
(20, 'Karyawan3', 'karyawan3', NULL, '085783234923', '$2y$10$Sk/43dgRkm.B1wiI6TCMf.4bUVwriZs5dMl1WMCjLHpPXUvXP4M.6', 3, 0, '2020-03-09'),
(23, 'Orang01', 'indodram123', 'rafi_khalish@yahoo.com', '085672441612', '$2y$10$8m1uk/.9BcvJeRPipmg0QeTIQFDAXmXr29.BKmZhsH8vlsNcGOgre', 2, 1, '2020-03-12'),
(24, 'Karyawan2', 'karyawan2', NULL, '081234123480', '$2y$10$9La8RRj.1StGsHjGJ6ctWe2T2CzEG9kuqyAZKCgXDhb3dPCv1Ub2y', 3, 0, '2020-03-13'),
(26, 'Nur Aji Sasongki', 'Tocayy', 'Nasasongko@gmail.com', '087784840401', '$2y$10$kmoa4WT7A6GD3fgbhzrsjeu1td8EkIpNK1.bBJPWvlQ1JyTI08z1C', 2, 1, '2020-04-05'),
(27, 'Karyawan4', 'karyawan4', NULL, '08578392842', '$2y$10$MBI7RSvlNGyeNewjqr4aCOBWOEupQ1liH.2deydNQna11A3WKcifq', 3, 1, '2020-04-13'),
(28, 'Rafi Khalish', 'rafikhalish', 'rafi.pblk@gmail.com', '08567244161', '$2y$10$EoeMsDugaV/kDzgF5htaUeijVd8KUuVstu85s3GvXPaTuGPvZ6VbK', 2, 1, '2020-04-14'),
(29, 'Akuadalah', 'siapaya', 'gamesrafi05@gmail.com', '085783234927', '$2y$10$kOfsSZu9KB5R8rYTyBdj8ukGTKCCUwOXnROW./tAtBECov.a5jU9O', 2, 1, '2020-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id_user_role` int(11) NOT NULL,
  `user_role` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`id_user_role`, `user_role`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `users_token`
--

CREATE TABLE `users_token` (
  `id` int(11) NOT NULL,
  `user_email` varchar(128) NOT NULL,
  `user_token` varchar(64) NOT NULL,
  `user_cdate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_token`
--

INSERT INTO `users_token` (`id`, `user_email`, `user_token`, `user_cdate`) VALUES
(11, 'berbagiya2@gmail.com', 'mTYlQcvsm1UDh6XBCyl6OS9qGElS852ZGcGeWhYrptA=', 1583421309),
(12, 'rafi.khalish@outlook.com', 'NZp23HWJMmgOky785qmD0ERdEnukDJKPo8oxQel1ODc=', 1584011125),
(23, 'berbagiya2@gmail.com', 'EeNjvSg+aeEPq0vIbxqLGbybGYfm5FqMmpes2m45f3w=', 1596528868),
(24, 'berbagiya2@gmail.com', 'P9lfNfJOwCaoiHS2jfbcktWJDqoZpDlb0s/FhRLEPsg=', 1596528958),
(25, 'berbagiya2@gmail.com', 'TmXMmHmXRFEiKdegcL5LlSK0meKvSExkwNIiTAA7CVU=', 1596529000),
(26, 'berbagiya2@gmail.com', '218s21rQEZvoK6aEiTltjutf562XNJPTuaWwfz5IzCQ=', 1596529129);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_typemotor`
--
ALTER TABLE `tbl_typemotor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_washing`
--
ALTER TABLE `tbl_washing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_user_role`);

--
-- Indexes for table `users_token`
--
ALTER TABLE `users_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_typemotor`
--
ALTER TABLE `tbl_typemotor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_washing`
--
ALTER TABLE `tbl_washing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_user_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_token`
--
ALTER TABLE `users_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_washing`
--
ALTER TABLE `tbl_washing`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`user_role_id`) REFERENCES `users_role` (`id_user_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
