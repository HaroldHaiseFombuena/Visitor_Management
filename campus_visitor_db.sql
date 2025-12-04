/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 10.4.32-MariaDB : Database - campus_visitor_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`campus_visitor_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `campus_visitor_db`;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`user_id`,`username`,`password`) values 
(1,'Harold','admin123');

/*Table structure for table `visitors` */

DROP TABLE IF EXISTS `visitors`;

CREATE TABLE `visitors` (
  `vis_code` int(11) NOT NULL AUTO_INCREMENT,
  `vis_lname` varchar(50) DEFAULT NULL,
  `vis_fname` varchar(50) DEFAULT NULL,
  `vis_date` date DEFAULT NULL,
  `vis_time` time DEFAULT NULL,
  `vis_address` varchar(255) DEFAULT NULL,
  `vis_phone` varchar(11) DEFAULT NULL,
  `vis_affil` varchar(30) DEFAULT NULL,
  `vis_purpose` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`vis_code`)
) ENGINE=InnoDB AUTO_INCREMENT=100112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `visitors` */

insert  into `visitors`(`vis_code`,`vis_lname`,`vis_fname`,`vis_date`,`vis_time`,`vis_address`,`vis_phone`,`vis_affil`,`vis_purpose`) values 
(100101,'Dela Cruz','Juan','2025-11-28','09:15:00','Sorsogon City','09123456789','Sorsogon National HS','exam'),
(100102,'Santos','Maria','2025-11-28','10:30:00','Bulan, Sorsogon','09987654321','Bulan NHS','inquiry'),
(100103,'Reyes','Mark','2025-11-28','11:05:00','Casiguran','09111222333','Casiguran SHS','visit'),
(100104,'Garcia','Ana','2025-11-27','13:40:00','Gubat','09445566778','Gubat NHS','exam'),
(100105,'Lopez','Peter','2025-11-27','14:10:00','Matnog','09223334455','Matnog NHS','interview'),
(100106,'Fernandez','Liza','2025-11-29','08:45:00','Irosin, Sorsogon','09177889900','Irosin National HS','interview'),
(100107,'Villanueva','Carlo','2025-11-29','09:20:00','Sorsogon City','09192345678','Sorsogon State University','inquiry'),
(100108,'Mendoza','Shaira','2025-11-29','10:05:00','Juban, Sorsogon','09214567890','Juban NHS','exam'),
(100109,'Rodriguez','Kevin','2025-11-29','10:55:00','Bulan, Sorsogon','09434567821','Bulan National HS','visit'),
(100110,'Bautista','Rica','2025-11-29','11:30:00','Matnog, Sorsogon','09321234567','Matnog SHS','meeting'),
(100111,'fombuena','Harold Haise','2025-12-03','21:52:00','San Antonio, Barcelona, Sorsogon','09108897416','CCDI','exam');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
