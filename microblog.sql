-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Anamakine: localhost
-- Üretim Zamanı: 05 Temmuz 2012 saat 01:42:47
-- Sunucu sürümü: 5.0.51
-- PHP Sürümü: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Veritabanı: `microblog`
-- 

-- --------------------------------------------------------

-- 
-- Tablo yapısı: `messages`
-- 

CREATE TABLE `messages` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `message` varchar(140) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- Tablo döküm verisi `messages`
-- 

INSERT INTO `messages` VALUES (1, 2, 'ilk microblog postu....', '2012-06-30 14:22:43');
INSERT INTO `messages` VALUES (6, 3, ':p', '2012-06-30 16:40:34');
INSERT INTO `messages` VALUES (3, 2, 'en yeni mesaj....', '2012-06-30 14:35:12');
INSERT INTO `messages` VALUES (4, 3, 'selamm...', '2012-06-30 14:40:33');
INSERT INTO `messages` VALUES (12, 3, '&lt;SCRIPT SRC=http://ha.ckers.org/xss.js&gt;&lt;/SCRIPT&gt;', '2012-06-30 16:45:38');

-- --------------------------------------------------------

-- 
-- Tablo yapısı: `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Tablo döküm verisi `users`
-- 

INSERT INTO `users` VALUES (1, 'Engür', 'Pişirici', 'engur@uzay.eu', 'engur', '41c63678bc5154e1a7c04152ac05327e1ccee8d1');
INSERT INTO `users` VALUES (2, 'Hidayet', 'Doğan', 'hdogan@gmail.com', 'hdogan', 'edd024c7708b8e1d1527e14a3dbbc8f79907f8da');
INSERT INTO `users` VALUES (3, 'Ramazan', 'Terzi', 'rt@rterzi.com', 'rterzi', '89e495e7941cf9e40e6980d14a16bf023ccd4c91');
INSERT INTO `users` VALUES (4, 'Engin', 'Aygen', 'enginaygen@gmail.com', 'engin', '8cb2237d0679ca88db6464eac60da96345513964');
INSERT INTO `users` VALUES (5, 'Test', 'Test', 'test@test.com', 'test', '8400087281980f2c67038359c0dee5a896089f6e');
