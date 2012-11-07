-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 11 月 07 日 03:48
-- 服务器版本: 5.5.28
-- PHP 版本: 5.4.6-1ubuntu1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ci_wiki`
--

-- --------------------------------------------------------

--
-- 表的结构 `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) NOT NULL,
  `uname` varchar(10) NOT NULL,
  `details` text NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `catalogus`
--

CREATE TABLE IF NOT EXISTS `catalogus` (
  `cid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `deepth` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `catalogus`
--

INSERT INTO `catalogus` (`cid`, `fid`, `deepth`) VALUES
(1, 0, 0),
(2, 1, 1),
(3, 2, 2),
(4, 2, 2),
(5, 1, 1),
(6, 5, 2),
(7, 1, 1),
(8, 2, 2),
(9, 5, 2),
(10, 7, 2),
(11, 7, 2),
(12, 2, 2),
(13, 0, 0),
(14, 9, 3),
(15, 9, 3),
(16, 9, 3),
(17, 5, 2),
(18, 2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) NOT NULL,
  `uname` varchar(10) NOT NULL,
  `body` text NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `entries`
--

INSERT INTO `entries` (`id`, `subject`, `body`, `time`) VALUES
(1, 'The C Programming Language', 'test\n', '2012-11-05 15:37:18'),
(2, 'Chapter1', '', '2012-11-05 15:37:34'),
(3, 'Entry1', '', '2012-11-05 11:27:01'),
(4, 'Entry2', '', '2012-11-05 11:27:01'),
(5, 'Chapter2', '', '2012-11-05 11:27:31'),
(6, 'Entry1', '', '2012-11-05 11:27:31'),
(7, 'Chapter3', '', '2012-11-05 11:27:52'),
(8, 'Entry3', '', '2012-11-05 16:12:10'),
(9, 'Entry2', '', '2012-11-05 16:52:06'),
(10, 'Entry1', '', '2012-11-05 16:54:04'),
(11, 'Entry2', '', '2012-11-05 16:58:02'),
(12, 'Entry4', '', '2012-11-05 16:59:26'),
(13, 'C++', '', '2012-11-05 17:32:44'),
(14, 'a', '', '2012-11-05 17:34:19'),
(15, 'b', '', '2012-11-05 17:34:33'),
(16, 'c', '', '2012-11-05 17:34:55'),
(17, 'Entry3', '', '2012-11-05 17:35:09'),
(18, 'Entry5', '', '2012-11-06 20:10:39');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`name`, `password`, `email`, `profile`) VALUES
('hyq', 'hyq', 'wind2007@163.com', 'hehe!'),
('wind', '4869', '1060185294@qq.com', 'I love coding!\r\n--I also love sunshine!\r\n----I love sleeping!\r\n------But, I love conan better!\r\n--------Please call me wind, W-I-N-D!');

-- --------------------------------------------------------

--
-- 表的结构 `work_for`
--

CREATE TABLE IF NOT EXISTS `work_for` (
  `eid` int(11) NOT NULL,
  `uname` varchar(10) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `work_for`
--

INSERT INTO `work_for` (`eid`, `uname`) VALUES
(2, 'hyq');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
