-- phpMyAdmin SQL Dump
-- version 4.4.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-07-19 09:42:17
-- 服务器版本： 5.6.24
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `oid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `bonus_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`oid`, `uid`, `bonus_id`, `created`, `updated`) VALUES
(1, 1, 1, '2015-07-19 08:59:35', '2015-07-19 08:59:35');

-- --------------------------------------------------------

--
-- 表的结构 `user_bonus`
--

CREATE TABLE IF NOT EXISTS `user_bonus` (
  `id` int(10) unsigned NOT NULL COMMENT '主键ID',
  `user_id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `bonus_id` int(10) unsigned NOT NULL COMMENT '红包ID',
  `status` tinyint(3) unsigned NOT NULL COMMENT '使用状态',
  `version` int(10) unsigned NOT NULL COMMENT '版本',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='用户红包';

--
-- 转存表中的数据 `user_bonus`
--

INSERT INTO `user_bonus` (`id`, `user_id`, `bonus_id`, `status`, `version`, `created`) VALUES
(1, 1, 1, 1, 8, '2015-07-19 07:19:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `bonus_id` (`bonus_id`);

--
-- Indexes for table `user_bonus`
--
ALTER TABLE `user_bonus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bonus_id` (`bonus_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_bonus`
--
ALTER TABLE `user_bonus`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',AUTO_INCREMENT=2;