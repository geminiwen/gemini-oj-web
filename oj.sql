-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: 192.168.99.100
-- Generation Time: 2015-09-23 09:54:38
-- 服务器版本： 5.6.26
-- PHP Version: 5.6.13

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
-- 表的结构 `contest`
--

CREATE TABLE IF NOT EXISTS `contest` (
  `id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(256) COLLATE utf8mb4_bin NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_secret` int(11) NOT NULL DEFAULT '0',
  `password` char(60) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='比赛表';

--
-- 转存表中的数据 `contest`
--

INSERT INTO `contest` (`id`, `title`, `description`, `start_time`, `end_time`, `create_time`, `is_secret`, `password`) VALUES
(1, 'First Contest', 'This is the first contest', '2015-09-23 00:00:00', '2015-09-26 00:00:00', '2015-09-23 13:09:26', 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `contest_problem_c4ca4238a0b923820dcc509a6f75849b`
--

CREATE TABLE IF NOT EXISTS `contest_problem_c4ca4238a0b923820dcc509a6f75849b` (
  `id` int(11) NOT NULL,
  `title` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `output` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_input` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_output` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_file` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `output_file` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_limit` int(11) DEFAULT '1000',
  `memory_limit` int(11) NOT NULL DEFAULT '65536',
  `accept` int(11) NOT NULL DEFAULT '0',
  `submit` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `contest_problem_c4ca4238a0b923820dcc509a6f75849b`
--

INSERT INTO `contest_problem_c4ca4238a0b923820dcc509a6f75849b` (`id`, `title`, `description`, `input`, `output`, `sample_input`, `sample_output`, `input_file`, `output_file`, `time_limit`, `memory_limit`, `accept`, `submit`) VALUES
(1, 'A+B', 'Simple A + B', 'Each line will contain two integers A and B. Process to end of file.', 'For each case, output A + B in one line.', '1 1', '2', '/Users/geminiwen/Code/oj/1/input', '/Users/geminiwen/Code/oj/1/output', 1000, 65536, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `contest_ranklist_c4ca4238a0b923820dcc509a6f75849b`
--

CREATE TABLE IF NOT EXISTS `contest_ranklist_c4ca4238a0b923820dcc509a6f75849b` (
  `user_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `time_used` datetime DEFAULT NULL,
  `attempt` int(11) NOT NULL DEFAULT '0',
  `is_first` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `contest_status_c4ca4238a0b923820dcc509a6f75849b`
--

CREATE TABLE IF NOT EXISTS `contest_status_c4ca4238a0b923820dcc509a6f75849b` (
  `id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` int(11) NOT NULL DEFAULT '-2' COMMENT '-2:waiting -1:runing',
  `time_used` int(11) NOT NULL DEFAULT '0',
  `memory_used` int(11) NOT NULL DEFAULT '0',
  `compile_error_message` text COLLATE utf8mb4_unicode_ci,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `time_limit` int(11) DEFAULT '1000',
  `memory_limit` int(11) NOT NULL DEFAULT '65536',
  `accept` int(11) NOT NULL DEFAULT '0',
  `submit` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `problem`
--

INSERT INTO `problem` (`id`, `title`, `description`, `input`, `output`, `sample_input`, `sample_output`, `input_file`, `output_file`, `time_limit`, `memory_limit`, `accept`, `submit`) VALUES
(1, 'A+B', 'Simple A + B', 'Each line will contain two integers A and B. Process to end of file.', 'For each case, output A + B in one line.', '1 1', '2', '/Users/geminiwen/Code/oj/1/input', '/Users/geminiwen/Code/oj/1/output', 1000, 65536, 24, 24),
(2, '多项式求和', '多项式的描述如下：\r\n1 - 1/2 + 1/3 - 1/4 + 1/5 - 1/6 + ...\r\n现在请你求出该多项式的前n项的和。', '输入数据由2行组成，首先是一个正整数m（m<100），表示测试实例的个数，第二行包含m个正整数，对于每一个整数(不妨设为n,n<1000），求该多项式的前n项的和。', '对于每个测试实例n，要求输出多项式前n项的和。每个测试实例的输出占一行，结果保留2位小数。', '2\n1 2', '1.00\n0.50\n', '/Users/geminiwen/Code/oj/2/input', '/Users/geminiwen/Code/oj/2/output', 1000, 65536, 0, 0),
(3, 'LELE的RPG难题', '人称“AC女之杀手”的超级偶像LELE最近忽然玩起了深沉，这可急坏了众多“Cole”（LELE的粉丝,即"可乐"）,经过多方打探，某资深Cole终于知道了原因，原来，LELE最近研究起了著名的RPG难题:\r\n\r\n有排成一行的ｎ个方格，用红(Red)、粉(Pink)、绿(Green)三色涂每个格子，每格涂一色，要求任何相邻的方格不能同色，且首尾两格也不同色．求全部的满足要求的涂法.\r\n\r\n以上就是著名的RPG难题.\r\n\r\n如果你是Cole,我想你一定会想尽办法帮助LELE解决这个问题的;如果不是,看在众多漂亮的痛不欲生的Cole女的面子上,你也不会袖手旁观吧?', '输入数据包含多个测试实例,每个测试实例占一行,由一个整数N组成，(0<n<=50)。', '对于每个测试实例，请输出全部的满足要求的涂法，每个实例的输出占一行。', '1\r\n2', '3\r\n6', '/Users/geminiwen/Code/oj/3/input', '/Users/geminiwen/Code/oj/3/output', 1000, 65536, 0, 0),
(4, 'Prime Ring Problem', 'A ring is compose of n circles as shown in diagram. Put natural number 1, 2, ..., n into each circle separately, and the sum of numbers in two adjacent circles should be a prime.<br><br>Note: the number of first circle should always be 1.<br><br><img src="http://acm.hdu.edu.cn/data/images/1016-1.gif"><br>', 'n (0 < n < 20).', 'The output format is shown as sample below. Each row represents a series of circle numbers in the ring beginning from 1 clockwisely and anticlockwisely. The order of numbers must satisfy the above requirements. Print solutions in lexicographical order.<br><br>You are to write a program that completes above process.<br><br>Print a blank line after each case.', '6\r\n8', 'Case 1:\r\n1 4 3 2 5 6\r\n1 6 5 2 3 4\r\n\r\nCase 2:\r\n1 2 3 8 5 6 7 4\r\n1 2 5 8 3 4 7 6\r\n1 4 7 6 5 8 3 2\r\n1 6 7 4 3 8 5 2\r\n', '/Users/geminiwen/Code/oj/4/input', '/Users/geminiwen/Code/oj/4/output', 1000, 65536, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` int(11) NOT NULL DEFAULT '-2' COMMENT '-2:waiting -1:runing',
  `time_used` int(11) NOT NULL DEFAULT '0',
  `memory_used` int(11) NOT NULL DEFAULT '0',
  `compile_error_message` text COLLATE utf8mb4_unicode_ci,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `status`
--

INSERT INTO `status` (`id`, `problem_id`, `user_id`, `code`, `language`, `result`, `time_used`, `memory_used`, `compile_error_message`, `create_time`) VALUES
(1, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 1, 752, NULL, '2015-09-18 10:00:49'),
(2, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 1, 752, NULL, '2015-09-18 10:01:02'),
(3, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 724, NULL, '2015-09-18 10:01:04'),
(4, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:05'),
(5, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:05'),
(6, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 728, NULL, '2015-09-18 10:01:06'),
(7, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:07'),
(8, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:07'),
(9, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:08'),
(10, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 740, NULL, '2015-09-18 10:01:09'),
(11, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:10'),
(12, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 736, NULL, '2015-09-18 10:01:11'),
(13, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:11'),
(14, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:12'),
(15, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:13'),
(16, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:14'),
(17, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:14'),
(18, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:15'),
(19, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 724, NULL, '2015-09-18 10:01:16'),
(20, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:17'),
(21, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:18'),
(22, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 712, NULL, '2015-09-18 10:01:20'),
(23, 1, 1, '#include <stdio.h>\r\nint main() {\r\nint a,b;\r\nwhile(~scanf("%d%d",&a,&b)){\r\nprintf("%d\\n",a+b);\r\n}\r\nreturn 0;\r\n}', 'cpp', 0, 0, 724, NULL, '2015-09-18 10:01:21'),
(27, 1, 1, '#include <stdio.h>\r\nint main() {\r\n	int a,b;\r\n  	while (~scanf("%d%d", &a, &b)) {\r\n    	printf("%d\\n", a+b);\r\n    }\r\n}', 'c', 0, 0, 716, NULL, '2015-09-23 12:53:37');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accept` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `accept`, `remember_token`) VALUES
(1, 'gemini', '$2y$10$X3buSLzR6NfvtTyVawy8O.pUMMdK22iybUzQrSsMerSpIuZwRHLr6', 24, NULL),
(2, 'Integ', '$2y$10$bqpvzQyEKzZl5B4pC8OCs.Q/SKcy7JvV8KXHKol5oIBhbbmJbAHY2', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contest_problem_c4ca4238a0b923820dcc509a6f75849b`
--
ALTER TABLE `contest_problem_c4ca4238a0b923820dcc509a6f75849b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contest_ranklist_c4ca4238a0b923820dcc509a6f75849b`
--
ALTER TABLE `contest_ranklist_c4ca4238a0b923820dcc509a6f75849b`
  ADD PRIMARY KEY (`user_id`,`problem_id`);

--
-- Indexes for table `contest_status_c4ca4238a0b923820dcc509a6f75849b`
--
ALTER TABLE `contest_status_c4ca4238a0b923820dcc509a6f75849b`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contest`
--
ALTER TABLE `contest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contest_problem_c4ca4238a0b923820dcc509a6f75849b`
--
ALTER TABLE `contest_problem_c4ca4238a0b923820dcc509a6f75849b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contest_status_c4ca4238a0b923820dcc509a6f75849b`
--
ALTER TABLE `contest_status_c4ca4238a0b923820dcc509a6f75849b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
