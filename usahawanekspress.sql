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

insert  into `intelmlm_active_users`(`username`,`timestamp`) values ('level19@intelmlm.com',1388688430);

/*Table structure for table `intelmlm_banned_users` */

DROP TABLE IF EXISTS `intelmlm_banned_users`;

CREATE TABLE `intelmlm_banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_banned_users` */

/*Table structure for table `intelmlm_ebooks` */

DROP TABLE IF EXISTS `intelmlm_ebooks`;

CREATE TABLE `intelmlm_ebooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_ebooks` */

insert  into `intelmlm_ebooks`(`id`,`title`,`description`) values (1,'ebpM1N','TYtrTawecw5V7wYkmMkT'),(2,'795EbQ','JL7wgs6sghhy8PB2kTDJ'),(3,'MNtTtI','aWAuMp2DXbqhMZOLs7lQ'),(4,'bkOFNJ','YEhEpJQiGTlvFVm9Newb'),(5,'ogJrTI','OOGa4THLYPggZwmIDsuP'),(6,'2WwDqB','KWtwIU3GyIIZMcxH6S0G'),(7,'vO3JUl','L6EGDDrUmX5lICfyG6N8'),(8,'TeSerw','FmVrarhywjGZlOUxSyQD'),(9,'zdbFuh','8Wm5Q8wdDd3Wnsitnylm'),(10,'ojIiX2','L9egxrfjw9it4LAWmsC1'),(11,'Rq1e7J','Bd7p3znFwrnAuvAwVYU2'),(12,'mtyiBm','gWVItDElHm5S6IdK6rbG'),(13,'8lH03V','qobZw589Oe8OXPfmdv91'),(14,'w9W56l','CPISoCxkgsb0CfIs3SO7'),(15,'e7gzRC','4uBDhWMJxYORLtjpWYs1'),(16,'9m1ryR','NoCEawybIEeOMFaDsD67'),(17,'29LEYz','qTzUvhPKTg0lTg4iPKkT'),(18,'aHJvIG','ivdIotsqSbKYRZo0hzdn'),(19,'m8sfsN','UROh4vefSg2LW74Gtf5J'),(20,'erE7QF','2d8xFCp4Kawdvcweab6R'),(21,'slRVce','aFAw9v1Y9RDotzMP0hcT'),(22,'fxszcX','lgdtb5gyGpQXKQY7ntvJ'),(23,'xaTqfJ','vthZPyjXQ1ay4PCQvP8H'),(24,'G3eBdi','Ewj6IJDwdIcVmbJsNO7f'),(25,'jcXMkA','SROEGYXebv1ua8PBjoCF'),(26,'85gccI','LQrn9xEWK2UCYDtPxnVq'),(27,'2WH3W4','xC3aqjHXcI8djVyoMV3q'),(28,'ppzVq4','3e6YWslrQlZ1RZjN5MAH'),(29,'yUR82T','pWRMwvCkIZzZVsAMyFc0'),(30,'jqh7uU','9LgJnMQq8DAw1xmjkhHH'),(31,'cC5FGS','Tzu5oCvtWuDZu6X0DHZV'),(32,'A0RNZA','GcvDq6MgUxmNHn0hJY0z'),(33,'bRYhV0','AiRXMC3sWXxG02eTiKVI'),(34,'ap6VeJ','yH0GrOY69lR7n2kSehta'),(35,'3Gbri8','KozrHvUkAHuPag7UausW'),(36,'A6qLmc','jAU788clO21BVDHSuZSL'),(37,'PlnYxy','4AbxgQcBlY6DGq0YeFQb'),(38,'rViqqS','iIYsZawVB2WClSCadhmR'),(39,'lwTV1s','IME2a8QvEY4XaZhp7bqF'),(40,'Y4wdya','voQn1tXO5BoY3KfUcMwa');

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
  `upload_type` varchar(100) DEFAULT NULL,
  `trx_uid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `intelmlm_files` */

insert  into `intelmlm_files`(`id`,`uid`,`name`,`size`,`type`,`url`,`title`,`description`,`upload_type`,`trx_uid`) values (16,53,'maybank175x175 (6).jpg',14912,'image/jpeg',NULL,'','','upload_transaction','11'),(17,53,'Numbers-0-icon (2).png',1634,'image/png',NULL,'','','upload_transaction','11'),(18,53,'maybank175x175 (7).jpg',14912,'image/jpeg',NULL,'','','upload_transaction','11'),(19,53,'Book-icon (5).png',4461,'image/png',NULL,'','','upload_transaction','11'),(20,53,'maybank175x175 (8).jpg',14912,'image/jpeg',NULL,'','','upload_transaction','11'),(21,53,'maybank175x175 (9).jpg',14912,'image/jpeg',NULL,'','','upload_transaction','11'),(22,53,'maybank175x175 (10).jpg',14912,'image/jpeg',NULL,'','','upload_transaction','11'),(23,53,'maybank175x175 (11).jpg',14912,'image/jpeg',NULL,'','','upload_transaction','11'),(24,53,'maybank175x175 (12).jpg',14912,'image/jpeg',NULL,'','','upload_transaction','11'),(25,53,'Numbers-0-icon (3).png',1634,'image/png',NULL,'','','upload_transaction','11'),(26,53,'Book-icon (6).png',4461,'image/png',NULL,'','','upload_transaction','11'),(27,53,'Book-icon (7).png',4461,'image/png',NULL,'','','upload_transaction','11'),(28,53,'Book-icon (8).png',4461,'image/png',NULL,'','','upload_transaction','11'),(29,53,'Book-icon (9).png',4461,'image/png',NULL,'','','upload_transaction','11'),(30,53,'Numbers-1-icon (1).png',1055,'image/png',NULL,'','','upload_transaction','11'),(31,53,'Numbers-1-icon (2).png',1055,'image/png',NULL,'','','upload_transaction','11'),(32,53,'Numbers-2-icon.png',1539,'image/png',NULL,'','','upload_transaction','10');

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_settings` */

insert  into `intelmlm_settings`(`id`,`ref`,`meta`,`value`) values (1,'tbl_name','users','intelmlm_users'),(2,'tbl_name','active_users','intelmlm_active_users'),(3,'tbl_name','active_guest','intelmlm_active_guests'),(4,'tbl_name','banned_users','intelmlm_banned_users'),(5,'tbl_name','mail','intelmlm_mail'),(6,'constants','track_visitors','true'),(7,'constants','user_timeout','10'),(8,'system','title','intelMLM - Intelligent Multilevel System'),(9,'constants','debug_mode','yes'),(10,'tbl_name','ads','intelmlm_ads'),(11,'level_name','admin_name','admin'),(12,'level_name','guest_name','Guest'),(13,'level_constants','admin_level','9'),(14,'level_constants','guest_level','0'),(15,'level_constants','user_level','1'),(16,'system','login_using','email'),(17,'ads_category','name','Tudung'),(18,'ads_category','name','Minuman'),(19,'ads_subcategory','17','Bawal'),(20,'ads_subcategory','17','Tudung Bukit'),(21,'ads_subcategory','17',' Tudung Nasi Lemak'),(22,'ads_subcategory','17','Tudung Sarung Nangka'),(23,'ads_subcategory','17','Tudung Alien'),(24,'ads_subcategory','17','Tudung Papa Kedana'),(25,'ads_subcategory','17','Tudung Siput'),(26,'ads_subcategory','17','Tudung Retis'),(27,'ads_subcategory','17','Tudung Muslimah'),(28,'ads_subcategory','18','Teh Gaharu'),(29,'level_package','1','Users'),(30,'level_constants','enterprise_level','2'),(31,'level_package','2','Enterprise'),(32,'constants','theme_img','intelmlm_images'),(33,'tbl_name','files','intelmlm_files'),(34,'store_category','name','Boutique'),(35,'store_category','name','Restaurant'),(36,'tbl_name','store','intelmlm_store'),(37,'store_level','enterprise','Enterprise'),(38,'store_level','professional','Professional'),(39,'ads_status','need_admin_approval','Waiting for approval'),(40,'ads_status','published','Published'),(41,'store_status','need_admin_approval','Waiting for approval'),(42,'store_status','approved','Approved'),(43,'constants','system_setup','1'),(44,'level_constants','verified_user','3'),(45,'tbl_name','transaction','intelmlm_transaction'),(46,'tbl_name','ebooks','intelmlm_ebooks'),(47,'tbl_name','transaction_meta','intelmlm_transaction_meta'),(48,'constants','referral_url','http://www.usahawanekspress.com');

/*Table structure for table `intelmlm_transaction` */

DROP TABLE IF EXISTS `intelmlm_transaction`;

CREATE TABLE `intelmlm_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trx_ref` varchar(100) DEFAULT NULL,
  `trx_uid` varchar(100) DEFAULT NULL,
  `rcx_uid` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `trx_type` varchar(100) DEFAULT NULL,
  `trx_desc` varchar(100) DEFAULT NULL,
  `trx_date` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_transaction` */

insert  into `intelmlm_transaction`(`id`,`trx_ref`,`trx_uid`,`rcx_uid`,`amount`,`trx_type`,`trx_desc`,`trx_date`,`status`) values (12,'user43_upline10','47','10','20','pendaftaran','1,2','1388580399','paid'),(13,'user43_upline11','43','11','20','pendaftaran','1,2','1388580692','paid'),(14,'user43_upline9','43','9','20','pendaftaran','9,10','1388580781','paid'),(15,'user43_upline7','43','7','20','pendaftaran','17,18','1388580879','paid'),(16,'user43_upline8','43','8','20','pendaftaran','13,14','1388581260','paid'),(17,'user10_upline9','10','9','20','pendaftaran','1,2','1388589715','paid'),(18,'user10_upline8','10','8','20','pendaftaran','6,7','1388589942','paid'),(19,'user48_upline10','48','10','20','pendaftaran','1,2','1388592141','paid'),(20,'user48_upline9','48','9','20','pendaftaran','6,7','1388592306','paid'),(21,'user48_upline8','48','8','20','pendaftaran','9,10','1388592801','paid'),(22,'user48_upline7','48','7','20','pendaftaran','13,14','1388592911','paid'),(23,'user48_upline6','48','6','20','pendaftaran','18,19','1388593038','paid'),(24,'user49_upline48','49','48','20','pendaftaran','1,2','1388594636','paid'),(25,'user49_upline10','49','10','20','pendaftaran','5,6','1388594769','paid'),(26,'user49_upline9','49','9','20','pendaftaran','10,11','1388594840','paid'),(27,'user53_upline11','53','11','20','pendaftaran','1,2','1388607926','paid'),(28,'user47_upline9','47','9','20','pendaftaran','5,6','1388672373','waiting_for_payment'),(29,'user43_upline10','43','10','20','pendaftaran','5,6','1388673570','paid'),(30,'user53_upline10','53','10','20','pendaftaran','6,7','1388688376','paid');

/*Table structure for table `intelmlm_transaction_meta` */

DROP TABLE IF EXISTS `intelmlm_transaction_meta`;

CREATE TABLE `intelmlm_transaction_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(100) DEFAULT NULL,
  `meta` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `create_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_transaction_meta` */

insert  into `intelmlm_transaction_meta`(`id`,`ref`,`meta`,`value`,`create_date`) values (1,'user42_upline10','status','waiting_for_payment','1388574347'),(2,'user42_upline9','status','waiting_for_payment','1388574703'),(3,'user42_upline8','status','waiting_for_payment','1388574916'),(4,'user42_upline6','status','waiting_for_payment','1388575748'),(5,'user42_upline10','payment_date','01 01 2014','1388576340'),(6,'user42_upline10','payment_time','3434','1388576340'),(7,'user42_upline10','payment_reference','dfdf','1388576340'),(8,'user42_upline10','status','paid','1388576340'),(9,'user42_upline9','payment_date','01 01 2014','1388576392'),(10,'user42_upline9','payment_time','444','1388576392'),(11,'user42_upline9','payment_reference','ewrewrewr','1388576392'),(12,'user42_upline9','status','paid','1388576392'),(13,'user42_upline1','status','waiting_for_payment','1388576924'),(14,'user43_upline10','status','waiting_for_payment','1388579178'),(15,'user43_upline10','payment_date','01 01 2014','1388579187'),(16,'user43_upline10','payment_time','66','1388579187'),(17,'user43_upline10','payment_reference','dsfdsf','1388579187'),(18,'user43_upline10','status','paid','1388579187'),(19,'user43_upline9','status','waiting_for_payment','1388579608'),(20,'user43_upline5','status','waiting_for_payment','1388579626'),(21,'user43_upline6','status','waiting_for_payment','1388579818'),(22,'user43_upline6','payment_date','01 01 2014','1388580173'),(23,'user43_upline6','payment_time','ee','1388580173'),(24,'user43_upline6','payment_reference','rerer','1388580173'),(25,'user43_upline6','status','paid','1388580173'),(26,'user43_upline8','status','waiting_for_payment','1388580227'),(27,'user43_upline8','payment_date','01 01 2014','1388580233'),(28,'user43_upline8','payment_time','ee','1388580233'),(29,'user43_upline8','payment_reference','3333','1388580233'),(30,'user43_upline8','status','paid','1388580233'),(31,'user43_upline9','payment_date','01 01 2014','1388580283'),(32,'user43_upline9','payment_time','33','1388580283'),(33,'user43_upline9','payment_reference','333','1388580283'),(34,'user43_upline9','status','paid','1388580283'),(35,'user43_upline7','status','waiting_for_payment','1388580312'),(36,'user43_upline10','status','waiting_for_payment','1388580399'),(37,'user43_upline10','payment_date','01 01 2014','1388580407'),(38,'user43_upline10','payment_time','','1388580407'),(39,'user43_upline10','payment_reference','','1388580407'),(40,'user43_upline10','status','paid','1388580407'),(41,'user43_upline11','status','waiting_for_payment','1388580692'),(42,'user43_upline11','payment_date','01 01 2014','1388580699'),(43,'user43_upline11','payment_time','','1388580699'),(44,'user43_upline11','payment_reference','','1388580699'),(45,'user43_upline11','status','paid','1388580699'),(46,'user43_upline9','status','waiting_for_payment','1388580781'),(47,'user43_upline9','payment_date','01 01 2014','1388580786'),(48,'user43_upline9','payment_time','','1388580786'),(49,'user43_upline9','payment_reference','','1388580786'),(50,'user43_upline9','status','paid','1388580786'),(51,'user43_upline7','status','waiting_for_payment','1388580879'),(52,'user43_upline7','payment_date','01 01 2014','1388580882'),(53,'user43_upline7','payment_time','','1388580882'),(54,'user43_upline7','payment_reference','','1388580882'),(55,'user43_upline7','status','paid','1388580882'),(56,'user43_upline8','status','waiting_for_payment','1388581260'),(57,'user43_upline8','payment_date','01 01 2014','1388581263'),(58,'user43_upline8','payment_time','','1388581263'),(59,'user43_upline8','payment_reference','','1388581263'),(60,'user43_upline8','status','paid','1388581263'),(61,'user10_upline9','status','waiting_for_payment','1388589715'),(62,'user10_upline9','payment_date','02 01 2014','1388589724'),(63,'user10_upline9','payment_time','55555555','1388589724'),(64,'user10_upline9','payment_reference','erer','1388589724'),(65,'user10_upline9','status','paid','1388589724'),(66,'user10_upline8','status','waiting_for_payment','1388589942'),(67,'user10_upline8','payment_date','01 01 2014','1388589950'),(68,'user10_upline8','payment_time','eeeee','1388589950'),(69,'user10_upline8','payment_reference','ererer','1388589950'),(70,'user10_upline8','status','paid','1388589950'),(71,'user48_upline10','status','waiting_for_payment','1388592141'),(72,'user48_upline10','payment_date','01 01 2014','1388592148'),(73,'user48_upline10','payment_time','33333333','1388592148'),(74,'user48_upline10','payment_reference','ewrewrew','1388592148'),(75,'user48_upline10','status','paid','1388592148'),(76,'user48_upline9','status','waiting_for_payment','1388592306'),(77,'user48_upline9','payment_date','01 01 2014','1388592398'),(78,'user48_upline9','payment_time','2222','1388592398'),(79,'user48_upline9','payment_reference','333333','1388592398'),(80,'user48_upline9','status','paid','1388592398'),(81,'user48_upline8','status','waiting_for_payment','1388592801'),(82,'user48_upline8','payment_date','01 01 2014','1388592809'),(83,'user48_upline8','payment_time','3erer','1388592809'),(84,'user48_upline8','payment_reference','33333','1388592809'),(85,'user48_upline8','status','paid','1388592809'),(86,'user48_upline7','status','waiting_for_payment','1388592911'),(87,'user48_upline7','payment_date','01 01 2014','1388592917'),(88,'user48_upline7','payment_time','33333','1388592917'),(89,'user48_upline7','payment_reference','ewrewr','1388592917'),(90,'user48_upline7','status','paid','1388592917'),(91,'user48_upline6','status','waiting_for_payment','1388593038'),(92,'user48_upline6','payment_date','01 01 2014','1388593043'),(93,'user48_upline6','payment_time','3333333','1388593043'),(94,'user48_upline6','payment_reference','sdfdsf','1388593043'),(95,'user48_upline6','status','paid','1388593043'),(96,'user49_upline48','status','waiting_for_payment','1388594636'),(97,'user49_upline48','payment_date','01 01 2014','1388594646'),(98,'user49_upline48','payment_time','3333','1388594646'),(99,'user49_upline48','payment_reference','wqew','1388594646'),(100,'user49_upline48','status','paid','1388594646'),(101,'user49_upline10','status','waiting_for_payment','1388594769'),(102,'user49_upline10','payment_date','01 01 2014','1388594775'),(103,'user49_upline10','payment_time','444444','1388594775'),(104,'user49_upline10','payment_reference','444','1388594775'),(105,'user49_upline10','status','paid','1388594775'),(106,'user49_upline9','status','waiting_for_payment','1388594840'),(107,'user49_upline9','payment_date','01 01 2014','1388594848'),(108,'user49_upline9','payment_time','333333333','1388594848'),(109,'user49_upline9','payment_reference','asdasdasd','1388594848'),(110,'user49_upline9','status','paid','1388594848'),(111,'user53_upline11','status','waiting_for_payment','1388607926'),(112,'user47_upline9','status','waiting_for_payment','1388672373'),(113,'user43_upline10','status','waiting_for_payment','1388673570'),(114,'user43_upline10','payment_date','01 01 2014','1388673579'),(115,'user43_upline10','payment_time','4444','1388673579'),(116,'user43_upline10','payment_reference','sdfdsf','1388673579'),(117,'user43_upline10','status','paid','1388673579'),(118,'user53_upline11','upload_id','31','1388688264'),(119,'user53_upline11','payment_date','01 Jan 2014','1388688264'),(120,'user53_upline11','payment_time','','1388688264'),(121,'user53_upline11','payment_reference','','1388688264'),(122,'user53_upline11','status','paid','1388688264'),(123,'user53_upline10','status','waiting_for_payment','1388688376'),(124,'user53_upline10','upload_id','32','1388688384'),(125,'user53_upline10','payment_date','01 Jan 2014','1388688384'),(126,'user53_upline10','payment_time','','1388688384'),(127,'user53_upline10','payment_reference','','1388688384'),(128,'user53_upline10','status','paid','1388688384');

/*Table structure for table `intelmlm_users` */

DROP TABLE IF EXISTS `intelmlm_users`;

CREATE TABLE `intelmlm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uplineid` int(11) DEFAULT NULL,
  `upline_arr` varchar(100) DEFAULT NULL,
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
  `fb_id` varchar(100) DEFAULT NULL,
  `fb_token` varchar(300) DEFAULT NULL,
  `fb_array` longtext,
  `bank_acc` varchar(100) DEFAULT NULL,
  `bank_holder` varchar(100) DEFAULT NULL,
  `pakej` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Data for the table `intelmlm_users` */

insert  into `intelmlm_users`(`id`,`uplineid`,`upline_arr`,`username`,`password`,`bpassword`,`userid`,`userrole`,`userlevel`,`email`,`timestamp`,`valid`,`fullname`,`hash`,`hash_generated`,`fb_id`,`fb_token`,`fb_array`,`bank_acc`,`bank_holder`,`pakej`,`phone`) values (1,0,NULL,'level1@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','3db818401942a585eeac8b003d0e9c67','1',3,'level1@intelmlm.com',1387732715,1,'Admin Fullname Only','49ff1f61a1a945c699fce278a5f5795b',1387651608,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,NULL,'level2@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','cf39ff97bfe5e3635dc1b1ea6199874d','1',3,'level2@intelmlm.com',1386803668,1,'Test Fullname','67399eb7cb1088e7d3952d7c451098da',1386789575,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,2,NULL,'level3@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','b5dba4886eb44274158437f5a8605983','1',3,'level3@intelmlm.com',1386804302,1,'test','fb031eff2a63b0a85eded3a73389714f',1386804256,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,3,NULL,'level4@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','67a5f174961a7e24bd112d0cccea9c61','Please select user role',3,'level4@intelmlm.com',1387531993,1,'','947124340ac549df637d6d15825aedeb',1387531986,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,4,NULL,'level5@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','81eb2d2dd92acbb4736b0e96d561a430','2',3,'level5@intelmlm.com',1386825214,1,'Farizul','165dc1d04cf8129832ca62b81f6220e1',1386818861,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,5,NULL,'level6@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456',NULL,'2',3,'level6@intelmlm.com',1386823602,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,6,NULL,'level7@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','1387512381',NULL,3,'level7@intelmlm.com',1387512381,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,7,NULL,'level8@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','1387512460',NULL,3,'level8@intelmlm.com',1387512460,1,NULL,NULL,NULL,NULL,NULL,NULL,'11111111111111','Chemah Ishak',NULL,NULL),(9,8,NULL,'level9@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','5d4457f5b0b356d509fa7e9f7be1ffd1',NULL,3,'level9@intelmlm.com',1387732552,1,NULL,'dc3da24258ef0b470cdb37b129155384',1387532057,NULL,NULL,NULL,'55555555555','Rizuan Rais',NULL,NULL),(10,9,NULL,'level10@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','1dc195a913066481f73c8b425f24cb34',NULL,3,'level10@intelmlm.com',1388606392,1,'Fullname here','3a56e3296ea256a14d08c8e08b9073fd',1388587081,NULL,NULL,NULL,'55377746655488','MOHAMAD FARIZUL','20',NULL),(47,10,NULL,'sara.qalisha@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456','021e6cca3539cd22dd44f4e65c381fd9',NULL,1,'sara.qalisha@gmail.com',1388673522,1,NULL,'7638de84b6a1b5f350d1d656c623c4ad',1388585887,'100007083242149','CAAID0MaYYZC0BAOOyVm3INnte78lqhYisFLzDzNnND1NItIKIfXU5QF4oZADTyDy9ZBgCdqD8ZCJnVjQOF56Td7YQ0DtfZAOQoY2ayiD3OCVFTeVYRJQZBlqaYENZAq0FCuKT756xjJSbzxjobj8Vnif6YLXChw7VJUfk6xWcpApjtkUl0If1PRwopAaktLgaw6qdMa3awLZAgZDZD','a:7:{s:2:\"id\";s:15:\"100007083242149\";s:4:\"name\";s:12:\"Sara Qalisha\";s:10:\"first_name\";s:4:\"Sara\";s:9:\"last_name\";s:7:\"Qalisha\";s:8:\"username\";s:12:\"sara.qalisha\";s:6:\"gender\";s:6:\"female\";s:6:\"locale\";s:5:\"en_US\";}','722666554435','Sara Qalisha','10',NULL),(11,10,NULL,'level11@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','b46ee30663bb01b6cadf8b5fa7e38aee',NULL,3,'level11@intelmlm.com',1388638926,1,NULL,'7654189d252d1d3be0d41d533a4a07c1',1388606398,NULL,NULL,NULL,NULL,NULL,'20',NULL),(42,NULL,NULL,'level12@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','e574834d650f3c96f58006dd2bf1af93',NULL,1,'level12@intelmlm.com',1388578965,1,NULL,'5854ce5e7f0b3ac4d1804289a158e6f5',1388557452,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(43,11,NULL,'level13@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','ad3cb9b4e6aece91f1fdd7def64583a3',NULL,3,'level13@intelmlm.com',1388679807,1,NULL,'219d96703940e36975b03af631884e07',1388579009,NULL,NULL,NULL,'155566645363','mmdmdmmfaaeawea','10','2123234567'),(48,43,NULL,'level14@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','626d3df0f21fa7e61e9eb28c45711438',NULL,3,'level14@intelmlm.com',1388593201,1,NULL,'882c8b7accf41c0107dcc02a083761c0',1388587005,NULL,NULL,NULL,'444444444444','Raza bin dain','10','4444444444'),(49,48,NULL,'level15@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','70e3e419f3b1560cb376b717b192643d',NULL,1,'level15@intelmlm.com',1388604340,1,NULL,'391eec8344f56274a60108bd37dd3e6d',1388594629,NULL,NULL,NULL,NULL,NULL,'10',NULL),(50,NULL,NULL,'level16@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','1388604357',NULL,1,'level16@intelmlm.com',1388604357,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(51,0,NULL,'level17@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','1388604773',NULL,1,'level17@intelmlm.com',1388604773,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(52,43,NULL,'level18@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','1388604960',NULL,1,'level18@intelmlm.com',1388604960,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(53,11,NULL,'level19@intelmlm.com','e10adc3949ba59abbe56e057f20f883e','123456','d96d9c47bf5d9e4e763d715a64bb5780',NULL,1,'level19@intelmlm.com',1388688430,1,NULL,'74e0cade1d210cecdb219d3098f9041c',1388606547,NULL,NULL,NULL,NULL,NULL,'10',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
