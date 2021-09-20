/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.3.16-MariaDB : Database - vestd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `urlshort` */

DROP TABLE IF EXISTS `urlshort`;

CREATE TABLE `urlshort` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `fullurl` varchar(200) DEFAULT NULL,
  `shortcode` varchar(5) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `urlshort` */

insert  into `urlshort`(`id`,`fullurl`,`shortcode`,`created_date`) values 
(1,'https://www.google.com','B539D','2021-09-19 18:07:59'),
(2,'https://www.youtube.com','CAE89','2021-09-19 18:08:35'),
(3,'https://www.facebook.com','66718','2021-09-19 21:26:12');

/*Table structure for table `urltrack` */

DROP TABLE IF EXISTS `urltrack`;

CREATE TABLE `urltrack` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `urlid` bigint(25) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `urltrack` */

insert  into `urltrack`(`id`,`urlid`,`created_date`) values 
(1,1,'2021-09-19 18:24:19'),
(2,1,'2021-09-19 18:24:20'),
(3,1,'2021-09-19 18:24:22'),
(4,2,'2021-09-19 18:24:26'),
(5,2,'2021-09-19 20:01:44'),
(6,2,'2021-09-19 20:02:08'),
(7,2,'2021-09-19 20:46:54'),
(8,2,'2021-09-19 20:47:14'),
(9,2,'2021-09-19 20:48:43'),
(10,2,'2021-09-19 20:50:52'),
(11,2,'2021-09-19 20:52:46'),
(12,2,'2021-09-19 20:52:56'),
(13,2,'2021-09-19 20:53:29'),
(14,2,'2021-09-19 20:53:53'),
(15,2,'2021-09-19 20:54:09'),
(16,2,'2021-09-19 20:54:25'),
(17,2,'2021-09-19 20:54:46'),
(18,2,'2021-09-19 20:56:13'),
(19,2,'2021-09-19 20:58:36'),
(20,2,'2021-09-19 20:59:00'),
(21,2,'2021-09-19 20:59:53'),
(22,2,'2021-09-19 21:00:04'),
(23,2,'2021-09-19 21:00:53');

/* Procedure structure for procedure `seturlshort` */

/*!50003 DROP PROCEDURE IF EXISTS  `seturlshort` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `seturlshort`(IN fullurlvar VARCHAR(200))
BEGIN
			declare getshortcode text;
			select shortcode into @oldshortcode from urlshort where fullurl=fullurlvar;
			if @oldshortcode <> '' then
				set getshortcode=@oldshortcode;
			else
				INSERT INTO urlshort SET fullurl=fullurlvar,shortcode=(SELECT upper(LEFT(UUID(),5)));
				SELECT shortcode INTO @newshortcode FROM urlshort WHERE fullurl=fullurlvar;
				SET getshortcode=@newshortcode;
			end if;
			set @oldshortcode='';
			set @newshortcode='';
			select getshortcode;
END */$$
DELIMITER ;

/*Table structure for table `view_urlshort` */

DROP TABLE IF EXISTS `view_urlshort`;

/*!50001 DROP VIEW IF EXISTS `view_urlshort` */;
/*!50001 DROP TABLE IF EXISTS `view_urlshort` */;

/*!50001 CREATE TABLE  `view_urlshort`(
 `id` bigint(25) ,
 `shortcode` varchar(5) ,
 `fullurl` varchar(200) ,
 `tracked` bigint(21) ,
 `created_date` datetime 
)*/;

/*View structure for view view_urlshort */

/*!50001 DROP TABLE IF EXISTS `view_urlshort` */;
/*!50001 DROP VIEW IF EXISTS `view_urlshort` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_urlshort` AS select `s`.`id` AS `id`,`s`.`shortcode` AS `shortcode`,`s`.`fullurl` AS `fullurl`,count(`t`.`id`) AS `tracked`,`s`.`created_date` AS `created_date` from (`urlshort` `s` left join `urltrack` `t` on(`s`.`id` = `t`.`urlid`)) group by `t`.`urlid` order by `s`.`id` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
