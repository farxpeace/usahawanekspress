/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.34 : Database - intelmlm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `intelmlm_active_guests` */

DROP TABLE IF EXISTS `intelmlm_active_guests`;

CREATE TABLE `intelmlm_active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_active_guests` */

/*Table structure for table `intelmlm_active_users` */

DROP TABLE IF EXISTS `intelmlm_active_users`;

CREATE TABLE `intelmlm_active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_active_users` */

insert  into `intelmlm_active_users`(`username`,`timestamp`) values ('',1387413638);

/*Table structure for table `intelmlm_banned_users` */

DROP TABLE IF EXISTS `intelmlm_banned_users`;

CREATE TABLE `intelmlm_banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_banned_users` */

/*Table structure for table `intelmlm_mail` */

DROP TABLE IF EXISTS `intelmlm_mail`;

CREATE TABLE `intelmlm_mail` (
  `Deleted` tinyint(1) NOT NULL DEFAULT '0',
  `UserTo` tinytext NOT NULL,
  `UserFrom` tinytext NOT NULL,
  `Subject` mediumtext NOT NULL,
  `Message` longtext NOT NULL,
  `status` text NOT NULL,
  `SentDate` text NOT NULL,
  `mail_id` int(80) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_mail` */

/*Table structure for table `intelmlm_metatag` */

DROP TABLE IF EXISTS `intelmlm_metatag`;

CREATE TABLE `intelmlm_metatag` (
  `id` int(11) DEFAULT NULL,
  `ref` varchar(100) DEFAULT NULL,
  `meta` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `create_date` varchar(100) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_metatag` */

insert  into `intelmlm_metatag`(`id`,`ref`,`meta`,`value`,`create_date`,`update_date`) values (1,'Settings','title','Intelligent Multilevel System',NULL,NULL),(2,'Settings','shortname','IntelMLM',NULL,NULL);

/*Table structure for table `intelmlm_settings` */

DROP TABLE IF EXISTS `intelmlm_settings`;

CREATE TABLE `intelmlm_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(100) DEFAULT NULL,
  `meta` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_settings` */

insert  into `intelmlm_settings`(`id`,`ref`,`meta`,`value`) values (1,'tbl_name','users','intelmlm_users'),(2,'tbl_name','active_users','intelmlm_active_users'),(3,'tbl_name','active_guest','intelmlm_active_guests'),(4,'tbl_name','banned_users','intelmlm_banned_users'),(5,'tbl_name','mail','intelmlm_mail'),(6,'constants','track_visitors','true'),(7,'constants','user_timeout','10'),(8,'system','title','intelMLM - Intelligent Multilevel System'),(9,'constants','debug_mode','yes');

/*Table structure for table `intelmlm_users` */

DROP TABLE IF EXISTS `intelmlm_users`;

CREATE TABLE `intelmlm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `bpassword` varchar(100) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userrole` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) unsigned DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` int(11) unsigned DEFAULT NULL,
  `valid` tinyint(1) unsigned DEFAULT '0',
  `fullname` varchar(50) DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `hash_generated` int(11) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_users` */

insert  into `intelmlm_users`(`id`,`username`,`password`,`bpassword`,`userid`,`userrole`,`userlevel`,`email`,`timestamp`,`valid`,`fullname`,`hash`,`hash_generated`) values (1,'admin','e10adc3949ba59abbe56e057f20f883e','123456','2ece6e4171f0f938c28ea3d7b50bdd8f','1',9,'',1387406787,1,'Admin Fullname Only','198cdf7b4d7c579e5f82406f9bd3ee97',1387389748),(2,'test_guest','e10adc3949ba59abbe56e057f20f883e','123456','cf39ff97bfe5e3635dc1b1ea6199874d','1',9,'',1386803668,1,'Test Fullname','67399eb7cb1088e7d3952d7c451098da',1386789575),(13,'temporary','e10adc3949ba59abbe56e057f20f883e','123456','b5dba4886eb44274158437f5a8605983','1',9,'',1386804302,1,'test','fb031eff2a63b0a85eded3a73389714f',1386804256),(15,'temporary1386804331','e10adc3949ba59abbe56e057f20f883e','123456','19aaf4aae642f4f92e3f10277dd25a55','Please select user role',NULL,'',1386808156,1,'','bf9ad7c8fb5991001e78672bd3b5704c',1386804342),(19,'614504161','e10adc3949ba59abbe56e057f20f883e','123456','81eb2d2dd92acbb4736b0e96d561a430','2',9,'',1386825214,1,'Farizul','165dc1d04cf8129832ca62b81f6220e1',1386818861),(23,'temporary1386823602','e10adc3949ba59abbe56e057f20f883e','123456',NULL,'2',NULL,NULL,1386823602,1,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
