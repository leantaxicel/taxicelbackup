-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2014 at 09:02 AM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `taxi_cel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tc_app_galleries`
--

DROP TABLE IF EXISTS `tc_app_galleries`;
CREATE TABLE IF NOT EXISTS `tc_app_galleries` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `ios_image` varchar(200) NOT NULL,
  `android_image` varchar(200) NOT NULL,
  `gallery_text` longtext NOT NULL,
  `is_background_image` int(11) NOT NULL DEFAULT '0' COMMENT '0=normal image, 1=background image',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tc_app_galleries`
--

INSERT INTO `tc_app_galleries` (`id`, `ios_image`, `android_image`, `gallery_text`, `is_background_image`) VALUES
(1, '1409690538yfh.jpg', '14096897986.jpg', 'This is a sample text given by me..', 1),
(2, '1409695687127.0.0.1_Wallpaper.png', '1409695687aqfkj.jpg', 'Testing the content database...', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_assign_company_ownner`
--

DROP TABLE IF EXISTS `tc_assign_company_ownner`;
CREATE TABLE IF NOT EXISTS `tc_assign_company_ownner` (
  `id` int(22) NOT NULL AUTO_INCREMENT,
  `company_id` int(22) NOT NULL,
  `user_id` int(22) NOT NULL COMMENT 'user_id= ''driver_id''',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tc_assign_company_ownner`
--

INSERT INTO `tc_assign_company_ownner` (`id`, `company_id`, `user_id`) VALUES
(1, 9, 12),
(2, 10, 19),
(3, 9, 21);

-- --------------------------------------------------------

--
-- Table structure for table `tc_blogs`
--

DROP TABLE IF EXISTS `tc_blogs`;
CREATE TABLE IF NOT EXISTS `tc_blogs` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` longtext NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tc_blogs`
--

INSERT INTO `tc_blogs` (`id`, `image`, `title`, `description`, `date_time`) VALUES
(1, '1408657523hd-wallpapers-1366x768-12.jpg', 'Taxicel Launch', 'Morbi ut fringilla ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id risus id elit placerat vehicula ac vitae ligula. Nullam justo leo, ultricies vitae mollis scelerisque, placerat ut ipsum. Morbi adipiscing dui ligula, ac bibendum urna commodo eget. Mauris eget egestas est', '2014-08-21 12:03:51'),
(2, '1408657603the-amazing-spider-man-hd-wallpaper-for-pc-free-download-4.jpg', 'Lorem ipsum dolor', 'Vivamus imperdiet blandit ligula, in sollicitudin augue consectetur in. Proin viverra ultricies porta. Suspendisse feugiat gravida est, sit amet interdum lacus. Etiam nec nulla id dolor efficitur gravida id vitae ante. Nunc vestibulum purus mi, vel tincidunt velit malesuada non. Curabitur diam justo, aliquet suscipit finibus a, imperdiet vitae nibh. Sed vel euismod nisi. Aenean condimentum et sapien vitae tempus. Aliquam et pharetra diam. Morbi eu dui malesuada nisi accumsan sodales id at mi. Duis interdum magna nulla, nec suscipit metus tempor ac. Duis molestie varius condimentum.', '2014-08-21 14:46:20'),
(3, '1408663505wallpapers-natural-microsoft-next-image-1366x768.jpg', 'Sed vehicula', 'Phasellus nisi diam, fermentum vel arcu vel, aliquam pharetra ex. In ut tortor a arcu laoreet ornare. Quisque feugiat fringilla accumsan.', '2014-08-21 16:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `tc_cars`
--

DROP TABLE IF EXISTS `tc_cars`;
CREATE TABLE IF NOT EXISTS `tc_cars` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `model_id` int(20) NOT NULL DEFAULT '1',
  `name` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL COMMENT '0=active, 1=not active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tc_cars`
--

INSERT INTO `tc_cars` (`id`, `model_id`, `name`, `is_active`) VALUES
(1, 1, 'Ferrar', 0),
(2, 1, 'mersedies', 0),
(3, 1, 'BMW', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_car_models`
--

DROP TABLE IF EXISTS `tc_car_models`;
CREATE TABLE IF NOT EXISTS `tc_car_models` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL COMMENT '0=active, 1=not active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tc_car_models`
--

INSERT INTO `tc_car_models` (`id`, `name`, `is_active`) VALUES
(1, 'Ambassador', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_cities`
--

DROP TABLE IF EXISTS `tc_cities`;
CREATE TABLE IF NOT EXISTS `tc_cities` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `country_id` int(20) NOT NULL DEFAULT '1',
  `name` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL COMMENT '0=active, 1=not active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tc_cities`
--

INSERT INTO `tc_cities` (`id`, `country_id`, `name`, `is_active`) VALUES
(1, 1, 'Kolkata', 0),
(2, 1, 'Bhubaneshwar', 0),
(3, 1, 'Mumbai', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_city_configurations`
--

DROP TABLE IF EXISTS `tc_city_configurations`;
CREATE TABLE IF NOT EXISTS `tc_city_configurations` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `city_id` int(20) NOT NULL,
  `base_fare` double NOT NULL,
  `base_distance` double NOT NULL,
  `fare_per_kilometer` double NOT NULL,
  `fare_per_minute` double NOT NULL,
  `inter_fare_distance` int(10) NOT NULL COMMENT 'Values in meter',
  `inter_fare_time` int(10) NOT NULL COMMENT 'values in seconds',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tc_city_configurations`
--

INSERT INTO `tc_city_configurations` (`id`, `city_id`, `base_fare`, `base_distance`, `fare_per_kilometer`, `fare_per_minute`, `inter_fare_distance`, `inter_fare_time`) VALUES
(1, 1, 25, 2, 12, 1.5, 200, 134);

-- --------------------------------------------------------

--
-- Table structure for table `tc_companies`
--

DROP TABLE IF EXISTS `tc_companies`;
CREATE TABLE IF NOT EXISTS `tc_companies` (
  `id` int(22) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(200) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_logo` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `website` varchar(255) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tc_companies`
--

INSERT INTO `tc_companies` (`id`, `company_name`, `company_address`, `company_logo`, `contact_no`, `email_address`, `website`, `details`) VALUES
(1, 'TCS', 'ewewe', '1410786777animals_dogs_pets_golden_retriever_2560x1600_wallpaper_www.wall321.com_55.jpg', 'wewew', 'ewew', 'ewew', 'ewewewewew'),
(10, 'Infosys', 'jhgshjdgshd', '1410786719animals_dogs_pets_golden_retriever_2560x1600_wallpaper_www.wall321.com_55.jpg', 'sdsds', 'dsdsd@gmail.com', 'sdsds', 'sdsdsd'),
(9, 'Mindscale Tech', 'kolkatta', '1410785448animals_dogs_pets_golden_retriever_2560x1600_wallpaper_www.wall321.com_55.jpg', 'dsds', 'dsdsd@gmail.com', 'sdsdsdsd', 'sdsdsd'),
(11, 'thumsion reutors', 'bangalore', '1411125654Tulips.jpg', '34343', 'bapu@yahoo.com', 'www.tts.com', 'dsdsdskldhskdh');

-- --------------------------------------------------------

--
-- Table structure for table `tc_configurations`
--

DROP TABLE IF EXISTS `tc_configurations`;
CREATE TABLE IF NOT EXISTS `tc_configurations` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `andversion` double NOT NULL,
  `iosversion` double NOT NULL,
  `ride_later_limit` double NOT NULL,
  `promotion_value` double NOT NULL,
  `googlekey` longtext NOT NULL,
  `wait_time_charge` double NOT NULL,
  `withdraw_limit` double NOT NULL,
  `website_url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tc_configurations`
--

INSERT INTO `tc_configurations` (`id`, `andversion`, `iosversion`, `ride_later_limit`, `promotion_value`, `googlekey`, `wait_time_charge`, `withdraw_limit`, `website_url`) VALUES
(1, 5.2, 3.2, 2, 10, 'AIzaSyBmoRt5gXU6nGN8AbLGZe3qdDuu4z2nE3s', 10, 100000, 'www.taxicel.com');

-- --------------------------------------------------------

--
-- Table structure for table `tc_contactus`
--

DROP TABLE IF EXISTS `tc_contactus`;
CREATE TABLE IF NOT EXISTS `tc_contactus` (
  `id` int(22) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tc_contactus`
--

INSERT INTO `tc_contactus` (`id`, `name`, `email`, `contact_no`, `message`) VALUES
(1, 'Amit ', 'amit@gmail.com', '8961655488', 'Hello testing ....'),
(2, 'Anup', 'anup@gmail.com', '5659523232', 'Testing CU...'),
(3, 'Amit ', 'amit@gmail.com', '5659523232', 'asdasdasd'),
(4, 'Amit ', 'amit@gmail.com', '5659523232', 'sdsafasf'),
(5, 'dshdksh', 'an@gmail.cm', 'dsdsds', 'dsdsds'),
(6, 'dshdksh', 'an@gmail.cm', 'dsdsds', 'dsdsds');

-- --------------------------------------------------------

--
-- Table structure for table `tc_countries`
--

DROP TABLE IF EXISTS `tc_countries`;
CREATE TABLE IF NOT EXISTS `tc_countries` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0' COMMENT '0=active, 1=not active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tc_countries`
--

INSERT INTO `tc_countries` (`id`, `name`, `is_active`) VALUES
(1, 'India', 0),
(2, 'swiden', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_customer_customs`
--

DROP TABLE IF EXISTS `tc_customer_customs`;
CREATE TABLE IF NOT EXISTS `tc_customer_customs` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `user_image` varchar(200) NOT NULL,
  `device_type` int(20) NOT NULL DEFAULT '1' COMMENT '1=android, 2=IPhone',
  `device_unique_id` longtext NOT NULL,
  `lat` varchar(200) NOT NULL,
  `long` varchar(200) NOT NULL,
  `billingadd` varchar(200) NOT NULL,
  `billingareaname` varchar(200) NOT NULL,
  `billingstreetname` varchar(200) NOT NULL,
  `billingcity` varchar(200) NOT NULL,
  `billingstate` varchar(200) NOT NULL,
  `billingpin` varchar(200) NOT NULL,
  `billingcountry` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tc_customer_customs`
--

INSERT INTO `tc_customer_customs` (`id`, `user_id`, `user_image`, `device_type`, `device_unique_id`, `lat`, `long`, `billingadd`, `billingareaname`, `billingstreetname`, `billingcity`, `billingstate`, `billingpin`, `billingcountry`) VALUES
(2, 13, '', 1, 'APA91bGLl9SmLNX7aAfT3NU8pYVyBwYpKLPO4Sg4hEzRN43BGg1iDCwjmFEYAoEX8IqttaWvdPIK-ttbgx1oNfxVOTmPmOmGBteyk8vxtvDjiz0oJBIpe3O3k9Ve7EppvzyRVRbdtXSpPpS0idF67m7NYNaHwguQHefXbl-wDjLWS218732oIx4', '23.33', '11.22', '', '', '', '', '', '', ''),
(3, 15, '', 1, 'APA91bGLl9SmLNX7aAfT3NU8pYVyBwYpKLPO4Sg4hEzRN43BGg1iDCwjmFEYAoEX8IqttaWvdPIK-ttbgx1oNfxVOTmPmOmGBteyk8vxtvDjiz0oJBIpe3O3k9Ve7EppvzyRVRbdtXSpPpS0idF67m7NYNaHwguQHefXbl-wDjLWS218732oIx4', '0', '0', '', '', '', '', '', '', ''),
(4, 16, '', 1, 'APA91bHwjZruuZNoxzZeY7ozEJoYhQrXp-H7yaXX6A44U-c4A7oCetD9w9s9kappe53dBkeGqJWD0Ti5p2dIAdV9firT7-8yJ1oyPeeOcd2iIYjfir-AhpM32duLMODKGCufSCMloYMaJ8vXVLYXxebuB2T617ktUJ-oa5-pPdXKrdAujygJf4A', '0', '0', '', '', '', '', '', '', ''),
(5, 21, '', 2, 'ABCD', '23.23', '22.23', '', '', '', '', '', '', ''),
(8, 22, '', 1, 'APA91bHwjZruuZNoxzZeY7ozEJoYhQrXp-H7yaXX6A44U-c4A7oCetD9w9s9kappe53dBkeGqJWD0Ti5p2dIAdV9firT7-8yJ1oyPeeOcd2iIYjfir-AhpM32duLMODKGCufSCMloYMaJ8vXVLYXxebuB2T617ktUJ-oa5-pPdXKrdAujygJf4A', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tc_driver_commissions`
--

DROP TABLE IF EXISTS `tc_driver_commissions`;
CREATE TABLE IF NOT EXISTS `tc_driver_commissions` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `ride_id` int(20) unsigned NOT NULL,
  `commission_rate` double NOT NULL,
  `amount_paid` double NOT NULL,
  `is_paid` int(11) NOT NULL DEFAULT '0' COMMENT '0=not paid, 1=Paid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tc_driver_commissions`
--


-- --------------------------------------------------------

--
-- Table structure for table `tc_driver_customs`
--

DROP TABLE IF EXISTS `tc_driver_customs`;
CREATE TABLE IF NOT EXISTS `tc_driver_customs` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `drive_city` int(20) NOT NULL,
  `user_pic` varchar(200) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `address1` longtext NOT NULL,
  `address2` longtext NOT NULL,
  `country_id` int(20) NOT NULL,
  `city_id` int(20) NOT NULL,
  `region` varchar(200) NOT NULL,
  `postal_code` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `arg_bus_card` varchar(200) NOT NULL,
  `status` int(20) NOT NULL COMMENT '0=offline,1=online, 2=engage',
  `device_type` int(11) NOT NULL COMMENT '1=android, 2=IPhone',
  `device_unique_id` longtext NOT NULL,
  `lat` varchar(200) NOT NULL,
  `long` varchar(200) NOT NULL,
  `company_id` int(22) NOT NULL,
  `is_owner` int(11) NOT NULL DEFAULT '0' COMMENT '0=''Not owner'', 1=''Owner''',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tc_driver_customs`
--

INSERT INTO `tc_driver_customs` (`id`, `user_id`, `drive_city`, `user_pic`, `company_name`, `address1`, `address2`, `country_id`, `city_id`, `region`, `postal_code`, `mobile`, `arg_bus_card`, `status`, `device_type`, `device_unique_id`, `lat`, `long`, `company_id`, `is_owner`) VALUES
(2, 12, 2, '1410508254bapu.jpg', 'dsdsjdsjhdgsj', 'Saltlake,Kolkata', 'Chingrighata', 2, 3, 'SaltLake', '700001', '7853232322', 'B84455', 2, 1, '', '22.35', '21.23', 9, 1),
(3, 19, 2, '', 'Mindscale', 'Saltlake,Kolkata', 'Chingrighata', 2, 3, 'SaltLake', '700001', '7853232322', 'B84455', 1, 1, '', '', '', 10, 1),
(4, 21, 2, '1410358830bapu.jpg', 'mind', 'qwqwq', 'cuttack', 3, 2, 'cuttack', '989898', '9861125455', 'cy666', 0, 0, '', '', '', 9, 1),
(5, 28, 1, '', 'mindscale', 'bhubaneswar', '', 2, 2, 'west bengal', '751019', '9007561788', 'ABCD', 0, 0, '', '55.56', '21.43', 0, 0),
(16, 0, 0, '1411046432Chrysanthemum.jpg', 'gfgfgf', 'vghghgh', '', 3, 4, 'fgfg', 'gfgfg', 'gfgfg', 'gfgfg', 0, 0, '', '', '', 0, 0),
(17, 0, 0, '1411046450Chrysanthemum.jpg', 'gfgfgf', 'vghghgh', 'ggfgfgf', 3, 4, 'fgfg', 'gfgfg', 'gfgfg', 'gfgfg', 0, 0, '', '', '', 0, 0),
(9, 33, 3, '', 'mindscale', 'kolkatta', 'kolkatta', 2, 2, 'west bengal', '751019', '73897289372', 'ABCD', 0, 0, '', '', '', 0, 0),
(18, 47, 2, '1411046538Koala.jpg', 'ewew', 'ewewe', 'ewewe', 0, 2, 'ewewewe', 'iuyuiyuiyuiy', '73897289372', 'ABCD', 0, 0, '', '', '', 0, 0),
(14, 45, 2, '1411046385Lighthouse.jpg', 'mindscale', 'kolkatta', 'kolkatta', 3, 3, 'idjhdjk', '751019', '73897289372', 'ABCD', 0, 0, '', '', '', 0, 0),
(13, 44, 2, '1411022555Chrysanthemum.jpg', 'ns,mdns,mdn,sm', 'kolkatta', 'kolkatta', 0, 2, 'idjhdjk', '751019', 'dsdsds', 'ABCD', 0, 0, '', '', '', 0, 0),
(19, 48, 2, '1411120575Chrysanthemum.jpg', 'dsdskjdhk', 'shdkjshdkj', 'khskdhskjd', 0, 1, 'jdlksjdlksj', 'jlkdjlksd', 'lsjdklsjdkl', 'djlkdjskldj', 0, 0, '', '', '', 0, 0),
(20, 49, 2, '1411120823Tulips.jpg', 'shree radha', 'A-249, bhubaneswar', '-do-', 0, 2, 'Odisha', '751019', '9861125455', 'no', 0, 0, '', '', '', 0, 0),
(21, 50, 2, '1411122033Tulips.jpg', 'mindscale', 'saltlake sector 2', 'kolkatta', 1, 1, 'west bengal', '876543', '9007561082', 'ABCD', 0, 0, '', '', '', 0, 0),
(22, 51, 6, '', 'TCS', 'kolkatta', 'kolkatta', 1, 1, 'kelkehw', 'jhjkhjkeh', '8908908', 'BBBBBB', 0, 0, '', '', '', 0, 0),
(23, 13, 2, '', 'ns,mdns,mdn,sm', 'kolkatta', 'kolkatta', 2, 2, 'west bengal', '751019', '73897289372', 'ABCD', 0, 0, '', '0', '0', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_driver_documents`
--

DROP TABLE IF EXISTS `tc_driver_documents`;
CREATE TABLE IF NOT EXISTS `tc_driver_documents` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(20) unsigned NOT NULL,
  `filename` varchar(200) NOT NULL,
  `expiry_date` date NOT NULL,
  `filename_auth` varchar(200) NOT NULL,
  `expiry_date_auth` date NOT NULL,
  `filename_lic` varchar(200) NOT NULL,
  `expiry_date_lic` date NOT NULL,
  `filename_oper` int(200) NOT NULL,
  `expiry_date_oper` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tc_driver_documents`
--

INSERT INTO `tc_driver_documents` (`id`, `user_id`, `filename`, `expiry_date`, `filename_auth`, `expiry_date_auth`, `filename_lic`, `expiry_date_lic`, `filename_oper`, `expiry_date_oper`) VALUES
(1, 12, '1409885513Test01.pdf', '2027-03-04', '1409885513Test3.pdf', '2032-07-09', '1409885513Test_Document_001.pdf', '2030-05-05', 1409885513, '2027-10-19');

-- --------------------------------------------------------

--
-- Table structure for table `tc_faqs`
--

DROP TABLE IF EXISTS `tc_faqs`;
CREATE TABLE IF NOT EXISTS `tc_faqs` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `question` longtext NOT NULL,
  `answer` longtext NOT NULL,
  `is_active` int(20) NOT NULL DEFAULT '0' COMMENT '0=active, 1=deactive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tc_faqs`
--

INSERT INTO `tc_faqs` (`id`, `question`, `answer`, `is_active`) VALUES
(1, 'How to work through your apps ? ', 'Download your app go to app store find the app and download it after that....', 0),
(2, 'Proin vitae euismod lacus, sed dapibus eros. Ut auctor dolor diam, quis fermentum elit facilisis ac ?', 'Aenean ac pretium ante, quis dictum metus. Aenean non venenatis ligula. Donec dictum risus non urna tempor dapibus. Aenean ultricies tincidunt mauris, id pretium eros varius ac. Cras sit amet porttitor nulla. Pellentesque vitae metus egestas, semper nisi sit amet, pharetra quam. Nullam non lectus nulla. Maecenas ac lobortis velit. Phasellus adipiscing nunc molestie, vestibulum sapien eu, dapibus augue.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_heat_zones`
--

DROP TABLE IF EXISTS `tc_heat_zones`;
CREATE TABLE IF NOT EXISTS `tc_heat_zones` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `create_time` int(11) NOT NULL,
  `is_active` int(20) NOT NULL DEFAULT '0' COMMENT '0=active, 1=not active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tc_heat_zones`
--

INSERT INTO `tc_heat_zones` (`id`, `city_id`, `name`, `create_time`, `is_active`) VALUES
(1, 1, 'test zone', 1409717255, 0),
(2, 1, 'Kolkata Metro', 1410311630, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_heat_zone_cordinets`
--

DROP TABLE IF EXISTS `tc_heat_zone_cordinets`;
CREATE TABLE IF NOT EXISTS `tc_heat_zone_cordinets` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `heat_zone_id` int(20) NOT NULL,
  `lat` varchar(200) NOT NULL,
  `long` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tc_heat_zone_cordinets`
--

INSERT INTO `tc_heat_zone_cordinets` (`id`, `heat_zone_id`, `lat`, `long`, `name`) VALUES
(1, 1, '22.6039246', '88.1088482', 'Pantihal Garhbaliya Khadarghat Sidhysar Road, Finga Gachhi, West Bengal 711414, India'),
(2, 1, '22.5932732', '88.2644469', 'Kona Expressway, Bankra, Howrah, West Bengal 711403, India'),
(3, 1, '22.561581', '88.281852', '12, Guabaria, Mourigram, Howrah, West Bengal 711109, India'),
(4, 1, '22.5062293', '88.1665837', 'Bauria Station Road, Chakmadhu, Nalpur, Howrah, West Bengal 711305, India'),
(5, 1, '22.5363993', '88.0799017', 'Unnamed Road, Tehatta, West Bengal 711322, India'),
(6, 1, '22.6039246', '88.1088482', 'Pantihal Garhbaliya Khadarghat Sidhysar Road, Finga Gachhi, West Bengal 711414, India'),
(8, 2, '22.617753', '88.3817679', 'E13, Mitrabagan Basti, Paikpara, Kolkata, West Bengal 700002, India'),
(9, 2, '22.5357762', '88.3389482', 'Debendra Lal Khan Road, Bhawanipur, Kolkata, West Bengal 700025, India'),
(10, 2, '22.552253', '88.480387', 'Pachuria Main Road, Bishnupur, Rajarhat Newtown, Kolkata, West Bengal 743502, India'),
(11, 2, '22.616438', '88.38662699999999', '1/2, Noongola Basti, Paikpara, Kolkata, West Bengal 700002, India'),
(12, 2, '22.6190881', '88.38308909999999', '22D, Dum Dum Road, Mitrabagan Basti, Paikpara, Kolkata, West Bengal 700002, India');

-- --------------------------------------------------------

--
-- Table structure for table `tc_payment_settings`
--

DROP TABLE IF EXISTS `tc_payment_settings`;
CREATE TABLE IF NOT EXISTS `tc_payment_settings` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `ride_commision` double NOT NULL COMMENT '%',
  `ride_later_booking_after` double NOT NULL COMMENT 'hour',
  `ride_now_canceled_in` double NOT NULL COMMENT 'minutes',
  `ride_now_cancellation_fee` double NOT NULL COMMENT '$',
  `no_fee_before` double NOT NULL COMMENT 'hour',
  `full_fee_after` double NOT NULL COMMENT 'hour',
  `cancellation_charge_apply_after` double NOT NULL COMMENT 'hour',
  `cancellation_charge` double NOT NULL COMMENT '$',
  `payflow_username` varchar(200) NOT NULL,
  `payflow_partner` varchar(200) NOT NULL,
  `payflow_vendor` varchar(200) NOT NULL,
  `payflow_password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tc_payment_settings`
--

INSERT INTO `tc_payment_settings` (`id`, `ride_commision`, `ride_later_booking_after`, `ride_now_canceled_in`, `ride_now_cancellation_fee`, `no_fee_before`, `full_fee_after`, `cancellation_charge_apply_after`, `cancellation_charge`, `payflow_username`, `payflow_partner`, `payflow_vendor`, `payflow_password`) VALUES
(1, 20, 5, 1, 10, 1, 0.15, 0.3, 50, 'Taxicel', 'VSA', 'Taxicel', 'D5iSBsSSarBaz2');

-- --------------------------------------------------------

--
-- Table structure for table `tc_price_settings`
--

DROP TABLE IF EXISTS `tc_price_settings`;
CREATE TABLE IF NOT EXISTS `tc_price_settings` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(20) NOT NULL,
  `base_fare` double NOT NULL,
  `base_distance` double NOT NULL,
  `fare_per_meter` double NOT NULL,
  `fare_per_minute` double NOT NULL,
  `base_waiting_time` double NOT NULL,
  `inter_fare_distance` double NOT NULL COMMENT 'Values in meters',
  `inter_fare_time` double NOT NULL COMMENT 'Values in seconds',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tc_price_settings`
--

INSERT INTO `tc_price_settings` (`id`, `city_id`, `base_fare`, `base_distance`, `fare_per_meter`, `fare_per_minute`, `base_waiting_time`, `inter_fare_distance`, `inter_fare_time`) VALUES
(1, 1, 10.5, 10, 20, 25.3, 15, 78, 25);

-- --------------------------------------------------------

--
-- Table structure for table `tc_rides`
--

DROP TABLE IF EXISTS `tc_rides`;
CREATE TABLE IF NOT EXISTS `tc_rides` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `driver_id` int(20) NOT NULL,
  `card_id` int(20) NOT NULL,
  `payment_option` int(20) NOT NULL COMMENT '0=cash, 1=credit card',
  `pick_up` varchar(200) NOT NULL,
  `pick_lat` double NOT NULL,
  `pick_long` double NOT NULL,
  `drop_off` varchar(200) NOT NULL,
  `drop_lat` double NOT NULL,
  `drop_long` double NOT NULL,
  `instruction` longtext NOT NULL,
  `distance_cost` double NOT NULL,
  `total_distance` double NOT NULL,
  `total_time` double NOT NULL,
  `date_time` varchar(200) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `city_id` int(22) NOT NULL,
  `is_faviorate` int(11) NOT NULL DEFAULT '0' COMMENT '0=not faviorate, 1=faviorate',
  `ride_type` int(11) NOT NULL DEFAULT '0' COMMENT '0=Ride now, 1=Ride later',
  `status` int(20) NOT NULL COMMENT '1=RideAccepted, 2=DriverArriving, 3=TripStarted, 4=TripEnds ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `tc_rides`
--

INSERT INTO `tc_rides` (`id`, `user_id`, `driver_id`, `card_id`, `payment_option`, `pick_up`, `pick_lat`, `pick_long`, `drop_off`, `drop_lat`, `drop_long`, `instruction`, `distance_cost`, `total_distance`, `total_time`, `date_time`, `start_time`, `end_time`, `city_id`, `is_faviorate`, `ride_type`, `status`) VALUES
(1, 13, 12, 0, 0, 'sdfsdf', 46546, 546546, 'dsfsd', 4545, 546456, ' ', 10.23, 0, 0, '', 0, 0, 1, 0, 0, 4),
(2, 13, 12, 0, 0, 'sdfsdf', 46546, 546546, 'dsfsd', 4545, 546456, ' ', 0, 0, 0, '', 0, 0, 3, 0, 0, 4),
(3, 13, 12, 0, 0, 'sdfsdf', 46546, 546546, 'dsfsd', 4545, 546456, ' ', 0, 0, 0, '', 0, 0, 3, 0, 0, 4),
(4, 13, 28, 0, 0, 'sdfsdf', 46546, 546546, 'dsfsd', 4545, 546456, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 4),
(62, 13, 0, 0, 0, ' ', 22.5667, 88.3667, ' ', 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 1, 0, 0, 0),
(6, 13, 33, 0, 0, 'trtet', 22.56, 88.416, 'yruwyuw', 22.5789, 88.498, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(7, 13, 0, 0, 0, 'trtet', 22.56, 88.416, 'yruwyuw', 22.5789, 88.498, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 3),
(8, 13, 0, 0, 0, 'trtet', 22.56, 88.416, 'yruwyuw', 22.5789, 88.498, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(9, 13, 0, 0, 0, 'trtet', 22.56, 88.416, 'yruwyuw', 22.5789, 88.498, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(10, 13, 0, 0, 0, 'trtet', 22.56, 88.416, 'yruwyuw', 22.5789, 88.498, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(11, 13, 0, 0, 0, 'trtet', 22.56, 88.416, 'yruwyuw', 22.5789, 88.498, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(12, 13, 0, 0, 0, 'trtet', 22.56, 88.416, 'yruwyuw', 22.5789, 88.498, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 4),
(13, 13, 0, 0, 0, 'fghfh', 22.5454, 88.545, 'gfhfgh', 0, 0, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(14, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 3),
(15, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(16, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(17, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(18, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(19, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 3),
(20, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 1, 0, 0, 3),
(21, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 4),
(22, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 3),
(23, 12, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 4),
(24, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(25, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(26, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 1, 0),
(27, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 1, 0),
(28, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 1, 4),
(29, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 1, 0),
(30, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 0, 3),
(31, 13, 0, 0, 0, 'dsfsd dsf sdf', 22.5667, 88.3667, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 1, 0, 0, 4),
(32, 13, 0, 0, 0, 'dsfsd dsf sdf', 22, 88, 'sdfdsf', 22.552421, 88.2121212, ' ', 0, 0, 0, '', 0, 0, 0, 0, 1, 0),
(33, 0, 0, 0, 0, 'Dhaka, Dhaka Division, Bangladesh', 0, 0, 'Sydney, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-08-26', 0, 0, 0, 0, 0, 4),
(34, 0, 0, 0, 0, 'Dharruk, New South Wales, Australia', 0, 0, 'Bayswater Road, Rushcutters Bay, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-30', 0, 0, 0, 0, 0, 0),
(35, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(36, 0, 0, 0, 0, 'Darlinghurst Road, Potts Point, New South Wales, Australia', 0, 0, 'Sydney, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-30', 0, 0, 0, 0, 0, 0),
(37, 0, 0, 0, 0, 'Darlinghurst Road, Potts Point, New South Wales, Australia', 0, 0, 'Sydney, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-30', 0, 0, 0, 0, 0, 0),
(38, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(39, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(40, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(41, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(42, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(43, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(44, 0, 0, 0, 0, 'dhanbad', 0, 0, 'kolkata', 0, 0, '', 0, 0, 0, '2014-09-09', 0, 0, 0, 0, 0, 0),
(45, 0, 0, 0, 0, 'Darlinghurst, New South Wales, Australia', 0, 0, 'Forbes Street, Darlinghurst, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-29', 0, 0, 0, 0, 0, 0),
(46, 17, 0, 0, 0, 'Kolkata, West Bengal, India', 0, 0, 'Sydney, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-30', 0, 0, 0, 0, 0, 0),
(47, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 4),
(48, 18, 0, 0, 1, 'Darlinghurst, New South Wales, Australia', 0, 0, 'Farrer Place, Sydney, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-30', 0, 0, 0, 0, 0, 0),
(49, 20, 0, 0, 1, 'Sydney, New South Wales, Australia', 0, 0, 'Darlinghurst, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-17', 0, 0, 0, 0, 0, 0),
(50, 13, 0, 0, 0, 'kolkatta', 23.4, 212.23, 'bihar', 12.23, 21.21, '3232', 0, 0, 0, ' ', 0, 0, 0, 0, 0, 0),
(51, 0, 0, 0, 0, 'Beliaghata, Kolkata, West Bengal, India', 0, 0, 'Howrah, West Bengal, India', 0, 0, '', 0, 0, 0, '2014-09-24', 0, 0, 0, 0, 0, 4),
(52, 0, 0, 0, 0, 'Howrah, Tasmania, Australia', 0, 0, 'Babushkas Kefir, Bay Street, Botany, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-16', 0, 0, 0, 0, 0, 0),
(53, 29, 0, 0, 0, 'Saladworks, Sydney, New South Wales, Australia', 0, 0, '213 Darlinghurst Road, Darlinghurst, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-17', 0, 0, 0, 0, 0, 3),
(54, 0, 0, 0, 0, '206 bus stop, 1st Avenue, Sector II, Salt Lake, West Bengal, India', 0, 0, 'Chingrighata Fish Market, Canal South Road, Metropolitan, Tangra, Kolkata, West Bengal, India', 0, 0, '', 0, 0, 0, '2014-09-26', 0, 0, 0, 0, 0, 0),
(55, 0, 0, 0, 0, 'Jhgh Holding ApS, Cortinavej, Skanderborg, Denmark', 0, 0, 'South Australia, Australia', 0, 0, '', 0, 0, 0, '2014-09-10 02:09', 0, 0, 0, 0, 0, 0),
(56, 0, 0, 0, 0, 'Darlinghurst Road, Potts Point, New South Wales, Australia', 0, 0, 'Darlinghurst, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014/09/26 20:00', 0, 0, 0, 0, 0, 0),
(57, 0, 0, 0, 0, 'Ewart Street, Marrickville, New South Wales, Australia', 0, 0, 'Surry Hills, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014/09/30 20:00', 0, 0, 0, 0, 0, 0),
(58, 0, 0, 0, 0, 'Darlinghurst, New South Wales, Australia', 0, 0, '21 Ward Avenue, Potts Point, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-25 23:00', 0, 0, 0, 0, 0, 0),
(59, 0, 0, 0, 0, '289 Sussex Street, Sydney, New South Wales, Australia', 0, 0, '213 Darlinghurst Road, Darlinghurst, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-25 15:00', 0, 0, 0, 0, 0, 0),
(60, 0, 0, 0, 0, 'Elizabeth Bay, New South Wales, Australia', 0, 0, 'Elizabeth Bay, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-27 15:00', 0, 0, 0, 0, 0, 0),
(61, 0, 0, 0, 0, 'Alfred Street, Sydney, New South Wales, Australia', 0, 0, 'Alfred Street, Sydney, New South Wales, Australia', 0, 0, '', 0, 0, 0, '2014-09-26 15:00', 0, 0, 0, 0, 0, 0),
(63, 13, 0, 0, 0, ' ', 22.5667, 88.3667, ' ', 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 1, 0, 0, 0),
(64, 13, 0, 0, 0, ' ', 18.975, 72.8258, ' ', 0, 0, ' ', 0, 0, 0, ' ', 0, 0, 3, 0, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tc_ride_traces`
--

DROP TABLE IF EXISTS `tc_ride_traces`;
CREATE TABLE IF NOT EXISTS `tc_ride_traces` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `ride_id` int(20) NOT NULL,
  `lat` varchar(200) NOT NULL,
  `long` varchar(200) NOT NULL,
  `ride_status` int(11) NOT NULL COMMENT '1=Arriving, 2=Ontrip',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tc_ride_traces`
--

INSERT INTO `tc_ride_traces` (`id`, `ride_id`, `lat`, `long`, `ride_status`) VALUES
(1, 30, '22.34', '23.43', 0),
(2, 30, '22.43', '67.43', 0),
(3, 30, '22.34', '23.43', 0),
(4, 30, '22.43', '67.43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_rollmaster`
--

DROP TABLE IF EXISTS `tc_rollmaster`;
CREATE TABLE IF NOT EXISTS `tc_rollmaster` (
  `id` int(22) NOT NULL AUTO_INCREMENT,
  `roll_model` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tc_rollmaster`
--

INSERT INTO `tc_rollmaster` (`id`, `roll_model`) VALUES
(1, 'Engineer'),
(2, 'Senior Engineer'),
(4, 'Engineer Doc'),
(5, 'bkfdhdfkjdh');

-- --------------------------------------------------------

--
-- Table structure for table `tc_settings`
--

DROP TABLE IF EXISTS `tc_settings`;
CREATE TABLE IF NOT EXISTS `tc_settings` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `ride_distance_radius` double NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tc_settings`
--


-- --------------------------------------------------------

--
-- Table structure for table `tc_users`
--

DROP TABLE IF EXISTS `tc_users`;
CREATE TABLE IF NOT EXISTS `tc_users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_type` int(20) NOT NULL COMMENT '0=admin, 1=Driver, 2=customer',
  `username` varchar(200) NOT NULL,
  `f_name` varchar(200) NOT NULL,
  `l_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `address` longtext NOT NULL,
  `reffered_by` int(22) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `tc_users`
--

INSERT INTO `tc_users` (`id`, `user_type`, `username`, `f_name`, `l_name`, `email`, `pass`, `mobile`, `address`, `reffered_by`, `reg_date`) VALUES
(4, 0, 'sreemoyee', 'Sreemoyee', 'Banarjee', 'banarjee.sreemoyee@mindscale.co.in', '12345', '7853232322', 'Salt Lake, Kolkata', 0, '2014-08-19 16:16:19'),
(12, 1, 'atanu', 'bapu', 'sahoo', 'atanu@gmail.com', '12345', '90075', 'India', 0, '0000-00-00 00:00:00'),
(13, 2, 'Gourav Kundu', 'Gourav', 'Kundu', 'gouravkundu@gmail.com', 'qwerty', '9674168891', '', 0, '0000-00-00 00:00:00'),
(14, 2, 'Gourav kundu', 'Gourav', 'kundu', 'grv@gmail.com', 'qwerty', '9674168891', '', 0, '0000-00-00 00:00:00'),
(15, 2, 'deck tho', 'deck', 'tho', 'chm', 'chm', 'dbl', '', 0, '0000-00-00 00:00:00'),
(16, 2, 'DTM full', 'DTM', 'full', 'CTL', 'chm', 'chm', '', 0, '0000-00-00 00:00:00'),
(17, 2, 'Pratim Bhowmik', 'Pratim', 'Bhowmik', 'pratim@gmail.com', '12345', '1', '', 0, '0000-00-00 00:00:00'),
(18, 2, 'amit', 'Amit', 'Dutta', 'amit@gmail.com', 'Taxi-846918', '8961655477', '', 0, '2014-09-03 19:01:10'),
(19, 1, 'arindam', 'Arindam', 'Das', 'arindam@live.com', '12345', '7853232322', 'India', 0, '0000-00-00 00:00:00'),
(20, 2, 'anup', 'Anup', 'Das', 'anup@gmail.com', 'Taxicel-96773', '8961655477', '', 0, '2014-09-09 18:09:02'),
(21, 2, 'anup', 'bapu', 'sahoo', 'sdsds@gmail.com', 'Taxicel-82141', '9007561082', 'bhubaneswar', 0, '2014-09-10 17:32:02'),
(22, 2, 'anup samantaray', 'anup', 'samantaray', 'bapu4u@gmail.com', 'Taxicel-64560', '1', '', 0, '0000-00-00 00:00:00'),
(28, 1, 'bapusahoo', 'bapu', 'sahoo', 'bapusahoo@gmail.com', '12345', '9861125455', 'India', 0, '0000-00-00 00:00:00'),
(52, 1, 'amitduttasdsd', 'qwqwqw', 'wqwqwqw', 'wwqqwq@gmail.com', '1234', 'dsdsds', 'swiden', 0, '0000-00-00 00:00:00'),
(51, 1, 'soyankasubha', 'soyanka', 'subhadarshani', 'soyankasubha@gmail.com', '12345', '9861154555', 'India', 0, '0000-00-00 00:00:00'),
(30, 1, 'amitdutta', 'bapu', 'ewewe', 'ewewe@gmai.com', '1234', '9007561082', 'Argentina', 0, '0000-00-00 00:00:00'),
(47, 1, 'sohali', 'ewew', 'ewewe', 'ewewe@gmai.com', '1234', 'wewew', 'Argentina', 12, '0000-00-00 00:00:00'),
(48, 1, 'dsd@yahoo.com', 'fdfhdjkfh', 'khsdkjsdh', 'yahoo@gmail.com', '111', 'fjdfjdkfjlk', 'swiden', 12, '0000-00-00 00:00:00'),
(49, 1, 'swain', 'bapu', 'sahoo', 'bapuswain@gmail.com', '123', '9865545444', 'India', 12, '0000-00-00 00:00:00'),
(50, 1, '34343', 'anup ', 'prasad samantaray', 'samantaray@gmail.com', '111', '9007561082', 'India', 12, '0000-00-00 00:00:00'),
(33, 1, 'soyanka', 'soyanka', 'subha', 'samantaray@gmail.com', '1234', '11111', 'India', 12, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tc_user_credit_details`
--

DROP TABLE IF EXISTS `tc_user_credit_details`;
CREATE TABLE IF NOT EXISTS `tc_user_credit_details` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `credit_card_no` varchar(200) NOT NULL,
  `holdername` varchar(200) NOT NULL,
  `expirydate` varchar(200) NOT NULL,
  `cvvno` varchar(200) NOT NULL,
  `cardtype` varchar(200) NOT NULL,
  `postcode` varchar(200) NOT NULL,
  `address` longtext NOT NULL,
  `is_active` int(20) NOT NULL DEFAULT '0' COMMENT '0=not active, 1=active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tc_user_credit_details`
--

INSERT INTO `tc_user_credit_details` (`id`, `user_id`, `credit_card_no`, `holdername`, `expirydate`, `cvvno`, `cardtype`, `postcode`, `address`, `is_active`) VALUES
(1, 12, '5232323232544', 'Atanu', '121212422', '631', 'VISA', '832255254', '', 0),
(2, 12, '5232323232888952', 'Akash', '121212422', '325', 'MASTER', '828205', '', 0),
(3, 12, '58654654', 'fdgfdgfdg', 'fdgfdg', 'fgfg', 'fdgfgd', '', '', 0),
(4, 12, '58654654', 'fdgfdgfdg', 'fdgfdg', 'fgfg', 'fdgfgd', '', '', 0),
(5, 12, '58654654', 'fdgfdgfdg', 'fdgfdg', 'fgfg', 'fdgfgd', '', '', 0),
(6, 18, '12345678', 'amit sutta', '23/12/2014', '12345', 'mastro', '751098', 'dhanbaad', 0),
(7, 20, '1', 'Amit', '2014-09-10', '625', 'VSA', '895825', 'Kolkata', 0),
(8, 21, '12345678', 'anup samantaray', '12/04/2014', '1234', 'mastro', '751019', '', 0),
(9, 21, '12345678', 'anup samantaray', '12/04/2014', '1234', 'mastro', '751019', '', 0),
(10, 21, '12345678', 'anup samantaray', '12/04/2014', '1234', 'mastro', '751019', '', 0),
(11, 21, '12345678', 'anup samantaray', '12/04/2014', '1234', 'mastro', '751019', '', 0),
(12, 21, '12345678', 'anup samantaray', '12/04/2014', '1234', 'mastro', '751019', '', 0),
(13, 21, '12345678', 'anup samantaray', '12/04/2014', '1234', 'mastro', '751019', '', 0),
(14, 21, '12345678', 'anup samantaray', '12/04/2014', '1234', 'mastro', '751019', '', 0),
(15, 13, '12345678323232', 'anup samantaray', '12/04/2014', '1234', 'mastro', '751019', '', 0),
(16, 27, '5345435345wwe', 'gdfgdgdg', '02/2014', '232', '2', '234', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_user_ride_ratings`
--

DROP TABLE IF EXISTS `tc_user_ride_ratings`;
CREATE TABLE IF NOT EXISTS `tc_user_ride_ratings` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `ride_id` int(20) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `driver_id` int(20) NOT NULL,
  `customer_rating` double NOT NULL,
  `driver_rating` double NOT NULL,
  `customer_comment` longtext NOT NULL,
  `driver_comment` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tc_user_ride_ratings`
--


-- --------------------------------------------------------

--
-- Table structure for table `tc_user_roll_details`
--

DROP TABLE IF EXISTS `tc_user_roll_details`;
CREATE TABLE IF NOT EXISTS `tc_user_roll_details` (
  `id` int(22) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `roll_id` int(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `pass` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tc_user_roll_details`
--

INSERT INTO `tc_user_roll_details` (`id`, `first_name`, `last_name`, `roll_id`, `user_name`, `pass`, `email`) VALUES
(1, 'rpu', 'sahooddddd', 2, 'bapu', '1234', 'bapu@gmail.com'),
(2, 'ewew', 'ewewe', 2, 'ewewe', 'weew', 'eewew@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tc_vehicle_details`
--

DROP TABLE IF EXISTS `tc_vehicle_details`;
CREATE TABLE IF NOT EXISTS `tc_vehicle_details` (
  `id` int(22) NOT NULL AUTO_INCREMENT,
  `user_id` int(22) NOT NULL,
  `car_id` int(22) NOT NULL,
  `manufactureing_date` date NOT NULL,
  `vehicle_no` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tc_vehicle_details`
--

INSERT INTO `tc_vehicle_details` (`id`, `user_id`, `car_id`, `manufactureing_date`, `vehicle_no`) VALUES
(1, 12, 1, '2014-09-12', '0234 210s'),
(2, 12, 2, '2016-01-17', 'we-02 3213');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
