-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 11 月 10 日 00:40
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
(58, 0, 0),
(59, 58, 1),
(60, 58, 1),
(61, 58, 1),
(62, 58, 1),
(63, 58, 1),
(64, 59, 2),
(65, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`id`, `eid`, `uname`, `body`, `time`) VALUES
(4, 64, 'hyq', '==!hehe...', '2012-11-09 23:42:11');

-- --------------------------------------------------------

--
-- 表的结构 `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `deadline` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- 转存表中的数据 `entries`
--

INSERT INTO `entries` (`id`, `subject`, `deadline`) VALUES
(58, 'Thinking in C++', '2013-02-01'),
(59, 'Chapter1: Introduction to Objects', '2012-11-30'),
(60, 'Chapter2: Making & Using Objects', '2012-11-14'),
(61, 'Chapter3: The C in C++', '2012-12-21'),
(62, 'Chapter3: Data Abstraction', '2012-12-10'),
(63, 'Chapter5: Hiding the Implementation', '2013-01-22'),
(64, 'The progress of abstraction', '2012-11-21'),
(65, 'The C Programming Language', '2013-01-31');

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
('hx', 'hx', 'huxu.1234@163.com', '^_^?????????????'),
('hyq', 'hyq', 'wind2007@163.com', 'hehe!'),
('wind', '4869', '1060185294@qq.com', 'I love coding!\r\n--I also love sunshine!\r\n----I love sleeping!\r\n------But, I love conan better!\r\n--------Please call me wind, W-I-N-D!');

-- --------------------------------------------------------

--
-- 表的结构 `version_ctrl`
--

CREATE TABLE IF NOT EXISTS `version_ctrl` (
  `entry_id` int(11) NOT NULL,
  `version_id` int(11) NOT NULL,
  `body` text,
  `dateposted` datetime DEFAULT NULL,
  `donepercent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `version_ctrl`
--

INSERT INTO `version_ctrl` (`entry_id`, `version_id`, `body`, `dateposted`, `donepercent`) VALUES
(58, 1, '', '2012-11-09 22:44:29', 0),
(59, 1, '', '2012-11-09 22:46:03', 0),
(60, 1, '', '2012-11-09 22:47:34', 0),
(61, 1, '', '2012-11-09 22:48:21', 0),
(62, 1, '', '2012-11-09 22:49:14', 0),
(63, 1, '', '2012-11-09 22:51:39', 0),
(64, 1, '', '2012-11-09 22:53:50', 0),
(65, 1, '', '2012-11-09 22:54:48', 0),
(64, 2, 'All programming languages provide abstractions!', '2012-11-09 22:57:54', 1),
(64, 3, 'All programming languages provide abstractions!Wow...', '2012-11-09 23:42:57', 2),
(64, 4, 'All programming languages provide abstractions!Wow...\nC++ is wonderful!', '2012-11-09 23:45:54', 0);

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
(64, 'hyq');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
