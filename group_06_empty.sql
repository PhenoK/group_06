-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-05-21 18:47:00
-- 伺服器版本: 10.1.10-MariaDB
-- PHP 版本： 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `group_06`
--
CREATE DATABASE IF NOT EXISTS `group_06` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `group_06`;

-- --------------------------------------------------------

--
-- 資料表結構 `3c`
--

CREATE TABLE `3c` (
  `id` int(10) NOT NULL COMMENT 'from product_id',
  `warranty` int(10) NOT NULL COMMENT '保固月份'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `book`
--

CREATE TABLE `book` (
  `id` int(10) NOT NULL COMMENT '書本編號',
  `lang` tinytext COLLATE utf8_unicode_ci NOT NULL COMMENT '書本語言',
  `category` tinytext COLLATE utf8_unicode_ci NOT NULL COMMENT '書本類型',
  `author` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '作者',
  `translator` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '譯者',
  `publisher` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '出版商',
  `publish_date` date NOT NULL COMMENT '出版日',
  `isbn` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ISBN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `game`
--

CREATE TABLE `game` (
  `id` int(10) NOT NULL,
  `category` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `lang` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `sale_date` date NOT NULL,
  `company` tinytext COLLATE utf8_unicode_ci,
  `platform` tinytext COLLATE utf8_unicode_ci,
  `multi_player` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `id` int(10) NOT NULL COMMENT '會員編號',
  `account` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT '會員帳號',
  `password` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT '密碼',
  `name` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `sex` enum('M','F') COLLATE utf8_unicode_ci NOT NULL COMMENT '性別',
  `birth` date NOT NULL COMMENT '生日',
  `tel_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '電話號碼',
  `addr` tinytext COLLATE utf8_unicode_ci COMMENT '地址',
  `mail` tinytext COLLATE utf8_unicode_ci NOT NULL COMMENT '電子郵件',
  `nickname` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '暱稱',
  `level` tinyint(3) NOT NULL DEFAULT '1' COMMENT '會員等級'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL COMMENT '商品編號',
  `type` enum('book','game','3c') COLLATE utf8_unicode_ci NOT NULL COMMENT '商品類型',
  `name` tinytext COLLATE utf8_unicode_ci NOT NULL COMMENT '商品名稱',
  `price` int(10) NOT NULL COMMENT '價格',
  `content` text COLLATE utf8_unicode_ci COMMENT '商品簡介',
  `inventory` int(10) NOT NULL DEFAULT '0' COMMENT '商品存貨量',
  `rank` tinyint(5) NOT NULL DEFAULT '0' COMMENT '商品評價',
  `sales` int(10) NOT NULL DEFAULT '0' COMMENT '銷售量',
  `pre_img` text COLLATE utf8_unicode_ci COMMENT '商品預覽圖片',
  `intro_img1` text COLLATE utf8_unicode_ci COMMENT '內部介紹圖片',
  `intro_img2` text COLLATE utf8_unicode_ci COMMENT '內部介紹圖片',
  `intro_img3` text COLLATE utf8_unicode_ci COMMENT '內部介紹圖片',
  `intro_video` text COLLATE utf8_unicode_ci COMMENT '內部介紹影片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `3c`
--
ALTER TABLE `3c`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `price` (`price`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '會員編號';
--
-- 使用資料表 AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品編號';
--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `3c`
--
ALTER TABLE `3c`
  ADD CONSTRAINT `3c_ibfk_1` FOREIGN KEY (`id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
