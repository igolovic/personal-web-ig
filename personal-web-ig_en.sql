-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Erstellungszeit: 04. Sep 2020 um 23:44
-- Server-Version: 8.0.18
-- PHP-Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `personal-web-ig_en`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `calendar_dates`
--

DROP TABLE IF EXISTS `calendar_dates`;
CREATE TABLE IF NOT EXISTS `calendar_dates` (
  `date` date NOT NULL,
  `text` text NOT NULL,
  `calendar_date_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`calendar_date_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `calendar_dates`
--

INSERT INTO `calendar_dates` (`date`, `text`, `calendar_date_id`) VALUES
('2020-04-18', 'Subota! :)', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_date` datetime NOT NULL,
  `comment_author` varchar(256) NOT NULL,
  `comment_text` text NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cv_data`
--

DROP TABLE IF EXISTS `cv_data`;
CREATE TABLE IF NOT EXISTS `cv_data` (
  `cv_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `cv_part_id` int(11) NOT NULL,
  `_order` int(11) NOT NULL,
  PRIMARY KEY (`cv_data_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `cv_data`
--

INSERT INTO `cv_data` (`cv_data_id`, `title`, `text`, `cv_part_id`, `_order`) VALUES
(1, 'LinkedIn', '<a  target=\"_blank\" href=\"https://www.linkedin.com/in/ivangolovic/\">https://www.linkedin.com/in/ivangolovic/</a>', 1, -1),
(3, 'GitHub', '<a  target=\"_blank\" href=\"https://github.com/igolovic\">https://github.com/igolovic</a>', 1, 0),
(4, 'CodeProject', '<a  target=\"_blank\" href=\"https://www.codeproject.com/script/Articles/MemberArticles.aspx?amid=11176433\">https://www.codeproject.com/script/Articles/MemberArticles.aspx?amid=11176433</a>', 1, 1),
(6, 'Generally', 'Since there are numerous places today in web where one can leave their CV information and information about their work, instead of copying of text, I will post some links on already published information.', 3, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cv_parts`
--

DROP TABLE IF EXISTS `cv_parts`;
CREATE TABLE IF NOT EXISTS `cv_parts` (
  `cv_part_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `_order` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  PRIMARY KEY (`cv_part_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `cv_parts`
--

INSERT INTO `cv_parts` (`cv_part_id`, `title`, `_order`, `gallery_id`) VALUES
(1, 'Links', 1, 0),
(3, 'CV and information', 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `path` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `part_id` varchar(256) NOT NULL,
  `_order` int(11) NOT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `title`, `path`, `text`, `part_id`, `_order`) VALUES
(1, 'Vorarlberg - Austrija', 'gallery1', 'Pictures from Bludenz, province of Vorarlberg, Austria.', 'Leisure', 3),
(6, 'Drava near Varaždin <3', 'gallery6', '', 'Leisure', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gallery_element`
--

DROP TABLE IF EXISTS `gallery_element`;
CREATE TABLE IF NOT EXISTS `gallery_element` (
  `gallery_element_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL,
  `path` varchar(256) NOT NULL,
  `_order` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`gallery_element_id`),
  KEY `_order` (`_order`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `gallery_element`
--

INSERT INTO `gallery_element` (`gallery_element_id`, `gallery_id`, `path`, `_order`, `title`, `text`) VALUES
(46, 6, 'res/gallery6/image006.jpg', 6, '', ''),
(3, 1, 'res/gallery1/100_0085.jpg', 2, '', ''),
(4, 1, 'res/gallery1/100_0094.jpg', 4, '', ''),
(5, 1, 'res/gallery1/100_0095.jpg', 5, 'Mjesna crkva', 'Bludenz'),
(6, 1, 'res/gallery1/100_0096.jpg', 6, '', ''),
(7, 1, 'res/gallery1/100_0122.jpg', 7, '', ''),
(8, 1, 'res/gallery1/100_0127.jpg', 8, '', ''),
(9, 1, 'res/gallery1/100_0128.jpg', 9, '', ''),
(10, 1, 'res/gallery1/100_0140.jpg', 10, '', ''),
(11, 1, 'res/gallery1/100_0184.jpg', 11, '', ''),
(12, 1, 'res/gallery1/100_0189.jpg', 12, '', ''),
(13, 1, 'res/gallery1/100_0228.jpg', 13, '', ''),
(14, 1, 'res/gallery1/100_0260.jpg', 14, '', ''),
(45, 6, 'res/gallery6/image005.jpg', 5, '', ''),
(44, 6, 'res/gallery6/image004.jpg', 4, '', ''),
(43, 6, 'res/gallery6/image003.jpg', 3, '', ''),
(41, 6, 'res/gallery6/image001.jpg', 1, '', ''),
(42, 6, 'res/gallery6/image002.jpg', 2, '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` int(11) NOT NULL,
  `ip` char(15) NOT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `grades`
--

INSERT INTO `grades` (`grade_id`, `grade`, `ip`) VALUES
(3, 4, '::1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hit_count`
--

DROP TABLE IF EXISTS `hit_count`;
CREATE TABLE IF NOT EXISTS `hit_count` (
  `ip` char(15) NOT NULL,
  `date` datetime NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `hit_count`
--

INSERT INTO `hit_count` (`ip`, `date`, `total`) VALUES
('::1', '2020-06-24 01:42:37', 31);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `image_text_modules`
--

DROP TABLE IF EXISTS `image_text_modules`;
CREATE TABLE IF NOT EXISTS `image_text_modules` (
  `image_text_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` varchar(256) NOT NULL,
  `_order` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `image_path` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_image` int(11) NOT NULL,
  PRIMARY KEY (`image_text_module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `image_text_modules`
--

INSERT INTO `image_text_modules` (`image_text_module_id`, `part_id`, `_order`, `title`, `text`, `image_path`, `is_image`) VALUES
(1, 'FavProgram', 1, 'Program support for professional software making', 'Here are some of my favorite tools used for programming work. Through long-term use the have shown themselves and proven how useful and reliable they are.', 'res/vs.jpg', 1),
(4, 'FavProgram', 2, 'Non-programming programs :)', 'Here you can find few programs that proved themselves useful time and again, and they are also free ;)', 'res/firefox.jpg', 1),
(8, 'FavLinks', 1, 'Microsoft Channel 9', 'Interesting web resource containing interviews with Microsoft developers, I found especially interesting interviews with \"tag\" internals or \"kernel\" in which it was possible to hear people speak sho created these fascinating things suh as windows kernel, memory manager etc.', 'res/Rob-Short-and-kernel-team-Going-deep-inside-Windo_512.jpg', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `image_text_submodules`
--

DROP TABLE IF EXISTS `image_text_submodules`;
CREATE TABLE IF NOT EXISTS `image_text_submodules` (
  `image_text_submodule_id` int(11) NOT NULL AUTO_INCREMENT,
  `module` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `position` int(11) NOT NULL,
  `_order` int(11) NOT NULL,
  `part_id` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`image_text_submodule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `image_text_submodules`
--

INSERT INTO `image_text_submodules` (`image_text_submodule_id`, `module`, `title`, `text`, `position`, `_order`, `part_id`) VALUES
(1, 1, 'Microsoft Visual Studio', 'Top notch tool for software manufacturing on Microsoft and open-source technologies. Many languages and types of applications are supported. Functioning of the program itself is fast and reliable. Wid range of tools an extensioins is avialable in Visual Studio, all of this makes this IDE (Integrated Development Environment) my favorite IDE since 2003. onward.', 0, 1, 'Technical'),
(16, 4, 'Gimp', 'Advances picture editor. Supports working with layers and possesses many functions that can be found in Photoshop.', 1, 3, 'FavProgram'),
(15, 4, 'Mozzila Firefox', 'One of the most popular browsers with a lot of free extensions. Renders web pages without problems and in accordance with HTML standards.', 0, 1, 'FavProgram'),
(8, 1, 'Git', 'Very popular (with good reason!) Version Control System - completely free, supports small and large projets without objection. This software was invented by Linus Torvalds for purpose of development of Linux kernel.', 1, 1, 'FavProgram'),
(17, 4, 'BS Player', 'Video player with various possibilities and useful functionality of automatic subtitle search.', 0, 2, 'FavProgram'),
(18, 1, 'Microsoft SQL Server', 'Enterprise-level RDMS system, although \"stronger\" versions are relatively expensive, there is also a free version intended for simpler use.', 0, 3, 'FavProgram'),
(19, 4, 'Scratch', 'MIT\'s programming language and IDE that enables children to learn programming. Excellent software and concept developed from children\'s psychologists and computer experts enables young ones to enter the world of programming.', 1, 2, 'FavProgram'),
(21, 8, 'Interview with one-man-team developer who develops Windows memory management ', 'Interesting interview with programmer who<b>alone</b> develops large part of memory functionality of Windows OS, interesting to watch \"safe distance\" :)\r\n<br/><br/><a target=\"_blank\" href=\"https://channel9.msdn.com/Shows/Going+Deep/Landy-Wang-Windows-Memory-Manager\">Memory manager - Landy Wang</a>', 0, 1, 'FavLinks'),
(22, 8, 'Conversation with one of the Windows kernel architects', 'Old but very educational and understandable conversation with one of the Windows kernel architects. Interview se is comprised of 4 parts. Except of explaining interesting facts about Windows kernel, Dave talks about general events and facts from the history of Windows. First part:<br/><br/><a target=\"_blank\" href=\"https://channel9.msdn.com/Shows/Going+Deep/Windows-Part-I-Dave-Probert\">Windows, Part I - Dave Probert</a>', 1, 1, 'FavLinks'),
(24, 8, 'Mark Russinovich - author of SysInternals tools', 'Conversation with one of Microsoft\'s all-star Windows engineers, Marks parents are descended from Croatia. He is an author of several excellent tools for in-depth monitoring of system statuses and messages (Sysmon, Process Explorer...)\r\n<br/>\r\n<br/>\r\n<a target=\"_blank\" href=\"https://channel9.msdn.com/Shows/Going+Deep/Mark-Russinovich-Inside-Windows-7\">Mark Russinovich: Inside Windows 7</a>', 0, 2, 'FavLinks');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(256) NOT NULL,
  `linktext` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(256) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `news`
--

INSERT INTO `news` (`news_id`, `link`, `linktext`, `description`, `title`) VALUES
(1, 'https://news.microsoft.com/features/artificial-intelligence-makes-a-splash-in-efforts-to-protect-alaskas-ice-seals-and-beluga-whales/', 'Read here', 'Biologists cooperate with Microsoft in AI data analysis. Until recently scientists have spent hundreds of hours by examining terabytes of aerial photos looking for migrations of polar species. Using the AI-a the will be able to let the computer perform this important but streinious part of the work.', 'Artificial intelligence (AI) in protection of seals an beluga whales'),
(2, 'https://zd.net/2MYwM4m via @ZDNet & @TiernanRayTech', 'Read the article', 'Interesting article about super-computers of future based on quantum mechanics. Currently there are only two hardware implementations of this concept, Google\'s and IBM\'s, both saw theday of the light just recently and they represent pinacle of today\'s science.', 'Pioneers among quantum computers');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `short_text_modules`
--

DROP TABLE IF EXISTS `short_text_modules`;
CREATE TABLE IF NOT EXISTS `short_text_modules` (
  `short_text_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  `_order` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `part_id` varchar(256) NOT NULL,
  PRIMARY KEY (`short_text_module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `short_text_modules`
--

INSERT INTO `short_text_modules` (`short_text_module_id`, `position`, `_order`, `title`, `text`, `part_id`) VALUES
(1, 0, 0, 'Frontend', 'As with most of the web applications today, on frontend we can find HTML, CSS, Javascript. For the prupose of speed I tried using as much as possible of AJAX calls.', 'Technical'),
(2, 1, 0, 'Backend', 'On the backend aas the technnology I choose PHP, popular language which is utilised by thousands of  web-sites running WordPress CMS platform.', 'Technical'),
(3, 0, 1, 'Backend - database', 'As the database I used MySQL, RDBMS with possibilities that more than satisfy all needs of presentational web-sites.', 'Technical'),
(5, 1, 1, 'WAMP - all-in-one solution', 'For the development in stack Windows - Apache - MySQL - PHP there is already a ready-made solution that enables fast install and easy adjsutment of Apache server, MySQL database and PHP environment.', 'Technical');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `text`
--

DROP TABLE IF EXISTS `text`;
CREATE TABLE IF NOT EXISTS `text` (
  `text_id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` varchar(256) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`text_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `text_modules`
--

DROP TABLE IF EXISTS `text_modules`;
CREATE TABLE IF NOT EXISTS `text_modules` (
  `text_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `_order` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  PRIMARY KEY (`text_module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `text_modules`
--

INSERT INTO `text_modules` (`text_module_id`, `part_id`, `text`, `_order`, `title`) VALUES
(1, 'Homepage', 'Welcome to my presentational web-site. Here you can find programming curiosities and few bits of data bout my programming work, dive right in! :)', 1, 'Welcome BARBI!'),
(3, 'FavLinks', 'Tese are some of my favorite web-sites.', 1, 'Favorite links'),
(4, 'Homepage', 'This web-site was created in year 2009., only texts are new because the old database went missing during the years when my PHP sites were offline.\r\nAlso, I have changed deprecated libraries and I adjsuted the code.\r\nThis web site is one of the first web-applications I ever created - forgive me for possible bugs and lack of best practices! :)', 3, 'Good old 2009...'),
(6, 'Homepage', 'This web-site utilizes pure Javascript (for example - for animating motion of elements) and PHP. The idea was to by-pass all of the libraries so that I would learn Javascript and PHP on the \"lowest\" possible level, without intermediarry, already made, functionalities. Such functionalities make programmer\'s life easier but they tend to hide from the programmer details that are good to learn during the training process.', 2, 'Using of ready-made libraries'),
(18, 'Homepage', 'This web-site uses a simple administrative interface for editing the texts and graphics that appear in the web-site. It is somewhat reminiscent of the times when each company that built web-site had their own home-made CMS, before the era of WordPress :)<br/><br/>\r\n<img src=\"res/admin2.png\">', 4, 'Administrative interface'),
(10, 'Leisure', 'There are few recommendations linked to the places worth visiting:\r\n\r\n<ul>\r\n<li>\r\n<a style=\"color:white;\" target=\"_blank\" href=\"https://www.eliscaffe.com/\">Elis caffe</a> - simple caffe with pleasant atmosphere and delcioius coffee.\r\n</li>\r\n<li>\r\n<a style=\"color:white;\" target=\"_blank\" href=\"https://www.vincek.com.hr/en/Slasticarnice/Tomiceva/\">Vincek Vis a Vis</a> - ice-cream places with excellent cakes and other sweets, smoothies and similar products. All products are made of natural healthy-as-possible products without additives. Cakes have perfect taste, not greasy, light, ideally sweet and yet full of flavor.\r\n</li>\r\n</ul>', 0, 'Where to go after a day at work?'),
(11, 'Leisure', 'This place can be use to find out few interesting bits and pieces from programming:\r\n\r\n<ul>\r\n<li>\r\n<a style=\"color:white;\" target=\"_blank\" href=\"https://informationisbeautiful.net/visualizations/million-lines-of-code/\">Comparison of number of lines of code in various software products</a> - although LOC cannot be a measure of application\'s complexity, we can presumme that it gives some rough introspective into the size of the application. On this link you can find estimate of LOCs in some of the famous software products.\r\n</li>\r\n<li><a style=\"color:white;\" target=\"_blank\" href=\"https://www.codingdojo.com/blog/7-most-in-demand-programming-languages-of-2018\">Article about market demand after certain programming languages</a> - interesting article about demand after programming languages during the alst few years, naturally, most-demanded doesn\'t mean most payed, but this article can be especially interesting to those that are just coming into the world of professional programming and they might get an idea what language will provide them work fastest.</li>\r\n</ul>', -1, 'Few curiosities from the world of computer programming');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'ivan', 'ivan');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
