-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2014 at 01:08 
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aplication`
--

CREATE TABLE IF NOT EXISTS `aplication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `descri` text NOT NULL,
  `type_asc` int(1) NOT NULL,
  `ico_url` varchar(600) NOT NULL,
  `publish` int(11) NOT NULL,
  `ordem` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `aplication`
--

INSERT INTO `aplication` (`id`, `name`, `file_name`, `descri`, `type_asc`, `ico_url`, `publish`, `ordem`) VALUES
(1, 'Facebook', 'facebook', 'Achas que somos bons, então clica em "Like".', 6, 'http://cdn3.iconfinder.com/data/icons/socialnetworking/32/facebook.png', 1, 1),
(5, 'NexuS O Legado', 'game', 'Lançamos o jogo a 16-06-2011, 11 anos  e sempre a evoluir, ajuda-nos a evoluir!', 6, 'http://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/32x32/game_pad.png', 1, 0),
(7, 'Google+ (Plus)', 'google+', 'Adere já ao nosso lado Google!', 6, 'https://ssl.gstatic.com/images/icons/gplus-32.png', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `app_data`
--

CREATE TABLE IF NOT EXISTS `app_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_1` varchar(30) NOT NULL,
  `data_2` varchar(30) NOT NULL,
  `data_3` varchar(30) NOT NULL,
  `data_4` varchar(30) NOT NULL,
  `app` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_url` varchar(250) NOT NULL,
  `url_go_to` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image_url`, `url_go_to`, `name`) VALUES
(1, 'media/imagens/pub_1.png', './', 'Home'),
(3, './images/banner/pcgamingbanner.jpg', 'http://pcgaming.com.pt/', 'PCGamming');

-- --------------------------------------------------------

--
-- Table structure for table `coins`
--

CREATE TABLE IF NOT EXISTS `coins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quant` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id_ass` int(11) NOT NULL,
  `why` text NOT NULL,
  `date` date NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `coins_order`
--

CREATE TABLE IF NOT EXISTS `coins_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_ass` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `writer` int(11) NOT NULL,
  `text` text NOT NULL,
  `content_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `config_name` varchar(200) NOT NULL,
  `config_value` varchar(200) NOT NULL,
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`config_name`, `config_value`) VALUES
('site_name', 'System'),
('site_slogan', 'Community of NexuS'),
('site_estado', '1'),
('nxs_tcg_card_url', ''),
('nxs_tcg_thumb_url', '');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `writer` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `nome`, `description`, `content`, `writer`, `time`) VALUES
(1, 'Bem-Vindos', 'Noticia de Obrigado!', '<p align=''justify''>É com muita felicidade nossa que podemos dar asas aos nossos sonhos, perspectivas entre muitas outras coisas. Da-mo-vos as boas-vindas à nossa comunidade, ou como costumamos dizer, à nossa família, é uma plataforma nova totalmente desenvolvida por nós, a NexuS Team, poderão encontrar alguns entraves no sistema, mas contamos convosco para nós informarem dessas avarias, para que possamos corrigir e dar-vos o melhor serviço possivel.<br> Contamos convosco, e o nosso muito obrigado!</p> ', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `acess` int(11) NOT NULL DEFAULT '6',
  `publish` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `name`, `acess`, `publish`) VALUES
(1, 'Geral', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `sf_id_ass` int(11) NOT NULL,
  `user_id_ass` int(11) NOT NULL,
  `text` text NOT NULL,
  `position` int(11) NOT NULL,
  `post_ass` int(10) DEFAULT NULL,
  `publish` int(1) NOT NULL,
  `date` bigint(20) NOT NULL,
  `edited` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`id`, `name`, `sf_id_ass`, `user_id_ass`, `text`, `position`, `post_ass`, `publish`, `date`, `edited`) VALUES
(1, 'NexuS 4.0 - 1st post', 1, 1, '<p align="justify">Boas a todos os que estiverem a ler este tópico, espero que gostem da nossa surpresa de natal, e que vos possa alegrar um pouco mais a vossa vida, deixem aqui as vossas opiniões sobre este novo <strong>NexuS</strong> será muito gratificante para nós.</p>\r\n<p>O nosso muito obrigado, NexuSystem</p>', 1, 1, 0, 1311722474, 1311722474);

-- --------------------------------------------------------

--
-- Table structure for table `forum_sub_forum`
--

CREATE TABLE IF NOT EXISTS `forum_sub_forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `cat_id_ass` int(11) NOT NULL,
  `acess` int(11) NOT NULL DEFAULT '6',
  `publish` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forum_sub_forum`
--

INSERT INTO `forum_sub_forum` (`id`, `name`, `cat_id_ass`, `acess`, `publish`) VALUES
(1, 'Site', 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `g_bag`
--

CREATE TABLE IF NOT EXISTS `g_bag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_ass` int(11) NOT NULL,
  `equip_id_ass` int(11) NOT NULL,
  `equiped` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `g_char`
--

CREATE TABLE IF NOT EXISTS `g_char` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_ass` int(11) NOT NULL,
  `team_id_ass` int(11) NOT NULL DEFAULT '0',
  `gepys` int(11) NOT NULL DEFAULT '0',
  `name` varchar(15) NOT NULL,
  `img` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `expirience` bigint(20) NOT NULL DEFAULT '50',
  `atk` int(11) NOT NULL DEFAULT '1',
  `def` int(11) NOT NULL DEFAULT '1',
  `velocidade` int(11) NOT NULL DEFAULT '1',
  `vida` int(11) NOT NULL DEFAULT '1',
  `win` int(11) NOT NULL DEFAULT '0',
  `lose` int(11) NOT NULL DEFAULT '0',
  `last_fight` bigint(20) NOT NULL,
  `last_fight_with` int(11) NOT NULL,
  `register_since` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `g_duo_combat`
--

CREATE TABLE IF NOT EXISTS `g_duo_combat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activo` int(11) NOT NULL,
  `chefe` int(11) NOT NULL,
  `parceiro` int(11) NOT NULL,
  `oponente` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `g_equips`
--

CREATE TABLE IF NOT EXISTS `g_equips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `part` varchar(15) NOT NULL,
  `mo` int(11) NOT NULL,
  `gepys` int(11) NOT NULL,
  `atk` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `velocidade` int(11) NOT NULL,
  `vida` int(11) NOT NULL,
  `critical` int(11) NOT NULL,
  `img` varchar(100) NOT NULL DEFAULT './media/imagens/character/equips/',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=186 ;

--
-- Dumping data for table `g_equips`
--

INSERT INTO `g_equips` (`id`, `name`, `type`, `part`, `mo`, `gepys`, `atk`, `def`, `velocidade`, `vida`, `critical`, `img`) VALUES
(63, 'Atlas King', 1, 'head', 700, 0, 0, 0, 0, 300, 25, './media/imagens/character/equips/'),
(62, 'Atlas Mermaid', 1, 'legs', 500, 0, 0, 0, 400, 100, 15, './media/imagens/character/equips/'),
(61, 'Atlas Magnetic Field', 1, 'right', 2100, 0, 0, 1500, 0, 50, 15, './media/imagens/character/equips/'),
(60, 'Atlas Sword', 1, 'left', 2300, 0, 2700, 50, 0, 50, 25, './media/imagens/character/equips/'),
(59, 'Volcano Head', 2, 'head', 1000, 0, 100, 100, 0, 25, 20, './media/imagens/character/equips/'),
(58, 'Volcano Legs', 2, 'legs', 1200, 0, 0, 100, 300, 50, 15, './media/imagens/character/equips/'),
(57, 'Dark Doubler', 5, 'legs', 750, 0, 0, 0, 255, 100, 20, './media/imagens/character/equips/'),
(56, 'Dark Shield', 5, 'left', 1000, 0, 0, 1000, 0, 0, 25, './media/imagens/character/equips/'),
(55, 'Volcano Arm R', 2, 'right', 1450, 0, 1900, 750, 0, 150, 20, './media/imagens/character/equips/'),
(54, 'Dark Absorv', 5, 'right', 1200, 0, 2050, 0, 0, 0, 15, './media/imagens/character/equips/'),
(53, 'Dark Eye', 5, 'head', 1500, 0, 0, 0, 0, 500, 15, './media/imagens/character/equips/'),
(52, 'Mountain Cover', 3, 'head', 750, 0, 0, 100, 50, 100, 10, './media/imagens/character/equips/'),
(51, 'Mountain River', 3, 'legs', 1000, 0, 0, 50, 250, 100, 20, './media/imagens/character/equips/'),
(50, 'Mountain Crash', 3, 'left', 1200, 0, 1300, 750, 2, 50, 25, './media/imagens/character/equips/'),
(49, 'Mountain Smasher', 3, 'right', 1400, 0, 1850, 500, 0, 50, 25, './media/imagens/character/equips/'),
(48, 'Volcano Arm L', 2, 'left', 1500, 0, 1750, 700, 0, 200, 25, './media/imagens/character/equips/'),
(47, 'Electricity Boots', 8, 'legs', 0, 55, 0, 0, 5, 3, 0, './media/imagens/character/equips/'),
(46, 'Electrical Cover', 8, 'head', 0, 60, 0, 10, 0, 5, 0, './media/imagens/character/equips/'),
(45, 'Electric Glove', 8, 'right', 0, 55, 0, 10, 2, 0, 0, './media/imagens/character/equips/'),
(44, 'Knight Mask Shield', 6, 'head', 0, 40, 0, 5, 0, 1, 0, './media/imagens/character/equips/'),
(43, 'Eletric Hand', 8, 'left', 0, 50, 10, 0, 2, 0, 0, './media/imagens/character/equips/'),
(42, 'Knight Legs', 6, 'legs', 0, 43, 0, 1, 7, 3, 0, './media/imagens/character/equips/'),
(41, 'Wood Shield', 6, 'left', 0, 51, 0, 6, 0, 2, 0, './media/imagens/character/equips/'),
(40, 'Light Saber', 6, 'right', 0, 56, 9, 2, 0, 0, 0, './media/imagens/character/equips/'),
(39, 'Iron Mask', 9, 'head', 0, 60, 2, 1, 0, 3, 0, './media/imagens/character/equips/'),
(38, 'Iron Legs', 9, 'legs', 0, 60, 0, 0, 7, 5, 0, './media/imagens/character/equips/'),
(37, 'Wind Crown', 4, 'head', 0, 40, 0, 0, 1, 5, 0, './media/imagens/character/equips/'),
(36, 'Bird Legs', 4, 'legs', 0, 50, 1, 1, 9, 1, 0, './media/imagens/character/equips/'),
(35, 'Iron Shield', 9, 'left', 0, 55, 0, 15, 0, 0, 0, './media/imagens/character/equips/'),
(34, 'Wing R', 4, 'right', 0, 57, 7, 6, 1, 0, 0, './media/imagens/character/equips/'),
(33, 'Iron Sword', 9, 'right', 0, 50, 20, 0, 0, 0, 0, './media/imagens/character/equips/'),
(32, 'Wing L', 4, 'left', 0, 56, 10, 3, 2, 1, 0, './media/imagens/character/equips/'),
(31, 'Ocult Mask', 7, 'head', 0, 60, 0, 3, 1, 5, 0, './media/imagens/character/equips/'),
(30, 'Psychic Shield', 5, 'legs', 0, 30, 0, 0, 0, 5, 0, './media/imagens/character/equips/'),
(29, 'Shadow Boots', 7, 'legs', 0, 59, 0, 2, 5, 0, 0, './media/imagens/character/equips/'),
(28, 'Black Shield', 7, 'right', 0, 45, 0, 10, 0, 0, 0, './media/imagens/character/equips/'),
(27, 'Spoon Mask', 5, 'head', 0, 75, 7, 5, 5, 0, 0, './media/imagens/character/equips/'),
(26, 'Spoon R', 5, 'right', 0, 70, 9, 5, 10, 0, 0, './media/imagens/character/equips/'),
(25, 'Spoon L', 5, 'left', 0, 70, 9, 5, 10, 0, 0, './media/imagens/character/equips/'),
(24, 'Head Rock', 3, 'head', 0, 45, 5, 3, 2, 3, 0, './media/imagens/character/equips/'),
(23, 'Black Saber', 7, 'left', 0, 50, 10, 1, 1, 0, 0, './media/imagens/character/equips/'),
(22, 'Tree Legs', 3, 'legs', 0, 60, 0, 10, 3, 10, 0, './media/imagens/character/equips/'),
(21, 'Wood Hammer L', 3, 'left', 0, 55, 15, 2, 1, 3, 0, './media/imagens/character/equips/'),
(20, 'Wood Hammer R', 3, 'right', 0, 55, 15, 2, 1, 3, 0, './media/imagens/character/equips/'),
(19, 'Water Crown', 1, 'head', 0, 50, 7, 5, 2, 5, 0, './media/imagens/character/equips/'),
(18, 'Mermaid Legs', 1, 'legs', 0, 50, 0, 2, 15, 3, 0, './media/imagens/character/equips/'),
(17, 'Water Sword', 1, 'left', 0, 60, 15, 9, 1, 0, 0, './media/imagens/character/equips/'),
(16, 'Bubble Gun', 1, 'right', 0, 25, 7, 4, 1, 0, 0, './media/imagens/character/equips/'),
(15, 'BumBum Fire Mask', 2, 'head', 0, 95, 5, 5, 3, 1, 0, './media/imagens/character/equips/'),
(14, 'Blue Fire Legs', 2, 'legs', 0, 75, 0, 5, 10, 2, 0, './media/imagens/character/equips/'),
(13, 'Burned Arm', 2, 'right', 0, 75, 20, 1, 0, 0, 0, './media/imagens/character/equips/'),
(12, 'Fire Glove', 2, 'left', 0, 25, 10, 2, 0, 0, 0, './media/imagens/character/equips/'),
(11, 'Shadow Gun', 7, 'right', 0, 25, 6, 1, 1, 0, 0, './media/imagens/character/equips/'),
(10, 'Light Gun', 6, 'left', 0, 25, 7, 0, 0, 0, 1, './media/imagens/character/equips/'),
(9, 'Psychic Cape', 5, 'head', 0, 50, 0, 10, 2, 0, 1, './media/imagens/character/equips/'),
(8, 'Necross Life Smash', 7, 'left', 1950, 50, 1700, 950, 200, 50, 20, './media/imagens/character/equips/'),
(7, 'Sagratus Lighting Legs', 6, 'legs', 2000, 0, 100, 100, 500, 250, 25, './media/imagens/character/equips/'),
(6, 'Sagratus Lighting Mask', 6, 'head', 2000, 0, 250, 1500, 100, 100, 25, './media/imagens/character/equips/'),
(5, 'Sagratus Ligtning Critical', 6, 'left', 2000, 0, 2000, 1000, 250, 100, 25, './media/imagens/character/equips/5.jpg'),
(4, 'Magestic Diamond', 5, 'left', 1500, 0, 1500, 600, 100, 250, 10, './media/imagens/character/equips/4.jpg'),
(3, 'Necross Life Sword', 7, 'right', 2000, 0, 2000, 1000, 250, 100, 25, './media/imagens/character/equips/3.jpg'),
(2, 'Sagratus Lightning Sword', 6, 'right', 2000, 0, 2000, 1000, 250, 100, 25, './media/imagens/character/equips/2.jpg'),
(1, 'Fire Gun', 2, 'left', 0, 25, 5, 0, 0, 0, 1, './media/imagens/character/equips/1.jpg'),
(64, 'Platanium Helmet', 9, 'head', 1500, 0, 0, 500, 0, 50, 20, './media/imagens/character/equips/'),
(65, 'Platanium Gun', 9, 'right', 1700, 0, 1900, 350, 5, 50, 25, './media/imagens/character/equips/'),
(66, 'Platanium Missiles', 9, 'left', 1750, 0, 1970, 350, 5, 100, 25, './media/imagens/character/equips/'),
(67, 'Platanium Runner', 9, 'legs', 1000, 0, 0, 0, 400, 0, 10, './media/imagens/character/equips/'),
(68, 'Electric Stone X', 8, 'head', 1000, 0, 0, 1000, 100, 0, 10, './media/imagens/character/equips/'),
(69, 'Electric Stone Neutron', 8, 'right', 2000, 0, 1500, 500, 0, 250, 25, './media/imagens/character/equips/'),
(70, 'Electric Stone Positron', 8, 'left', 2000, 0, 1900, 600, 0, 250, 25, './media/imagens/character/equips/'),
(71, 'Electric Stone Impulsion', 8, 'legs', 1000, 0, 0, 100, 400, 100, 10, './media/imagens/character/equips/'),
(72, 'Torbinator Cannon', 4, 'head', 700, 0, 500, 100, 200, 0, 15, './media/imagens/character/equips/'),
(73, 'Torbinator R', 4, 'right', 1700, 0, 1300, 300, 100, 100, 25, './media/imagens/character/equips/'),
(74, 'Torbinator L', 4, 'left', 1500, 0, 1500, 300, 100, 100, 25, './media/imagens/character/equips/'),
(75, 'Torbinator Fly', 4, 'legs', 1200, 0, 0, 200, 200, 100, 10, './media/imagens/character/equips/'),
(76, 'Necross Life Consumer', 7, 'head', 1700, 0, 1500, 250, 100, 100, 24, './media/imagens/character/equips/'),
(77, 'Necross Life Pulvarizor', 7, 'legs', 1200, 0, 0, 320, 425, 210, 19, './media/imagens/character/equips/'),
(83, 'Blaster Gun', 8, 'right', 0, 160, 36, 0, 7, 0, 0, './media/imagens/character/equips/'),
(82, 'Golden Helm ', 8, 'head', 0, 130, 0, 25, 0, 13, 0, './media/imagens/character/equips/'),
(81, 'Glacier Legs', 1, 'legs', 0, 170, 0, 40, 10, 70, 0, './media/imagens/character/equips/'),
(80, 'Jet Gun', 1, 'left', 0, 160, 37, 3, 5, 0, 0, './media/imagens/character/equips/'),
(79, 'Bottle Gun', 1, 'right', 0, 100, 27, 10, 11, 0, 0, './media/imagens/character/equips/'),
(78, 'Water Helm\r\n', 1, 'head', 0, 140, 0, 25, 0, 50, 0, './media/imagens/character/equips/'),
(84, 'Laser Gun', 8, 'left', 0, 110, 30, 0, 12, 0, 0, './media/imagens/character/equips/'),
(85, 'Golden Legs', 8, 'legs', 0, 170, 0, 30, 9, 50, 0, './media/imagens/character/equips/'),
(86, 'Garden Heds', 3, 'head', 0, 130, 0, 20, 0, 20, 0, './media/imagens/character/equips/'),
(87, 'Farmers Rake', 3, 'right', 0, 110, 27, 1, 10, 0, 0, './media/imagens/character/equips/'),
(88, 'Earth Wall', 3, 'left', 0, 170, 0, 35, 0, 0, 0, './media/imagens/character/equips/'),
(89, 'Rock Legs', 3, 'legs', 0, 160, 0, 5, 15, 70, 0, './media/imagens/character/equips/'),
(90, 'Black Head ', 7, 'head', 0, 135, 0, 17, 0, 21, 0, './media/imagens/character/equips/'),
(91, 'Darkness Axe ', 7, 'right', 0, 200, 34, 3, 11, 0, 0, './media/imagens/character/equips/'),
(92, 'Shadows Sheild', 7, 'left', 0, 100, 0, 25, 0, 0, 0, './media/imagens/character/equips/'),
(93, 'Deamon Legs', 7, 'legs', 0, 135, 0, 10, 13, 36, 0, './media/imagens/character/equips/'),
(94, 'Incandescent Helm', 2, 'head', 0, 160, 0, 32, 0, 26, 0, './media/imagens/character/equips/'),
(95, 'Incandescent Solusek', 2, 'right', 0, 140, 31, 0, 3, 0, 0, './media/imagens/character/equips/'),
(96, 'Incandescent Axe', 2, 'left', 0, 140, 25, 0, 0, 0, 0, './media/imagens/character/equips/'),
(97, 'Incandescent Legs', 2, 'legs', 0, 130, 0, 8, 8, 15, 0, './media/imagens/character/equips/'),
(98, 'God Helm', 6, 'head', 0, 175, 0, 28, 0, 30, 0, './media/imagens/character/equips/'),
(99, 'Sword of Revealing Light', 6, 'right', 0, 180, 35, 1, 5, 0, 0, './media/imagens/character/equips/'),
(100, 'God Hand', 6, 'left', 0, 115, 11, 0, 9, 0, 0, './media/imagens/character/equips/'),
(101, 'Energic Walker', 6, 'legs', 0, 100, 0, 6, 17, 23, 0, './media/imagens/character/equips/'),
(102, 'Silver Helm', 9, 'head', 0, 125, 0, 30, 0, 33, 0, './media/imagens/character/equips/'),
(103, 'Silver Dual-Sword', 9, 'right', 0, 150, 27, 10, 5, 0, 0, './media/imagens/character/equips/'),
(104, 'Silver Dual-Sword\r\n', 9, 'left', 0, 150, 27, 10, 5, 0, 0, './media/imagens/character/equips/'),
(105, 'Silver Legs', 9, 'legs', 0, 110, 0, 0, 12, 13, 0, './media/imagens/character/equips/'),
(106, 'Dirty Mind', 5, 'head', 0, 120, 0, 20, 0, 12, 0, './media/imagens/character/equips/'),
(107, 'Mind Reader Stone', 5, 'right', 0, 180, 35, 10, 15, 0, 0, './media/imagens/character/equips/'),
(108, 'Mind Sheild\r\n', 5, 'left', 0, 150, 0, 25, 0, 0, 0, './media/imagens/character/equips/'),
(109, 'Invisible Legs', 5, 'legs', 0, 120, 0, 0, 12, 23, 0, './media/imagens/character/equips/'),
(110, 'Hurricane Helm', 4, 'head', 0, 122, 0, 19, 0, 30, 0, './media/imagens/character/equips/'),
(111, 'Air Pression', 4, 'right', 0, 134, 17, 22, 13, 0, 0, './media/imagens/character/equips/'),
(112, 'Air Pression\r\n', 4, 'left', 0, 134, 17, 22, 13, 0, 0, './media/imagens/character/equips/'),
(113, 'Hurricane Legs\r\n', 4, 'legs', 0, 180, 0, 0, 5, 40, 0, './media/imagens/character/equips/'),
(114, 'Ice Crown', 1, 'head', 0, 525, 20, 50, 20, 80, 0, './media/imagens/character/equips/'),
(115, 'Ice Blade', 1, 'right', 0, 602, 30, 40, 25, 60, 0, './media/imagens/character/equips/'),
(116, 'Hidro Gun', 1, 'left', 0, 638, 50, 55, 15, 100, 1, './media/imagens/character/equips/'),
(117, 'Snow Legs', 1, 'legs', 0, 735, 50, 55, 27, 160, 2, './media/imagens/character/equips/'),
(118, 'Flame Head', 2, 'head', 0, 600, 50, 45, 35, 100, 0, './media/imagens/character/equips/'),
(119, 'Burning Sword', 2, 'right', 0, 690, 100, 30, 12, 60, 2, './media/imagens/character/equips/'),
(120, 'Flametongue', 2, 'left', 0, 675, 80, 40, 25, 120, 1, './media/imagens/character/equips/'),
(121, 'Burning Legs', 2, 'legs', 0, 535, 20, 35, 15, 70, 0, './media/imagens/character/equips/'),
(122, 'Stone Mask', 3, 'head', 0, 646, 50, 90, 15, 90, 1, './media/imagens/character/equips/'),
(123, 'Stone Mace', 3, 'right', 0, 617, 85, 40, 25, 100, 0, './media/imagens/character/equips/'),
(124, 'Shell Shield', 3, 'left', 0, 723, 30, 100, 14, 60, 2, './media/imagens/character/equips/'),
(125, 'Wooden Legs', 3, 'legs', 0, 514, 35, 20, 20, 50, 0, './media/imagens/character/equips/'),
(126, 'Air Cap', 4, 'head', 0, 619, 85, 55, 30, 95, 1, './media/imagens/character/equips/'),
(127, 'Wind Bow', 4, 'right', 0, 596, 50, 15, 10, 70, 0, './media/imagens/character/equips/'),
(128, 'Wind Arrows', 4, 'left', 0, 604, 50, 30, 20, 100, 0, './media/imagens/character/equips/'),
(129, 'Breeze Trousers', 4, 'legs', 0, 681, 65, 50, 40, 75, 2, './media/imagens/character/equips/'),
(130, 'Mind of Darkness ', 5, 'head', 0, 785, 110, 80, 35, 125, 3, './media/imagens/character/equips/'),
(131, 'Psichic Spear', 5, 'right', 0, 623, 45, 35, 15, 55, 0, './media/imagens/character/equips/'),
(132, 'Arm of Destiny', 5, 'left', 0, 627, 45, 35, 15, 70, 0, './media/imagens/character/equips/'),
(133, 'Spirit Legs', 5, 'legs', 0, 465, 50, 50, 22, 50, 0, './media/imagens/character/equips/'),
(134, 'Illumination Tiara', 6, 'head', 0, 525, 45, 45, 10, 65, 0, './media/imagens/character/equips/'),
(135, 'Shine Greatsword', 6, 'right', 0, 535, 55, 35, 15, 65, 0, './media/imagens/character/equips/'),
(136, 'Sword of Kings', 6, 'left', 0, 756, 75, 100, 30, 150, 3, './media/imagens/character/equips/'),
(137, 'Flash Legs', 6, 'legs', 0, 684, 25, 70, 45, 70, 0, './media/imagens/character/equips/'),
(138, 'Dark Iron Head', 7, 'head', 0, 665, 60, 55, 13, 80, 0, './media/imagens/character/equips/'),
(139, 'Axe of Obscurity', 7, 'right', 0, 765, 100, 95, 15, 135, 3, './media/imagens/character/equips/'),
(140, 'Darkbind Fingers', 7, 'left', 0, 548, 50, 30, 20, 60, 0, './media/imagens/character/equips/'),
(141, 'Dark Iron Boots', 7, 'legs', 0, 522, 40, 20, 25, 75, 0, './media/imagens/character/equips/'),
(142, 'Electrostatic Crown', 8, 'head', 0, 687, 55, 50, 15, 60, 0, './media/imagens/character/equips/'),
(143, 'Electrified Spear', 8, 'right', 0, 537, 35, 25, 20, 80, 0, './media/imagens/character/equips/'),
(144, 'Electro Shock Bolt', 8, 'left', 0, 523, 30, 30, 20, 75, 0, './media/imagens/character/equips/'),
(145, 'Electrical Storm Legs', 8, 'legs', 0, 753, 80, 95, 45, 85, 3, './media/imagens/character/equips/'),
(146, 'Gold Cap', 9, 'head', 0, 638, 80, 80, 22, 130, 1, './media/imagens/character/equips/'),
(147, 'Gold Hammer', 9, 'right', 0, 622, 90, 25, 5, 20, 1, './media/imagens/character/equips/'),
(148, 'Gold Shield', 9, 'left', 0, 635, 20, 90, 15, 60, 1, './media/imagens/character/equips/'),
(149, 'Gold Boots', 9, 'legs', 0, 605, 10, 5, 43, 90, 0, './media/imagens/character/equips/'),
(150, 'Crown of Burning Waters', 1, 'head', 0, 740, 75, 150, 60, 230, 0, './media/imagens/character/equips/'),
(151, 'Icebrande', 1, 'right', 0, 1030, 150, 70, 50, 200, 1, './media/imagens/character/equips/'),
(152, 'Cascading Water Shield', 1, 'left', 0, 730, 90, 180, 60, 180, 0, './media/imagens/character/equips/'),
(153, 'Sabots of Red Waters', 1, 'legs', 0, 1500, 85, 100, 80, 190, 3, './media/imagens/character/equips/'),
(154, 'Firehank Hood', 2, 'head', 0, 740, 90, 130, 40, 175, 0, './media/imagens/character/equips/'),
(155, 'Firelit Two-Hand Sword', 2, 'right', 0, 1280, 200, 80, 60, 150, 2, './media/imagens/character/equips/'),
(156, 'Firelit Two-Hand Sword', 2, 'left', 0, 1280, 200, 80, 60, 150, 2, './media/imagens/character/equips/'),
(157, 'Fireweave Legs', 2, 'legs', 0, 700, 110, 110, 90, 125, 0, './media/imagens/character/equips/'),
(158, 'Earthfury Helmet', 3, 'head', 0, 1200, 85, 190, 70, 220, 2, './media/imagens/character/equips/'),
(159, 'Earthen Guard Shield', 3, 'right', 0, 1090, 95, 230, 25, 230, 1, './media/imagens/character/equips/'),
(160, 'Axe of Earthshaker', 3, 'left', 0, 1010, 120, 55, 25, 65, 1, './media/imagens/character/equips/'),
(161, 'Earthforged Legs', 3, 'legs', 0, 700, 100, 125, 80, 85, 0, './media/imagens/character/equips/'),
(162, 'Windchaser Coronet', 4, 'head', 0, 700, 90, 125, 65, 195, 0, './media/imagens/character/equips/'),
(163, 'Windflight Staff', 4, 'right', 0, 730, 165, 65, 20, 145, 0, './media/imagens/character/equips/'),
(164, 'Wind Spirit Staff', 4, 'left', 0, 1120, 175, 85, 85, 115, 1, './media/imagens/character/equips/'),
(165, 'Wind Dancer''s Legguards', 4, 'legs', 0, 1450, 70, 125, 130, 145, 3, './media/imagens/character/equips/'),
(166, 'Cursed Vision of Spirit''s', 5, 'head', 0, 1680, 270, 200, 85, 170, 4, './media/imagens/character/equips/'),
(167, 'Stave of the Spirtcaller', 5, 'right', 0, 800, 125, 85, 25, 65, 0, './media/imagens/character/equips/'),
(168, 'Spirit Channeller''s Rod', 5, 'left', 0, 810, 120, 100, 25, 70, 0, './media/imagens/character/equips/'),
(169, 'Legs of Glorious Spirit', 5, 'legs', 0, 710, 85, 115, 115, 95, 0, './media/imagens/character/equips/'),
(170, 'Lightsworn Helmet', 6, 'head', 0, 760, 95, 150, 50, 160, 0, './media/imagens/character/equips/'),
(171, 'Light Skyforged Greatsword', 6, 'right', 0, 1660, 150, 120, 45, 185, 4, './media/imagens/character/equips/'),
(172, 'Lightning Dagger', 6, 'left', 0, 830, 120, 135, 55, 90, 0, './media/imagens/character/equips/'),
(173, 'Legplates of Blazing Light', 6, 'legs', 0, 750, 35, 95, 150, 65, 0, './media/imagens/character/equips/'),
(174, 'Dark Phoenix Helmet', 7, 'head', 0, 790, 65, 150, 25, 85, 0, './media/imagens/character/equips/'),
(175, 'Darkstone Claymore', 7, 'right', 0, 890, 215, 135, 35, 120, 0, './media/imagens/character/equips/'),
(176, 'Blade os Eternal Darkness', 7, 'left', 0, 1600, 260, 125, 65, 230, 4, './media/imagens/character/equips/'),
(177, 'Darksoul Boots', 7, 'legs', 0, 720, 60, 90, 125, 165, 0, './media/imagens/character/equips/'),
(178, 'Thunderheart Helmet', 8, 'head', 0, 720, 60, 120, 60, 150, 0, './media/imagens/character/equips/'),
(179, 'Thunderstrike Polearm', 8, 'right', 0, 800, 145, 95, 40, 55, 0, './media/imagens/character/equips/'),
(180, 'Thunderstorm Blade', 8, 'left', 0, 830, 175, 90, 40, 65, 0, './media/imagens/character/equips/'),
(181, 'Boots of the five Thunders', 8, 'legs', 0, 1650, 120, 195, 160, 130, 4, './media/imagens/character/equips/'),
(182, 'Diamond Helmet', 9, 'head', 0, 1030, 70, 135, 60, 230, 1, './media/imagens/character/equips/'),
(183, 'Diamond Greatsword', 9, 'right', 0, 1005, 185, 95, 25, 105, 1, './media/imagens/character/equips/'),
(184, 'Diamond Shield', 9, 'left', 0, 1005, 160, 155, 25, 115, 1, './media/imagens/character/equips/'),
(185, 'Diamond Boots', 9, 'legs', 0, 960, 85, 115, 140, 150, 1, './media/imagens/character/equips/');

-- --------------------------------------------------------

--
-- Table structure for table `g_history`
--

CREATE TABLE IF NOT EXISTS `g_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_ass` int(11) NOT NULL,
  `frase` text NOT NULL,
  `history` text NOT NULL,
  `type` varchar(1) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `g_monsters`
--

CREATE TABLE IF NOT EXISTS `g_monsters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `exp_min` int(11) NOT NULL DEFAULT '0',
  `exp_max` int(11) NOT NULL DEFAULT '0',
  `atk` int(11) NOT NULL DEFAULT '1',
  `def` int(11) NOT NULL DEFAULT '1',
  `velocidade` int(11) NOT NULL DEFAULT '1',
  `vida` int(11) NOT NULL DEFAULT '1',
  `critical` int(11) NOT NULL DEFAULT '1',
  `expirience` int(11) DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `gepys` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `g_monsters`
--

INSERT INTO `g_monsters` (`id`, `name`, `type`, `exp_min`, `exp_max`, `atk`, `def`, `velocidade`, `vida`, `critical`, `expirience`, `img`, `gepys`) VALUES
(1, 'Alix -Y', 2, 0, 0, 1, 1, 1, 1, 1, 100, './media/imagens/character/alixy.jpg', 20),
(2, 'Anifire', 2, 0, 0, 1, 1, 2, 1, 1, 50, './media/imagens/character/anifire.jpg', 10),
(3, 'Snipver', 2, 70, 0, 2, 1, 1, 1, 0, 75, './media/imagens/character/snipver.jpg', 20),
(4, 'Tentic', 6, 0, 0, 1, 2, 2, 1, 0, 125, './media/imagens/character/tentic.jpg', 10),
(5, 'Alien BiteF', 6, 4500, 0, 17, 15, 15, 16, 0, 1200, './media/imagens/character/alienbitef.jpg', 100),
(6, 'Alien BiteG', 7, 4200, 0, 20, 16, 10, 16, 3, 1500, './media/imagens/character/alienbiteg.jpg', 200),
(7, 'Alix-X', 3, 2000, 0, 19, 8, 6, 10, 1, 650, './media/imagens/character/alixx.jpg', 100),
(8, 'Anark', 3, 4000, 0, 50, 25, 50, 27, 6, 1700, './media/imagens/character/anark.jpg', 300),
(9, 'Atlon', 6, 2500, 0, 40, 20, 10, 27, 10, 900, './media/imagens/character/atlon.jpg', 190),
(10, 'Bluebloom', 1, 3600, 0, 50, 25, 25, 35, 0, 1700, './media/imagens/character/bluebloom.jpg', 300),
(11, 'Cátia', 6, 4600, 0, 75, 47, 5, 40, 5, 1900, './media/imagens/character/catia.jpg', 250),
(12, 'Cerberk', 2, 5000, 0, 75, 50, 50, 30, 15, 2000, './media/imagens/character/cerberk.jpg', 400),
(13, 'Chama Alada', 6, 2700, 0, 50, 31, 31, 31, 5, 213, './media/imagens/character/chamaalada.jpg', 200),
(14, 'Cometa Em Chamas', 2, 0, 0, 1, 1, 1, 1, 0, 50, './media/imagens/character/cometaemchamas.jpg', 50),
(15, 'Draker', 2, 20000, 0, 800, 550, 250, 400, 25, 12000, './media/imagens/character/draker.jpg', 5000),
(16, 'Drakerio', 7, 6000, 0, 100, 75, 50, 70, 15, 3000, './media/imagens/character/drakerio.jpg', 500),
(17, 'Drakeriosk', 7, 2700, 0, 50, 29, 60, 35, 12, 1300, './media/imagens/character/drakeriosk.jpg', 300),
(18, 'Drakerium', 7, 100, 0, 5, 2, 10, 7, 1, 90, './media/imagens/character/drakerium.jpg', 75),
(19, 'Drakero', 4, 10000, 0, 250, 175, 300, 123, 11, 4950, './media/imagens/character/drakero.jpg', 2700),
(20, 'Duentic', 6, 1700, 0, 17, 10, 11, 9, 0, 649, './media/imagens/character/duentic.jpg', 133),
(21, 'Duo-Volt', 8, 3500, 0, 42, 30, 5, 20, 3, 1100, './media/imagens/character/duovolt.jpg', 133),
(22, 'D-Win', 4, 4100, 0, 70, 20, 60, 40, 5, 1853, './media/imagens/character/dwin.jpg', 223),
(23, 'Escaravelho Escorpião', 9, 1000, 0, 20, 12, 6, 8, 10, 1000, './media/imagens/character/escaravelhoescorpiao.jpg', 200),
(24, 'Filmi', 9, 300, 0, 6, 6, 2, 5, 0, 500, './media/imagens/character/filmi.jpg', 100),
(25, 'Flamejante Alado', 6, 11500, 0, 300, 250, 75, 200, 20, 2500, './media/imagens/character/flamejantealado.jpg', 2000),
(26, 'Freevo', 5, 500, 0, 15, 9, 5, 10, 2, 750, './media/imagens/character/freevo.jpg', 253),
(27, 'Gato S.Tar', 6, 2200, 0, 30, 15, 20, 35, 5, 1674, './media/imagens/character/gatostar.jpg', 368),
(28, 'Guerreira S.Tar', 6, 3000, 0, 42, 42, 25, 30, 35, 1208, './media/imagens/character/gerreirastar.jpg', 500),
(29, '&szlig;&theta;&zeta;&zeta; J-Dragon', 7, 6000, 0, 400, 375, 125, 195, 39, 5000, './media/imagens/character/jdragon.jpg', 0),
(30, 'Laiwin', 4, 3900, 0, 135, 40, 18, 30, 7, 750, './media/imagens/character/laiwin.jpg', 375),
(31, '&szlig;&theta;&zeta;&zeta; Lamim', 1, 4000, 0, 80, 60, 40, 20, 40, 2000, './media/imagens/character/lammim.jpg', 0),
(32, 'Lampion', 2, 2400, 0, 16, 16, 16, 12, 0, 300, './media/imagens/character/lampion.jpg', 200),
(33, 'Limeforesto', 3, 425, 0, 20, 30, 10, 35, 2, 350, './media/imagens/character/limeforesto.jpg', 270),
(34, 'Loberk', 2, 370, 0, 28, 20, 30, 25, 10, 290, './media/imagens/character/loberk.jpg', 170),
(35, 'Lopes', 7, 3500, 0, 80, 60, 75, 90, 20, 2500, './media/imagens/character/lopes.jpg', 600),
(36, '&szlig;&theta;&zeta;&zeta; Mestre das Artes Negras', 2, 3750, 0, 350, 300, 100, 150, 30, 3500, './media/imagens/character/mestredasartesnegras.jpg', 0),
(37, 'Milmi', 9, 60, 0, 3, 3, 1, 4, 0, 60, './media/imagens/character/milmi.jpg', 60),
(38, 'Mini Chama Alada', 6, 360, 0, 25, 20, 17, 20, 5, 156, './media/imagens/character/minicahmaalada.jpg', 170),
(39, 'Mini Voltorb', 8, 60, 0, 8, 5, 10, 10, 1, 90, './media/imagens/character/minivoltorb.jpg', 85),
(40, 'Mistverde', 3, 800, 0, 25, 15, 25, 15, 1, 670, './media/imagens/character/mistverde.jpg', 280),
(41, 'Monche', 8, 800, 0, 25, 25, 40, 20, 3, 780, './media/imagens/character/monche.jpg', 300),
(42, 'Muffle 1', 8, 65, 0, 5, 2, 2, 3, 0, 75, './media/imagens/character/muffle.jpg', 75),
(43, 'Muffle 2', 8, 400, 0, 20, 15, 12, 17, 3, 185, './media/imagens/character/muffle2.jpg', 180),
(44, 'Muffle 3', 8, 1000, 0, 50, 27, 30, 38, 9, 850, './media/imagens/character/muffle3.jpg', 350),
(45, 'Niitaa', 6, 1000, 0, 45, 45, 30, 50, 10, 880, './media/imagens/character/nitaa.jpg', 390),
(46, 'Perciebes', 4, 0, 0, 3, 1, 5, 2, 1, 55, './media/imagens/character/perciebes.jpg', 60),
(47, 'Perciebes #2', 7, 190, 0, 15, 10, 18, 10, 8, 130, './media/imagens/character/perciebes2.jpg', 180),
(48, 'Pilpup', 4, 70, 0, 5, 2, 2, 5, 0, 75, './media/imagens/character/pilpup.jpg', 75),
(51, 'Psyseed', 5, 100, 0, 10, 3, 5, 2, 1, 90, './media/imagens/character/psyseed.jpg', 90),
(49, 'Primeira Estrela', 6, 150, 0, 7, 7, 7, 7, 7, 100, './media/imagens/character/primeiraestrela.jpg', 100),
(52, 'Psymor', 5, 430, 0, 20, 15, 18, 10, 2, 480, './media/imagens/character/psymor.jpg', 200),
(53, 'Psytron', 5, 1700, 0, 65, 30, 35, 20, 10, 1500, './media/imagens/character/psytron.jpg', 430),
(54, 'Rapaz Star', 6, 2000, 0, 55, 60, 60, 55, 15, 2180, './media/imagens/character/rapazstar.jpg', 500),
(55, 'Rocha de Nivel', 9, 300, 0, 10, 50, 1, 30, 5, 190, './media/imagens/character/rochadenivel.jpg', 260),
(56, 'Serpfire', 2, 10000, 0, 120, 75, 60, 70, 20, 2800, './media/imagens/character/serpfire.jpg', 690),
(57, 'Silencer', 7, 18000, 0, 150, 60, 60, 50, 30, 2930, './media/imagens/character/silencer.jpg', 700),
(58, 'Spidazul', 1, 360, 0, 25, 15, 15, 20, 0, 195, './media/imagens/character/spidazul.jpg', 165),
(59, 'S-Win', 1, 3100, 0, 50, 20, 30, 25, 5, 1150, './media/imagens/character/swin.jpg', 550),
(60, 'Tolmi', 9, 3200, 0, 55, 60, 45, 60, 5, 1250, './media/imagens/character/tolmi.jpg', 580),
(61, 'Totem de Electricidade', 7, 1500, 0, 50, 40, 60, 40, 2, 900, './media/imagens/character/totemdeelectricidade.jpg', 400),
(62, 'Totem de Fogo', 7, 1500, 0, 60, 40, 40, 50, 2, 900, './media/imagens/character/totemdefogo.jpg', 400),
(63, 'Totem de Vento', 7, 1500, 0, 50, 60, 50, 40, 2, 900, './media/imagens/character/totemdevento.jpg', 400),
(64, 'Trifade', 3, 13000, 0, 115, 100, 150, 75, 15, 2850, './media/imagens/character/trifade.jpg', 700),
(65, 'O Vampiro de Ayamonte', 7, 1750, 0, 65, 30, 50, 25, 15, 1950, './media/imagens/character/ovampirodeayamonte.jpg', 480),
(66, 'Volt', 8, 780, 0, 40, 20, 50, 45, 3, 650, './media/imagens/character/volt.jpg', 280),
(67, 'Garius', 1, 35000, 0, 600, 400, 350, 850, 25, 20000, './media/imagens/character/garius.jpg', 6000),
(68, 'Serkin', 3, 50000, 0, 900, 500, 400, 1250, 25, 25000, './media/imagens/character/serkin.jpg', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `g_team`
--

CREATE TABLE IF NOT EXISTS `g_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'team-logo-001',
  `user_id_ass` int(11) NOT NULL,
  `owner_id_ass` int(11) NOT NULL,
  `member_combat` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `expirience` int(11) NOT NULL DEFAULT '0',
  `win` int(11) NOT NULL DEFAULT '0',
  `lose` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `g_team_history`
--

CREATE TABLE IF NOT EXISTS `g_team_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id_ass` int(11) NOT NULL,
  `frase` text COLLATE utf8_unicode_ci NOT NULL,
  `history` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `g_team_invites`
--

CREATE TABLE IF NOT EXISTS `g_team_invites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_ass` int(11) NOT NULL,
  `team_id_ass` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE IF NOT EXISTS `private_messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subject` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `sender` int(10) DEFAULT NULL,
  `sender_id` int(10) DEFAULT NULL,
  `recep` int(10) DEFAULT NULL,
  `recep_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_team_promotion`
--

CREATE TABLE IF NOT EXISTS `site_team_promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value_01` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value_02` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_ass` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  `coin` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `sobremim` text NOT NULL,
  `template` int(11) NOT NULL,
  `date` date NOT NULL,
  `active` int(1) NOT NULL,
  `admin_comment` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `username`, `avatar`, `coin`, `dia`, `mes`, `ano`, `sobremim`, `template`, `date`, `active`, `admin_comment`) VALUES
(1, 'geral@nexus-pt.eu', 'fe01ce2a7fbac8fafaed7c982a04e229', 1, 'administrator', 'http://static.cbl.statdrive.net/avatars/developer_avatar.png', 355, 28, 10, 1991, '<div style="text-align: center;"><font class="Apple-style-span" size="4">~ E-MAIL ~</font></div><div style="text-align: center;"><font class="Apple-style-span" size="6"><b>geral@nexus-pt.eu</b></font></div>', 1, '2011-01-05', 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
