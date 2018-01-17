
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` VALUES (1,1,'EZJq6YbcTbGgZ2dNXV8xbSmwIixHWshK',1,'2018-01-15 14:44:35','2018-01-15 14:44:34','2018-01-15 14:44:35'),(11,11,'cPJfjEhAOtkbAWz2NKrHaJUWSSGXcWNy',1,'2018-01-15 15:38:27','2018-01-15 15:37:56','2018-01-15 15:38:27'),(21,21,'8YPs8Xmw1UlgqXrzLOhsaYRT14NMBtZi',1,'2018-01-15 17:46:21','2018-01-15 17:46:21',NULL);
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Men','2018-01-15 14:44:31',NULL),(2,'Women','2018-01-15 14:44:31',NULL),(3,'Kids','2018-01-15 14:44:32',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `active` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_country_id_foreign` (`country_id`),
  CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Dnepr',1,1,'2018-01-15 14:44:35','2018-01-15 16:50:35'),(2,'Kharkiv',1,1,'2018-01-15 14:44:35','2018-01-15 16:50:37'),(3,'Kiev',1,1,'2018-01-15 14:44:36','2018-01-15 16:50:40'),(4,'Lviv',1,1,'2018-01-15 14:44:36','2018-01-15 16:50:42'),(5,'Odessa',1,NULL,'2018-01-15 14:44:36',NULL),(6,'London',2,1,'2018-01-15 14:44:36','2018-01-15 16:50:47'),(7,'Liverpool',2,1,'2018-01-15 14:44:36','2018-01-15 16:50:49'),(8,'Manchester',2,1,'2018-01-15 14:44:36','2018-01-15 16:50:51'),(9,'Cambridge',2,NULL,'2018-01-15 14:44:36',NULL);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Ukraine','2018-01-15 14:44:35',NULL),(2,'England','2018-01-15 14:44:35',NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favorites_good_id_foreign` (`good_id`),
  KEY `favorites_user_id_foreign` (`user_id`),
  CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `favorites_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (1,4,1,NULL,NULL),(11,3,1,NULL,NULL);
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `good_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `good_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `good_category_good_id_foreign` (`good_id`),
  KEY `good_category_category_id_foreign` (`category_id`),
  CONSTRAINT `good_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `good_category_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `good_category` WRITE;
/*!40000 ALTER TABLE `good_category` DISABLE KEYS */;
INSERT INTO `good_category` VALUES (1,1,1,'2018-01-15 14:44:32',NULL),(21,3,2,'2018-01-15 14:44:32',NULL),(41,2,2,NULL,NULL),(51,3,1,NULL,NULL),(61,3,3,NULL,NULL),(71,4,1,NULL,NULL),(81,11,1,NULL,NULL),(91,21,1,NULL,NULL),(101,31,1,NULL,NULL),(111,41,1,NULL,NULL),(121,51,3,NULL,NULL),(131,61,3,NULL,NULL),(141,71,1,NULL,NULL),(151,81,1,NULL,NULL),(161,91,2,NULL,NULL),(171,101,1,NULL,NULL),(181,111,1,NULL,NULL),(191,121,1,NULL,NULL),(201,131,1,NULL,NULL),(211,141,1,NULL,NULL),(221,151,1,NULL,NULL);
/*!40000 ALTER TABLE `good_category` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `good_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `good_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(10) unsigned NOT NULL,
  `image_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `good_image_good_id_foreign` (`good_id`),
  KEY `good_image_image_id_foreign` (`image_id`),
  CONSTRAINT `good_image_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  CONSTRAINT `good_image_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1751 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `good_image` WRITE;
/*!40000 ALTER TABLE `good_image` DISABLE KEYS */;
INSERT INTO `good_image` VALUES (1,1,1,'2018-01-15 14:44:29',NULL),(11,1,2,'2018-01-15 14:44:29',NULL),(21,1,3,'2018-01-15 14:44:30',NULL),(1291,2,1191,NULL,NULL),(1301,2,1201,NULL,NULL),(1311,2,1211,NULL,NULL),(1321,3,1221,NULL,NULL),(1331,4,1231,NULL,NULL),(1341,4,1241,NULL,NULL),(1351,4,1251,NULL,NULL),(1361,11,1261,NULL,NULL),(1371,11,1271,NULL,NULL),(1381,11,1281,NULL,NULL),(1391,21,1291,NULL,NULL),(1401,21,1301,NULL,NULL),(1411,21,1311,NULL,NULL),(1421,31,1321,NULL,NULL),(1431,31,1331,NULL,NULL),(1441,31,1341,NULL,NULL),(1451,41,1351,NULL,NULL),(1461,41,1361,NULL,NULL),(1471,41,1371,NULL,NULL),(1481,41,1381,NULL,NULL),(1491,51,1391,NULL,NULL),(1501,61,1401,NULL,NULL),(1511,61,1411,NULL,NULL),(1521,71,1421,NULL,NULL),(1531,71,1431,NULL,NULL),(1541,71,1441,NULL,NULL),(1551,81,1451,NULL,NULL),(1561,81,1461,NULL,NULL),(1571,81,1471,NULL,NULL),(1581,91,1481,NULL,NULL),(1591,101,1491,NULL,NULL),(1601,101,1501,NULL,NULL),(1611,101,1511,NULL,NULL),(1621,111,1521,NULL,NULL),(1631,111,1531,NULL,NULL),(1641,111,1541,NULL,NULL),(1651,121,1551,NULL,NULL),(1661,121,1561,NULL,NULL),(1671,121,1571,NULL,NULL),(1681,131,1581,NULL,NULL),(1691,131,1591,NULL,NULL),(1701,131,1601,NULL,NULL),(1711,141,1611,NULL,NULL),(1721,141,1621,NULL,NULL),(1731,141,1631,NULL,NULL),(1741,151,1641,NULL,NULL);
/*!40000 ALTER TABLE `good_image` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `good_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `good_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `goods_num` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `good_order_good_id_foreign` (`good_id`),
  KEY `good_order_order_id_foreign` (`order_id`),
  CONSTRAINT `good_order_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `good_order_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `good_order` WRITE;
/*!40000 ALTER TABLE `good_order` DISABLE KEYS */;
INSERT INTO `good_order` VALUES (1,3,1,1,NULL,NULL),(11,4,1,1,NULL,NULL);
/*!40000 ALTER TABLE `good_order` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) unsigned NOT NULL,
  `old_price` double(8,2) unsigned DEFAULT NULL,
  `discount_percent` double(8,2) unsigned DEFAULT NULL,
  `description` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(10) unsigned DEFAULT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(10) unsigned DEFAULT NULL,
  `case_width_approx_mm` int(10) unsigned NOT NULL,
  `case_depth_approx_mm` int(10) unsigned NOT NULL,
  `main_id_img` int(10) unsigned DEFAULT NULL,
  `case_material` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `water_resistancy_m` int(10) unsigned NOT NULL,
  `guarantee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `public` int(11) DEFAULT NULL,
  `MPN` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goods_main_id_img_foreign` (`main_id_img`),
  CONSTRAINT `goods_main_id_img_foreign` FOREIGN KEY (`main_id_img`) REFERENCES `images` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (1,'Seamaster Automatic Blue Dial Watch',3250.00,NULL,50.00,'This Men\'s Emporio Armani watch has a stainless steel case and clear, classy looking black dial with silver baton hour markers and other elegant silver touches. Also features chronograph, date function and powered by a quality quartz movement. The watch fastens with a chunky stainless steel bracelet.',NULL,'Emporio Armani',NULL,43,11,1,'Stainless Steel',50,'Emporio Armani 2 year guarantee','black',1,'AR2434','Seamaster_Automatic_Blue_Dial_Watch_1','2018-01-15 14:44:29','2018-01-15 14:55:26'),(2,'Michael Kors Parker Chronograph Watch',7372.00,NULL,32.00,'An elegant ladies Michael Kors watch in stainless steel. This glitzy model is set around a silver multi-dial clock face with chronograph and date function. Further features include a gem-studded case border and sparking stone hour markers. It fastens with a slender silver metal bracelet.',NULL,'Michael Kors',NULL,39,12,1191,'Stainless Steel',100,'Michael Kors 2 year guarantee','Silver',1,'MK5353','Michael_Kors_Parker_Chronograph_Watch_2','2018-01-15 14:44:29','2018-01-15 22:12:10'),(3,'Guess Exclusive Connect Android Watch',10883.00,NULL,0.00,'Customise your dial with over 100 different combinations of display face, colour and sub dials and go from fun to function in a single swipe, all while staying connected. \n\n\nDownload apps directly onto your GUESS CONNECT from the on-watch Google Play store, co-ordinate your day using Voice Activation from Google Assistant and reach your goals with the fitness tracking features.\n\n\nThis Exclusive colourway GUESS Connect unisex smartwatch features a 44mm polished gold case with black top ring, a black digital dial and black textured silicone interchangeable strap.',4,'Guess',NULL,44,12,1221,'PVD Gold plated',0,'Guess 2 year guarantee','black',1,'C1001G3','Guess_Exclusive_Connect_Android_Watch_3','2018-01-15 14:44:29','2018-01-15 22:12:40'),(4,'Casio Edifice Waveceptor Watch',11703.00,NULL,20.00,'This Casio Edifice Wave Ceptor watch is a bold model in stainless steel, set around a hi-tech dial, with silver baton hour markers, negative LCD displays and high-visibility luminescent hands. Accuracy is maintained by the Waveceptor technology, ensuring accuracy to the second, and the Solar movement also features alarm, chronograph and countdown timer, as well as world time function. The watch fastens with a chunky stainless steel bracelet with push button deployment clasp with Edifice Logo.',5,'Casio',NULL,50,14,1231,'Stainless Steel',100,'Casio 2 year guarantee','black',1,'ECWM300EDB1AER','Casio_Edifice_Waveceptor_Watch_4','2018-01-15 14:44:29','2018-01-15 22:12:57'),(11,'Emporio Armani Chronograph Watch',8426.00,NULL,30.00,'A stylish mens Emporio Armani model in high-shine stainless steel, set around a stunning deep blue multi-dial clock face with clear silver baton hour markers and date function. This sought after watch also features chronograph and powered by a quality quartz movement. It fastens with a silver colour stainless steel bracelet with push-button deployment.',NULL,'Emporio Armani',1,11,43,1261,'Stainless Steel',50,'Emporio Armani 2 year guarantee','Blue',1,'AR2448','Emporio_Armani_Chronograph_Watch_11','2018-01-15 14:57:02','2018-01-15 22:13:30'),(21,'Fossil Grant Chronograph Watch',3003.00,NULL,35.00,'The smart and stylish mens Fossil Grant watch. This watch has a stainless steel round case, clear looking cream dial with stand out Roman numeral hour markers and is complete with chronograph function. It has a brown genuine leather strap and powered by a quality quartz movement.',NULL,'Fossil',1,12,44,1291,'Stainless Steel',50,'Fossil 2 year guarantee','Cream',1,'Stainless Steel','Fossil_Grant_Chronograph_Watch_21','2018-01-15 14:58:43','2018-01-15 22:14:07'),(31,'Michael Kors Lexington Watch',7372.00,NULL,32.00,'Mens Michael Kors PVD gold-plate design from the Lexington collection. This model comes complete with date function, chronograph, gold baton hour markers and a champagne colour dial. \r\n\r\nIt fastens with a PVD Gold plate bracelet and is powered by a quality Japanese Quartz movement',NULL,'Michael Kors',1,13,45,1321,'PVD Gold plated',100,'Michael Kors 2 year guarantee','Champagne',1,'MK8281','Michael_Kors_Lexington_Watch_31','2018-01-15 15:01:19','2018-01-15 22:14:40'),(41,'Daniel Wellington St Mawes Watch',4330.00,NULL,25.00,'From the St Andrews collection by Daniel Wellington. This timepiece is made from PVD rose plated steel and has a round 40mm case. It features a round white dial with rose baton hour markers and slender rose hands. This watch fastens on a brown genuine leather strap and is powered by a quality quartz movement.',3,'Daniel Wellington',1,6,40,1351,'PVD rose plating',30,'Daniel Wellington 2 year guarantee','Cream',1,'DW00100006','Daniel_Wellington_St_Mawes_Watch_41','2018-01-15 15:04:02','2018-01-15 22:15:17'),(51,'Tikkers Gift Set Watch',441.00,NULL,44.00,'This childrens Tikkers Gift Set watch is made from plastic/resin and is powered by a quartz movement. It fastens a orange rubber strap and has a orange dial.',NULL,'Tikkers',1,11,36,1391,'Plastic and Resin',0,'Tikkers 1 year guarantee','Orange',1,'ATK1000','Tikkers_Gift_Set_Watch_51','2018-01-15 15:11:43','2018-01-15 22:15:48'),(61,'Character Trolls LCD Watch',308.00,NULL,44.00,'This childrens Character Trolls Lcd Sound Effect watch has a plastic/resin case and is fitted with a quartz movement. It fastens a pink plastic/resin strap and has a multicolour dial.',NULL,'Character',1,10,30,1401,'Plastic and Resin',0,'Character 1 year guarantee','MultiColour',1,'TROL40','Character_Trolls_LCD_Watch_61','2018-01-15 15:14:04','2018-01-15 22:15:59'),(71,'Hugo Boss Ambassador Watch',9300.00,NULL,21.00,'This men\'s Hugo Boss watch is fitted with a quartz movement. It is fastened with a black ceramic bracelet and has a black dial. The watch has a date function.',NULL,'Hugo Boss',1,10,43,1421,'Ceramic',30,'Hugo Boss 2 year guarantee','black',1,'1513223','Hugo_Boss_Ambassador_Watch_71','2018-01-17 09:30:23','2018-01-17 09:30:43'),(81,'Armani Exchange Chronograph Watch',6000.00,NULL,34.00,'This spectacular Mens Armani Exchange Zulu watch is made from stainless steel in a smart black and silver design. Features include a round black dial with silver high-visibility baton hour markers, clear Armani Exchange logo at the 12 o\'clock point, date function and chronograph. The watch fastens with a push-button deployment and is powered by a quality Japanese Quartz movement.',NULL,'Armani Exchange',1,13,46,1451,'Stainless Steel',50,'Armani Exchange 2 year guarantee','black',1,'AX1214','Armani_Exchange_Chronograph_Watch_81','2018-01-17 09:32:25','2018-01-17 09:32:44'),(91,'Vivienne Westwood Bloomsbury Watch',11500.00,NULL,0.00,'This ladies Vivienne Westwood Bloomsbury watch has a PVD rose plating case and is powered by a quartz movement. It is fastened with a two tone bracelet and has a silver dial. The watch also has a date function.',NULL,'Vivienne Westwood',1,8,35,1481,'PVD rose plating',30,'Vivienne Westwood 2 year guarantee','Silver',1,'VV152RSSL','Vivienne_Westwood_Bloomsbury_Watch_91','2018-01-17 09:34:26','2018-01-17 09:34:28'),(101,'Casio Edifice Smartwatch Watch',12800.00,NULL,0.00,'Mobile Link function (Wireless linking with Bluetooth Smart devices)\r\nRequires download of the CASIO WATCH+ app to your phone. (Available on the Google Play Store and Apple App Store for compatible devices)\r\nWorld Time dial at 9 o\'clock can be set to one of approximately 300 cities around the globe.\r\nHome Time and World Time settings (including summer time) updated at a preset time each day.\r\nUse your phone to adjust hand positions, set alarm times, and more.\r\nUse your phone to change the distance setting for calculation of speed in the Stopwatch mode.\r\nTransfer stopwatch data to a phone to create a log file.(lap/split time display measured in 1/1000 second for up to 100 entries)\r\nPhone finder causes your phone to emit a tone when a watch button is pressed.\r\nUse your watch to check for new e-mail. (Requires registration of mail account with the app.)\r\n\r\nTough Solar\r\nDual Dial World Time\r\nDaily Alarm\r\n100-meter water resistance\r\nDay indicator\r\nDate display',NULL,'Casio',1,15,43,1491,'Stainless Steel',100,'Casio 2 year guarantee','black',1,'EQB-500D-1AER','Casio_Edifice_Smartwatch_Watch_101','2018-01-17 09:36:36','2018-01-17 09:36:53'),(111,'PULSAR KINETIC WATCH',3600.00,NULL,43.00,'Stylish mens Pulsar Kinetic model, set around a cream dial with high-visibility numeral hour markers and a date function. The watch fastens with a brown leather strap and buckle.',NULL,'Pulsar',1,10,37,1521,'Stainless Steel',100,'Pulsar 2 year guarantee','Cream',1,'PAR167X1','PULSAR_KINETIC_WATCH_111','2018-01-17 09:38:27','2018-01-17 09:38:40'),(121,'Rotary Vintage Automatic Watch',7800.00,NULL,20.00,'This gents Rotary watch has a stainless steel case, water resistant to Rotary\'s Waterproof standard and is powered by an automatic self winding mechanical movement. It fastens a black leather strap and has a silver skeleton dial with roman numerals and blue hands.',NULL,'Rotary',1,11,40,1551,'Stainless Steel',0,'Rotary 2 year guarantee','Silver',1,'GS02940/06','Rotary_Vintage_Automatic_Watch_121','2018-01-17 09:40:43','2018-01-17 09:40:59'),(131,'Citizen Titanium Eco-Drive Watch',7600.00,NULL,30.00,'Mens Citizen watch in silver colour made from Titanium. This model has a round dial in a midnight-blue colour and features date function, chunky high-visibility glow in the dark hour markers and hands. It is 100 meter water resistant and powered by the Citizen Eco-Drive movement. The sturdy silver titanium bracelet fastens with a push-button clasp.',NULL,'Citizen',1,10,41,1581,'Titanium',100,'Citizen 2 year guarantee','Dark Blue',1,'BM7170-53L','Citizen_Titanium_Eco-Drive_Watch_131','2018-01-17 09:42:21','2018-01-17 09:42:38'),(141,'Sekonda Mens Watch',1700.00,NULL,14.00,'This gents Sekonda watch is made from two-tone steel/gold plate and is fitted with a quartz movement. It is fitted with a two tone bracelet and has a blue dial. The watch has a date function.',NULL,'Sekonda',1,9,38,1611,'Two tone steel and gold plate',50,'Sekonda 2 year guarantee','Blue',1,'1032','Sekonda_Mens_Watch_141','2018-01-17 09:49:43','2018-01-17 09:51:11'),(151,'Smart Turnout Royal Watch',5200.00,NULL,42.00,'This men\'s Smart Turnout Royal watch has a stainless steel case and is fitted with a chronograph quartz movement. It is fitted with a blue fabric strap and has a black dial. The watch has a date function.',NULL,'Smart Turnout',1,12,40,1641,'Stainless Steel',50,'Smart Turnout 1 year guarantee','black',1,'STD2/56/W-RN','Smart_Turnout_Royal_Watch_151','2018-01-17 09:50:58','2018-01-17 09:51:00');
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1651 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'Seamaster Automatic Blue Dial Men\'s Watch 1',NULL,NULL,NULL,'armani1.jpg','2018-01-15 14:44:26',NULL),(2,'Seamaster Automatic Blue Dial Men\'s Watch 2',NULL,NULL,NULL,'armani2.jpg','2018-01-15 14:44:27',NULL),(3,'Seamaster Automatic Blue Dial Men\'s Watch 3',NULL,NULL,NULL,'armani3.jpg','2018-01-15 14:44:27',NULL),(7,'Seamaster Automatic Blue Dial Men\'s Watch 1',NULL,NULL,NULL,'armani1.jpg','2018-01-15 14:44:27',NULL),(10,'Seamaster Automatic Blue Dial Men\'s Watch 1',NULL,NULL,NULL,'armani1.jpg','2018-01-15 14:44:28',NULL),(13,'Slider Watches 1','1',NULL,NULL,'bnr-1.jpg','2018-01-15 14:44:28',NULL),(14,'Slider Watches 2','1',NULL,NULL,'bnr-2.jpg','2018-01-15 14:44:28',NULL),(15,'Slider Watches 3','1',NULL,NULL,'bnr-3.jpg','2018-01-15 14:44:29',NULL),(21,'15160276421154',NULL,NULL,NULL,'15160276421154.jpg','2018-01-15 14:47:22','2018-01-15 14:47:22'),(61,'1516028003924',NULL,NULL,NULL,'1516028003924.jpg','2018-01-15 14:53:23','2018-01-15 14:53:23'),(111,'15160282222832',NULL,NULL,NULL,'15160282222832.jpg','2018-01-15 14:57:02','2018-01-15 14:57:02'),(141,'1516028323869',NULL,NULL,NULL,'1516028323869.jpg','2018-01-15 14:58:43','2018-01-15 14:58:43'),(171,'15160284809830',NULL,NULL,NULL,'15160284809830.jpg','2018-01-15 15:01:20','2018-01-15 15:01:20'),(211,'15160286426829',NULL,NULL,NULL,'15160286426829.jpg','2018-01-15 15:04:02','2018-01-15 15:04:02'),(221,'15160291036714',NULL,NULL,NULL,'15160291036714.jpg','2018-01-15 15:11:43','2018-01-15 15:11:43'),(241,'15160292445443',NULL,NULL,NULL,'15160292445443.jpg','2018-01-15 15:14:04','2018-01-15 15:14:04'),(251,'15160347667130',NULL,NULL,NULL,'15160347667130.jpg','2018-01-15 16:46:06','2018-01-15 16:46:06'),(281,'1516034795934',NULL,NULL,NULL,'1516034795934.jpg','2018-01-15 16:46:35','2018-01-15 16:46:35'),(291,'15160348325544',NULL,NULL,NULL,'15160348325544.jpg','2018-01-15 16:47:12','2018-01-15 16:47:12'),(321,'15160348712950',NULL,NULL,NULL,'15160348712950.jpg','2018-01-15 16:47:51','2018-01-15 16:47:51'),(351,'15160349056766',NULL,NULL,NULL,'15160349056766.jpg','2018-01-15 16:48:25','2018-01-15 16:48:25'),(361,'15160349213386',NULL,NULL,NULL,'15160349213386.jpg','2018-01-15 16:48:41','2018-01-15 16:48:41'),(401,'15160349728517',NULL,NULL,NULL,'15160349728517.jpg','2018-01-15 16:49:32','2018-01-15 16:49:32'),(431,'15160349938636',NULL,NULL,NULL,'15160349938636.jpg','2018-01-15 16:49:53','2018-01-15 16:49:53'),(451,'15160350137039',NULL,NULL,NULL,'15160350137039.jpg','2018-01-15 16:50:13','2018-01-15 16:50:13'),(481,'15160363373403',NULL,NULL,NULL,'15160363373403.jpg','2018-01-15 17:12:17','2018-01-15 17:12:17'),(511,'15160363679107',NULL,NULL,NULL,'15160363679107.jpg','2018-01-15 17:12:47','2018-01-15 17:12:47'),(521,'15160363796836',NULL,NULL,NULL,'15160363796836.jpg','2018-01-15 17:12:59','2018-01-15 17:12:59'),(551,'15160364186665',NULL,NULL,NULL,'15160364186665.jpg','2018-01-15 17:13:38','2018-01-15 17:13:38'),(581,'15160364519363',NULL,NULL,NULL,'15160364519363.jpg','2018-01-15 17:14:11','2018-01-15 17:14:11'),(611,'15160364733366',NULL,NULL,NULL,'15160364733366.jpg','2018-01-15 17:14:33','2018-01-15 17:14:33'),(641,'15160364936832',NULL,NULL,NULL,'15160364936832.jpg','2018-01-15 17:14:53','2018-01-15 17:14:53'),(681,'15160365124852',NULL,NULL,NULL,'15160365124852.jpg','2018-01-15 17:15:12','2018-01-15 17:15:12'),(691,'15160365195793',NULL,NULL,NULL,'15160365195793.jpg','2018-01-15 17:15:19','2018-01-15 17:15:19'),(711,'15160372934493',NULL,NULL,NULL,'15160372934493.jpg','2018-01-15 17:28:13','2018-01-15 17:28:13'),(741,'15160373136126',NULL,NULL,NULL,'15160373136126.jpg','2018-01-15 17:28:33','2018-01-15 17:28:33'),(761,'15160373389504',NULL,NULL,NULL,'15160373389504.jpg','2018-01-15 17:28:58','2018-01-15 17:28:58'),(791,'15160373636837',NULL,NULL,NULL,'15160373636837.jpg','2018-01-15 17:29:23','2018-01-15 17:29:23'),(821,'15160373904782',NULL,NULL,NULL,'15160373904782.jpg','2018-01-15 17:29:50','2018-01-15 17:29:50'),(851,'15160374093457',NULL,NULL,NULL,'15160374093457.jpg','2018-01-15 17:30:09','2018-01-15 17:30:09'),(881,'15160374245732',NULL,NULL,NULL,'15160374245732.jpg','2018-01-15 17:30:24','2018-01-15 17:30:24'),(891,'1516037435792',NULL,NULL,NULL,'1516037435792.jpg','2018-01-15 17:30:35','2018-01-15 17:30:35'),(931,'15160374574659',NULL,NULL,NULL,'15160374574659.jpg','2018-01-15 17:30:57','2018-01-15 17:30:57'),(951,'15160381205500',NULL,NULL,NULL,'15160381205500.jpg','2018-01-15 17:42:00','2018-01-15 17:42:00'),(981,'15160381393197',NULL,NULL,NULL,'15160381393197.jpg','2018-01-15 17:42:19','2018-01-15 17:42:19'),(991,'15160381577837',NULL,NULL,NULL,'15160381577837.jpg','2018-01-15 17:42:37','2018-01-15 17:42:37'),(1021,'15160381774266',NULL,NULL,NULL,'15160381774266.jpg','2018-01-15 17:42:57','2018-01-15 17:42:57'),(1051,'1516038194760',NULL,NULL,NULL,'1516038194760.jpg','2018-01-15 17:43:14','2018-01-15 17:43:14'),(1091,'15160382227777',NULL,NULL,NULL,'15160382227777.jpg','2018-01-15 17:43:42','2018-01-15 17:43:42'),(1121,'1516038236945',NULL,NULL,NULL,'1516038236945.jpg','2018-01-15 17:43:56','2018-01-15 17:43:56'),(1131,'15160382478875',NULL,NULL,NULL,'15160382478875.jpg','2018-01-15 17:44:07','2018-01-15 17:44:07'),(1171,'15160382684396',NULL,NULL,NULL,'15160382684396.jpg','2018-01-15 17:44:28','2018-01-15 17:44:28'),(1191,'15160543251897',NULL,NULL,NULL,'15160543251897.jpg','2018-01-15 22:12:05','2018-01-15 22:12:05'),(1201,'1516054335134',NULL,NULL,NULL,'1516054335134.jpg','2018-01-15 22:12:16','2018-01-15 22:12:16'),(1211,'15160543437938',NULL,NULL,NULL,'15160543437938.jpg','2018-01-15 22:12:23','2018-01-15 22:12:23'),(1221,'15160543544757',NULL,NULL,NULL,'15160543544757.jpg','2018-01-15 22:12:35','2018-01-15 22:12:35'),(1231,'15160543716696',NULL,NULL,NULL,'15160543716696.jpg','2018-01-15 22:12:51','2018-01-15 22:12:51'),(1241,'1516054382210',NULL,NULL,NULL,'1516054382210.jpg','2018-01-15 22:13:02','2018-01-15 22:13:02'),(1251,'1516054391673',NULL,NULL,NULL,'1516054391673.jpg','2018-01-15 22:13:11','2018-01-15 22:13:11'),(1261,'15160544057777',NULL,NULL,NULL,'15160544057777.jpg','2018-01-15 22:13:25','2018-01-15 22:13:25'),(1271,'15160544146325',NULL,NULL,NULL,'15160544146325.jpg','2018-01-15 22:13:34','2018-01-15 22:13:34'),(1281,'15160544215909',NULL,NULL,NULL,'15160544215909.jpg','2018-01-15 22:13:41','2018-01-15 22:13:41'),(1291,'15160544421198',NULL,NULL,NULL,'15160544421198.jpg','2018-01-15 22:14:02','2018-01-15 22:14:02'),(1301,'15160544566487',NULL,NULL,NULL,'15160544566487.jpg','2018-01-15 22:14:16','2018-01-15 22:14:16'),(1311,'15160544633280',NULL,NULL,NULL,'15160544633280.jpg','2018-01-15 22:14:23','2018-01-15 22:14:23'),(1321,'15160544757230',NULL,NULL,NULL,'15160544757230.jpg','2018-01-15 22:14:36','2018-01-15 22:14:36'),(1331,'15160544856629',NULL,NULL,NULL,'15160544856629.jpg','2018-01-15 22:14:45','2018-01-15 22:14:45'),(1341,'15160544961018',NULL,NULL,NULL,'15160544961018.jpg','2018-01-15 22:14:56','2018-01-15 22:14:56'),(1351,'15160545128214',NULL,NULL,NULL,'15160545128214.jpg','2018-01-15 22:15:13','2018-01-15 22:15:13'),(1361,'15160545215626',NULL,NULL,NULL,'15160545215626.jpg','2018-01-15 22:15:21','2018-01-15 22:15:21'),(1371,'1516054527184',NULL,NULL,NULL,'1516054527184.jpg','2018-01-15 22:15:28','2018-01-15 22:15:28'),(1381,'15160545351077',NULL,NULL,NULL,'15160545351077.jpg','2018-01-15 22:15:35','2018-01-15 22:15:35'),(1391,'1516054543521',NULL,NULL,NULL,'1516054543521.jpg','2018-01-15 22:15:44','2018-01-15 22:15:44'),(1401,'15160545557900',NULL,NULL,NULL,'15160545557900.jpg','2018-01-15 22:15:55','2018-01-15 22:15:55'),(1411,'15160545635394',NULL,NULL,NULL,'15160545635394.jpg','2018-01-15 22:16:03','2018-01-15 22:16:03'),(1421,'1516181423990',NULL,NULL,NULL,'1516181423990.jpg','2018-01-17 09:30:23','2018-01-17 09:30:23'),(1431,'15161814231058',NULL,NULL,NULL,'15161814231058.jpg','2018-01-17 09:30:23','2018-01-17 09:30:23'),(1441,'15161814231425',NULL,NULL,NULL,'15161814231425.jpg','2018-01-17 09:30:24','2018-01-17 09:30:24'),(1451,'15161815455509',NULL,NULL,NULL,'15161815455509.jpg','2018-01-17 09:32:26','2018-01-17 09:32:26'),(1461,'15161815461344',NULL,NULL,NULL,'15161815461344.jpg','2018-01-17 09:32:26','2018-01-17 09:32:26'),(1471,'15161815468655',NULL,NULL,NULL,'15161815468655.jpg','2018-01-17 09:32:26','2018-01-17 09:32:26'),(1481,'15161816665261',NULL,NULL,NULL,'15161816665261.jpg','2018-01-17 09:34:26','2018-01-17 09:34:26'),(1491,'15161817969025',NULL,NULL,NULL,'15161817969025.jpg','2018-01-17 09:36:36','2018-01-17 09:36:36'),(1501,'1516181796482',NULL,NULL,NULL,'1516181796482.jpg','2018-01-17 09:36:37','2018-01-17 09:36:37'),(1511,'15161817975154',NULL,NULL,NULL,'15161817975154.jpg','2018-01-17 09:36:37','2018-01-17 09:36:37'),(1521,'15161819079156',NULL,NULL,NULL,'15161819079156.jpg','2018-01-17 09:38:27','2018-01-17 09:38:27'),(1531,'15161819079809',NULL,NULL,NULL,'15161819079809.jpg','2018-01-17 09:38:27','2018-01-17 09:38:27'),(1541,'15161819088869',NULL,NULL,NULL,'15161819088869.jpg','2018-01-17 09:38:28','2018-01-17 09:38:28'),(1551,'15161820436579',NULL,NULL,NULL,'15161820436579.jpg','2018-01-17 09:40:43','2018-01-17 09:40:43'),(1561,'15161820449590',NULL,NULL,NULL,'15161820449590.jpg','2018-01-17 09:40:44','2018-01-17 09:40:44'),(1571,'15161820446475',NULL,NULL,NULL,'15161820446475.jpg','2018-01-17 09:40:44','2018-01-17 09:40:44'),(1581,'15161821418642',NULL,NULL,NULL,'15161821418642.jpg','2018-01-17 09:42:21','2018-01-17 09:42:21'),(1591,'15161821411826',NULL,NULL,NULL,'15161821411826.jpg','2018-01-17 09:42:22','2018-01-17 09:42:22'),(1601,'15161821421100',NULL,NULL,NULL,'15161821421100.jpg','2018-01-17 09:42:22','2018-01-17 09:42:22'),(1611,'15161825831928',NULL,NULL,NULL,'15161825831928.jpg','2018-01-17 09:49:44','2018-01-17 09:49:44'),(1621,'1516182584890',NULL,NULL,NULL,'1516182584890.jpg','2018-01-17 09:49:44','2018-01-17 09:49:44'),(1631,'15161825842891',NULL,NULL,NULL,'15161825842891.jpg','2018-01-17 09:49:44','2018-01-17 09:49:44'),(1641,'15161826587384',NULL,NULL,NULL,'15161826587384.jpg','2018-01-17 09:50:59','2018-01-17 09:50:59');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `mail_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `mail_id` int(10) unsigned NOT NULL,
  `checked` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mail_user_user_id_foreign` (`user_id`),
  KEY `mail_user_mail_id_foreign` (`mail_id`),
  CONSTRAINT `mail_user_mail_id_foreign` FOREIGN KEY (`mail_id`) REFERENCES `mails` (`id`),
  CONSTRAINT `mail_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `mail_user` WRITE;
/*!40000 ALTER TABLE `mail_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_user` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `mails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `mails` WRITE;
/*!40000 ALTER TABLE `mails` DISABLE KEYS */;
/*!40000 ALTER TABLE `mails` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=481 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (321,'2014_07_02_230147_migration_cartalyst_sentinel',1),(331,'2017_12_13_085843_create_images_table',1),(341,'2017_12_13_085844_create_goods_table',1),(351,'2017_12_13_091144_create_good_image_table',1),(361,'2017_12_13_100516_create_categories_table',1),(371,'2017_12_13_100703_create_good_categorie_table',1),(381,'2017_12_16_144230_create_reviews_table',1),(391,'2017_12_16_191833_create_countries_table',1),(401,'2017_12_16_192007_create_cities_table',1),(411,'2017_12_16_193431_create_orders_table',1),(421,'2017_12_16_194220_create_good_order_table',1),(431,'2017_12_29_143546_create_favorites_table',1),(441,'2018_01_07_192646_notifications_table',1),(451,'2018_01_07_192751_notification_user_table',1),(461,'2018_01_12_145015_mails_table',1),(471,'2018_01_12_145158_mail_user_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `notification_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `notification_id` int(10) unsigned NOT NULL,
  `checked` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_user_user_id_foreign` (`user_id`),
  KEY `notification_user_notification_id_foreign` (`notification_id`),
  CONSTRAINT `notification_user_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`),
  CONSTRAINT `notification_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=411 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `notification_user` WRITE;
/*!40000 ALTER TABLE `notification_user` DISABLE KEYS */;
INSERT INTO `notification_user` VALUES (1,1,1,1,NULL,NULL),(11,1,11,1,NULL,NULL),(21,1,21,1,NULL,NULL),(31,1,31,1,NULL,NULL),(41,1,41,1,NULL,NULL),(51,1,51,1,NULL,NULL),(61,1,61,1,NULL,NULL),(71,1,71,1,NULL,NULL),(81,11,71,NULL,NULL,NULL),(91,1,81,1,NULL,NULL),(101,11,81,NULL,NULL,NULL),(111,1,91,1,NULL,NULL),(121,11,91,NULL,NULL,NULL),(131,21,91,NULL,NULL,NULL),(141,1,101,1,NULL,NULL),(151,11,101,NULL,NULL,NULL),(161,21,101,NULL,NULL,NULL),(171,1,111,1,NULL,NULL),(181,11,111,NULL,NULL,NULL),(191,21,111,NULL,NULL,NULL),(201,1,121,1,NULL,NULL),(211,11,121,NULL,NULL,NULL),(221,21,121,NULL,NULL,NULL),(231,1,131,1,NULL,NULL),(241,11,131,NULL,NULL,NULL),(251,21,131,NULL,NULL,NULL),(261,1,141,1,NULL,NULL),(271,11,141,NULL,NULL,NULL),(281,21,141,NULL,NULL,NULL),(291,1,151,1,NULL,NULL),(301,11,151,NULL,NULL,NULL),(311,21,151,NULL,NULL,NULL),(321,1,161,1,NULL,NULL),(331,11,161,NULL,NULL,NULL),(341,21,161,NULL,NULL,NULL),(351,1,171,1,NULL,NULL),(361,11,171,NULL,NULL,NULL),(371,21,171,NULL,NULL,NULL),(381,1,181,1,NULL,NULL),(391,11,181,NULL,NULL,NULL),(401,21,181,NULL,NULL,NULL);
/*!40000 ALTER TABLE `notification_user` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'New item added <a href=\"https://w-eshop.herokuapp.com/admin/single/11\">Emporio Armani Chronograph Watch</a>','2018-01-15 14:57:02','2018-01-15 14:57:02'),(11,'New item added <a href=\"https://w-eshop.herokuapp.com/admin/single/21\">Fossil Grant Chronograph Watch</a>','2018-01-15 14:58:43','2018-01-15 14:58:43'),(21,'New item added <a href=\"https://w-eshop.herokuapp.com/admin/single/31\">Michael Kors Lexington Watc</a>','2018-01-15 15:01:20','2018-01-15 15:01:20'),(31,'New item added <a href=\"https://w-eshop.herokuapp.com/admin/single/41\">Daniel Wellington St Mawes Watch</a>','2018-01-15 15:04:02','2018-01-15 15:04:02'),(41,'New item added <a href=\"https://w-eshop.herokuapp.com/admin/single/51\">Tikkers Gift Set Watch</a>','2018-01-15 15:11:43','2018-01-15 15:11:43'),(51,'New item added <a href=\"https://w-eshop.herokuapp.com/admin/single/61\">Character Trolls LCD Watch</a>','2018-01-15 15:14:04','2018-01-15 15:14:04'),(61,'New user registrated <a href=\"https://w-eshop.herokuapp.com/admin/single_user/11\">Valera Kto</a>','2018-01-15 15:37:58','2018-01-15 15:37:58'),(71,'New review created on item <a href=\"https://w-eshop.herokuapp.com/admin/single/4\">Casio Edifice Waveceptor Watch</a>','2018-01-15 16:51:46','2018-01-15 16:51:46'),(81,'New order registrated <a href=\"https://w-eshop.herokuapp.com/admin/orders/1\">1</a>','2018-01-15 16:52:31','2018-01-15 16:52:31'),(91,'New user registrated <a href=\"https://w-eshop.herokuapp.com/admin/single_user/21\">Андрей Жмышенко</a>','2018-01-15 17:46:22','2018-01-15 17:46:22'),(101,'New item added <a href=\"http://luxury-laravel.com/admin/single/71\">Hugo Boss Ambassador Watch</a>','2018-01-17 09:30:24','2018-01-17 09:30:24'),(111,'New item added <a href=\"http://luxury-laravel.com/admin/single/81\">Armani Exchange Chronograph Watch</a>','2018-01-17 09:32:27','2018-01-17 09:32:27'),(121,'New item added <a href=\"http://luxury-laravel.com/admin/single/91\">Vivienne Westwood Bloomsbury Watch</a>','2018-01-17 09:34:27','2018-01-17 09:34:27'),(131,'New item added <a href=\"http://luxury-laravel.com/admin/single/101\">Casio Edifice Smartwatch Watch</a>','2018-01-17 09:36:37','2018-01-17 09:36:37'),(141,'New item added <a href=\"http://luxury-laravel.com/admin/single/111\">PULSAR KINETIC WATCH</a>','2018-01-17 09:38:28','2018-01-17 09:38:28'),(151,'New item added <a href=\"http://luxury-laravel.com/admin/single/121\">Rotary Vintage Automatic Watch</a>','2018-01-17 09:40:45','2018-01-17 09:40:45'),(161,'New item added <a href=\"http://luxury-laravel.com/admin/single/131\">Citizen Titanium Eco-Drive Watch</a>','2018-01-17 09:42:22','2018-01-17 09:42:22'),(171,'New item added <a href=\"http://luxury-laravel.com/admin/single/141\">Sekonda Mens Watch</a>','2018-01-17 09:49:45','2018-01-17 09:49:45'),(181,'New item added <a href=\"http://luxury-laravel.com/admin/single/151\">Smart Turnout Royal Watch</a>','2018-01-17 09:50:59','2018-01-17 09:50:59');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `postal_zip` int(10) unsigned NOT NULL,
  `delivery_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` int(10) unsigned DEFAULT NULL,
  `order_cost` int(11) NOT NULL,
  `order_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_city_id_foreign` (`city_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `orders_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'Alex','Br',1,48999,'Express','my home','380945543213',NULL,22586,'Pending',1,'2018-01-15 16:52:31','2018-01-15 16:52:31');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `persistences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `persistences` WRITE;
/*!40000 ALTER TABLE `persistences` DISABLE KEYS */;
/*!40000 ALTER TABLE `persistences` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `reminders` WRITE;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `good_id` int(10) unsigned NOT NULL,
  `rating` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_good_id_foreign` (`good_id`),
  CONSTRAINT `reviews_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`),
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,NULL,1,4,5,'2018-01-15 16:51:38','2018-01-15 16:51:38'),(11,'zzz',1,4,NULL,'2018-01-15 16:51:46','2018-01-15 16:51:46'),(21,NULL,1,3,4,'2018-01-15 16:52:50','2018-01-15 16:52:50'),(31,NULL,1,41,3,'2018-01-15 17:45:51','2018-01-15 17:45:51');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
INSERT INTO `role_users` VALUES (1,1,'2018-01-15 14:44:35','2018-01-15 14:44:35'),(11,21,'2018-01-15 15:37:56','2018-01-15 15:37:56'),(21,21,'2018-01-15 17:46:22','2018-01-15 17:46:22');
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','{\"user.create\":true,\"user.delete\":true,\"user.view\":true,\"user.update\":true,\"good.create\":true,\"good.delete\":true,\"good.view\":true,\"good.update\":true,\"order.create\":true,\"order.delete\":true,\"order.view\":true,\"order.update\":true,\"comment.delete\":true,\"comment.update\":true}','2018-01-15 14:44:34','2018-01-15 14:44:34'),(11,'manager','Manager','{\"user.create\":false,\"user.delete\":false,\"user.view\":true,\"user.update\":false,\"good.create\":true,\"good.delete\":true,\"good.view\":true,\"good.update\":true,\"order.create\":true,\"order.delete\":true,\"order.view\":true,\"order.update\":true,\"comment.delete\":true,\"comment.update\":true}','2018-01-15 14:44:34','2018-01-15 14:44:34'),(21,'user','User',NULL,'2018-01-15 14:44:34','2018-01-15 14:44:34');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `throttle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
INSERT INTO `throttle` VALUES (1,NULL,'global',NULL,'2018-01-15 17:09:59','2018-01-15 17:09:59'),(11,NULL,'ip','127.0.0.1','2018-01-15 17:09:59','2018-01-15 17:09:59'),(21,1,'user',NULL,'2018-01-15 17:09:59','2018-01-15 17:09:59'),(31,NULL,'global',NULL,'2018-01-15 17:10:26','2018-01-15 17:10:26'),(41,NULL,'ip','10.13.200.133','2018-01-15 17:10:26','2018-01-15 17:10:26'),(51,1,'user',NULL,'2018-01-15 17:10:26','2018-01-15 17:10:26'),(61,NULL,'global',NULL,'2018-01-15 17:10:31','2018-01-15 17:10:31'),(71,NULL,'ip','10.13.200.133','2018-01-15 17:10:31','2018-01-15 17:10:31'),(81,1,'user',NULL,'2018-01-15 17:10:31','2018-01-15 17:10:31'),(91,NULL,'global',NULL,'2018-01-15 17:31:12','2018-01-15 17:31:12'),(101,NULL,'ip','10.77.3.69','2018-01-15 17:31:12','2018-01-15 17:31:12'),(111,1,'user',NULL,'2018-01-15 17:31:12','2018-01-15 17:31:12'),(121,NULL,'global',NULL,'2018-01-15 17:31:15','2018-01-15 17:31:15'),(131,NULL,'ip','10.77.3.69','2018-01-15 17:31:15','2018-01-15 17:31:15'),(141,1,'user',NULL,'2018-01-15 17:31:15','2018-01-15 17:31:15');
/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_ava.jpg',
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `session_id_login` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'whoiam942@gmail.com','$2y$10$RBkQWDtoCAxhE2iKmLWl6uuYgqlsIg3OqH0Qb6dkRNgswzJ7vnm6u','380945543213','15160542848629.jpg',NULL,NULL,'2018-01-15 22:18:02','Alex','Br',NULL,NULL,'2018-01-15 14:44:34','2018-01-15 22:18:02'),(11,'whoiam943@gmail.com','$2y$10$0nrWRcUKXlb.5pAGIs6dS.UqN61M8S4l6fedzUqNDUg7toU.3MfIa',NULL,'default_ava.jpg',NULL,NULL,NULL,'Valera','Kto',NULL,NULL,'2018-01-15 15:37:56','2018-01-15 15:37:56'),(21,NULL,NULL,NULL,'default_ava.jpg',NULL,NULL,NULL,'Андрей','Жмышенко','185419488693575','EAANFdUkubcEBAMZBZBec9EFfO9ngDiIEFbjdv8Dlo891FodaFSZCO4qDXhyGpaoRPC7ixUHI6OnSbsoAMlnmh8TvyMIP3VVp2GSSVXKHjD0zyBfkBdLOP5gMFlGoP7mZCsnFxBvZAwX4SYmPLn3YLbpEHM2Om9IGJIloFGQTfFpahTF8Fz7j3','2018-01-15 17:46:21','2018-01-15 17:46:22');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

