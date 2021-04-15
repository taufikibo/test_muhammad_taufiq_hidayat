/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.1.21-MariaDB : Database - db_test_ci
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_test_ci` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_test_ci`;

/*Table structure for table `authors` */

DROP TABLE IF EXISTS `authors`;

CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_authors` varchar(30) DEFAULT '0',
  `telepon` varchar(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `authors` */

insert  into `authors`(`id`,`nama_authors`,`telepon`) values (2,'muhammad taufiq hidayat','081380706026'),(3,'genta','021838333'),(4,'tini','089282932323');

/*Table structure for table `authors_books` */

DROP TABLE IF EXISTS `authors_books`;

CREATE TABLE `authors_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_authors` int(11) DEFAULT NULL,
  `id_books` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `authors_books` */

insert  into `authors_books`(`id`,`id_authors`,`id_books`) values (3,2,1);

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_buku` varchar(30) DEFAULT '0',
  `tahun` varchar(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `books` */

insert  into `books`(`id`,`nama_buku`,`tahun`) values (1,'Harry Potter','2008');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT '0',
  `password` varchar(100) DEFAULT '0',
  `role` varchar(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`role`) values (1,'doni','e10adc3949ba59abbe56e057f20f883e','user'),(2,'taufiq','e10adc3949ba59abbe56e057f20f883e','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
