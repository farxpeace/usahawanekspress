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

insert  into `intelmlm_active_guests`(`ip`,`timestamp`) values ('127.0.0.1',1387732727);

/*Table structure for table `intelmlm_active_users` */

DROP TABLE IF EXISTS `intelmlm_active_users`;

CREATE TABLE `intelmlm_active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_active_users` */

/*Table structure for table `intelmlm_ads` */

DROP TABLE IF EXISTS `intelmlm_ads`;

CREATE TABLE `intelmlm_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext,
  `category` varchar(100) DEFAULT NULL,
  `subcategory` varchar(100) DEFAULT NULL,
  `images` varchar(200) DEFAULT NULL,
  `price_sale` varchar(100) DEFAULT NULL,
  `create_date` varchar(100) DEFAULT NULL,
  `publish_date` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_ads` */

insert  into `intelmlm_ads`(`id`,`userid`,`title`,`description`,`category`,`subcategory`,`images`,`price_sale`,`create_date`,`publish_date`,`status`) values (2,32,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,32,'eeeeee',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,32,'eeeeee',NULL,NULL,NULL,NULL,NULL,'1387661880',NULL,'need_admin_approval'),(5,32,'eeeeee','fffffffff',NULL,NULL,NULL,NULL,'1387662222',NULL,'need_admin_approval'),(6,32,'eeeeee','fffffffff',NULL,NULL,NULL,NULL,'1387662279',NULL,'need_admin_approval'),(7,32,'eeeeee','fffffffff','17',NULL,NULL,NULL,'1387662303',NULL,'need_admin_approval'),(8,32,'eeeeee','fffffffff','17',NULL,NULL,NULL,'1387662359',NULL,'need_admin_approval'),(9,32,'eeeeee','fffffffff','17',NULL,NULL,NULL,'1387662381',NULL,'need_admin_approval'),(10,32,'eeeeee','fffffffff','18',NULL,NULL,NULL,'1387662415',NULL,'need_admin_approval'),(11,32,'eeeeee','fffffffff','18',NULL,NULL,NULL,'1387662621',NULL,'need_admin_approval'),(12,32,'eeeeee','fffffffff','18',NULL,NULL,NULL,'1387662654',NULL,'need_admin_approval'),(13,32,'ddddddd','dsfsdf','17',NULL,NULL,NULL,'1387663245',NULL,'need_admin_approval'),(14,32,'ddddddd','dsfsdf','17',NULL,NULL,NULL,'1387663282',NULL,'need_admin_approval'),(15,32,'ddddddd','dsfsdf',NULL,NULL,NULL,NULL,'1387663301',NULL,'need_admin_approval'),(16,32,'ddddddd','dsfsdf','23',NULL,NULL,NULL,'1387663309',NULL,'need_admin_approval'),(17,32,'ddddddd','dsfsdf','17','23',NULL,NULL,'1387663369',NULL,'need_admin_approval'),(18,32,'ddddddd','dsfsdf','17','23',NULL,'22','1387663657',NULL,'need_admin_approval'),(19,32,'ddddddd','dsfsdf','17','23',NULL,'22','1387663783',NULL,'need_admin_approval'),(20,32,'','dffffff','17','22',NULL,'33','1387663919',NULL,'need_admin_approval'),(21,32,'rrrrrrrrrrr','fffffffff','17','23',NULL,'4','1387666532',NULL,'need_admin_approval'),(22,32,'qqqqqqqqq','qqqqqqqq','17','22',NULL,'33','1387666573',NULL,'need_admin_approval'),(23,32,'qqqqqqqqq','qqqqqqqq','17','22',NULL,'33','1387666714',NULL,'need_admin_approval'),(24,32,'qqqqqqqqq','qqqqqqqq','17','22',NULL,'33','1387666970',NULL,'need_admin_approval'),(25,32,'qqqqqqqqq','qqqqqqqq','18','28',NULL,'33','1387666993',NULL,'need_admin_approval'),(26,32,'qqqqqqqqq','qqqqqqqq','18','28','47,48','33','1387667078',NULL,'need_admin_approval'),(27,32,'qqqqqqqqqrrrrrrrrrrrrrr','qqqqqqqq','18','28','47,48','33','1387668063',NULL,'need_admin_approval'),(28,32,'Ubah gambar','qqqqqqqq','18','28','47,48','33','1387668196',NULL,'need_admin_approval'),(29,32,'Ubah gambar','qqqqqqqq','18','28','47','33','1387668209',NULL,'need_admin_approval'),(30,32,'Ubah gambar','qqqqqqqq','18','28','47,48','33','1387668220',NULL,'need_admin_approval'),(31,32,'Ubah gambar','qqqqqqqq','17','19','47,49','78','1387668293',NULL,'need_admin_approval'),(32,32,'testttttttt','dfdfrrrrrrrrrrrrrr','18','28','48','33','1387670161',NULL,'need_admin_approval'),(33,32,'Ubah gambar','qqqqqqqq','18','28','47,48,49','33','1387670913',NULL,'need_admin_approval'),(34,32,'Ubah gambaryyyy1','qqqqqqqq','18','28','47,48,49','33','1387670928',NULL,'need_admin_approval'),(35,32,'Ubah gambaryyyy2','ddddddddddddddddd','18','28','48,47','45','1387670984',NULL,'published'),(36,32,'Ubah gambaryyyy3','qqqqqqqq','18','28','47,48,49','33','1387671070',NULL,'published'),(37,32,'Test Ads id no 37','qqqqqqqq','18','28','47,48,49','33','1387671078',NULL,'published'),(38,32,'Ubah 5',NULL,NULL,NULL,NULL,NULL,'1387671102',NULL,'published'),(39,32,'ttttttt','ggggggggggg','18','28','47','44','1387671455',NULL,'published'),(40,32,'Barang baik','fffffffyyyyy','17','19','48,47','234324','1387671492',NULL,'published');

/*Table structure for table `intelmlm_banned_users` */

DROP TABLE IF EXISTS `intelmlm_banned_users`;

CREATE TABLE `intelmlm_banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_banned_users` */

/*Table structure for table `intelmlm_files` */

DROP TABLE IF EXISTS `intelmlm_files`;

CREATE TABLE `intelmlm_files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

/*Data for the table `intelmlm_files` */

insert  into `intelmlm_files`(`id`,`uid`,`name`,`size`,`type`,`url`,`title`,`description`) values (30,3,'Facebook-Connect-authenticate.png',16913,'image/png',NULL,'',''),(32,1,'facebook_connect_pic1.png',9233,'image/png',NULL,'',''),(33,1,'Facebook-Connect-authenticate (1).png',16913,'image/png',NULL,'',''),(34,1,'facebook_connect_pic2.png',14285,'image/png',NULL,'',''),(47,32,'facebook_connect_pic2 (1).png',14285,'image/png',NULL,'',''),(48,32,'facebook_connect_pic1 (1).png',9233,'image/png',NULL,'',''),(49,32,'res_1367594262966.jpg',54290,'image/jpeg',NULL,'','');

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_settings` */

insert  into `intelmlm_settings`(`id`,`ref`,`meta`,`value`) values (1,'tbl_name','users','intelmlm_users'),(2,'tbl_name','active_users','intelmlm_active_users'),(3,'tbl_name','active_guest','intelmlm_active_guests'),(4,'tbl_name','banned_users','intelmlm_banned_users'),(5,'tbl_name','mail','intelmlm_mail'),(6,'constants','track_visitors','true'),(7,'constants','user_timeout','10'),(8,'system','title','intelMLM - Intelligent Multilevel System'),(9,'constants','debug_mode','yes'),(10,'tbl_name','ads','intelmlm_ads'),(11,'level_name','admin_name','admin'),(12,'level_name','guest_name','Guest'),(13,'level_constants','admin_level','9'),(14,'level_constants','guest_level','0'),(15,'level_constants','user_level','1'),(16,'system','login_using','email'),(17,'ads_category','name','Tudung'),(18,'ads_category','name','Minuman'),(19,'ads_subcategory','17','Bawal'),(20,'ads_subcategory','17','Tudung Bukit'),(21,'ads_subcategory','17',' Tudung Nasi Lemak'),(22,'ads_subcategory','17','Tudung Sarung Nangka'),(23,'ads_subcategory','17','Tudung Alien'),(24,'ads_subcategory','17','Tudung Papa Kedana'),(25,'ads_subcategory','17','Tudung Siput'),(26,'ads_subcategory','17','Tudung Retis'),(27,'ads_subcategory','17','Tudung Muslimah'),(28,'ads_subcategory','18','Teh Gaharu'),(29,'level_package','1','Users'),(30,'level_constants','enterprise_level','2'),(31,'level_package','2','Enterprise'),(32,'constants','theme_img','intelmlm_images'),(33,'tbl_name','files','intelmlm_files'),(34,'store_category','name','Boutique'),(35,'store_category','name','Restaurant'),(36,'tbl_name','store','intelmlm_store'),(37,'store_level','enterprise','Enterprise'),(38,'store_level','professional','Professional'),(39,'ads_status','need_admin_approval','Waiting for approval'),(40,'ads_status','published','Published'),(41,'store_status','need_admin_approval','Waiting for approval'),(42,'store_status','approved','Approved');

/*Table structure for table `intelmlm_store` */

DROP TABLE IF EXISTS `intelmlm_store`;

CREATE TABLE `intelmlm_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `store_name` varchar(100) DEFAULT NULL,
  `create_date` varchar(100) DEFAULT NULL,
  `store_level` varchar(100) DEFAULT 'enterprise',
  `store_status` varbinary(100) DEFAULT 'published',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_store` */

insert  into `intelmlm_store`(`id`,`userid`,`store_name`,`create_date`,`store_level`,`store_status`) values (1,32,'ssssssssssss','1387719559','37','need_admin_approval'),(2,32,'tttttttttt','1387719615','37','need_admin_approval'),(3,32,'tttttttttt','1387719615','37','need_admin_approval'),(4,32,'test store','1387719655','37','approved'),(5,1,'test fffffffffff','1387732681','37','need_admin_approval');

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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_users` */

insert  into `intelmlm_users`(`id`,`username`,`password`,`bpassword`,`userid`,`userrole`,`userlevel`,`email`,`timestamp`,`valid`,`fullname`,`hash`,`hash_generated`) values (1,'admin','e10adc3949ba59abbe56e057f20f883e','123456','3db818401942a585eeac8b003d0e9c67','1',9,'admin@intelmlm.com',1387732715,1,'Admin Fullname Only','49ff1f61a1a945c699fce278a5f5795b',1387651608),(2,'test_guest','e10adc3949ba59abbe56e057f20f883e','123456','cf39ff97bfe5e3635dc1b1ea6199874d','1',9,'',1386803668,1,'Test Fullname','67399eb7cb1088e7d3952d7c451098da',1386789575),(13,'temporary','e10adc3949ba59abbe56e057f20f883e','123456','b5dba4886eb44274158437f5a8605983','1',9,'',1386804302,1,'test','fb031eff2a63b0a85eded3a73389714f',1386804256),(15,'temporary1386804331','e10adc3949ba59abbe56e057f20f883e','123456','67a5f174961a7e24bd112d0cccea9c61','Please select user role',1,'admin@boxgenerator.com',1387531993,1,'','947124340ac549df637d6d15825aedeb',1387531986),(19,'614504161','e10adc3949ba59abbe56e057f20f883e','123456','81eb2d2dd92acbb4736b0e96d561a430','2',9,'',1386825214,1,'Farizul','165dc1d04cf8129832ca62b81f6220e1',1386818861),(23,'temporary1386823602','e10adc3949ba59abbe56e057f20f883e','123456',NULL,'2',NULL,NULL,1386823602,1,NULL,NULL,NULL),(28,NULL,'c162de19c4c3731ca3428769d0cd593d','aaaaaaaaaaaaa','1387512381',NULL,1,'',1387512381,0,NULL,NULL,NULL),(29,NULL,'d57f21e6a273781dbf8b7657940f3b03','aaaaaaaaaaa','1387512460',NULL,1,'aa@asdasd.com',1387512460,0,NULL,NULL,NULL),(32,'aaaa','e10adc3949ba59abbe56e057f20f883e','123456','5d4457f5b0b356d509fa7e9f7be1ffd1',NULL,2,'user@intelmlm.com',1387732552,1,NULL,'dc3da24258ef0b470cdb37b129155384',1387532057),(33,'user2@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','1627325d9f5f577a54b018f7b0270b0b',NULL,1,'user2@intelmlm.com',1387532160,1,'Fullname here','387419d4e008720635d350527b8dc160',1387532146),(34,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'dfdf',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
