/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.32 : Database - sql424404
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

insert  into `intelmlm_active_users`(`username`,`timestamp`) values ('admin',1386622692);

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

/*Table structure for table `intelmlm_settings_meta` */

DROP TABLE IF EXISTS `intelmlm_settings_meta`;

CREATE TABLE `intelmlm_settings_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_settings_meta` */

/*Table structure for table `intelmlm_users` */

DROP TABLE IF EXISTS `intelmlm_users`;

CREATE TABLE `intelmlm_users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `bpassword` varchar(100) NOT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) unsigned NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `valid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `hash` varchar(32) NOT NULL,
  `hash_generated` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_users` */

insert  into `intelmlm_users`(`username`,`password`,`bpassword`,`userid`,`userlevel`,`email`,`timestamp`,`valid`,`name`,`hash`,`hash_generated`) values ('admin','e10adc3949ba59abbe56e057f20f883e','123456','68a231f38ef3d98a79f6dea3d104701a',9,'admin@intelmlm.com',1386622692,1,NULL,'1e82e9b24ab41de17a661a523f5623fa',1386525172),('test_guest','e10adc3949ba59abbe56e057f20f883e','123456',NULL,0,NULL,0,0,NULL,'',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
