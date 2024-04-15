CREATE TABLE `account` (
    `id` int(6) UNSIGNED NOT NULL,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `phone` varchar(20) NOT NULL,
    `birthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

TRUNCATE TABLE `account`;


CREATE TABLE `comments` (
    `ID` int(4) NOT NULL,
    `CREATIONDATE` datetime NOT NULL DEFAULT current_timestamp(),
    `CONTENT` text NOT NULL,
    `DISPLAYNAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

TRUNCATE TABLE `comments`;