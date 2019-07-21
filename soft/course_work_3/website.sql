-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 17 2013 г., 16:54
-- Версия сервера: 5.5.32
-- Версия PHP: 5.4.6-1ubuntu1.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `website`
--

-- --------------------------------------------------------

--
-- Структура таблицы `c3_timetable`
--

CREATE TABLE IF NOT EXISTS `c3_timetable` (
  `id` smallint(11) NOT NULL AUTO_INCREMENT,
  `day` enum('0','1','2','3','4','5','6') NOT NULL,
  `begin` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `title` varchar(20) NOT NULL,
  `teacher` varchar(20) DEFAULT NULL,
  `room` varchar(10) DEFAULT NULL,
  `parity` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `c3_timetable`
--

INSERT INTO `c3_timetable` (`id`, `day`, `begin`, `end`, `title`, `teacher`, `room`, `parity`) VALUES
(1, '1', '16:10:00', '17:40:00', 'ЛОИ', 'Михайлова', 'Т4, 628', 0),
(2, '1', '17:50:00', '19:20:00', 'ЛОИ', 'Михайлова ', 'Т4, 628', 0),
(3, '2', '14:30:00', '16:00:00', 'ПОИС', 'Гальперин', 'Т4, КМЭ', 0),
(4, '2', '16:10:00', '17:30:00', 'МАТЭК', 'Логинов', 'Т4, 621', 0),
(6, '3', '10:40:00', '12:10:00', 'ТС', 'Ряшко', 'Т4, 625', 0),
(7, '3', '12:50:00', '14:20:00', 'ОС', 'Лукач', 'Т4, 621', 0),
(8, '3', '14:30:00', '16:10:00', 'Политология', 'Наронская', 'Т4, 621', 0),
(9, '3', '16:10:00', '17:50:00', 'Естествознание', 'Бородин', 'Т4, 632', 0),
(10, '3', '17:50:00', '19:20:00', 'Социология', 'Вандышев', 'Т4, 632', 0),
(14, '5', '16:10:00', '17:40:00', 'ОС', NULL, '105', 0),
(11, '4', '09:00:00', '10:30:00', 'ИМ', 'Березин', 'Т4, 628', 0),
(15, '2', '12:10:00', '14:20:00', 'МИРЭК', 'Степанова', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `author` int(11) NOT NULL,
  `send` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `name`, `path`, `author`, `send`) VALUES
(3, 'README.md', './files/README.md', 3, '2013-10-16 10:57:19');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `send` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `message`, `send`, `from`, `to`) VALUES
(10, 'Привет', '2013-10-15 09:52:20', 1, 4),
(1, 'Ты теперь модератор.', '2013-09-01 14:40:14', 1, 2),
(9, 'Hello', '2013-09-25 11:39:28', 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `author` int(11) NOT NULL,
  `send` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `theme` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `message`, `author`, `send`, `theme`) VALUES
(45, 'Хорошо я тоже буду', 1, '2013-10-15 09:51:55', 13),
(46, 'бу га га', 3, '2013-10-16 10:56:04', 13),
(44, 'На поис мы заполняем справочники (2.5 - 2.6)', 1, '2013-10-15 09:50:47', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `author` int(11) NOT NULL,
  `send` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `theme`
--

INSERT INTO `theme` (`id`, `title`, `author`, `send`) VALUES
(13, 'привет', 1, '2013-10-16 10:56:04');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `email` varchar(20) CHARACTER SET utf32 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `position`, `firstname`, `lastname`, `birth`, `phone`, `email`) VALUES
(1, 'admin', '76d80224611fc919a5d54f0ff9fba446', 2, 'Александр', 'Собянин', '1992-12-09', '+79022563069', 'delta01j@gmail.com'),
(2, 'zevaqa', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'Игорь', 'Дмитриев', '1992-03-28', NULL, NULL),
(3, 'khlyzoff', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 'Илья', 'Хлызов', NULL, NULL, NULL),
(4, 'paxan', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 'Павел', 'Мамаев', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
