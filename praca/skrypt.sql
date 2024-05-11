SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+01:00";

CREATE DATABASE IF NOT EXISTS `piabd2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `piabd2`;

CREATE TABLE `account` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(9) NOT NULL,
  `birthdate` date NOT NULL
) /*  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci; */

INSERT INTO `account` (`id`, `username`, `password`, `email`, `phone`, `birthdate`) VALUES
(14, 'Developer', '$2y$10$MEdlgXmWTgeDDeQg3reXzeL2.S8f8QI56VPa4y29PkpomPdMbK1PO', 'zota0-dev@gmail.com', 697178618, '2009-08-20'),
(21, 'Admin', '', 'Admin@admin.pl', 0, '1966-09-30');

CREATE TABLE `comments` (
  `ID` int(4) NOT NULL,
  `CREATIONDATE` datetime NOT NULL DEFAULT current_timestamp(),
  `CONTENT` text NOT NULL,
  `DISPLAYNAME` varchar(100) NOT NULL
) /*  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci; */

INSERT INTO `comments` (`ID`, `CREATIONDATE`, `CONTENT`, `DISPLAYNAME`) VALUES
(162, '2024-04-17 20:13:21', '<b> Pogrubiony </b>', 'Developer'),
(163, '2024-04-17 20:14:08', '<span style=\'color:red\'> UWAGA! </span> <b> A nie...</b> jednak fałszywy alarm... :)', 'Developer');

ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `account`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `comments`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
COMMIT;