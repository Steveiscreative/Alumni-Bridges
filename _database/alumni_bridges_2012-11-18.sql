# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.5-m8)
# Database: alumni_bridges
# Generation Time: 2012-11-19 01:20:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `pwd` binary(16) NOT NULL,
  `role_id` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`id`, `email`, `first_name`, `last_name`, `pwd`, `role_id`)
VALUES
	(4,'ttwstephenson@gmail.com','Steve','name',X'64343164386364393866303062323034',2),
	(8,'steven2@steve.com','name','name',X'64343164386364393866303062323034',3),
	(11,'steven2277@steve.com','name','name',X'64343164386364393866303062323034',3),
	(13,'steven00@steve.com','name','name',X'00000000000000000000000000000000',3),
	(14,'steven0330@steve.com','name','name',X'077E4043B11D4FC71D4D82E218235CA5',1),
	(22,'steven03302wq21@steve.com','name','name',X'00000000000000000000000000000000',1),
	(23,'sjddteven03302wq21@steve.com','name','name',X'31633633313239616539646239633630',1),
	(24,'sjddFDSteven03302wq21@steve.com','name','name',X'38316238613162373730363864303665',3),
	(27,'sjddFDSteven0W33dsd02wq21@steve.com','name','name',X'30000000000000000000000000000000',3);

/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table alumni
# ------------------------------------------------------------

DROP TABLE IF EXISTS `alumni`;

CREATE TABLE `alumni` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `student_id` int(20) NOT NULL,
  `pwd` binary(16) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip_code` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(22) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `role_id` int(1) DEFAULT NULL,
  `donation_total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_id` (`student_id`),
  KEY `degree` (`degree`),
  KEY `department` (`department`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `alumni_ibfk_1` FOREIGN KEY (`degree`) REFERENCES `valid_degrees` (`degree`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `alumni_ibfk_2` FOREIGN KEY (`department`) REFERENCES `valid_departments` (`department`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `alumni_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `alumni` WRITE;
/*!40000 ALTER TABLE `alumni` DISABLE KEYS */;

INSERT INTO `alumni` (`id`, `student_id`, `pwd`, `first_name`, `last_name`, `street`, `city`, `state`, `zip_code`, `email`, `telephone`, `degree`, `department`, `role_id`, `donation_total`)
VALUES
	(1,12345,NULL,'steve','stephenson','3011 saints street','baltmore','md','21218','test@testing.com','555-555-5555',NULL,NULL,1,2247.00),
	(3,55555,NULL,'Steve','Stephenson','3011 Saint Paul Street','Baltimore','MD','21218','ttwstephenson@gmail.com','555-555-5555',NULL,NULL,1,0.00),
	(4,23562,NULL,'Test','Test','test','test','MD','21218','test@test.com','212-222-2223',NULL,'Fine Arts',1,0.00),
	(6,99329,NULL,'Test','test','test','test','MD','21218','test@testing.com','555-555-5555',NULL,'Fine Arts',1,0.00),
	(7,23291,NULL,'test','test','test','test','MD','21218','ttwstephenson@gmail.com','222-222-2222',NULL,'Fine Arts',1,0.00),
	(9,12311,NULL,'Marion','Bell','Saint Pail Street','Baltimore','MD','21218','ttwstephenson@gmail.com','222-222-2222','Nursing','Fine Arts',1,5122.00),
	(29,23144,NULL,'Steve','Stephenson','Stephenson','Baltimore','MD','21218','ttwstephenson@gmail.com','222-222-2222',NULL,'Fine Arts',1,0.00),
	(152,34523,NULL,'Steve','Stephenson','Stephenson','Baltimore','MD','21218','ttwstephenson@gmail.com','222-222-2222',NULL,'Fine Arts',1,0.00),
	(155,34562,NULL,'Steve','test','test','test','md','21218','test@test.com','123-456-7890',NULL,'Fine Arts',1,0.00);

/*!40000 ALTER TABLE `alumni` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table alumni_donations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `alumni_donations`;

CREATE TABLE `alumni_donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(20) DEFAULT NULL,
  `donation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `donation_id` (`donation_id`),
  CONSTRAINT `alumni_donations_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `alumni` (`student_id`) ON UPDATE CASCADE,
  CONSTRAINT `alumni_donations_ibfk_2` FOREIGN KEY (`donation_id`) REFERENCES `donations` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `alumni_donations` WRITE;
/*!40000 ALTER TABLE `alumni_donations` DISABLE KEYS */;

INSERT INTO `alumni_donations` (`id`, `student_id`, `donation_id`)
VALUES
	(1,12345,16),
	(2,12345,17),
	(3,12345,18),
	(4,12345,19),
	(5,12345,20),
	(6,12345,21),
	(7,12345,22),
	(8,12345,23),
	(9,12345,24),
	(10,12345,25),
	(11,12345,26),
	(12,12345,27),
	(13,12345,28),
	(14,12345,29),
	(15,12345,30),
	(16,12345,31),
	(17,12345,32),
	(18,12345,33),
	(19,12345,34),
	(20,12345,35),
	(24,12345,39),
	(25,12345,40),
	(26,12345,41),
	(27,12345,43),
	(28,12311,44),
	(29,12311,45);

/*!40000 ALTER TABLE `alumni_donations` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `alumni_donation_total` AFTER INSERT ON `alumni_donations` FOR EACH ROW BEGIN
     DECLARE recentSubID INT;
     DECLARE recentSID INT;
     DECLARE donation_total_amount DECIMAL(10,2);
     DECLARE recent_donation DECIMAL(10,2);
     DECLARE new_total DECIMAL(10,2);


     SET recentSubID =  (SELECT id FROM alumni_donations ORDER BY id DESC LIMIT 1);
     SET recentSID = (SELECT student_id FROM alumni_donations WHERE id = recentSubID);
     SET donation_total_amount = (SELECT donation_total FROM alumni where student_id = recentSID);
     SET recent_donation = (SELECT donation_amount FROM alumni_donations LEFT JOIN donations ON alumni_donations.donation_id = donations.id WHERE alumni_donations.id = recentSubID);   

     SET new_total = (SELECT donation_total FROM alumni where student_id = recentSID + recent_donation);


     UPDATE alumni
     SET alumni.donation_total =  donation_total_amount + recent_donation

     WHERE student_id = recentSID;


END */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table donations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `donations`;

CREATE TABLE `donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(20) DEFAULT NULL,
  `payment_type` varchar(150) DEFAULT NULL,
  `donation_amount` decimal(10,2) DEFAULT NULL,
  `date_donated` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `payment_type` (`payment_type`),
  CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `alumni` (`student_id`) ON UPDATE CASCADE,
  CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`payment_type`) REFERENCES `valid_payment_type` (`payment_type`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `donations` WRITE;
/*!40000 ALTER TABLE `donations` DISABLE KEYS */;

INSERT INTO `donations` (`id`, `student_id`, `payment_type`, `donation_amount`, `date_donated`)
VALUES
	(1,12345,'credit card',1230.55,'2012-10-28'),
	(2,12345,'credit card',1230.55,'2012-10-28'),
	(13,12345,'credit card',300.00,'2012-10-28'),
	(16,12345,'credit card',300.00,'2012-10-28'),
	(17,12345,'CASH',350.00,'2012-10-25'),
	(18,12345,'CASH',350.00,'2012-10-25'),
	(19,12345,'CASH',100.00,'2012-10-25'),
	(20,12345,'CASH',100.00,'2012-10-25'),
	(21,12345,'CASH',100.00,'2012-10-25'),
	(22,12345,'CASH',100.00,'2012-10-25'),
	(23,12345,'CASH',1020.00,'2012-10-25'),
	(24,12345,'CASH',1020.00,'2012-10-25'),
	(25,12345,'CASH',1020.00,'2012-10-25'),
	(26,12345,'CASH',1020.00,'2012-10-25'),
	(27,12345,'CASH',1020.00,'2012-10-25'),
	(28,12345,'CASH',1020.00,'2012-10-25'),
	(29,12345,'CASH',1020.00,'2012-10-25'),
	(30,12345,'CASH',350.00,'2012-10-25'),
	(31,12345,'CASH',350.00,'2012-10-25'),
	(32,12345,'CASH',350.00,'2012-10-25'),
	(33,12345,'CASH',350.00,'2012-10-25'),
	(34,12345,'CASH',350.00,'2012-10-25'),
	(35,12345,'CASH',350.00,'2012-10-25'),
	(39,12345,'CASH',350.00,'2012-10-25'),
	(40,12345,'CASH',350.00,'2012-10-25'),
	(41,12345,'CASH',32.00,'2012-10-25'),
	(43,12345,'check',1865.00,'2012-06-20'),
	(44,12311,'check',122.00,'2012-05-22'),
	(45,12311,'check',5000.00,'2012-06-16');

/*!40000 ALTER TABLE `donations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(1) NOT NULL,
  `role_type` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;

INSERT INTO `role` (`id`, `role_type`)
VALUES
	(1,'user'),
	(2,'employee'),
	(3,'administrator'),
	(4,'super-administrator');

/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table social_media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `social_media`;

CREATE TABLE `social_media` (
  `student_id` int(20) DEFAULT NULL,
  `twitter` varchar(150) DEFAULT NULL,
  `facebook` varchar(150) DEFAULT NULL,
  `linkedin` varchar(150) DEFAULT NULL,
  UNIQUE KEY `student_id` (`student_id`),
  CONSTRAINT `social_media_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `alumni` (`student_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table valid_degrees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `valid_degrees`;

CREATE TABLE `valid_degrees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `degree` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `degree` (`degree`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `valid_degrees` WRITE;
/*!40000 ALTER TABLE `valid_degrees` DISABLE KEYS */;

INSERT INTO `valid_degrees` (`id`, `degree`)
VALUES
	(15,'Architecture'),
	(18,'Degree'),
	(7,'Nursing'),
	(17,'Science'),
	(5,'Social Science');

/*!40000 ALTER TABLE `valid_degrees` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table valid_departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `valid_departments`;

CREATE TABLE `valid_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `department` (`department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `valid_departments` WRITE;
/*!40000 ALTER TABLE `valid_departments` DISABLE KEYS */;

INSERT INTO `valid_departments` (`id`, `department`)
VALUES
	(1,'Fine Arts'),
	(2,'New Updated Row');

/*!40000 ALTER TABLE `valid_departments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table valid_payment_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `valid_payment_type`;

CREATE TABLE `valid_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment_type` (`payment_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `valid_payment_type` WRITE;
/*!40000 ALTER TABLE `valid_payment_type` DISABLE KEYS */;

INSERT INTO `valid_payment_type` (`id`, `payment_type`)
VALUES
	(1,'cash'),
	(2,'check'),
	(3,'credit card');

/*!40000 ALTER TABLE `valid_payment_type` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Dumping routines (PROCEDURE) for database 'alumni_bridges'
--
DELIMITER ;;

# Dump of PROCEDURE sp_add_admin
# ------------------------------------------------------------

/*!50003 DROP PROCEDURE IF EXISTS `sp_add_admin` */;;
/*!50003 SET SESSION SQL_MODE=""*/;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_add_admin`(
IN     email     VARCHAR(255),
IN     first_name     VARCHAR(255),
IN     last_name     VARCHAR(255), 
IN     pwd     BINARY(16), 
IN     role_id     INT(1)
)
BEGIN
     DECLARE emailVal VARCHAR(255);
     DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND
          BEGIN
               SELECT 'ADMIN INSERT HAS FAILED';
               ROLLBACK;
          END;
     SET emailVal = email;
     
     START TRANSACTION;
     
     IF role_id + 1 = 2  THEN
      		SELECT 'NOT A VALID ROLE FOR ADMIN';
               ROLLBACK;

     ELSEIF EXISTS (SELECT 1 FROM admin WHERE admin.email = emailVal ) THEN
               ROLLBACK;
               SELECT 'ADMIN ALREADY EXISTS';
     ELSE 
              SELECT 'ADMIN ADDED';
     END IF;
 
        INSERT INTO admin (email,first_name,last_name, pwd, role_id) VALUES (email,first_name,last_name, UNHEX(MD5(pwd)), role_id);
     COMMIT;
END */;;

/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;;
# Dump of PROCEDURE sp_add_alumni
# ------------------------------------------------------------

/*!50003 DROP PROCEDURE IF EXISTS `sp_add_alumni` */;;
/*!50003 SET SESSION SQL_MODE=""*/;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_add_alumni`(
IN     student_id     INT(20),
IN     first_name     VARCHAR(255),
IN     last_name      VARCHAR(255),
IN     street         VARCHAR(255),
IN     city           VARCHAR(255),
IN     state          VARCHAR(2),
IN     zip_code       VARCHAR(15),
IN     email          VARCHAR(255),
IN     telephone      VARCHAR(22),
IN     degree         VARCHAR(255),
IN     department     VARCHAR(255)
)
BEGIN
     DECLARE studentID INT(20);
     DECLARE departmentVAL VARCHAR(255);
     DECLARE degreeVal VARCHAR(255);
 
     DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND
          BEGIN
               SELECT 'ALUMNI INSERT HAS FAILED';
               ROLLBACK;
          END;


     SET studentID = student_id;
     SET departmentVal = department;
     SET degreeVal = degree;


     IF student_id <= 0 THEN
               SELECT 'NOT A VALID STUDENT ID';
                   ROLLBACK;
      ELSEIF EXISTS (SELECT 1 FROM alumni WHERE alumni.student_id = studentID ) THEN
               SELECT 'ALUMNI ALREADY EXISTS';
               ROLLBACK;
     ELSEIF NOT EXISTS (SELECT 1 FROM valid_departments WHERE valid_departments.department = UCASE(departmentVal)) THEN
               SELECT 'DEPARTMENT DOES NOT EXISTS';
               ROLLBACK;
     ELSEIF NOT EXISTS (SELECT 1 FROM valid_degrees WHERE valid_degrees.degree = degreeVal) THEN
               SELECT 'DEGREE DOES NOT EXISTS';
     ELSE 
              SELECT 'ALUMNI ADDED';
              ROLLBACK;
     END IF;
 
     START TRANSACTION;
        INSERT INTO alumni (student_id, pwd ,first_name, last_name, street, city, state, zip_code, email, telephone, degree, department, role_id, donation_total) VALUES (student_id, NULL ,first_name, last_name, street, city, state, zip_code, email, telephone, degree, department, 1, 0.00);
     COMMIT;
END */;;

/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;;
# Dump of PROCEDURE sp_add_donations
# ------------------------------------------------------------

/*!50003 DROP PROCEDURE IF EXISTS `sp_add_donations` */;;
/*!50003 SET SESSION SQL_MODE=""*/;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_add_donations`(
IN     student_id INT(20),
IN     donation_amount DECIMAL(10,2),
IN     payment_type VARCHAR(150),
IN     date_donated    DATE
)
BEGIN

     DECLARE studentID INT(20);
     DECLARE paymentType VARCHAR(150);
     DECLARE donationAmount DECIMAL(10,2);
     DECLARE recentSubID INT(20);

     DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND
          BEGIN
               SELECT 'DONATION INSERT HAS FAILED';
               ROLLBACK;
          END;

     SET paymentType = payment_type;
     SET donationAmount = donation_amount;

      IF student_id <= 0 THEN
          SELECT 'NOT A VALID STUDENT ID';
          ROLLBACK;
     ELSEIF NOT EXISTS (SELECT 1 FROM alumni WHERE alumni.student_id = student_id) THEN
          SELECT 'ALUMNI DOES NOT EXIST';
          ROLLBACK;
      ELSEIF donationAmount <= 0 THEN
          SELECT 'NOT A VALID AMOUNT';
          ROLLBACK;
      ELSEIF NOT EXISTS (SELECT 1 FROM valid_payment_type WHERE valid_payment_type.payment_type = paymentType) THEN
          SELECT 'PAYMENT TYPE DOES NOT EXIST';
          ROLLBACK;
      ELSE
           SELECT 'DONATION ADDED';
      END IF;
     
      START TRANSACTION;
           INSERT INTO donations (student_id,payment_type,donation_amount,date_donated) VALUES (student_id,payment_type,donation_amount,date_donated);
           SET recentSubID =  (SELECT id FROM donations ORDER BY id DESC LIMIT 1);
           INSERT INTO  alumni_donations (student_id,donation_id) VALUES (student_id,recentSubID);
      COMMIT;

END */;;

/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;;
# Dump of PROCEDURE sp_add_valid_degree
# ------------------------------------------------------------

/*!50003 DROP PROCEDURE IF EXISTS `sp_add_valid_degree` */;;
/*!50003 SET SESSION SQL_MODE=""*/;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_add_valid_degree`( IN degree VARCHAR(255))
BEGIN
     DECLARE degreeVal VARCHAR(255);
 
     DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
          BEGIN
               ROLLBACK;
               SELECT 'DEGREE INSERT HAS FAILED';
          END;


     SET degreeVal = degree;


     IF EXISTS (SELECT 1 FROM valid_degrees WHERE valid_degrees.degree = degreeVal) THEN
               SELECT 'THIS DEGREE ALREADY EXISTS';
               ROLLBACK;
     ELSE  
              SELECT 'DEGREE ADDED';
     END IF;
 
     START TRANSACTION;
        INSERT INTO valid_degrees (degree) VALUES (degree);
     COMMIT;
END */;;

/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;;
# Dump of PROCEDURE sp_add_valid_department
# ------------------------------------------------------------

/*!50003 DROP PROCEDURE IF EXISTS `sp_add_valid_department` */;;
/*!50003 SET SESSION SQL_MODE=""*/;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_add_valid_department`( IN department VARCHAR(255))
BEGIN
     DECLARE departmentVal VARCHAR(255);
 
     DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND
          BEGIN
               ROLLBACK;
               SELECT 'department INSERT HAS FAILED';
          END;




     SET departmentVal = department;




     IF EXISTS (SELECT 1 FROM valid_departments WHERE valid_departments.department = departmentVal) THEN
               SELECT 'THIS department ALREADY EXISTS';
               ROLLBACK;
     ELSE 
              SELECT 'department ADDED';
     END IF;
 
     START TRANSACTION;
        INSERT INTO valid_departments (department) VALUES (department);
     COMMIT;
END */;;

/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;;
# Dump of PROCEDURE sp_delete_admin
# ------------------------------------------------------------

/*!50003 DROP PROCEDURE IF EXISTS `sp_delete_admin` */;;
/*!50003 SET SESSION SQL_MODE=""*/;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_delete_admin`(
IN     id INT(20)
)
BEGIN
     DECLARE idVal INT(20);
 
     DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND
          BEGIN
               SELECT 'ADMIN DROP HAS FAILED';
               ROLLBACK;
          END;


     SET idVal = id;
          IF NOT EXISTS (SELECT 1 FROM admin WHERE admin.id = idVal ) THEN
               SELECT 'ADMIN DOES NOT EXISTS';
               ROLLBACK;
     ELSE 
              SELECT 'ADMIN DELETED';
     END IF;
 
     START TRANSACTION;
        DELETE FROM admin WHERE admin.id = id;
     COMMIT;
END */;;

/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;;
# Dump of PROCEDURE sp_delete_valid_degree
# ------------------------------------------------------------

/*!50003 DROP PROCEDURE IF EXISTS `sp_delete_valid_degree` */;;
/*!50003 SET SESSION SQL_MODE=""*/;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `sp_delete_valid_degree`( IN degree VARCHAR(255) )
BEGIN
     DECLARE degreeVal VARCHAR(255);
     DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
          BEGIN
               ROLLBACK;
               SELECT 'DEGREE INSERT HAS FAILED';
          END;


       SET degreeVal = degree;
       
     IF NOT EXISTS (SELECT 1 FROM valid_degrees WHERE valid_degrees.degree = degreeVal) THEN
               SELECT 'THIS DEGREE DOES NOT EXIST';
               ROLLBACK;
     ELSE  
              SELECT 'DEGREE DELETED';
     END IF;



     START TRANSACTION;
        DELETE FROM valid_degrees WHERE valid_degrees.degree = degree;
     COMMIT;

END */;;

/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;;
DELIMITER ;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
