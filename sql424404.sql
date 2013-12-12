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

insert  into `intelmlm_active_users`(`username`,`timestamp`) values ('temporary1386804331',1386808156);

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(100) DEFAULT NULL,
  `meta` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_metatag` */

insert  into `intelmlm_metatag`(`id`,`ref`,`meta`,`value`,`create_date`,`update_date`) values (1,'Settings','title','Intelligent Multilevel System',NULL,NULL),(2,'Settings','shortname','IntelMLM',NULL,NULL);

/*Table structure for table `intelmlm_product` */

DROP TABLE IF EXISTS `intelmlm_product`;

CREATE TABLE `intelmlm_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productname` varchar(100) DEFAULT NULL,
  `create_date` varchar(100) DEFAULT NULL,
  `normal_price` varchar(100) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_product` */

insert  into `intelmlm_product`(`id`,`productname`,`create_date`,`normal_price`) values (1,'temporary1386806691','1386806691',NULL),(2,'temporary1386806691','1386806691',NULL),(3,'temporary1386806759','1386806759',NULL),(4,'ddgg','1386807052',NULL);

/*Table structure for table `intelmlm_product_meta` */

DROP TABLE IF EXISTS `intelmlm_product_meta`;

CREATE TABLE `intelmlm_product_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(100) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `meta` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_product_meta` */

insert  into `intelmlm_product_meta`(`id`,`productid`,`alias`,`meta`,`value`) values (1,NULL,NULL,'category','Food And Beverages'),(2,NULL,NULL,'category','Automobile');

/*Table structure for table `intelmlm_role` */

DROP TABLE IF EXISTS `intelmlm_role`;

CREATE TABLE `intelmlm_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_role` */

insert  into `intelmlm_role`(`id`,`name`) values (1,'Admin'),(2,'Users');

/*Table structure for table `intelmlm_role_meta` */

DROP TABLE IF EXISTS `intelmlm_role_meta`;

CREATE TABLE `intelmlm_role_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleid` varchar(11) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `meta` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_role_meta` */

insert  into `intelmlm_role_meta`(`id`,`roleid`,`alias`,`meta`,`value`) values (1,'1','Edit User','can_edit_user','yes'),(2,'1','Edit Role','can_edit_role','yes'),(5,'2','Can Edit User','can_edit_user','no');

/*Table structure for table `intelmlm_settings_meta` */

DROP TABLE IF EXISTS `intelmlm_settings_meta`;

CREATE TABLE `intelmlm_settings_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_settings_meta` */

insert  into `intelmlm_settings_meta`(`id`,`meta`,`value`) values (1,'title','Intelligent Multilevel System'),(2,'short-name','IntelMLM');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_users` */

insert  into `intelmlm_users`(`id`,`username`,`password`,`bpassword`,`userid`,`userrole`,`userlevel`,`email`,`timestamp`,`valid`,`fullname`,`hash`,`hash_generated`) values (1,'admin','e10adc3949ba59abbe56e057f20f883e','123456','521d78c3420a2d928025058c61548c93','1',9,'',1386805452,1,'Admin Fullname Only','67399eb7cb1088e7d3952d7c451098da',1386789575),(2,'test_guest','e10adc3949ba59abbe56e057f20f883e','123456','cf39ff97bfe5e3635dc1b1ea6199874d','1',9,'',1386803668,1,'Test Fullname','67399eb7cb1088e7d3952d7c451098da',1386789575),(13,'temporary','e10adc3949ba59abbe56e057f20f883e','123456','b5dba4886eb44274158437f5a8605983','1',9,'',1386804302,1,'test','fb031eff2a63b0a85eded3a73389714f',1386804256),(14,'temporary_1386804295','e10adc3949ba59abbe56e057f20f883e','123456',NULL,NULL,NULL,NULL,1386804295,1,NULL,NULL,NULL),(15,'temporary1386804331','e10adc3949ba59abbe56e057f20f883e','123456','19aaf4aae642f4f92e3f10277dd25a55','Please select user role',NULL,'',1386808156,1,'','bf9ad7c8fb5991001e78672bd3b5704c',1386804342);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
