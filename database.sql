/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.21-MariaDB : Database - todo_list
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`todo_list` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `todo_list`;

/*Table structure for table `todolist` */

DROP TABLE IF EXISTS `todolist`;

CREATE TABLE `todolist` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `work_name` varchar(256) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `delete_flag` bigint(20) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `todolist` */

insert  into `todolist`(`id`,`work_name`,`start_date`,`end_date`,`status`,`create_date`,`update_date`,`delete_flag`) values 
(20,'learn abc','2021-09-14 06:30:00','2021-09-14 07:00:00',0,'2021-09-14 15:10:20',NULL,0),
(21,'learn abc','2021-09-15 06:30:00','2021-09-15 07:00:00',0,'2021-09-14 15:10:32',NULL,0),
(22,'learn english','2021-09-17 06:30:00','2021-09-17 07:00:00',0,'2021-09-14 15:10:48',NULL,0),
(23,'learn english','2021-09-17 06:30:00','2021-09-17 07:00:00',0,'2021-09-14 15:20:52',NULL,0),
(24,'coding','2021-09-16 06:30:00','2021-09-16 07:00:00',0,'2021-09-14 15:21:06',NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
