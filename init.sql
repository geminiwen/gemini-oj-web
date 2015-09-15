-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: 192.168.99.100
-- Generation Time: 2015-09-15 00:04:25
-- 服务器版本： 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oj`
--

-- --------------------------------------------------------

--
-- 表的结构 `problem`
--

CREATE TABLE IF NOT EXISTS `problem` (
  `id` int(11) NOT NULL,
  `title` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `output` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_input` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_output` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_file` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `output_file` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_limit` int(11) NOT NULL,
  `memory_limit` int(11) NOT NULL,
  `accept` int(11) NOT NULL,
  `submit` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `problem`
--

INSERT INTO `problem` (`id`, `title`, `description`, `input`, `output`, `sample_input`, `sample_output`, `input_file`, `output_file`, `time_limit`, `memory_limit`, `accept`, `submit`) VALUES
(1, 'A+B', 'Simple A + B', 'Each line will contain two integers A and B. Process to end of file.', 'For each case, output A + B in one line.', '1 1', '2', '/Users/geminiwen/Code/CLionProjects/grunner/test/test.in', '/Users/geminiwen/Code/CLionProjects/grunner/test/test.sample', 1000, 65536, 1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` int(11) NOT NULL DEFAULT '-2' COMMENT '-2:waiting -1:runing',
  `time_used` int(11) NOT NULL DEFAULT '0',
  `memory_used` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
