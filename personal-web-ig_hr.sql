-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Erstellungszeit: 04. Sep 2020 um 23:45
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
-- Datenbank: `personal-web-ig_hr`
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_date`, `comment_author`, `comment_text`) VALUES
(5, '2020-06-24 01:27:58', 'jhbhjb', 'jhbhbjhb[muu][:P]'),
(6, '2020-06-24 01:28:07', 'hjbhb', 'b jb :D:D:D:D:D:D');

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
(6, 'Općenito', 'Budući da danas postoji više mjesta na web-u gdje je moguće postaviti informacije o svom radu, umjesto kopiranja teksta, u nastavku je par linkova na takve informacije.', 3, 1);

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
(1, 'Linkovi', 1, 0),
(3, 'Životopis i informacije', 0, 0);

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
(1, 'Vorarlberg - Austrija', 'gallery1', 'Slike iz Bludenza, pokrajina Vorarlberg, Austrija.', 'Leisure', 3),
(6, 'Drava pokraj Varaždina <3', 'gallery6', '', 'Leisure', 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `grades`
--

INSERT INTO `grades` (`grade_id`, `grade`, `ip`) VALUES
(3, 4, '::1'),
(4, 3, '::1');

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
('::1', '2020-06-24 01:42:40', 40);

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
(1, 'FavProgram', 1, 'Programska podrška za profesionalno programiranje', 'Ovdje su neki od alata koje najviše volim koristiti u poslu. Kroz dugogodišnju upotrebu pokazali su i dokazali koliko su korisni i pouzdani.', 'res/vs.jpg', 1),
(4, 'FavProgram', 2, 'Ne-programerski programi :)', 'Ovdje je nekoliko programa koji se uvijek iznova pokazuju korisnima, a uz to su i besplatni ;)', 'res/firefox.jpg', 1),
(8, 'FavLinks', 1, 'Microsoft Channel 9', 'Zanimljiv web resurs s interview-ima s Microsoft developerima. Posebno su mi zanimljivi interview-i s \"tagom\" internals ili \"kernel\" u kojima je moguće čuti ljude koji su stvarali fascinantne stvari kakve su kernel Windows-a, memory manager i sl.', 'res/Rob-Short-and-kernel-team-Going-deep-inside-Windo_512.jpg', 1);

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
(1, 1, 'Microsoft Visual Studio', 'Vrhunski alat za izradu softvera na Microsoft i open-source tehnologijama. Podržani su mnogi programski jezici i tipovi aplikacija. Funkcioniranje samog programa je brzo i pouzdano. Na raspolaganju je široki izbor alata i ekstenzija za Visual Studio, sve ovo čini ovaj IDE (Integrated Development Environment) mojim omiljenim IDE-om od 2003. pa na dalje.', 0, 1, 'Technical'),
(16, 4, 'Gimp', 'Napredni program za uređivanje slike. Podržava rad s layer-ima i mnoge funkcije koje se nalaze u Photoshopu.', 1, 3, 'FavProgram'),
(15, 4, 'Mozzila Firefox', 'Jedan od najkorištenijih browsera s puno korisnih besplatnih ekstenzija. Renderira stranice bez problema i u skladu s HTML standardima.', 0, 1, 'FavProgram'),
(8, 1, 'Git', 'Vrlo popularan (s dobrim razlogom!) Version Control System - potpuno je besplatan, bez problema podržava i male i velike projekte. Ovaj softver osmislio je Linus Torvalds za potrebe razvoja Linux kernela.', 1, 1, 'FavProgram'),
(17, 4, 'BS Player', 'Video player s različitim mogućnostima i korisnom funkcionalnosti automatskog traženja prijevoda.', 0, 2, 'FavProgram'),
(18, 1, 'Microsoft SQL Server', 'Enterprise-level RDMS sustav, iako su \"jače\" verzije relativno skupe, postoji i besplatna verzija za jednostavniju upotrebu.', 0, 3, 'FavProgram'),
(19, 4, 'Scratch', 'MIT-ov programski jezik i IDE koji omogućuju djeci učenje programiranja. Odličan softver i koncept razvijen od strane pedagoga i računalnih stručnjaka omogućuje najmlađima ulazak u svijet programiranja.', 1, 2, 'FavProgram'),
(21, 8, 'Interview s one-man-team developerom koji razvija ', 'Zanimljiv interview s programerom koji <b>sam</b> razvija veliki komad memorijske funkcionalnosti Windows-a, zanimljivo za promatranje sa \"sigurne udaljenosti\" :)\r\n<br/><br/><a target=\"_blank\" href=\"https://channel9.msdn.com/Shows/Going+Deep/Landy-Wang-Windows-Memory-Manager\">Memory manager - Landy Wang</a>', 0, 1, 'FavLinks'),
(22, 8, 'Razgovor s jednim od arhitekata Windows kernela', 'Star ali vrlo poučan i pitak razgovor s jednim od arhitekata kernela u Windows-ima. Interview se sastoji se od 4 dijela. Osim objašnjavanja zanimlijvosti vezanih uz kernel, Dave govori i o općenitim zanimlijvostima iz povijesti Windows-a. Prvi dio:<br/><br/><a  target=\"_blank\" href=\"https://channel9.msdn.com/Shows/Going+Deep/Windows-Part-I-Dave-Probert\">Windows, Part I - Dave Probert</a>', 1, 1, 'FavLinks'),
(24, 8, 'Mark Russinovich - autor SysInternals alata', 'Razgovor \r\ns jednim od Microsoft-ovih all-star Windows inženjera, Markovi roditelji su, porijeklom iz Hrvatske. Autor je nekoliko izvrsnih alata za in-depth nadziranje sistemskog stanja i poruka (Sysmon, Process Explorer...)\r\n<br/>\r\n<br/>\r\n<a target=\"_blank\" href=\"https://channel9.msdn.com/Shows/Going+Deep/Mark-Russinovich-Inside-Windows-7\">Mark Russinovich: Inside Windows 7</a>', 0, 2, 'FavLinks');

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
(1, 'https://news.microsoft.com/features/artificial-intelligence-makes-a-splash-in-efforts-to-protect-alaskas-ice-seals-and-beluga-whales/', 'Pročitajte ovdje', 'Biolozi surađuju s Microsoft-om u AI analizi podataka. Do nedavno znanstvenici su trošili stotine sati u pregledu terabajta zračnih fotografija tražeći migracije polarnih vrsta. Pomoću AI-a moći će ovaj ključan ali naporan dio posla uz visoku pouzdanost prepustiti računalu.', 'Umjetna inteligencija (AI) u zaštiti tuljana i beluga kitova'),
(2, 'https://zd.net/2MYwM4m via @ZDNet & @TiernanRayTech', 'Pročitajte članak', 'Interesantan članak o super-računalima budućnosti baziranim na kvantnoj mehanici. Trenutno postoje samo dvije hardverske implementacije ovog koncepta, Google-ova i IBM-ova, obje su na svjetlo dana izišle tek nedavno i obje predstavljaju vrhunac današnje znanosti.', 'Pioniri među kvantnim računalima');

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
(1, 0, 0, 'Frontend', 'Kao i kod većine web aplikacija danas na frontendu nalazimo HTML, CSS, Javascript. Zbog brzine pokušao sam koristiti čim više AJAX poziva.', 'Technical'),
(2, 1, 0, 'Backend', 'Na backendu kao tehnologija odabran je PHP, popularni jezik pomoću kojeg rade tisuće web-site-ova na WordPress CMS-u.', 'Technical'),
(3, 0, 1, 'Backend - baza podataka', 'Kao baza koristi se MySQL, RDBMS s mogućnostima koje zadovoljavaju sve prezentacijske web-site-ove.', 'Technical'),
(5, 1, 1, 'WAMP - all-in-one rješenje', 'Za razvoj aplikacija u stacku Windows - Apache - MySQL - PHP postoji već gotovo rješenje koje omogućava brzu instalaciju i olakšano podešavanje Apache servera, MySQL baze i PHP okruženja.', 'Technical');

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
(1, 'Homepage', 'Dobrodošli na moj prezentacijski web-site. Ovdje možete naći programerske zanimljivosti i par sitnica o mojem programerskom radu, dive right in! :)', 1, 'Dobrodošli!'),
(3, 'FavLinks', 'Ovo su neki od mojih omiljenih web-siteova.', 1, 'Omiljeni linkovi'),
(4, 'Homepage', 'Ovaj website je nastao 2009. godine, jedino su tekstovi koje novi jer je stara baza podataka izgubljena.\r\nTakođer, izmijenjeni su \"deprecated\" library-i i prilagođen je kod.\r\nOvaj web-site predstavlja jednu od prvih web-aplikacija koje sam napravio - oprostite moguće bugove i nekorištenje \"best-practice\"-a! :)', 3, 'Stara dobra 2009...'),
(6, 'Homepage', 'Na ovom web-site-u korišten je čisti Javascript (primjerice za animacije kretanja elemenata) i PHP. Ideja je bila izbjeći sve library-a kako bi tokom izrade stekao poznavanje Javascript-a i PHP-a na čim \"nižoj\" razini, bez posredničkih, već gotovih, funkcionalnosti. Takve funkcionalnosti olakšavaju programerski život ali od programera skrivaju detalje koje je dobro upoznati tokom učenja.', 2, 'Korištenje gotovih library-a'),
(18, 'Homepage', 'Ovaj web-site koristi i jednostavno administrativno sučelje za uređivanje tekstova i grafika koje se pojavljuju na njemu. Podsjetnik na vremena kada je svaka firma koja se bavila web programiranjem imala vlastiti CMS, prije WordPress ere :)<br/><br/>\r\n<img src=\"res/admin2.png\">', 4, 'Admin sučelje'),
(10, 'Leisure', 'Nekoliko preporuka vezanih uz mjesta za izlaske:\r\n\r\n<ul>\r\n<li>\r\n<a style=\"color:white;\" target=\"_blank\" href=\"https://www.eliscaffe.com/\">Elis caffe</a> - jednostavan kafić s ugodnom atmosferom i odličnom kavom.\r\n</li>\r\n<li>\r\n<a style=\"color:white;\" target=\"_blank\" href=\"https://www.vincek.com.hr/en/Slasticarnice/Tomiceva/\">Vincek Vis a Vis</a> - slastičarna s odličnim kolačima, smoothie-ima i sličnim proizvodima. Svi proizvodi su izrađeni od čim zdravijih prirodnih sastojaka bez aditiva. Kolači imaju savršen okus, nemasni, lagani, idealno slatki a opet puni okusa.\r\n</li>\r\n</ul>', 0, 'Kamo nakon radnog vremena?'),
(11, 'Leisure', 'Ovo mjesto može se iskoristiti za par zanimljivih sitnica iz programiranja:\r\n\r\n<ul>\r\n<li>\r\n<a style=\"color:white;\" target=\"_blank\" href=\"https://informationisbeautiful.net/visualizations/million-lines-of-code/\">Usporedba broja linija koda u različitim softverskim proizvodima</a> - iako broj linija koda nije precizna mjera složenosti aplikacije, možemo pretpostaviti da uglavnom daje neki grubi uvid u veličinu aplikacije. Na ovom linku nalazi se procjena broja linija koda ugrađenih u razne poznate softverske proizvode.\r\n</li>\r\n<li><a style=\"color:white;\" target=\"_blank\" href=\"https://www.codingdojo.com/blog/7-most-in-demand-programming-languages-of-2018\">Članak o traženosti programskih jezika</a> - Zanimljiv članak o traženosti programskih jezika unutar zadnjih nekoliko godina, naravno, najtraženiji ne znači i najplaćeniji, ali ovaj članak posebno je zanimljiv za one koji tek ulaze u svijet profesionalnog razvoja softvera i može im dati ideju s kojim programskim jezikom će najbrže naći posao.</li>\r\n</ul>', -1, 'Par zanimljivosti iz svijeta programiranja');

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
