-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2019 at 06:20 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `algorithms`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL,
  `page_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'home'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `userID`, `comment`, `createdOn`, `page_name`) VALUES
(39, 4, 'This is home', '2019-10-09 13:18:15', 'home'),
(72, 5, 'insertion', '2019-10-10 15:18:52', 'insertion'),
(73, 4, 'hi', '2019-10-10 15:19:38', 'insertion'),
(74, 4, 'jkx', '2019-10-10 15:20:07', 'insertion'),
(77, 5, 'fds', '2019-10-10 18:11:57', 'insertion'),
(78, 5, 'dsdv', '2019-10-10 18:16:11', 'insertion'),
(81, 5, 'SDD', '2019-10-10 18:21:27', 'insertion'),
(82, 5, 'dsd', '2019-10-10 18:21:36', 'insertion'),
(83, 5, '1', '2019-10-10 18:21:45', 'insertion'),
(84, 5, '2', '2019-10-10 18:22:01', 'insertion'),
(85, 5, '3', '2019-10-10 18:23:30', 'insertion'),
(86, 5, '4', '2019-10-10 18:23:40', 'insertion'),
(87, 5, '5', '2019-10-10 18:28:09', 'insertion'),
(88, 5, '6', '2019-10-10 18:28:13', 'insertion'),
(90, 5, 'bubble\n', '2019-10-10 18:32:52', 'bubble'),
(91, 5, '5\n', '2019-10-10 18:33:04', 'bubble'),
(92, 4, '4\n', '2019-10-10 18:33:29', 'bubble'),
(93, 4, 'bubble sort', '2019-10-10 18:33:40', 'bubble'),
(94, 4, 'sorting', '2019-10-10 18:34:46', 'bubble'),
(95, 4, '6', '2019-10-10 18:38:31', 'bubble'),
(96, 6, '31', '2019-10-11 10:17:17', 'bubble'),
(97, 6, 'merge\n', '2019-10-11 11:22:04', 'merge'),
(98, 6, '3\n', '2019-10-11 11:22:13', 'merge'),
(99, 6, '2', '2019-10-11 11:22:15', 'merge'),
(100, 6, '1', '2019-10-11 11:22:18', 'merge'),
(101, 4, '1\n', '2019-10-11 11:22:45', 'merge'),
(102, 4, '2\n', '2019-10-11 11:22:50', 'merge'),
(103, 4, 'quick\n', '2019-10-11 11:28:38', 'quick'),
(104, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-10-11 11:29:10', 'quick'),
(105, 6, 'sorting', '2019-10-11 11:30:06', 'quick'),
(107, 4, 'prims', '2019-10-11 11:54:55', 'prims'),
(108, 4, '3', '2019-10-11 11:54:59', 'prims'),
(109, 4, '2', '2019-10-11 11:55:04', 'prims'),
(110, 4, '1', '2019-10-11 11:55:07', 'prims'),
(111, 7, 'algo', '2019-10-11 12:05:07', 'prims'),
(112, 8, 'kruskal', '2019-10-11 12:07:09', 'kruskal'),
(113, 6, '5', '2019-10-11 12:07:44', 'kruskal'),
(114, 6, '4', '2019-10-11 12:07:47', 'kruskal'),
(115, 6, 'bfs', '2019-10-11 12:15:11', 'bfs'),
(116, 6, 'graph ', '2019-10-11 12:15:20', 'bfs'),
(117, 4, '2', '2019-10-11 12:15:49', 'bfs'),
(118, 4, 'dfs', '2019-10-11 12:21:37', 'dfs'),
(119, 8, '5', '2019-10-11 12:22:03', 'dfs'),
(120, 8, '4', '2019-10-11 12:22:06', 'dfs'),
(121, 8, 'brute force', '2019-10-11 12:30:34', 'knapbru'),
(122, 6, 'knapsack brute', '2019-10-11 12:31:08', 'knapbru'),
(123, 7, 'good', '2019-10-11 12:40:17', 'knapgreedy'),
(124, 7, 'greedy', '2019-10-11 12:40:32', 'knapgreedy'),
(125, 6, 'selection', '2019-10-11 19:56:52', 'selection'),
(126, 6, '5', '2019-10-11 19:56:57', 'selection'),
(127, 4, 'linear search', '2019-10-11 21:06:11', 'linear'),
(128, 4, 'linear search', '2019-10-11 21:06:13', 'linear'),
(129, 4, '5', '2019-10-11 21:06:21', 'linear'),
(130, 4, 'dd', '2019-10-11 21:06:27', 'linear'),
(131, 8, 'binary', '2019-10-11 21:30:44', 'binary'),
(134, 9, 'awdw', '2019-10-12 12:25:14', 'merge'),
(136, 9, 'abcd', '2019-10-12 21:11:27', 'bubble'),
(137, 9, 'coin', '2019-10-12 21:24:28', 'coin'),
(138, 7, 'change', '2019-10-12 21:25:01', 'coin'),
(139, 9, 'j', '2019-10-12 21:54:49', 'nqueen'),
(140, 9, 'kgb', '2019-10-12 22:14:41', 'matrix'),
(141, 7, 'hx', '2019-10-12 22:15:06', 'matrix');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL,
  `userID` int(11) NOT NULL,
  `page_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'home'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `createdOn`) VALUES
(1, 'dfasdf', 'asdfasdf@live.com', '$2y$10$SqzYz8CNpQkoAE93ZkWmUeCOXqQ5QPNqcGTEyAvU0MD0JnUT19Nz.', '2019-07-15 15:19:51'),
(2, 'Senaid', 'senaid@live.com', '$2y$10$EJyBBoc0sX3n.fYw/PQ5leJuoHYqv2pxOp9w6z3Tixty7x0iAveDO', '2019-07-15 15:25:34'),
(3, 'dsJoy', 'abc@gmail.com', '$2y$10$ytSBFSnNzgD5T9b7jbRdEetf6iAtRKevMxwWR/fC9x0H4slKt3f.e', '2019-09-29 21:36:13'),
(4, 'joy', '12@gmail.com', '$2y$10$XRu7L3MKHTpEomOiF1dae.MN77H9wWGh16C0S5vCwRYMite9YXRGG', '2019-09-29 23:44:25'),
(5, '129', '129@gmail.com', '$2y$10$YvJqi.CbFvQm16prNUiM6.rq8Vwq8dj.hoCsjHLy35CSUabj4t6/O', '2019-10-10 15:16:04'),
(6, 'hasib', 'hasib@gmail.com', '$2y$10$vzqfStSUs3Iz6u.jQ512XexjXFu.HhE5Wa2gIULAT//e2sl6t36hK', '2019-10-11 10:17:00'),
(7, 'zisa', 'zisa@gmail.com', '$2y$10$LeWJPktK8ZT1K9cXmsqqS.rz9PIS9PwR46XqRekdGxmOy8oquO9cS', '2019-10-11 12:04:52'),
(8, 'siam', 'siam@gmail.com', '$2y$10$dZO.XYHhTQd74s8H8U0bDulXvFOsmu5GEmnNKIy8WBvRiYuWVlf76', '2019-10-11 12:06:57'),
(9, 'anonymous', 'anonymous@gmail.com', '$2y$10$7wPZP1oYBJyPlx.iHxpVWebp04Fnt2Nj2.TA.iBYJkpahoGg2KhW2', '2019-10-12 12:22:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentID` (`commentID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`commentID`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
