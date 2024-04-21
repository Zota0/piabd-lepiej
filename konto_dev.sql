CREATE USER 'dev'@'localhost' IDENTIFIED BY 'dev';
GRANT SELECT, INSERT INTO ON *.* TO 'dev'@'localhost';
