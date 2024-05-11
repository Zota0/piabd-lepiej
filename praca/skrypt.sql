START TRANSACTION;

CREATE DATABASE IF NOT EXISTS piabd2 DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE piabd2;

CREATE TABLE ACCOUNT (
  id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone INT(9) NOT NULL,
  birthdate DATE NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY username (username)
) /* ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci */; 

INSERT INTO ACCOUNT (
  username,
  password,
  email,
  phone,
  birthdate
)
VALUES (
  'Developer',
  '$2y$10$MEdlgXmWTgeDDeQg3reXzeL2.S8f8QI56VPa4y29PkpomPdMbK1PO',
  'zota0-dev@gmail.com',
  697178618,
  '2009-08-20'
);

CREATE TABLE comments (
  ID INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  CREATIONDATE DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  CONTENT TEXT NOT NULL,
  DISPLAYNAME VARCHAR(100) NOT NULL,
  PRIMARY KEY (ID)
) /* ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci */; 

INSERT INTO comments (
  CREATIONDATE,
  CONTENT,
  DISPLAYNAME
)
VALUES (
  '2024-04-17 20:13:21',
  '<b> Pogrubiony </b>',
  'Developer'
),
(
  '2024-04-17 20:14:08',
  '<span style=\'color:red\'> UWAGA! </span> <b> A nie...</b> jednak fałszywy alarm... :)',
  'Developer'
);

COMMIT;
