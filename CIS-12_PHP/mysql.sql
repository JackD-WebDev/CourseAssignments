-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Jun 11, 2022 at 06:56 PM
-- Server version: 10.7.3-MariaDB-1:10.7.3+maria~focal
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backstage`
--
CREATE DATABASE IF NOT EXISTS `backstage` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `backstage`;

-- --------------------------------------------------------

--
-- Table structure for table `isFollowing`
--

CREATE TABLE `isFollowing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follower` bigint(20) UNSIGNED NOT NULL,
  `isFollowing` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `post` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `userid`, `post`, `datetime`) VALUES
(1, 1, 'test post', '2022-06-11 05:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'jackdaly', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `isFollowing`
--
ALTER TABLE `isFollowing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `follower` (`follower`),
  ADD UNIQUE KEY `isFollowing` (`isFollowing`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);
ALTER TABLE `posts` ADD FULLTEXT KEY `post` (`post`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `isFollowing`
--
ALTER TABLE `isFollowing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `isFollowing`
--
ALTER TABLE `isFollowing`
  ADD CONSTRAINT `isFollowing_ibfk_1` FOREIGN KEY (`follower`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isFollowing_ibfk_2` FOREIGN KEY (`isFollowing`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `banking`
--
CREATE DATABASE IF NOT EXISTS `banking` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `banking`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `type` enum('Checking','Savings') NOT NULL,
  `balance` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `customer_id`, `type`, `balance`) VALUES
(1, 1, 'Checking', '5560.23'),
(2, 2, 'Checking', '759225.24'),
(3, 3, 'Checking', '150892.00'),
(4, 2, 'Savings', '13546.97');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `pin` varbinary(16) NOT NULL,
  `nacl` varbinary(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `pin`, `nacl`) VALUES
(1, 'Sarah', 'Vowell', 0x5c81ceb0b52de2bc8b3ae005ff19bc42, 0x1964481c3083075bf680d2f6245f293cba25d1038662c7fdd7ca3519885a2d4f420ed0ee531ad4dc99df60293b945241fdfcce1db2571aeba825455874d86f31),
(2, 'David', 'Sedaris', '', ''),
(3, 'Kojo', 'Nnamdi', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `to_account_id` int(10) UNSIGNED NOT NULL,
  `from_account_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(5,2) UNSIGNED NOT NULL,
  `date_entered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `full_name` (`last_name`,`first_name`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `to_account_id` (`to_account_id`),
  ADD KEY `from_account_id` (`from_account_id`),
  ADD KEY `date_entered` (`date_entered`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`to_account_id`) REFERENCES `accounts` (`account_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`from_account_id`) REFERENCES `accounts` (`account_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Database: `cis_12`
--
CREATE DATABASE IF NOT EXISTS `cis_12` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cis_12`;
--
-- Database: `forum`
--
CREATE DATABASE IF NOT EXISTS `forum` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `forum`;

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `forum_id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`forum_id`, `name`) VALUES
(5, 'CSS'),
(4, 'HTML'),
(6, 'Kindling'),
(7, 'Modern Dance'),
(1, 'MySQL'),
(2, 'PHP'),
(3, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `forum_id` tinyint(3) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` longtext NOT NULL,
  `date_entered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `parent_id`, `forum_id`, `user_id`, `subject`, `body`, `date_entered`) VALUES
(1, 0, 1, 1, 'Question about normalization.', 'I\'m confused about normalization. For the second normal form (2NF), I read...', '2022-04-23 08:15:45'),
(2, 0, 1, 2, 'Database Design', 'I\'m creating a new database and am having problems with the structure. How many tables should I have?...', '2022-04-23 08:15:45'),
(3, 2, 1, 2, 'Database Design', 'The number of tables your database includes...', '2022-04-23 08:15:45'),
(4, 0, 1, 3, 'Database Design', 'Okay, thanks!', '2022-04-23 08:15:45'),
(5, 0, 2, 3, 'PHP Errors', 'I\'m using the scripts from Chapter 3 and I can\'t get the first calculator example to work. When I submit the form...', '2022-04-23 08:15:45'),
(6, 5, 2, 1, 'PHP Errors', 'What version of PHP are you using?', '2022-04-23 08:16:09'),
(7, 6, 2, 3, 'PHP Errors', 'Version 5.2', '2022-04-23 08:16:09'),
(8, 7, 2, 1, 'PHP Errors', 'In that case, try the debugging steps outlined in Chapter 7.', '2022-04-23 08:16:09'),
(9, 0, 3, 2, 'Chicago Bulls', 'Can the Bulls really win it all this year?', '2022-04-23 08:16:09'),
(10, 9, 3, 1, 'Chicago Bulls', 'I don\'t know, but they sure look good!', '2022-04-23 08:16:09'),
(11, 0, 5, 3, 'CSS Resources', 'Where can I found out more information about CSS?', '2022-04-23 08:16:09'),
(12, 11, 5, 1, 'CSS Resources', 'Read Elizabeth Castro\'s excellent book on (X)HTML and CSS. Or search Google on \"CSS\".', '2022-04-23 08:16:09'),
(13, 0, 4, 3, 'HTML vs. XHTML', 'What are the differences between HTML and XHTML?', '2022-04-23 08:16:09'),
(14, 13, 4, 1, 'HTML vs. XHTML', 'XHTML is a cross between HTML and XML. The differences are largely syntactic. Blah, blah, blah...', '2022-04-23 08:16:09'),
(15, 0, 6, 4, 'Why?', 'Why do you have a forum dedicated to kindling? Don\'t you deal mostly with PHP, MySQL, and so forth?', '2022-04-23 08:16:09'),
(16, 0, 2, 3, 'Dynamic HTML using PHP', 'Can I use PHP to dynamically generate HTML on the fly? Thanks...', '2022-04-23 08:16:09'),
(17, 16, 2, 1, 'Dynamic HTML using PHP', 'You most certainly can.', '2022-04-23 08:16:09'),
(18, 17, 2, 3, 'Dynamic HTML using PHP, still not clear', 'Um, how?', '2022-04-23 08:16:09'),
(19, 18, 2, 2, 'Dynamic HTML using PHP, clearer?', 'I think what Larry is trying to say is that you should buy and read his book.', '2022-04-23 08:16:09'),
(20, 15, 6, 4, 'Why? Why? Why?', 'Really, why?', '2022-04-23 08:16:09'),
(21, 20, 6, 1, 'Because', 'Because', '2022-04-23 08:16:09'),
(22, 0, 1, 3, 'This is my subject.', 'This is the body. It\'ll have apostrophes, \"quotes\", and even HTML.', '2022-05-28 19:54:30'),
(23, 0, 1, 3, 'Objectification!', 'This script has been objectified!', '2022-06-04 19:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` char(40) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pass`, `first_name`, `last_name`, `email`) VALUES
(1, 'troutster', 'e727d1464ae12436e899a726da5b2f11d8381b26', 'Larry', 'Ullman', 'lu@example.com'),
(2, 'funny man', 'ab87d24bdc7452e55738deb5f868e1f16dea5ace', 'David', 'Brent', 'db@example.com'),
(3, 'Gareth', '0d73e0a895b147446cba85df36b3e7d1e4ecec97', 'Gareth', 'Keenan', 'gk@example.com'),
(4, 'tim', '4cb0c3898531df6f039fc8fbeacf5c8ad15393c1', 'Tim', 'Canterbury', 'tc@example.com'),
(5, 'finchy', '45c30192fc7a8849b45f10573663ff63500f5431', 'Chris', 'Finch', 'cf@example.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`forum_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date_entered` (`date_entered`);
ALTER TABLE `messages` ADD FULLTEXT KEY `body` (`body`,`subject`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `login` (`pass`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `forum_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8mb3 NOT NULL DEFAULT '',
  `query` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `col_length` text COLLATE utf8mb3_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8mb3_bin DEFAULT '',
  `col_default` text COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8mb3 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8mb3 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `settings_data` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Settings related to Designer';

--
-- Dumping data for table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"angular_direct\":\"direct\",\"snap_to_grid\":\"off\",\"relation_lines\":\"true\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8mb3_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `template_data` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `tables` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8mb3 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `tables` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"backstage\",\"table\":\"posts\"},{\"db\":\"backstage\",\"table\":\"users\"},{\"db\":\"forum\",\"table\":\"messages\"},{\"db\":\"sitename\",\"table\":\"users\"},{\"db\":\"forum\",\"table\":\"users\"},{\"db\":\"banking\",\"table\":\"accounts\"},{\"db\":\"backstage\",\"table\":\"isFollowing\"},{\"db\":\"banking\",\"table\":\"customers\"},{\"db\":\"forum\",\"table\":\"forums\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `prefs` text COLLATE utf8mb3_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8mb3_bin NOT NULL,
  `schema_sql` text COLLATE utf8mb3_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8mb3_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8mb3_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2022-06-11 18:55:39', '{\"RetainQueryBox\":true,\"Console\\/Mode\":\"collapse\",\"Console\\/Height\":361.9916,\"Server\\/hide_db\":\"\",\"Server\\/only_db\":\"\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8mb3_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `RCC`
--
CREATE DATABASE IF NOT EXISTS `RCC` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `RCC`;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` bigint(10) UNSIGNED NOT NULL,
  `date_enrolled` datetime NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`user_id`, `first_name`, `last_name`, `phone_number`, `date_enrolled`, `email`, `password`) VALUES
(1, 'Tom', 'Jones', 7025278342, '2022-03-26 07:47:06', 'vegas@email.com', 'd06ac665dd874a427e2f3b947fbaa60da42c27ee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Database: `sitename`
--
CREATE DATABASE IF NOT EXISTS `sitename` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sitename`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass` char(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `registration_date`) VALUES
(1, 'Tom', 'Jones', 'tj@email.com', '996e54174e83c3b51852e6ffb68b4a83906af72d', '2022-03-14 02:01:47'),
(2, 'Tim', 'Burton', 'burton@email.com', '574af96709192be4309a8b0e8f3adf29a6dfd53c', '2022-03-14 02:19:02'),
(3, 'Tim', 'Curry', 'timcurry@email.com', '623afac018ae832823135cebbed916a590da6ec4', '2022-03-14 02:19:58'),
(4, 'Kevin', 'McCallister', 'alone@email.com', 'c095fdb6b4e4d9301024f44c35b9b2f048dd320c', '2022-03-14 02:21:39'),
(5, 'Mark', 'McGrath', 'sugar@email.com', 'b73fa659d87c7d1714b0c5590152f43bc127182e', '2022-03-14 02:23:34'),
(6, 'Lisa', 'Loeb', 'stories@email.com', '0aff875f296dc56948f660757168a7822d04504e', '2022-03-14 02:24:16'),
(7, 'Erica', 'Dunham', 'unternull@email.com', '3d5249f6a75290b0b7159a85bddb44db69f9ed74', '2022-03-14 02:27:02'),
(8, 'John', 'Waters', 'baltimore@email.com', '83e9c21a3aac9c2980d34444ebc7794845213598', '2022-03-14 02:34:02'),
(9, 'Kaydie', 'Daly', 'kitteh@email.com', 'ff694a0b6c02d7d9f8e7d934abb9fb28722d9b41', '2022-03-14 02:34:39'),
(10, 'Abe', 'Hiroshi', 'ah@email.com', 'b3ff02020dad79915240ab59bf6d9acf502c4804', '2022-03-14 03:08:20'),
(11, 'Abe', 'Hiroshi', 'ah@email.com', 'b3ff02020dad79915240ab59bf6d9acf502c4804', '2022-03-14 03:11:40'),
(12, 'Frank', 'Zappa', 'zap@email.com', '366b8ce3c4547dbe7b5841bad9a16f71b86b91ba', '2022-03-14 06:29:12'),
(13, 'Jack', 'Daly', 'jdaly@email.com', 'bfd581c35e65284d367b50a6b29c05a66fcd13a1', '2022-03-14 06:30:27'),
(14, 'John', 'Lydon', 'pil@email.com', '8d6fcee72193845b9602ffac39860c067a168e03', '2022-03-21 04:25:45'),
(15, 'Stacey', 'Abrahams', 'sas@email.com', '8f4d2f17a046b9377f548209ccd17d0a601191e2', '2022-03-21 04:29:11'),
(16, 'Thom', 'Yorke', 'radio@email.com', '9c3102934c689772f36fca178269e57a0fc0ce5e', '2022-03-21 04:41:56'),
(17, 'Pablo', 'Picasso', 'starry@email.com', '51addf88f08367714c7b4759098164f0fd1a6af1', '2022-03-21 04:47:09'),
(18, 'Minnie', 'Driver', 'mini@email.com', '83acaebc514b91c9dd77e7573bf9c7ae654a89db', '2022-03-21 05:11:18'),
(19, 'Renee', 'Zellweger', 'mary@email.com', '3b8034f044c543fb57171f723ac875264ce6bcf8', '2022-03-21 05:13:38'),
(20, 'Beth', 'Goldstein', 'bg@email.com', 'a8d04f686c6d37750ed6fab41aa2c7ace1cddf6b', '2022-03-21 05:14:45'),
(21, 'Adam', 'Foster', 'adfo@email.com', '8dd534c8abcced33d19e4a402690d5fef096a3dd', '2022-03-21 05:23:34'),
(22, 'Jack', 'Black', 'twentyone@email.com', '9c18ca00f2db5d2fd2512c5d8829dc722b61548a', '2022-03-21 05:24:31'),
(23, 'Eric', 'Foreman', 'foreman@email.com', '9456b66bc6d6f0093a3f33692d374fd07dff1ceb', '2022-03-21 05:26:17'),
(24, 'Mary', 'Blair', 'ohmary@email.com', 'f56bdac2b2c79a032c024b074f7a6b567e955c44', '2022-03-21 05:28:00'),
(25, 'Cloud', 'Strife', 'cloud@email.com', '4b4fb90596ed9aad1b7076def4e4ae553ebee11d', '2022-03-21 05:29:09'),
(26, 'Toby', 'McGuire', 'bully@email.com', '4d64235eed6c66218cac75ae68d469976b6ec892', '2022-03-21 05:34:21'),
(27, 'Mike', 'Score', 'seagull@email.com', '52908139074baa0768c9fb5ad1730dfbed57601b', '2022-03-21 05:35:19'),
(28, 'Les', 'Claypool', 'cheese@email.com', 'dff2565104b1a1e3b293579b35829abb47a73b2d', '2022-03-21 05:39:43'),
(29, 'Lucy', 'Liu', 'watson@email.com', 'c82940c8b3a430670709b2034b9423c728b34416', '2022-03-21 05:43:55'),
(30, 'Gregory', 'House', 'doctor@email.com', '7cf05621019e9c633b84f2ba1ea097e8dae22bf7', '2022-03-21 05:45:18'),
(31, 'Dexter', 'Morgan', 'passenger@email.com', '70de8f10edcbe18a77366264db2ee393c9827480', '2022-03-21 05:45:52'),
(32, 'Bruce', 'Wayne', 'knight@email.com', 'f4e1eca75c7ca588ffece061d51be44b65942422', '2022-03-21 05:46:46'),
(33, 'Milton', 'Bradley', 'park@email.com', '4e0f441b33ed59f69b2075604cf74f0b4dc5f8f7', '2022-03-21 05:47:30'),
(34, 'Clubber', 'Lang', 'mrt@email.com', '92bf18f8a63e350b0c95b1035c3939c633985875', '2022-03-21 05:53:02'),
(35, 'Johnny', 'Depp', 'sparrow@email.com', '849071e0dbc2d75250c36281eeaceb2377673cf6', '2022-03-21 05:55:12'),
(36, 'Ewan', 'McGregor', 'obi@email.com', '69a1871ab9200ed3e330e489f23789044e763fc7', '2022-03-21 05:57:01'),
(37, 'Johnny', 'Miller', 'zero@email.com', 'e68150663441fe28f6288a4688b557b2e15c2e03', '2022-03-21 05:58:53'),
(38, 'Matthew', 'Lillard', 'cereal@email.com', '678663851798df02f85f18a552184e9f46996735', '2022-03-21 06:00:12'),
(39, 'Jon', 'Favreau', 'swing@email.com', 'bf8e9b50e0a298be93cb412a73d9ef5ba7d746db', '2022-03-21 06:08:44'),
(40, 'Vince', 'Vaughn', 'swinger@email.com', '181a670402d8fac3ec284cb9309cd06b4499bf7d', '2022-03-21 06:09:16'),
(41, 'Todd', 'Bridges', 'willis@email.com', '68617a33df2ea41a0a835ac878e0d2065e238da8', '2022-03-21 06:10:13'),
(42, 'Carson', 'Daly', 'norelation@email.com', 'd2116a45f6cb68bf7dad2464e04a73b492ba1778', '2022-03-21 06:10:56'),
(43, 'Craig', 'Ferguson', 'dancer@email.com', 'aba1df3b90705c06f35282f52c51303a6c675669', '2022-03-21 06:12:12'),
(44, 'Hugh', 'Laurie', 'house@email.com', 'b472077a5a412cf4af8615d69db06c1472a4e95d', '2022-03-21 06:13:15'),
(45, 'Tom', 'Shear', 'assemblage@email.com', 'db9990ce810e272e3579513617a73862753d8070', '2022-03-21 06:14:13'),
(46, 'Ben', 'Arp', 'cat@email.com', '1ee51dee908702b116b6ac09c51cc148aa121398', '2022-03-21 06:15:28'),
(47, 'Wesley', 'Willis', 'vulture@email.com', '7d4a6d9d335815d2568a12a48650f2326c9111b5', '2022-03-21 06:17:41'),
(48, 'Zooey', 'Deschanel', 'her@email.com', '3c9947226da5cd7d347158d91317783ef6f9d819', '2022-03-21 06:19:28'),
(49, 'Wanda', 'Sykes', 'wsykes@email.com', '6391f96f05a5677cbfed763eef7ad8c852d0da2e', '2022-03-21 06:20:37'),
(50, 'Dee', 'Schneider', 'sister@email.com', '85d98211b1fe2e9c04f0674f01eab1cf38045370', '2022-03-21 06:21:42'),
(51, 'Marc', 'Spector', 'stevengrant@marvel.com', '1552c9cce63f0ed51706fbcd96c5fef21633f4be8f4084dcf0d12991b4813e009d76b2d9d26707ff7fbb73d6ace7216e08b1aac577be146bcea39417c4b9453f', '2022-05-01 21:05:13'),
(52, 'Peter', 'O\'Toole', 'petey@email.com', '4a59e80b6a5bfb4c8d8a592086a290b347c5d2b62418abe878cfa8037063ca268edeadd184bc3d54bf683584f294caf7a3109c90458b45f93d25587618070fa1', '2022-05-02 01:49:47'),
(54, 'Larry', 'Ullman', 'larryullman@email.com', '1c573dfeb388b562b55948af954a7b344dde1cc2099e978a992790429e7c01a4205506a93d9aef3bab32d6f06d75b7777a7ad8859e672fedb6a096ae369254d2', '2022-05-28 00:44:35'),
(55, 'Ivan', 'Terrible', 'iamterrible@email.com', '$2y$10$z9TfeIxO6UumyI8mUkqb2O3u4NsRRe3eKvwXtpY/BIBZfAv2L.VDm', '2022-05-28 20:27:04'),
(56, 'Mickey', 'Mouse', 'mickey@disney.com', '$2y$10$NNXGqGC1/ElOTdn/fmeFWeWKY.aFQie0Pd5dFFTx/dcC5igFE07Ra', '2022-05-28 20:40:51'),
(57, 'Perry', 'Ferrell', 'janesays@email.com', '$2y$10$smyyFvv/sKujMgo2tFqp/.0hzM7Obl7gtzcuea4iDHOFriCaxDV4.', '2022-06-04 18:53:33'),
(58, 'Jack', 'Daly', 'jdaly@student.rccd.edu', '$2y$10$1YHl7uM0K9yijJVpSApWaePDusexAXIrY/TEa10.eXXba33haORRu', '2022-06-04 18:57:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
