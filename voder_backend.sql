-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2015 at 03:27 AM
-- Server version: 5.5.41-cll-lve
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `voder_backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_type`
--

CREATE TABLE IF NOT EXISTS `bank_type` (
  `bankTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bsb` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `partnerID` int(11) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bankTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `bank_type`
--

INSERT INTO `bank_type` (`bankTypeID`, `name`, `number`, `bsb`, `partnerID`, `inactive`) VALUES
(1, 'DongA Bank', '15979765456798', '5548745415KJ', 9, 0),
(2, 'VietComBank', '15979765456798', '5548745415KJ', 10, 0),
(3, 'VietComBank', '55726856798', 'D5487156416', 11, 0),
(4, 'VietComBank', '55726856798', 'D5487156416', 12, 0),
(5, 'Dong A Bank', '258475848758', 'KD2354562346F', 2, 0),
(6, 'OCB', '2018-12-28', 'KD63466447647', 8, 0),
(7, 'Commonwealth', '94831993', '045321', 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `businessID` int(11) NOT NULL AUTO_INCREMENT,
  `partnerID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text,
  `longtitude` varchar(10) DEFAULT NULL,
  `latitude` varchar(10) DEFAULT NULL,
  `image` text,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`businessID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`businessID`, `partnerID`, `name`, `address`, `longtitude`, `latitude`, `image`, `inactive`) VALUES
(1, 2, 'KFC Tan Binh', '1 Hoang Hoa Tham', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0),
(4, 8, 'McDonald''s', '127/10 Hoang Hoa Tham', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0),
(5, 9, 'Loteria AAA', '50/12 Ho Nai BH-DN', '16.1667', '108.3333', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0),
(6, 23, 'aa1112224444', 'fff', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(7, 23, 'aaaddd', 'ddd', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(8, 23, '111', 'sss', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(9, 23, 'vvv', 'ccc', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(10, 23, 'a', 'c', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(11, 23, 'dd', 'as', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(12, 23, 'dfsd', '23', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(13, 23, '33', '32', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(14, 23, 'aaaa11111', 'fff', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(15, 23, 'vvv', 'ccc', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(16, 23, 'aaaddd', 'ddd', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(17, 23, '111', 'sss', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(18, 23, 'a00', 'Update address', '10.9500', '106.8167', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(19, 23, 'tiep', '12345623423', '-122.40641', '37.785834', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0),
(20, 23, 'Giang', 'abc456', '-122.40641', '37.785834', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0),
(21, 23, 'Khoa', 'HCM Q.9', '-122.40641', '37.785834', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(22, 60, 'tiep', '123', '0.000000', '0.000000', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0),
(23, 62, 'aaaaaa', '123', '0.000000', '0.000000', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(24, 62, 'aaaaaa', 'bbbbbbb', '0.000000', '0.000000', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1),
(25, 62, 'bbb', '123', '0.000000', '0.000000', '', 1),
(26, 62, 'ccc', '12334', '0.000000', '0.000000', '', 1),
(27, 62, 'ee', '12', '0.000000', '0.000000', '', 1),
(28, 62, 'ttt', '1231', '0.000000', '0.000000', '', 1),
(29, 62, 'rr', '12', '0.000000', '0.000000', '', 1),
(30, 62, 'nn', '12', '0.000000', '0.000000', 'image/business_image_30.png', 1),
(31, 62, 'aa', '12', '0.000000', '0.000000', 'image/business_image_31.png', 1),
(32, 62, '123123', 'safasf', '0.000000', '0.000000', 'image/business_image_32.png', 1),
(33, 62, '11113', '2223', '0.000000', '0.000000', 'http://www.appsun.com.au/voderbackend/http://www.appsun.com.au/voderbackend/image/business_image_33.png', 1),
(34, 62, 'aaa', '123', '0.000000', '0.000000', 'image/business_image_34.png', 1),
(35, 62, 'bbb', 'sss', '0.000000', '0.000000', 'image/business_image_35.png', 1),
(36, 62, '', '', '0.000000', '0.000000', 'image/business_image_36.png', 1),
(37, 62, 'abc', '234', '0.000000', '0.000000', 'image/business_image_37.png', 1),
(38, 62, 'abc', '234', '0.000000', '0.000000', 'image/business_image_38.png', 1),
(39, 62, 'sds', 'asdfas', '0.000000', '0.000000', 'image/business_image_39.png', 1),
(40, 62, 'aaa', 'ddd', '0.000000', '0.000000', 'image/business_image_40.png', 1),
(41, 62, 'aaa', 'sss', '0.000000', '0.000000', 'image/business_image_41.png', 1),
(42, 62, 'ss', 'sss', '0.000000', '0.000000', 'image/business_image_42.png', 1),
(43, 62, 's', 'as', '0.000000', '0.000000', 'image/business_image_43.png', 1),
(44, 62, 'as', 'daf', '0.000000', '0.000000', 'image/business_image_44.png', 1),
(45, 62, 'fasd', 'a', '0.000000', '0.000000', 'image/business_image_45.png', 1),
(46, 62, 'fasd', 'ssss', '0.000000', '0.000000', 'image/business_image_46.png', 1),
(47, 62, 'd', 'd', '0.000000', '0.000000', 'image/business_image_47.png', 0),
(48, 62, 't', 't', '0.000000', '0.000000', 'image/business_image_48.png', 0),
(49, 62, 'dd', 'dd', '0.000000', '0.000000', 'image/business_image_49.png', 0),
(50, 62, 'tt', 'tt', '0.000000', '0.000000', 'image/business_image_50.png', 0),
(51, 62, 'ddd', 'ddd', '0.000000', '0.000000', 'image/business_image_51.png', 1),
(52, 62, 'ttt', 'ttt', '0.000000', '0.000000', 'image/business_image_52.png', 0),
(53, 62, 'tttt', 'tttt', '0.000000', '0.000000', 'image/business_image_53.png', 0),
(54, 62, 'dddd', 'dddd', '0.000000', '0.000000', 'image/business_image_54.png', 0),
(55, 62, 'ddddd', 'ddddd', '0.000000', '0.000000', 'image/business_image_55.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `card_type`
--

CREATE TABLE IF NOT EXISTS `card_type` (
  `cardTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` date NOT NULL,
  `ccv` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `customerID` int(11) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cardTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `card_type`
--

INSERT INTO `card_type` (`cardTypeID`, `name`, `number`, `expire_date`, `ccv`, `customerID`, `inactive`) VALUES
(1, 'Vietcombank', '01534689574587', '2015-12-20', '1234564654dg878', 17, 0),
(2, 'DongA', '451265879', '2016-06-17', 'c4adbd442df22a73864e', 37, 0),
(3, 'Sacombank', '5646547498789415', '2016-06-17', '2165798DF56498', 43, 0),
(4, 'Sacombank', '4565498711646', '2015-12-20', '545dasdg4', 44, 0),
(5, 'Khoa Edward', '9494125112912911', '0000-00-00', '991', 77, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `isSendEmail` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=100 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `firstName`, `lastName`, `email`, `phone`, `password`, `birthday`, `address`, `image`, `inactive`, `isSendEmail`) VALUES
(17, 'giang update', 'pham', 'shinichi1692@gmail.com', '0976135377', 'f4ad231214cb99a985dff0f056a36242', '2014-11-30', '127/10 hoang hoa tham, tan binh, tp hcm', 'image/customer_17.jpg', 0, 1),
(42, 'Quynh', 'Nhu', 'quynhnhu@gmail.com', '0973359085', 'f4ad231214cb99a985dff0f056a36242', '2014-05-06', NULL, 'image/default.jpg', 0, 1),
(43, 'Trang', 'Pham', 'trangpham@gmail.com', '0987546875', 'f4ad231214cb99a985dff0f056a36242', NULL, NULL, NULL, 1, 1),
(44, 'Quyen', 'Pham', 'quyenpham@gmail.com', '01646877221', 'f4ad231214cb99a985dff0f056a36242', NULL, NULL, NULL, 0, 1),
(45, 'Kelvin', NULL, 'kelvin@appsun.com.au', '+61423946092', '1b449b62b91483c927ddca95e5ab8d8a', NULL, NULL, NULL, 0, 1),
(46, 'John', 'Cleland', 'John.cleland@gmail.com', '0434 446 192', '6c1c95eaa6bdc42142824da8df75b982', NULL, NULL, NULL, 0, 1),
(47, 'John', '', 'info@japancuisine.com.au', '', '6c1c95eaa6bdc42142824da8df75b982', NULL, NULL, NULL, 0, 1),
(48, 'giangpham', '', 'shinichi1693@gmail.com', '0976135377', 'f4ad231214cb99a985dff0f056a36242', NULL, NULL, 'image/customer_48.jpg', 0, 1),
(49, 'giang', 'pham', 'shinichi1694@gmail.com', '0983358025', 'f4ad231214cb99a985dff0f056a36242', NULL, NULL, 'image/customer_49.jpg', 0, 1),
(50, 'sdfs', 'fsad', '111', '34', '4124bc0a9335c27f086f24ba207a4912', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0),
(51, 'dsf', 'ass', 'aa', 'af', '47bce5c74f589f4867dbd57e9ca9f808', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0),
(52, 'dfs', 'fs', 's', 'f23', '0cc175b9c0f1b6a831c399e269772661', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0),
(53, '2', '2', 'a', '3', '8277e0910d750195b448797616e091ad', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0),
(54, 's', 's', 'd', 'df', '6226f7cbe59e99a90b5cef6f94f966fd', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0),
(55, '5', '5', '3', '6', 'a87ff679a2f3e71d9181a67b7542122c', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0),
(56, 'fd', 'fd', 'ds', 's', '8277e0910d750195b448797616e091ad', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_56.png', 0, 0),
(57, 'fd', 'fd', 'ds', 's', '8277e0910d750195b448797616e091ad', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0),
(58, 'aaa', 'bbb', 'tiep', '123', '27ff2ffe376b2edcc7c2de309173f0d8', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_58.png', 0, 0),
(59, 'aa', 'asd', 'adf', '32', '202cb962ac59075b964b07152d234b70', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_59.png', 0, 0),
(60, '333', '444', '1111', '555', 'bcbe3365e6ac95ea2c0343a2395834dd', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_60.png', 0, 0),
(61, '44', '55', '111', '666', 'b6d767d2f8ed5d21a44b0e5886680cb9', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_61.png', 0, 0),
(62, 'fas', 'fd', 'aaa', '32', '08f8e0260c64418510cefb2b06eee5cd', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_62.png', 0, 0),
(63, '333', '344', '111', '555', 'bcbe3365e6ac95ea2c0343a2395834dd', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_63.png', 0, 0),
(64, '333', '344', '111', '555', 'bcbe3365e6ac95ea2c0343a2395834dd', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_64.png', 0, 0),
(65, '333', '344', '111', '555', 'bcbe3365e6ac95ea2c0343a2395834dd', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_65.png', 0, 0),
(66, '333', '344', '111', '555', 'bcbe3365e6ac95ea2c0343a2395834dd', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_66.png', 0, 0),
(67, '333', '445', '11', '5', 'bcbe3365e6ac95ea2c0343a2395834dd', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_67.png', 0, 0),
(68, '333', '445', '11', '5', 'bcbe3365e6ac95ea2c0343a2395834dd', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_68.png', 0, 0),
(69, '333', '445', '11', '5', 'bcbe3365e6ac95ea2c0343a2395834dd', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_69.png', 0, 0),
(70, '333', '445', '11', '5', 'bcbe3365e6ac95ea2c0343a2395834dd', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_70.png', 0, 0),
(71, '3', '3', '111', '4', 'bcbe3365e6ac95ea2c0343a2395834dd', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_71.png', 0, 0),
(72, '5', '6', '23', '7', 'c81e728d9d4c2f636f067f89cc14862c', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_72.png', 0, 0),
(73, '5', '6', '23', '7', 'c81e728d9d4c2f636f067f89cc14862c', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_73.png', 0, 0),
(74, '5', '6', '23', '7', 'c81e728d9d4c2f636f067f89cc14862c', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0),
(75, 's', 'd', '222', 'd', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_75.png', 0, 0),
(76, 's', 'd', '222', 'd', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_76.png', 0, 0),
(77, 'Khoa', '', 'kelvin.ngo9712@gmail.com', '0423949393', '6c1c95eaa6bdc42142824da8df75b982', NULL, NULL, 'image/customer_image77.jpg', 0, 0),
(78, 'tiep', 'nguyen', 'tiep@g.com', '12312312312', '6343f6f600f998ca3075eacea9799c2e', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_78.png', 0, 0),
(79, 'tiep', 'nguyen', 'tiep@g.com', '12312312312', '6343f6f600f998ca3075eacea9799c2e', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_79.png', 0, 0),
(80, '', '', 'kelvin.ngo9712@gmail.com', '', '6c1c95eaa6bdc42142824da8df75b982', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_80.png', 0, 0),
(81, '', '', 'kelvin.ngo9712@gmail.com', '', '6c1c95eaa6bdc42142824da8df75b982', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_81.png', 0, 0),
(82, '', '', 'kelvin.ngo9712@gmail.com', '', '6c1c95eaa6bdc42142824da8df75b982', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_82.png', 0, 0),
(83, 'tiep', 'nguyen', 'anhtiep', '1231231', '202cb962ac59075b964b07152d234b70', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_83.png', 0, 0),
(84, 'kelvin', '', 'kelvin.ngo9712@gmail.com', '', '6c1c95eaa6bdc42142824da8df75b982', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_84.png', 0, 0),
(85, 'kelvin', '', 'kelvin.ngo9712@gmail.com', '', '6c1c95eaa6bdc42142824da8df75b982', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_85.png', 0, 0),
(86, 'kelvin', '', 'kelvin.ngo9712@gmail.com', '', '6c1c95eaa6bdc42142824da8df75b982', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_86.png', 0, 0),
(87, '123', 'sdf', 'aaa', '423', '0cc175b9c0f1b6a831c399e269772661', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_87.png', 0, 0),
(88, '123', 'sdf', 'aaa', '423', '0cc175b9c0f1b6a831c399e269772661', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_88.png', 0, 0),
(89, '', '', 'cho', '', '202cb962ac59075b964b07152d234b70', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_89.png', 0, 0),
(90, '', '', 'tiep@g.com', '', '202cb962ac59075b964b07152d234b70', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_90.png', 0, 0),
(91, '', '', 'tiep@g.com', '', '202cb962ac59075b964b07152d234b70', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_91.png', 0, 0),
(92, '', '', 'vit@g.com', '', '202cb962ac59075b964b07152d234b70', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_92.png', 0, 0),
(93, '', '', 'cool', '', '202cb962ac59075b964b07152d234b70', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0),
(94, '', '', 'cool1', '', '202cb962ac59075b964b07152d234b70', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0),
(95, '', '', 'heo1', '', '202cb962ac59075b964b07152d234b70', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0),
(96, '', '', 'abc', '', '202cb962ac59075b964b07152d234b70', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_96.png', 0, 0),
(97, '', '', 'quoc2', '', '202cb962ac59075b964b07152d234b70', '1988-05-12', '54/19 Tan Binh HCM', 'image/customer_image_97.png', 0, 0),
(98, '', '', 'c1', '', 'c6c16464a41697d3e43e7af65660bc9f', '1970-01-01', '54/19 Tan Binh HCM', 'image/customer_image_98.png', 0, 0),
(99, '', '', 'c11', '', '202cb962ac59075b964b07152d234b70', '1970-01-01', '54/19 Tan Binh HCM', 'image/customer_image_99.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemID`, `title`, `description`, `image`, `price`, `quantity`, `inactive`) VALUES
(1, 'C-Lemon', 'Its good for your health', '', 9, 0, 0),
(2, 'C-Lemon2', 'Its good for your health2', '', 92, 0, 0),
(3, '333', 'abc', 'image/item_image_3.jpg', 15, 100, 0),
(4, 'pizza', 'abc', '', 15, 100, 0),
(5, 'biscuits', 'abc', '', 15, 100, 0),
(6, 'Vodka', 'Alcohol 39', '', 18, 0, 0),
(7, 'Rice', 'rice', '', 20, 0, 0),
(8, 'Orange', 'fruite', '', 16, 0, 0),
(9, 'Buppaa', 'alcoholic', '', 9, 0, 1),
(10, 'abc', 'def', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 12, 1, 0),
(11, 'cam', 'cam vat tuoi', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 5, 1, 0),
(12, 'aaaa', 'dsfasd', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 12, 1, 0),
(31, 'ooooo', 'hhh', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 99, 1, 0),
(30, 'C-Lemon', 'It''s good for your health', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 9, 2, 0),
(29, 'C-Lemon', 'It''s good for your health', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 9, 2, 0),
(28, 'C-Lemon', 'It''s good for your health', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 9, 2, 0),
(27, 'C-Lemon', 'It''s good for your health', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 9, 2, 0),
(26, 'C-Lemon', 'It''s good for your health', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 9, 2, 0),
(25, 'aaa', '', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 234, 1, 0),
(24, 'aaa', 'fasd', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 234, 1, 0),
(23, 'C-Lemon', 'Its good for your health', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 9, 2, 0),
(32, 'yyyyy', 'jkl', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 9, 1, 0),
(33, '111', 'aa', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 2, 1, 0),
(34, 'apple', '123', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 1, 0),
(35, '123', 'anhtiep', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 123, 1, 0),
(36, 'keo', 'Ã¡da', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 11, 1, 0),
(37, 'kem', '231231', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 21, 1, 0),
(38, 'aaa', 'bbb', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 22, 1, 0),
(39, 'asd', 'sdf', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 33, 1, 0),
(40, 'tao', '123', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 12, 1, 0),
(41, 'chuoi', '123', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 33, 1, 0),
(42, 'cam', '123', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 324, 1, 0),
(43, '', '', '', 0, 0, 0),
(44, 'Italian Salads ', 'Veg, Eggs, onions, Italian dressing', 'image/item_image_44.jpg', 8, 0, 0),
(45, 'Hot Tofu', 'Serve with hot sugars', 'image/item_image_45.jpg', 6, 0, 0),
(46, '123', '222', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 1, 1),
(47, '123', 'asdfas', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 23, 1, 1),
(48, 'mm', 'mm', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 9, 1, 1),
(49, 'k', 'k', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 9, 1, 1),
(50, '33', '33', '', 33, 1, 1),
(51, 'ss', 'ss', '', 3, 1, 1),
(52, '33', '2', 'image/item_image_52.png', 3, 1, 0),
(53, 'fsda', 'sadfas', 'image/item_image_53.png', 3, 1, 0),
(54, 'Ty', 'Tt', 'image/item_image_54.png', 5555, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_detail`
--

CREATE TABLE IF NOT EXISTS `item_detail` (
  `itemDetailID` int(11) NOT NULL AUTO_INCREMENT,
  `menuID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemDetailID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `item_detail`
--

INSERT INTO `item_detail` (`itemDetailID`, `menuID`, `itemID`, `inactive`) VALUES
(41, 13, 42, 0),
(40, 13, 41, 0),
(3, 1, 3, 0),
(4, 2, 4, 0),
(5, 1, 5, 0),
(6, 5, 6, 0),
(7, 6, 6, 0),
(8, 3, 8, 0),
(9, 2, 9, 1),
(53, 18, 54, 0),
(52, 18, 53, 0),
(51, 18, 52, 0),
(50, 18, 51, 0),
(49, 18, 50, 0),
(48, 18, 49, 0),
(47, 18, 48, 0),
(46, 18, 47, 0),
(45, 18, 46, 0),
(44, 15, 45, 0),
(43, 2, 44, 0),
(42, 6, 43, 0),
(39, 3, 23, 0),
(38, 2, 23, 0),
(37, 1, 23, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `businessID` int(11) DEFAULT NULL,
  `groupName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menuID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuID`, `businessID`, `groupName`, `inactive`) VALUES
(1, 1, 'Drink', 0),
(2, 1, 'Food', 0),
(3, 1, 'Desert', 0),
(4, 5, 'Popular', 0),
(5, 5, 'Drink', 0),
(6, 4, 'Popular', 0),
(7, 6, 'bbb123dsaf', 0),
(8, 6, 'bbb', 1),
(9, 6, 'ac1231231', 1),
(10, 6, 'aaabbbcccccgg', 0),
(11, 6, 'bbaa123', 0),
(12, 19, 'foods', 1),
(13, 19, 'drinks', 0),
(14, 19, 'popular', 0),
(15, 1, 'Extra', 0),
(16, 47, 'aaabbb', 1),
(17, 47, 'nbbb', 1),
(18, 47, 'tipeddsfdsf', 0),
(19, 47, 'nnn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
  `partnerID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `role` int(11) NOT NULL DEFAULT '1',
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `isSendEmail` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`partnerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=66 ;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`partnerID`, `firstName`, `lastName`, `email`, `password`, `phone`, `birthday`, `address`, `image`, `role`, `inactive`, `isSendEmail`) VALUES
(1, 'adminupdate1', '', 'pvgiang106@gmail.com', '7488e331b8b64e5794da3fa4eb10ad5d', '0976135377', '1991-11-06', '127/10 Hoang Hoa Tham', 'image/default.jpg', 0, 0, 1),
(2, 'giang pham update', '', 'giangpham@hdexpertise.com', '3c0d9364bee6c8e4e71a2aecdc6cf57f', '0973359085', '1991-05-06', 'phu nhuan', 'image/partner_2.jpg', 1, 0, 1),
(8, 'Kelvin Ngo', '', 'Kelvinngo@gmail.com', '3c0d9364bee6c8e4e71a2aecdc6cf57f', '03 9582 9331', '1991-05-06', 'Melbourne Australia', 'image/partner_image_8.jpg', 1, 0, 1),
(9, 'Anh Tiep', '', 'tiep@gmail.com', '3c0d9364bee6c8e4e71a2aecdc6cf57f', '097584257', NULL, 'Ho Nai, Dong Nai', 'image/default.jpg', 1, 1, 1),
(14, 'Test partner', '', 'testpartner@gmail.com', '3c0d9364bee6c8e4e71a2aecdc6cf57f', '02458794687', NULL, 'Phu Nhuan', NULL, 1, 0, 1),
(15, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', NULL, '', NULL, 1, 1, 0),
(16, 'Taiwan Cuisine', '', 'Taiwain@cuisinse.com', '6c1c95eaa6bdc42142824da8df75b982', '03 9487 3332', NULL, '45 smith street brunkswick VIC 3010', 'image/partner_image_16.jpg', 1, 0, 1),
(17, 'Tiep123', 'Nguyen', 'anhtiep', '6343f6f600f998ca3075eacea9799c2e', '23423424', '1988-05-12', '54/19 Tan Binh HCM', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 0, 0, 0),
(18, 'undefined', 'undefined', 'anhtiep1', 'd41d8cd98f00b204e9800998ecf8427e', '111', '1988-05-12', '54/19 Tan Binh HCM111', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0),
(19, 'undefined', 'undefined', 'aaa', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_19.jpg', 1, 1, 0),
(20, 'undefined', 'undefined', '111', '698d51a19d8a121ce581499d7b701668', '', '1988-05-12', '54/19 Tan Binh HCM111', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0),
(21, 'undefined', 'undefined', 'qqq', 'b2ca678b4c936f905fb82f2733f5297f', '', '1988-05-12', '54/19 Tan Binh HCM111', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0),
(22, 'nnn', 'bbb', 'kkk', '202cb962ac59075b964b07152d234b70', '1213123', '1988-05-12', '54/19 Tan Binh HCM111', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0),
(23, 'Kim', 'Anh', 'kim', '8fdac70409263192d07064c9bcc78c7a', '999', '1988-05-12', '54/19 Tan Binh HCM', 'image/partner_image_23.png', 1, 0, 0),
(24, 'tiep', 'nguyen', 'tiep', '202cb962ac59075b964b07152d234b70', '90', '1988-05-12', '54/19 Tan Binh HCM111', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0),
(25, 'giangpham', '', 'shinichi1691@gmail.com', '286676cc08e2680058cb45d6adb8ced2', '0976135377', NULL, 'Phu Nhuan', 'image/partner_25.jpg', 1, 0, 1),
(26, '3', '3', 'd', 'c81e728d9d4c2f636f067f89cc14862c', '222', '1988-05-12', '54/19 Tan Binh HCM111', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0),
(27, '123', '123', '123', '202cb962ac59075b964b07152d234b70', '123', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_27.png', 1, 0, 0),
(28, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_28.png', 1, 0, 0),
(29, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_29.png', 1, 0, 0),
(30, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0),
(31, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0),
(32, 'kelvin', 'ngo', 'kelvin.ngo9712@gmail.com', '6c1c95eaa6bdc42142824da8df75b982', '0425325963', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_32.png', 1, 0, 0),
(33, 'kelvin', 'ngo', 'kelvin.ngo9712@gmail.com', '6c1c95eaa6bdc42142824da8df75b982', '0425325963', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_33.png', 1, 0, 0),
(34, 'kelvin', 'ngo', 'kelvin.ngo9712@gmail.com', '6c1c95eaa6bdc42142824da8df75b982', '0425325963', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_34.png', 1, 0, 0),
(35, 'kelvin', 'ngo', 'kelvin.ngo9712@gmail.com', '6c1c95eaa6bdc42142824da8df75b982', '0425325963', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_35.png', 1, 0, 0),
(36, 'kelvin', 'ngo', 'kelvin.ngo9712@gmail.com', '6c1c95eaa6bdc42142824da8df75b982', '0425325963', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_36.png', 1, 0, 0),
(37, 'kelvin', 'ngo', 'kelvin.ngo9712@gmail.com', '6c1c95eaa6bdc42142824da8df75b982', '0425325963', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_37.png', 1, 0, 0),
(38, 'kelvin', 'ngo', 'kelvin.ngo9712@gmail.com', '6c1c95eaa6bdc42142824da8df75b982', '0425325963', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_38.png', 1, 0, 0),
(39, 'kelvin', 'ngo', 'kelvin.ngo9712@gmail.com', '6c1c95eaa6bdc42142824da8df75b982', '0425325963', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_39.png', 1, 0, 0),
(40, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_40.png', 1, 0, 0),
(41, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_41.png', 1, 0, 0),
(42, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_42.png', 1, 0, 0),
(43, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_43.png', 1, 0, 0),
(44, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_44.png', 1, 0, 0),
(45, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_45.png', 1, 0, 0),
(46, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_46.png', 1, 0, 0),
(47, 'anh', 'tiep', 'tiep', '202cb962ac59075b964b07152d234b70', '234', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_47.png', 1, 0, 0),
(48, '', '', 'heo', '202cb962ac59075b964b07152d234b70', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_48.png', 1, 0, 0),
(49, '', '', 'ga', '202cb962ac59075b964b07152d234b70', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_49.png', 1, 0, 0),
(50, 'meo', 'con', 'meo@meo.com', '202cb962ac59075b964b07152d234b70', '2342', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_50.png', 1, 0, 0),
(51, 'Kelvin', 'Ngo', 'kelvin@gmail.com', 'b2c6de510d584484d74c9aa9f8fa9f04', '1231231231', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_51.png', 1, 0, 0),
(52, 'kelvin', 'ngo', 'kelvin.ngo9712@gmail.com', '6c1c95eaa6bdc42142824da8df75b982', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_52.png', 1, 0, 0),
(53, 'kelvin', 'ngo', 'kelvin.ngo9712@gmail.com', '6c1c95eaa6bdc42142824da8df75b982', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_53.png', 1, 0, 0),
(54, 'kelvin', 'ngo', 'kelvin@appsun.com.au', '6c1c95eaa6bdc42142824da8df75b982', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_54.png', 1, 0, 0),
(55, '', '', 'gau@g.com', '202cb962ac59075b964b07152d234b70', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_55.png', 1, 0, 0),
(56, '', '', 'vit1@g.com', '202cb962ac59075b964b07152d234b70', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_56.png', 1, 0, 0),
(57, '', '', 'teo', 'd41d8cd98f00b204e9800998ecf8427e', '', '1988-05-12', '54/19 Tan Binh HCM', 'image/partner_image_57.png', 1, 0, 0),
(58, '', '', 'quoc1', '202cb962ac59075b964b07152d234b70', '', '1988-05-12', '54/19 Tan Binh HCM111', 'image/partner_image_58.png', 1, 0, 0),
(59, '', '', 'quoc3', '202cb962ac59075b964b07152d234b70', '', '1988-05-12', '54/19 Tan Binh HCM111', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0),
(60, 'tiep', 'nguyen', 'tiep1', 'd9b1d7db4cd6e70935368a1efb10e377', '0999999999', '1970-01-01', '54/19 Tan Binh HCM', 'http://www.appsun.com.au/voderbackend/http://www.appsun.com.au/voderbackend/http://www.appsun.com.au/voderbackend/image/partner_image_60.png', 1, 0, 0),
(61, 'aaaaa', '111', 'a@a.com', '202cb962ac59075b964b07152d234b70', '23423423', '1988-05-12', '54/19 Tan Binh HCM', 'image/partner_image_61.png', 1, 0, 0),
(62, 'tiep', 'nguyen', 'tiep2', 'd9b1d7db4cd6e70935368a1efb10e377', '0988888888', '1970-01-01', '54/19 Tan Binh HCM', 'http://www.appsun.com.au/voderbackend/http://www.appsun.com.au/voderbackend/http://www.appsun.com.au/voderbackend/image/partner_image_62.png', 1, 0, 0),
(63, '', '', 'p11', '202cb962ac59075b964b07152d234b70', '', '1970-01-01', '54/19 Tan Binh HCM111', 'http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0),
(64, 'tiep11', 'nguyen11', 'tiep3', '456', '0999999999', '1970-01-01', '54/19 Tan Binh HCM', 'http://www.appsun.com.au/voderbackend/http://www.appsun.com.au/voderbackend/http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0),
(65, 'tiep11', 'nguyen11', 'tiep4', '202cb962ac59075b964b07152d234b70', '090000000011', '1970-01-01', '54/19 Tan Binh HCM', 'http://www.appsun.com.au/voderbackend/http://www.appsun.com.au/voderbackend/http://www.appsun.com.au/voderbackend/http://www.appsun.com.au/voderbackend/http://findicons.com/files/icons/1239/sticker_2/128/apple.png', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionID` int(11) NOT NULL AUTO_INCREMENT,
  `businessID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `dateTime` datetime DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `note` text COLLATE utf8_unicode_ci,
  `paymentMethod` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `totalCost` double DEFAULT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`transactionID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `businessID`, `customerID`, `dateTime`, `description`, `note`, `paymentMethod`, `totalCost`, `inactive`) VALUES
(1, 1, 17, '2014-12-03 00:00:00', 'test transaction', 'first transaction', 'Card', 170, 0),
(2, 1, 17, '2014-12-02 17:00:00', 'test', 'anh tiep', 'Card', 120, 0),
(3, 1, 17, '2015-01-20 16:27:37', 'mmmmmmmmmmmmmmm', 'kkkkkkkkkkkkkkk', 'vvvvvvvvvvvvvvv', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE IF NOT EXISTS `transaction_detail` (
  `transactionDetailID` int(11) NOT NULL AUTO_INCREMENT,
  `transactionID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`transactionDetailID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`transactionDetailID`, `transactionID`, `itemID`, `quantity`, `inactive`, `title`, `description`, `image`, `price`) VALUES
(1, 1, 1, 3, 0, 'tiger', 'abc', '', 15),
(2, 1, 2, 8, 0, 'saigon', 'abc', '', 15),
(3, 1, 4, 2, 0, 'pizza', 'abc', '', 15),
(4, 2, 1, 2, 0, 'C-Lemon', 'Its good for your health', '', 9),
(5, 2, 2, 4, 0, 'C-Lemon2', 'Its good for your health2', '', 92),
(6, 3, 1, 2, 0, 'C-Lemon', 'Its good for your health', '', 9),
(7, 3, 2, 4, 0, 'C-Lemon2', 'Its good for your health2', '', 92);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
