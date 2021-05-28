-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2020 at 01:18 PM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`admin_id` int(6) unsigned NOT NULL,
  `admin_account` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_account`, `password`, `admin_email`, `name`) VALUES
(1, 'A001', '123456', 'zzz@zzz.com', 'zzz'),
(2, 'A002', '123456', 'yyy@yyy.com', 'yyy'),
(3, 'A003', '123456', 'xxx@xxx.com', 'xxx'),
(4, 'A004', '123456', 'vvv@vvv.com', 'vvv'),
(5, 'A005', '123456', 'www@www.com', 'wwww');

-- --------------------------------------------------------

--
-- Table structure for table `airline`
--

CREATE TABLE IF NOT EXISTS `airline` (
  `AirlineCode` varchar(2) NOT NULL,
  `airlineName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `airline`
--

INSERT INTO `airline` (`AirlineCode`, `airlineName`) VALUES
('BR', '長榮航空'),
('CI', '中華航空'),
('CX', '國泰航空'),
('EK', '阿聯酋航空'),
('HX', '香港航空'),
('JL', '日本航空'),
('KA', '港龍航空'),
('MU', '中國東方航空'),
('NH', '全日空航空'),
('SQ', '新加坡航空'),
('TG', '泰國國際航空'),
('UA', '美國聯合航空');

-- --------------------------------------------------------

--
-- Table structure for table `flightclass`
--

CREATE TABLE IF NOT EXISTS `flightclass` (
  `flight_no` varchar(6) NOT NULL,
  `flightclass_type` varchar(10) NOT NULL,
  `AirlineCode` varchar(2) NOT NULL,
  `Price_Adult` int(11) NOT NULL,
  `Price_Children` int(11) NOT NULL,
  `Price_Infant` int(11) NOT NULL,
  `Tax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flightclass`
--

INSERT INTO `flightclass` (`flight_no`, `flightclass_type`, `AirlineCode`, `Price_Adult`, `Price_Children`, `Price_Infant`, `Tax`) VALUES
('BR856', 'Economy', 'BR', 1023, 774, 596, 0),
('BR858', 'Business', 'BR', 3088, 3088, 3088, 0),
('BR858', 'Economy', 'BR', 1023, 774, 596, 0),
('BR872', 'Economy', 'BR', 1023, 774, 596, 0),
('CI602', 'Business', 'CI', 2999, 2999, 500, 0),
('CI602', 'Economy', 'CI', 999, 746, 500, 0),
('CI614', 'Economy', 'CI', 931, 694, 500, 0),
('CI680', 'Business', 'CI', 2977, 2977, 500, 0),
('CI680', 'Economy', 'CI', 1098, 792, 500, 0),
('CX360', 'Business', 'CX', 6500, 6500, 2000, 0),
('CX360', 'Economy', 'CX', 3990, 2990, 1500, 0),
('CX364', 'Business', 'CX', 6500, 6500, 2000, 0),
('CX364', 'Economy', 'CX', 3990, 2990, 1500, 0),
('CX400', 'Economy', 'CX', 1490, 1090, 740, 0),
('CX406', 'Economy', 'CX', 1544, 1155, 740, 0),
('CX510', 'Economy', 'CX', 1554, 1115, 740, 0),
('CX564', 'Economy', 'CX', 1305, 1174, 760, 0),
('CX617', 'Economy', 'CX', 4300, 3100, 1300, 0),
('CX659', 'Business', 'CX', 3500, 3500, 800, 0),
('CX659', 'Economy', 'CX', 1760, 1760, 800, 0),
('CX703', 'Economy', 'CX', 4300, 3100, 1300, 0),
('CX713', 'Business', 'CX', 7500, 7500, 2000, 0),
('CX713', 'Economy', 'CX', 4300, 3100, 1300, 0),
('CX715', 'Business', 'CX', 3500, 3500, 800, 0),
('CX715', 'Economy', 'CX', 1880, 1880, 800, 0),
('CX735', 'Economy', 'CX', 1880, 1880, 800, 0),
('EK385', 'Economy', 'EK', 2200, 1652, 600, 0),
('EK386', 'Economy', 'EK', 2200, 1652, 600, 0),
('EK395', 'Economy', 'EK', 2200, 1652, 600, 0),
('HX232', 'Business', 'HX', 5600, 5600, 3000, 0),
('HX232', 'Economy', 'HX', 2850, 1800, 1200, 0),
('HX234', 'Economy', 'HX', 2850, 1800, 1200, 0),
('HX236', 'Economy', 'HX', 27850, 1800, 1200, 0),
('HX246', 'Business', 'HX', 5600, 5600, 3000, 0),
('HX246', 'Economy', 'HX', 2850, 1800, 1200, 0),
('HX252', 'Economy', 'HX', 1584, 1152, 500, 0),
('HX264', 'Economy', 'HX', 1584, 1152, 500, 0),
('HX282', 'Economy', 'HX', 1584, 1152, 500, 0),
('HX284', 'Business', 'HX', 2499, 2499, 530, 0),
('HX284', 'Economy', 'HX', 1584, 1160, 530, 0),
('JL7050', 'Business', 'JL', 11000, 7111, 800, 0),
('JL7050', 'Economy', 'JL', 7111, 5400, 600, 0),
('JL7054', 'Economy', 'JL', 7111, 5400, 750, 0),
('JL7060', 'Business', 'JL', 11000, 7111, 800, 0),
('JL7060', 'Economy', 'JL', 7111, 5400, 750, 0),
('KA482', 'Economy', 'KA', 1699, 1140, 670, 0),
('KA499', 'Economy', 'KA', 1699, 1162, 970, 0),
('KA565', 'Economy', 'KA', 1069, 1254, 670, 0),
('KA802', 'Business', 'KA', 8000, 7900, 1200, 0),
('KA802', 'Economy', 'KA', 4100, 3050, 1000, 0),
('KA858', 'Business', 'KA', 8050, 7900, 1200, 0),
('KA864', 'Economy', 'KA', 4100, 3050, 1000, 0),
('KA876', 'Economy', 'KA', 4100, 3050, 1000, 0),
('MU502', 'Economy', 'MU', 1990, 1190, 900, 0),
('MU503', 'Economy', 'MU', 1688, 1550, 400, 0),
('MU509', 'Economy', 'MU', 1658, 1550, 400, 0),
('MU702', 'Economy', 'MU', 1990, 1190, 800, 0),
('MU722', 'Economy', 'MU', 1893, 1140, 800, 0),
('MU724', 'Economy', 'MU', 2690, 2400, 1000, 0),
('MU728', 'Economy', 'MU', 1458, 1140, 400, 0),
('SQ857', 'Economy', 'SQ', 2950, 2950, 800, 0),
('SQ861', 'Business', 'SQ', 6500, 6500, 800, 0),
('SQ861', 'Economy', 'SQ', 3000, 3050, 800, 0),
('SQ865', 'Business', 'SQ', 6500, 6500, 800, 0),
('SQ865', 'Economy', 'SQ', 3050, 3050, 800, 0),
('SQ871', 'Economy', 'SQ', 3000, 3050, 800, 0),
('SQ891', 'Economy', 'SQ', 3010, 3010, 800, 0),
('TG601', 'Business', 'TG', 5600, 5600, 1200, 0),
('TG601', 'Economy', 'TG', 2400, 1850, 1000, 0),
('TG603', 'Economy', 'TG', 2400, 1850, 1000, 0),
('TG607', 'Economy', 'TG', 2400, 1850, 1000, 0),
('TG639', 'Business', 'TG', 5600, 5600, 1200, 0),
('TG639', 'Economy', 'TG', 2400, 1850, 1000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `flightorder`
--

CREATE TABLE IF NOT EXISTS `flightorder` (
`flight_order_id` int(11) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `flight_no` varchar(6) NOT NULL,
  `DepDateTime` datetime NOT NULL,
  `flightclass_type` varchar(10) NOT NULL,
  `OrderDate` date NOT NULL,
  `AdultNum` int(11) NOT NULL,
  `ChildNum` int(11) NOT NULL,
  `InfantNum` int(11) NOT NULL,
  `real_price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flightorder`
--

INSERT INTO `flightorder` (`flight_order_id`, `user_id`, `flight_no`, `DepDateTime`, `flightclass_type`, `OrderDate`, `AdultNum`, `ChildNum`, `InfantNum`, `real_price`) VALUES
(1, 2, 'BR856', '2020-05-22 17:00:00', 'Economy', '2020-05-23', 1, 0, 0, 1023),
(2, 1, 'BR856', '2020-05-22 17:00:00', 'Economy', '2020-05-23', 1, 0, 0, 1023),
(3, 1, 'BR856', '2020-05-22 17:00:00', 'Economy', '2020-05-23', 1, 0, 0, 1023),
(4, 3, 'BR872', '2020-05-23 19:25:00', 'Economy', '2020-05-24', 1, 0, 3, 2811),
(5, 3, 'KA802', '2020-05-24 08:00:00', 'Business', '2020-05-24', 1, 0, 0, 8000),
(6, 3, 'KA802', '2020-05-24 08:00:00', 'Business', '2020-05-24', 1, 0, 0, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `flightschedule`
--

CREATE TABLE IF NOT EXISTS `flightschedule` (
  `flight_no` varchar(6) NOT NULL,
  `DepDateTime` datetime NOT NULL,
  `ArrDateTime` datetime NOT NULL,
  `DepAirport` varchar(3) NOT NULL,
  `ArrAirport` varchar(3) NOT NULL,
  `FlyMinute` int(11) NOT NULL,
  `Aircraft` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flightschedule`
--

INSERT INTO `flightschedule` (`flight_no`, `DepDateTime`, `ArrDateTime`, `DepAirport`, `ArrAirport`, `FlyMinute`, `Aircraft`) VALUES
('BR856', '2020-05-22 17:00:00', '2020-05-22 18:45:00', 'HKG', 'TPE', 105, 'A330-300'),
('BR858', '2020-05-22 20:55:00', '2020-05-22 22:40:00', 'HKG', 'TPE', 105, 'A330-300'),
('BR872', '2020-05-23 19:25:00', '2020-05-23 21:10:00', 'HKG', 'TPE', 105, 'A330-300'),
('CI602', '2020-05-20 10:15:00', '2020-05-20 11:55:00', 'HKG', 'TPE', 100, '747-400'),
('CI614', '2020-05-20 17:35:00', '2020-05-20 19:15:00', 'HKG', 'TPE', 100, 'A330-300'),
('CI680', '2020-05-20 13:25:00', '2020-05-20 15:05:00', 'HKG', 'TPE', 100, 'A330-300'),
('CX360', '2020-05-25 13:55:00', '2020-05-25 16:25:00', 'HKG', 'PVG', 150, 'A330-200'),
('CX364', '2020-05-24 17:35:00', '2020-05-24 20:10:00', 'HKG', 'PVG', 150, '777-300'),
('CX400', '2020-05-22 16:25:00', '2020-05-22 18:15:00', 'HKG', 'TPE', 110, 'A330-300'),
('CX406', '2020-05-20 12:15:00', '2020-05-20 14:15:00', 'HKG', 'TPE', 120, 'A330-300'),
('CX510', '2020-05-22 14:55:00', '2020-05-22 16:45:00', 'HKG', 'TPE', 110, 'A330-300'),
('CX564', '2020-05-20 13:10:00', '2020-05-20 15:05:00', 'HKG', 'TPE', 115, 'A330-300'),
('CX617', '2020-06-24 21:20:00', '2020-06-24 23:10:00', 'HKG', 'BKK', 175, '777-300'),
('CX659', '2020-06-28 01:45:00', '2020-06-28 05:25:00', 'HKG', 'SIN', 220, 'A330-300'),
('CX703', '2020-06-23 17:05:00', '2020-06-23 19:00:00', 'HKG', 'BKK', 170, 'A330-300'),
('CX713', '2020-06-22 08:50:00', '2020-06-22 10:40:00', 'HKG', 'BKK', 170, 'A330-300'),
('CX715', '2020-06-28 20:25:00', '2020-06-28 00:15:00', 'HKG', 'SIN', 230, '777-300'),
('CX715', '2020-06-29 20:25:00', '2020-06-29 00:15:00', 'HKG', 'SIN', 230, '777-300'),
('CX735', '2020-06-30 14:30:00', '2020-06-30 18:20:00', 'HKG', 'SIN', 230, 'A340-300'),
('EK385', '2020-06-22 21:50:00', '2020-06-22 23:45:00', 'HKG', 'BKK', 175, 'A380-800'),
('EK385', '2020-06-23 21:50:00', '2020-06-23 23:45:00', 'HKG', 'BKK', 175, 'A380-800'),
('EK386', '2020-06-24 19:50:00', '2020-06-24 21:45:00', 'HKG', 'BKK', 175, 'A380-800'),
('EK395', '2020-07-25 17:50:00', '2020-07-25 19:45:00', 'HKG', 'BKK', 175, 'A380-800'),
('HX232', '2020-05-29 17:25:00', '2020-05-29 19:55:00', 'HKG', 'PVG', 150, 'A330-200'),
('HX234', '2020-05-29 21:00:00', '2020-05-29 23:25:00', 'HKG', 'PVG', 145, 'A330-200'),
('HX236', '2020-05-30 08:15:00', '2020-05-30 10:50:00', 'HKG', 'PVG', 155, 'A330-200'),
('HX246', '2020-05-28 13:15:00', '2020-05-28 15:45:00', 'HKG', 'PVG', 150, 'A330-200'),
('HX252', '2020-05-21 09:30:00', '2020-05-21 11:25:00', 'HKG', 'TPE', 115, 'A330-300'),
('HX264', '2020-05-20 12:10:00', '2020-05-20 13:50:00', 'HKG', 'TPE', 100, 'A330-300'),
('HX282', '2020-05-20 17:40:00', '2020-05-20 19:30:00', 'HKG', 'TPE', 110, 'A330-300'),
('HX284', '2020-05-23 22:50:00', '2020-05-24 00:40:00', 'HKG', 'TPE', 110, 'A330-300'),
('JL7050', '2020-05-23 01:45:00', '2020-05-23 06:25:00', 'HKG', 'KIX', 220, 'A320'),
('JL7054', '2020-05-25 13:10:00', '2020-05-25 20:00:00', 'HKG', 'KIX', 350, 'A320'),
('JL7060', '2020-05-23 07:55:00', '2020-05-23 12:45:00', 'HKG', 'KIX', 230, 'A320'),
('KA482', '2020-05-20 18:25:00', '2020-05-20 20:15:00', 'HKG', 'TPE', 115, 'A330-300'),
('KA499', '2020-05-21 14:55:00', '2020-05-21 16:45:00', 'HKG', 'TPE', 110, 'A330-300'),
('KA565', '2020-05-24 17:00:00', '2020-05-24 18:45:00', 'HKG', 'TPE', 105, 'A330-300'),
('KA802', '2020-05-24 08:00:00', '2020-05-24 10:30:00', 'HKG', 'PVG', 150, 'A330-200'),
('KA858', '2020-09-30 10:00:00', '2020-09-30 12:20:00', 'HKG', 'SHA', 140, 'A330-200'),
('KA864', '2020-06-15 09:25:00', '2020-06-15 12:00:00', 'HKG', 'SHA', 155, 'A330-200'),
('KA876', '2020-05-22 09:55:00', '2020-05-22 12:30:00', 'HKG', 'PVG', 155, 'A321'),
('MU502', '2020-05-25 12:50:00', '2020-05-25 15:25:00', 'HKG', 'PVG', 155, 'A321'),
('MU702', '2020-05-26 13:55:00', '2020-05-26 16:25:00', 'HKG', 'PVG', 150, 'A320'),
('MU724', '2020-05-25 09:35:00', '2020-05-25 11:45:00', 'HKG', 'PVG', 130, 'A321'),
('SQ857', '2020-06-28 09:05:00', '2020-06-28 12:50:00', 'HKG', 'SIN', 225, '777-300'),
('SQ861', '2020-06-26 15:20:00', '2020-06-26 19:10:00', 'HKG', 'SIN', 230, 'A380-800'),
('SQ865', '2020-06-26 18:50:00', '2020-06-26 22:35:00', 'HKG', 'SIN', 225, '777-300'),
('SQ871', '2020-06-26 19:55:00', '2020-06-26 23:40:00', 'HKG', 'SIN', 225, '777-200'),
('SQ891', '2020-06-30 12:30:00', '2020-06-30 16:15:00', 'HKG', 'SIN', 225, 'A380-800'),
('TG601', '2020-06-24 13:25:00', '2020-06-24 15:05:00', 'HKG', 'BKK', 160, 'A380-800'),
('TG603', '2020-07-25 07:45:00', '2020-07-25 09:25:00', 'HKG', 'BKK', 160, 'A330-300'),
('TG607', '2020-06-22 20:45:00', '2020-06-22 22:25:00', 'HKG', 'BKK', 160, '747-400'),
('TG639', '2020-06-22 19:05:00', '2020-06-22 20:45:00', 'HKG', 'BKK', 160, 'A330-300');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `hotel_id` int(11) NOT NULL,
  `chiName` varchar(50) NOT NULL,
  `engName` varchar(80) NOT NULL,
  `star` int(1) DEFAULT '0',
  `country` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `hotel_tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `chiName`, `engName`, `star`, `country`, `city`, `district`, `address`, `hotel_tel`) VALUES
(1, '台北君悅酒店', 'Grand Hyatt Taipei', 4, 'Taiwan', 'Taipei', '信義', '2 SongShou Road Taipei 11051 台灣 ', '30774857'),
(2, '台北凱撒大飯店', 'Caesar Park Taipei', 4, 'Taiwan', 'Taipei', '中正', '38 Chung Hsiao West Road Section 1 Zhongzheng Taipei 100 台灣', '30774857'),
(3, '台北福華大飯店', 'The Howard Plaza Hotel Taipei', 4, 'Taiwan', 'Taipei', '大安', '160, Sec.3, Ren Ai Rd Taipei 10657 台灣 ', '30774857'),
(4, '台北中山意舍酒店', 'amba Taipei Zhongshan', 3, 'Taiwan', 'Taipei', '中山', '57-1 Zhongshan North Road Section 2 Taipei 10412 台灣 ', '30774857'),
(5, '台北晶華酒店', 'Regent Taipei', 5, 'Taiwan', 'Taipei', '中山', 'No 3, Lane 39, Section 2 ZhongShan North, Road Taipei 104 台灣 ', '30774857'),
(6, '台北西華飯店', 'The Sherwood Taipei', 4, 'Taiwan', 'Taipei', '松山', '111 Min Sheng East Road Taipei 104 台灣 ', '30774857'),
(7, '黑部觀光酒店', 'Kurobe Kanko Hotel', 3, 'Japan', 'Nagano', 'Omachi', '2822 Taira Omachi Nagano-ken 398-0001 日本 ', '30774857'),
(8, '落葉松莊酒店', 'Hotel Karamatsuso', 3, 'Japan', 'Nagano', 'Omachi', '2884-109 Taira Omachi Nagano-ken 398-0001 日本 ', '30774857'),
(9, '東根拉雪酒店', 'Hotel La Neige Higashi-kan', 5, 'Japan', 'Nagano', 'Hakuba', 'Happo Wadanonomori Hakuba Nagano-ken 399-9301 日本', '30774857'),
(10, '松本多米酒店', 'Dormy Inn Matsumoto', 4, 'Japan', 'Nagano', 'Matsumoto', '2-2-1 Fukashi Matsumoto Nagano-ken 390-0815 日本 ', '30774857'),
(11, '新加坡唐購物中心萬豪酒店', 'Singapore Marriott Tang Plaza Hotel', 5, 'Singapore', 'Singapore', '烏節路', '320 Orchard Road Singapore 238865 新加坡', '30774857'),
(12, '新加坡瑞士史丹福酒店', 'Swissotel The Stamford, Singapore', 5, 'Singapore', 'Singapore', '殖民區 - 美芝路', '2 Stamford Road Singapore 178882 新加坡 ', '30774857'),
(13, '克萊蒙梭公園大道酒店', 'Park Avenue Clemenceau', 4, 'Singapore', 'Singapore', '新加坡河', '81A Clemenceau Avenue # 05 - 18 UE Square Singapore 239918 新加坡', '30774857'),
(14, '新加坡國敦河畔大酒店', 'Grand Copthorne Waterfront Hotel Singapore', 4, 'Singapore', 'Singapore', '新加坡河', '392 Havelock Road Singapore 169663 新加坡', '30774857'),
(15, '聖里吉斯曼谷酒店', 'The St. Regis Bangkok', 5, 'Thailand', 'Bangkok', '市中心 - 暹邏廣場', '159 Rajadamri Road Bangkok Bangkok 10330 泰國', '30774857'),
(16, '帕色哇公主飯店', 'Pathumwan Princess Hotel', 4, 'Thailand', 'Bangkok', '市中心 - 暹邏廣場', '444 MBK Center, Phayathai Rd., Wangmai Pathumwan Bangkok Bangkok 10330 泰國', '30774857'),
(17, '曼谷悅榕莊', 'Banyan Tree Bangkok', 5, 'Thailand', 'Bangkok', '是隆路 - 沙吞', '21/100 South Sathon Road Bangkok Bangkok 10120 泰國 ', '30774857'),
(18, 'D&D 旅館', 'D&D Inn', 3, 'Thailand', 'Bangkok', '舊城', '68-70 Khaosan Road, Pranakorn Bangkok 10200 泰國 ', '30774857'),
(19, '曼谷東方公寓', 'Oriental Residence Bangkok', 5, 'Thailand', 'Bangkok', '素坤逸路', '110 Wireless Road, Lumpini, Pathumwan Bangkok Bangkok 10330 泰國 ', '30774857'),
(20, '上海虹橋元一希爾頓酒店', 'Hilton Shanghai Hongqiao', 5, 'China', 'Shanghai', 'Minhang', 'No.1116 Hong Song East Road Minhang Shanghai 201103 中國', '30774857'),
(21, '和平飯店', 'Fairmont Peace Hotel', 5, 'China', 'Shanghai', '黃浦 - 外灘', '20 Nanjing Road East, Huang Pu District Shanghai Shanghai 200002 中國', '30774857'),
(22, '上海世茂皇家艾美酒店', 'Le Royal Meridien Shanghai', 5, 'China', 'Shanghai', '黃浦 - 外灘', '789 Nanjing Road East Shanghai Shanghai 200001 中國 ', '30774857'),
(23, '華亨賓館', 'Jin Jiang Hua Ting Hotel & Towers', 4, 'China', 'Shanghai', '徐匯', '1200 Cao Xi Bei Road Shanghai Shanghai 200030 中國', '30774857'),
(24, '上海靜安香格里拉大酒店', 'Jing An Shangri-La, West Shanghai', 4, 'China', 'Shanghai', '長寧', '1218 Middle Yan''an Road Jing An Kerry Centre, West Nanjing Shanghai Shanghai 200040 中國', '30774857');

-- --------------------------------------------------------

--
-- Table structure for table `hotelorder`
--

CREATE TABLE IF NOT EXISTS `hotelorder` (
`hotel_order_id` int(10) unsigned NOT NULL,
  `room_id` int(11) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `OrderDate` datetime NOT NULL,
  `real_price` decimal(8,2) NOT NULL,
  `Checkin` datetime NOT NULL,
  `Checkout` datetime NOT NULL,
  `Remark` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotelorder`
--

INSERT INTO `hotelorder` (`hotel_order_id`, `room_id`, `user_id`, `OrderDate`, `real_price`, `Checkin`, `Checkout`, `Remark`) VALUES
(1, 1, 2, '2020-05-23 19:07:48', '4688.00', '2020-05-05 00:00:00', '2020-05-07 00:00:00', ''),
(2, 1, 1, '2020-05-24 10:31:24', '14064.00', '2020-05-08 00:00:00', '2020-05-14 00:00:00', ''),
(3, 1, 3, '2020-05-24 11:05:56', '46880.00', '2020-05-01 00:00:00', '2020-05-21 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE IF NOT EXISTS `package` (
`package_id` int(10) unsigned NOT NULL,
  `room_id` int(11) unsigned NOT NULL,
  `flight_no` varchar(6) NOT NULL,
  `DepDateTime` datetime NOT NULL,
  `flightclass_type` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `room_id`, `flight_no`, `DepDateTime`, `flightclass_type`) VALUES
(1, 1, 'BR856', '2020-05-22 17:00:00', 'Economy'),
(2, 2, 'BR856', '2020-05-22 17:00:00', 'Economy'),
(3, 3, 'CI602', '2020-05-20 10:15:00', 'Business'),
(4, 4, 'CI602', '2020-05-20 10:15:00', 'Economy'),
(5, 5, 'CI680', '2020-05-20 13:25:00', 'Economy');

-- --------------------------------------------------------

--
-- Table structure for table `packageorder`
--

CREATE TABLE IF NOT EXISTS `packageorder` (
`package_order_id` int(10) unsigned NOT NULL,
  `package_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `OrderDate` datetime NOT NULL,
  `AdultNum` int(11) NOT NULL,
  `ChildNum` int(11) NOT NULL,
  `InfantNum` int(11) NOT NULL,
  `real_price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
`room_id` int(11) unsigned NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `room_type` varchar(45) NOT NULL,
  `room_noSmoke` tinyint(1) NOT NULL DEFAULT '0',
  `room_num` int(11) NOT NULL,
  `RoomSize` int(2) NOT NULL,
  `RoomDesc` varchar(50) NOT NULL,
  `Price` decimal(8,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `hotel_id`, `room_type`, `room_noSmoke`, `room_num`, `RoomSize`, `RoomDesc`, `Price`) VALUES
(1, 1, '君悅客房 - 一大床', 1, 4, 5, '1 張特大雙人床', '2344.00'),
(2, 1, '君悅行政套房 - 一大床', 1, 5, 5, '1 張特大雙人床', '5485.00'),
(3, 1, '君悅豪華客房', 1, 3, 5, '1 張特大雙人床', '2493.00'),
(4, 1, '君悅豪華客房 - 二小床', 1, 4, 5, '2 張單人床', '2493.00'),
(5, 1, '嘉賓軒客房 一大床', 1, 3, 5, '1 張特大雙人床', '3241.00'),
(6, 1, '頂級套房, 1 張特大雙人床', 0, 4, 5, '1 張特大雙人床', '3989.00'),
(7, 1, '頂級標準客房', 1, 5, 5, '2 張單人床', '2344.00'),
(8, 2, 'Metro Room', 1, 4, 5, '1 張雙人床', '1142.00'),
(9, 2, '四人房', 1, 5, 5, '2 張床', '1655.00'),
(10, 2, '套房', 1, 4, 5, '1 張雙人床', '1364.00'),
(11, 2, '高級客房', 1, 5, 5, '1 張雙人床', '948.00'),
(12, 2, '高級雙人房', 1, 5, 5, '2 張單人床', '1007.00'),
(13, 3, '尊爵高級套房', 1, 2, 5, '1 張特大雙人床', '1398.00'),
(14, 3, '尊爵高級雙人單床房', 0, 3, 5, '1 張特大雙人床', '1392.00'),
(15, 3, '標準單人房', 1, 5, 5, '1 張單人床', '991.00'),
(16, 3, '豪華雙人房', 1, 5, 5, '1 張雙人床', '906.00'),
(17, 4, '中房一中床', 1, 4, 5, '1 張加大雙人床', '758.00'),
(18, 4, '標準客房', 1, 4, 5, '1 張特大雙人床', '1646.00'),
(19, 4, '酷景房一中床', 1, 5, 5, '1 張加大雙人床', '971.00'),
(20, 4, '陽台房二單床', 1, 5, 5, '2 張單人床', '1112.00'),
(21, 5, '寰宇客房一大床', 1, 3, 5, '1 張特大雙人床', '2016.00'),
(22, 5, '精緻套房', 1, 4, 5, '1 張特大雙人床', '3747.00'),
(23, 5, '豪華客房一特大床客房', 1, 5, 5, '1 張特大雙人床', '1747.00'),
(24, 5, '高級客房', 1, 5, 5, '1 張特大雙人床', '1635.00'),
(25, 6, '普通套房', 0, 5, 5, '1 張特大雙人床', '1908.00'),
(26, 6, '行政標準客房', 1, 5, 5, '1 張特大雙人床', '1603.00'),
(27, 6, '豪華三人房', 1, 3, 5, '3 張單人床', '1460.00'),
(28, 6, '豪華標準客房', 1, 5, 5, '1 張特大雙人床', '1221.00'),
(29, 6, '豪華雙人房', 0, 5, 5, '2 張單人床', '1259.00'),
(30, 7, '傳統客房', 1, 3, 5, '1 張日式床墊', '724.00'),
(31, 7, '傳統客房 (8 Tatami mat)', 1, 5, 5, '1 張日式床墊', '706.00'),
(32, 8, '傳統客房 (Japanese Style Room)', 1, 5, 5, '4 張日式床墊', '918.00'),
(33, 8, '傳統客房 (Run of the House Japanese Style Room)', 0, 5, 5, '1 張日式床墊', '965.00'),
(34, 9, '普通套房 (B Type)', 0, 5, 5, '2 張單人床', '3175.00'),
(35, 9, '標準小木屋', 1, 5, 5, '4 張床', '3686.00'),
(36, 9, '豪華標準客房 (A Type)', 1, 3, 5, '2 張單人床', '2658.00'),
(37, 9, '豪華標準客房, 轉角', 1, 3, 5, '2 張單人床', '3522.00'),
(38, 10, '雙人房, 1 張雙人床', 1, 5, 5, '1 張雙人床', '680.00'),
(39, 10, '雙人房, 2 張單人床', 1, 5, 5, '2 張單人床', '781.00'),
(40, 11, '標準客房, 露台', 1, 5, 5, '1 張特大雙人床', '4452.00'),
(41, 11, '行政標準客房', 1, 5, 5, '1 張特大雙人床 或 2 張單人床', '3090.00'),
(42, 11, '豪華標準客房', 1, 5, 5, '1 張特大雙人床 或 2 張單人床', '2079.00'),
(43, 11, '開放式客房', 1, 5, 5, '1 張特大雙人床', '2859.00'),
(44, 12, 'Swiss, 行政標準客房', 1, 5, 5, '1 張特大雙人床 或 2 張單人床', '1915.00'),
(45, 12, '標準客房 (Swiss Advantage)', 1, 2, 5, '1 張雙人床或 1 張單人床', '1571.00'),
(46, 12, '經典標準客房', 0, 5, 5, '1 張特大雙人床 或 2 張單人床', '1424.00'),
(47, 12, '頂級標準客房, 1 張特大雙人床', 1, 5, 5, '1 張特大雙人床', '1866.00'),
(48, 13, '公寓, 1 間臥室, 廚房', 1, 5, 5, '1 張加大雙人床', '1328.00'),
(49, 13, '公寓, 2 間臥室, 廚房', 1, 5, 5, '1 張加大雙人床 或 1 張單人床', '1733.00'),
(50, 14, '俱樂部標準客房', 1, 1, 5, '1 張特大雙人床 或 2 張單人床', '2285.00'),
(51, 14, '行政套房, 1 張特大雙人床', 1, 5, 5, '1 張特大雙人床', '2634.00'),
(52, 14, '豪華標準客房', 1, 5, 5, '1 張特大雙人床 或 2 張單人床', '1274.00'),
(53, 14, '高級客房, 海灣景', 0, 5, 5, '1 張特大雙人床', '1182.00'),
(54, 15, 'Caroline Astor Suite, 1 King bed', 0, 5, 5, '1 張特大雙人床', '4732.00'),
(55, 15, 'St. Regis Suite, 1 King Bed', 1, 5, 5, '1 張特大雙人床', '2883.00'),
(56, 15, '豪華標準客房, 1 張特大雙人床', 1, 5, 5, '1 張特大雙人床', '1546.00'),
(57, 15, '頂級標準客房, 1 張特大雙人床', 1, 5, 5, '1 張特大雙人床', '1898.00'),
(58, 16, 'Execuplus Suite, 1 Double or 2 Single Beds', 1, 5, 5, '1 張雙人床 或 2 張單人床', '1137.00'),
(59, 16, '高級單人房', 1, 5, 5, '1 張雙人床 或 2 張單人床', '768.00'),
(60, 16, '高級雙人房', 1, 5, 5, '1 張雙人床 或 2 張單人床', '705.00'),
(61, 17, '套房, 1 間臥室', 0, 5, 5, '1 張特大雙人床', '1281.00'),
(62, 17, '套房, 2 間臥室', 1, 5, 5, '2 張特大雙人床', '2870.00'),
(63, 17, '尊貴標準客房, 1 張特大雙人床', 1, 5, 5, '1 張特大雙人床', '2120.00'),
(64, 17, '豪華標準客房, 1 張特大雙人床', 1, 5, 5, '1 張特大雙人床', '1006.00'),
(65, 18, 'Family with Balcony', 1, 5, 5, '2 張雙人床', '372.00'),
(66, 18, '標準客房, 2 張單人床', 1, 5, 5, '2 張單人床', '196.00'),
(67, 18, '豪華標準客房, 1 張單人床', 1, 5, 5, '1 張單人床', '176.00'),
(68, 18, '豪華標準客房, 1 張雙人床', 1, 5, 5, '1 張雙人床', '244.00'),
(69, 18, '豪華標準客房, 3 張單人床', 1, 5, 5, '3 張單人床', '303.00'),
(70, 19, 'Grand Deluxe', 1, 1, 5, '1 張特大雙人床 或 2 張單人床', '939.00'),
(71, 19, '套房', 1, 5, 5, '1 張特大雙人床及 1 張加大雙人床', '2504.00'),
(72, 19, '套房, 2 間臥室', 1, 5, 5, '1 張特大雙人床及 2 張單人床', '3452.00'),
(73, 20, '一樓客房', 1, 5, 5, '1 張特大雙人床', '3303.00'),
(74, 20, '一特大床客房', 1, 5, 5, '1 張特大雙人床', '1164.00'),
(75, 20, '二單人床客房', 1, 5, 5, '2 張單人床', '1164.00'),
(76, 20, '豪華標準客房', 1, 5, 5, '1 張特大雙人床', '2685.00'),
(77, 21, '一卧室套房', 1, 5, 5, '1 張特大雙人床', '3278.00'),
(78, 21, '特色江景套房', 1, 5, 5, '1 張特大雙人床', '5619.00'),
(79, 21, '費爾蒙房', 1, 5, 5, '1 張特大雙人床 或 2 張加大雙人床', '1873.00'),
(80, 21, '費爾蒙金尊客房', 1, 1, 5, '1 張特大雙人床', '2110.00'),
(81, 22, '帝皇套房', 1, 5, 5, '1 張特大雙人床', '11035.00'),
(82, 22, '皇家套房', 1, 5, 5, '1 張特大雙人床', '48494.00'),
(83, 22, '纯净客房', 1, 5, 5, '1 張特大雙人床', '1341.00'),
(84, 22, '艾美房', 1, 5, 5, '1 張特大雙人床', '1403.00'),
(85, 22, '豪華客房', 1, 5, 5, '1 張特大雙人床 或 2 張單人床', '1153.00'),
(86, 22, '高級豪華房', 1, 5, 5, '1 張特大雙人床 或 2 張單人床', '1278.00'),
(87, 23, '行政標準客房', 1, 5, 5, '1 張特大雙人床 或 2 張單人床', '911.00'),
(88, 23, '行政豪华房', 1, 5, 5, '1 張特大雙人床', '1041.00'),
(89, 23, '豪華大床房', 1, 5, 5, '1 張特大雙人床', '638.00'),
(90, 24, '尊貴套房', 1, 5, 5, '1 張特大雙人床', '5344.00'),
(91, 24, '標準客房', 1, 5, 5, '2 張單人床', '2732.00'),
(92, 24, '豪華套房, 1 張特大雙人床', 1, 5, 5, '1 張特大雙人床', '5344.00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(10) unsigned NOT NULL,
  `user_account` varchar(20) NOT NULL,
  `password` varchar(18) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `passport_no` varchar(15) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `Nationality` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_account`, `password`, `user_email`, `lastname`, `firstname`, `DateOfBirth`, `Gender`, `passport_no`, `contact_no`, `Nationality`) VALUES
(1, 'C001', '123456', 'aaa@aaa.com', 'Chana', 'Chi Ming', '1982-03-15', 'M', 'F1842154', '95215852', 'Chinese'),
(2, 'C002', '123456', 'bbb@bbb.com', 'Wong', 'Chun Tin', '1991-03-31', 'F', 'G6645132', '96254685', 'Chinese'),
(3, 'C003', '123456', 'ccc@ccc.com', 'Tang', 'Tai Chi', '1979-09-24', 'M', 'T2165158', '91254854', 'Chinese'),
(4, 'C004', '123456', 'ddd@ddd.com', 'Man', 'Chi Kuen', '1952-01-18', 'M', 'G2514144', '92548475', 'Chinese'),
(5, 'C005', '123456', 'eee@eee.com', 'Lee', 'Man Tao', '1983-04-16', 'M', 'A1254855', '92165845', 'Chinese'),
(6, 'C006', '123456', 'fff@fff.com', 'Leung', 'Shun Yee', '1991-02-19', 'F', 'B1215485', '91236545', 'Chinese'),
(7, 'C007', '123456', 'ggg@ggg.com', 'Lee', 'Ka Man', '1998-06-05', 'F', 'R2315845', '92548548', 'Chinese'),
(8, 'C008', '123456', 'hhh@hhh.com', 'Lung', 'Chi Kin', '1985-12-06', 'M', 'R1254856', '97584254', 'Chinese'),
(9, 'C009', '123456', 'iii@iii.com', 'Chan', 'Siu Dong', '1973-08-19', 'M', 'G6584251', '94652514', 'Chinese'),
(10, 'C010', '123456', 'jjj@jjj.com', 'Cheung', 'Tai Tim', '1978-08-17', 'M', 'J56698452', '94521575', 'Chinese'),
(11, 'C011', '123456', 'kkk@kkk.com', 'Fung', 'Chi Tak', '1977-02-15', 'M', 'T15515155', '96251675', 'Chinese'),
(12, 'C012', '123456', 'lll@lll.com', 'Chan', 'Man Sheung', '1976-06-18', 'F', 'F21251515', '95462415', 'Chinese'),
(13, 'C0013', '123456', 'kkk@kkk1.com', 'bbb', 'aaa', '0000-00-00', 'M', 'F13516513', '45648613', 'Guatemalan'),
(14, 'C014', '123456', 'fa@hufiahui.com', 'gaasgas', 'asdas', '0000-00-00', 'M', 'D15616516', '345345', 'Afghan'),
(15, 'C014', '123456', 'fa@hufiahui.com', 'gaasgas', 'asdas', '2020-05-07', 'M', 'D15616516', '345345', 'Afghan'),
(16, 'C015', '123456', 'fa@hufiahui.com', 'gaasgas', 'asdas', '2020-05-07', 'M', 'D15616516', '345345', 'Afghan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `airline`
--
ALTER TABLE `airline`
 ADD PRIMARY KEY (`AirlineCode`);

--
-- Indexes for table `flightclass`
--
ALTER TABLE `flightclass`
 ADD PRIMARY KEY (`flight_no`,`flightclass_type`), ADD KEY `idx_flightclass_AirlineCode` (`AirlineCode`);

--
-- Indexes for table `flightorder`
--
ALTER TABLE `flightorder`
 ADD PRIMARY KEY (`flight_order_id`,`flight_no`,`DepDateTime`), ADD KEY `idx_fb_flightschedule` (`flight_no`,`DepDateTime`), ADD KEY `idx_fb_flightclass` (`flight_no`,`flightclass_type`), ADD KEY `fk_fb_customer` (`user_id`);

--
-- Indexes for table `flightschedule`
--
ALTER TABLE `flightschedule`
 ADD PRIMARY KEY (`flight_no`,`DepDateTime`), ADD KEY `idx_fs_FlightNp` (`flight_no`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
 ADD PRIMARY KEY (`hotel_id`), ADD UNIQUE KEY `ChiName_unique` (`chiName`), ADD UNIQUE KEY `EngName_unique` (`engName`);

--
-- Indexes for table `hotelorder`
--
ALTER TABLE `hotelorder`
 ADD PRIMARY KEY (`hotel_order_id`), ADD KEY `idx_hb_user_id` (`user_id`), ADD KEY `fk_ho_room_id` (`room_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
 ADD PRIMARY KEY (`package_id`), ADD KEY `fk_pk_flightclass` (`flight_no`,`flightclass_type`), ADD KEY `fk_pk_flightschedule` (`flight_no`,`DepDateTime`);

--
-- Indexes for table `packageorder`
--
ALTER TABLE `packageorder`
 ADD PRIMARY KEY (`package_order_id`), ADD KEY `fk_po_user_id` (`user_id`), ADD KEY `fk_po_package_id` (`package_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
 ADD PRIMARY KEY (`room_id`), ADD KEY `idx_room_HotelID` (`hotel_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `flightorder`
--
ALTER TABLE `flightorder`
MODIFY `flight_order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `hotelorder`
--
ALTER TABLE `hotelorder`
MODIFY `hotel_order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
MODIFY `package_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `packageorder`
--
ALTER TABLE `packageorder`
MODIFY `package_order_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
MODIFY `room_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `flightclass`
--
ALTER TABLE `flightclass`
ADD CONSTRAINT `fk_flightclass_AirlineCode` FOREIGN KEY (`AirlineCode`) REFERENCES `airline` (`AirlineCode`);

--
-- Constraints for table `flightorder`
--
ALTER TABLE `flightorder`
ADD CONSTRAINT `fk_fb_customer` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
ADD CONSTRAINT `fk_fb_flightclass` FOREIGN KEY (`flight_no`, `flightclass_type`) REFERENCES `flightclass` (`flight_no`, `flightclass_type`),
ADD CONSTRAINT `fk_fb_flightschedule` FOREIGN KEY (`flight_no`, `DepDateTime`) REFERENCES `flightschedule` (`flight_no`, `DepDateTime`);

--
-- Constraints for table `flightschedule`
--
ALTER TABLE `flightschedule`
ADD CONSTRAINT `fk_fs_flightclass` FOREIGN KEY (`flight_no`) REFERENCES `flightclass` (`flight_no`);

--
-- Constraints for table `hotelorder`
--
ALTER TABLE `hotelorder`
ADD CONSTRAINT `fk_ho_room_id` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
ADD CONSTRAINT `fk_ho_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `package`
--
ALTER TABLE `package`
ADD CONSTRAINT `fk_pk_flightclass` FOREIGN KEY (`flight_no`, `flightclass_type`) REFERENCES `flightclass` (`flight_no`, `flightclass_type`),
ADD CONSTRAINT `fk_pk_flightschedule` FOREIGN KEY (`flight_no`, `DepDateTime`) REFERENCES `flightschedule` (`flight_no`, `DepDateTime`);

--
-- Constraints for table `packageorder`
--
ALTER TABLE `packageorder`
ADD CONSTRAINT `fk_po_package_id` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`),
ADD CONSTRAINT `fk_po_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
ADD CONSTRAINT `fk_room_HotelID` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
