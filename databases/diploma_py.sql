-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 24 2014 г., 21:11
-- Версия сервера: 5.5.37-0ubuntu0.13.10.1
-- Версия PHP: 5.5.3-1ubuntu2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `diploma_py`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts_message`
--

CREATE TABLE IF NOT EXISTS `accounts_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext NOT NULL,
  `sended` datetime NOT NULL,
  `user_reciver_id` int(11) NOT NULL,
  `user_sender_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_message_3c917144` (`user_reciver_id`),
  KEY `accounts_message_00a31d06` (`user_sender_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `accounts_message`
--

INSERT INTO `accounts_message` (`id`, `message`, `sended`, `user_reciver_id`, `user_sender_id`) VALUES
(1, 'Привет!', '2014-06-04 10:55:56', 2, 1),
(2, 'Доброе утро!', '2014-06-07 08:04:24', 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_group`
--

CREATE TABLE IF NOT EXISTS `auth_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_group_permissions`
--

CREATE TABLE IF NOT EXISTS `auth_group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`permission_id`),
  KEY `auth_group_permissions_5f412f9a` (`group_id`),
  KEY `auth_group_permissions_83d7f98b` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_permission`
--

CREATE TABLE IF NOT EXISTS `auth_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content_type_id` int(11) NOT NULL,
  `codename` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_type_id` (`content_type_id`,`codename`),
  KEY `auth_permission_37ef4eb4` (`content_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Дамп данных таблицы `auth_permission`
--

INSERT INTO `auth_permission` (`id`, `name`, `content_type_id`, `codename`) VALUES
(1, 'Can add permission', 1, 'add_permission'),
(2, 'Can change permission', 1, 'change_permission'),
(3, 'Can delete permission', 1, 'delete_permission'),
(4, 'Can add group', 2, 'add_group'),
(5, 'Can change group', 2, 'change_group'),
(6, 'Can delete group', 2, 'delete_group'),
(7, 'Can add user', 3, 'add_user'),
(8, 'Can change user', 3, 'change_user'),
(9, 'Can delete user', 3, 'delete_user'),
(10, 'Can add content type', 4, 'add_contenttype'),
(11, 'Can change content type', 4, 'change_contenttype'),
(12, 'Can delete content type', 4, 'delete_contenttype'),
(13, 'Can add session', 5, 'add_session'),
(14, 'Can change session', 5, 'change_session'),
(15, 'Can delete session', 5, 'delete_session'),
(16, 'Can add log entry', 6, 'add_logentry'),
(17, 'Can change log entry', 6, 'change_logentry'),
(18, 'Can delete log entry', 6, 'delete_logentry'),
(19, 'Can add table', 7, 'add_table'),
(20, 'Can change table', 7, 'change_table'),
(21, 'Can delete table', 7, 'delete_table'),
(22, 'Can add info', 8, 'add_info'),
(23, 'Can change info', 8, 'change_info'),
(24, 'Can delete info', 8, 'delete_info'),
(47, 'Can change store file', 16, 'change_storefile'),
(46, 'Can add store file', 16, 'add_storefile'),
(44, 'Can change message', 15, 'change_message'),
(43, 'Can add message', 15, 'add_message'),
(45, 'Can delete message', 15, 'delete_message'),
(37, 'Can add post', 13, 'add_post'),
(38, 'Can change post', 13, 'change_post'),
(39, 'Can delete post', 13, 'delete_post'),
(48, 'Can delete store file', 16, 'delete_storefile');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_user`
--

CREATE TABLE IF NOT EXISTS `auth_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(128) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(75) NOT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_joined` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `auth_user`
--

INSERT INTO `auth_user` (`id`, `password`, `last_login`, `is_superuser`, `username`, `first_name`, `last_name`, `email`, `is_staff`, `is_active`, `date_joined`) VALUES
(1, 'pbkdf2_sha256$12000$H61m46IJhtKK$/bqo4xbf/Ali1NgkHAxJVlLmyeEqFiY8yw1Tggsgz/4=', '2014-06-13 13:19:23', 1, 'admin', 'Александр', 'Собянин', '', 1, 1, '2014-03-24 12:45:51'),
(2, 'pbkdf2_sha256$12000$oXrGwI9NnCNB$uSeYT3BlQ6rtY9mPEAubbqiqblFA4V6S2W6pzJIxvsQ=', '2014-05-11 12:17:16', 0, 'eocen', 'Егор', 'Глотов', '', 0, 1, '2014-05-11 12:04:24'),
(3, 'pbkdf2_sha256$12000$NfGQsdiU3Shf$oAzckrnM+386dSvpp7d5IGLYDUKaRv4RR7QC+enA7f4=', '2014-06-13 13:19:10', 0, 'dora', 'Дарья', 'Карпова', '', 0, 1, '2014-05-11 12:29:00');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_user_groups`
--

CREATE TABLE IF NOT EXISTS `auth_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`group_id`),
  KEY `auth_user_groups_6340c63c` (`user_id`),
  KEY `auth_user_groups_5f412f9a` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_user_user_permissions`
--

CREATE TABLE IF NOT EXISTS `auth_user_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`permission_id`),
  KEY `auth_user_user_permissions_6340c63c` (`user_id`),
  KEY `auth_user_user_permissions_83d7f98b` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `django_admin_log`
--

CREATE TABLE IF NOT EXISTS `django_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `content_type_id` int(11) DEFAULT NULL,
  `object_id` longtext,
  `object_repr` varchar(200) NOT NULL,
  `action_flag` smallint(5) unsigned NOT NULL,
  `change_message` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `django_admin_log_6340c63c` (`user_id`),
  KEY `django_admin_log_37ef4eb4` (`content_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `django_admin_log`
--

INSERT INTO `django_admin_log` (`id`, `action_time`, `user_id`, `content_type_id`, `object_id`, `object_repr`, `action_flag`, `change_message`) VALUES
(11, '2014-05-11 12:29:35', 1, 3, '1', 'admin', 2, 'Изменен password.'),
(10, '2014-05-11 12:16:49', 1, 3, '1', 'admin', 2, 'Изменен password.'),
(9, '2014-05-10 21:10:20', 1, 3, '1', 'admin', 2, 'Изменен first_name,last_name и date_joined.'),
(17, '2014-06-04 18:06:31', 1, 16, '1', 'Игра LiteSnake', 3, '');

-- --------------------------------------------------------

--
-- Структура таблицы `django_content_type`
--

CREATE TABLE IF NOT EXISTS `django_content_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `app_label` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_label` (`app_label`,`model`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `django_content_type`
--

INSERT INTO `django_content_type` (`id`, `name`, `app_label`, `model`) VALUES
(1, 'permission', 'auth', 'permission'),
(2, 'group', 'auth', 'group'),
(3, 'user', 'auth', 'user'),
(4, 'content type', 'contenttypes', 'contenttype'),
(5, 'session', 'sessions', 'session'),
(6, 'log entry', 'admin', 'logentry'),
(7, 'table', 'timetable', 'table'),
(8, 'info', 'info', 'info'),
(16, 'store file', 'files', 'storefile'),
(15, 'message', 'accounts', 'message'),
(13, 'post', 'forum', 'post');

-- --------------------------------------------------------

--
-- Структура таблицы `django_session`
--

CREATE TABLE IF NOT EXISTS `django_session` (
  `session_key` varchar(40) NOT NULL,
  `session_data` longtext NOT NULL,
  `expire_date` datetime NOT NULL,
  PRIMARY KEY (`session_key`),
  KEY `django_session_b7b81f0c` (`expire_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `django_session`
--

INSERT INTO `django_session` (`session_key`, `session_data`, `expire_date`) VALUES
('s34e93t8w8i7yo11pa4dpmkoz1349sye', 'MWUwNjk1YmM5MTc1MTBmMDk0MWFiMDgzZmZlOWQyMTdiYWNiN2EzMDp7Il9hdXRoX3VzZXJfYmFja2VuZCI6ImRqYW5nby5jb250cmliLmF1dGguYmFja2VuZHMuTW9kZWxCYWNrZW5kIiwiX2F1dGhfdXNlcl9pZCI6M30=', '2014-05-30 07:43:19'),
('054dviozgnf8q224ka9id87jabscq5lo', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-18 08:01:23'),
('l5olwg6h24vb5f7cexoktjsqr0qjkird', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:05:25'),
('f5nzkqdiydvxyafbjgulo2ewqeun2r6o', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:05:38'),
('8ni87jucogeph88p2xnipaveeuj5ys8w', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:10:28'),
('fsxpikz6umzhv33oqfjqtm2qdp8an3ne', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:11:30'),
('xcecvxxs29j909cjpyl20hokslpt3lj7', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:11:32'),
('x95b6df39l34rcky8ehpt9rwe0vnqcmr', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:11:33'),
('a24p1fpy4auqt5f2p9noxysmtxodejmy', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:11:34'),
('vt0vq2b6rf69o2opu32vrhbiswucjgph', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:11:35'),
('v2hktq90askam4dbpn00dqg888toe9ha', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:11:36'),
('zrz3qt6g9l9qtzcmtl3mo7duf9f57mrq', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:11:50'),
('ydbq5fweg37kyl66tqp0wyzfe6s97437', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:11:51'),
('g7mki2nwgg0k962ak40t2snwjaxnbl5w', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:11:52'),
('9ao16lqsgultsmcuuh3uo5aatevaveb0', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-10 23:11:55'),
('css8scjeb90sg71zbltmv3ubnyo3ek3u', 'NzYwYWI2YWM5NzFkNjAxMDc4OTVjZDczNjNjY2Y5MmU2Mjk4ZTVjNDp7Il9hdXRoX3VzZXJfYmFja2VuZCI6ImRqYW5nby5jb250cmliLmF1dGguYmFja2VuZHMuTW9kZWxCYWNrZW5kIiwiX2F1dGhfdXNlcl9pZCI6MX0=', '2014-06-05 05:55:04'),
('pmt1b68hyc084pw0l4f3qivwbv3mzy1a', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-15 20:05:31'),
('2593qzfr5w3dtlwkjww159ctjhkuft5w', 'NzYwYWI2YWM5NzFkNjAxMDc4OTVjZDczNjNjY2Y5MmU2Mjk4ZTVjNDp7Il9hdXRoX3VzZXJfYmFja2VuZCI6ImRqYW5nby5jb250cmliLmF1dGguYmFja2VuZHMuTW9kZWxCYWNrZW5kIiwiX2F1dGhfdXNlcl9pZCI6MX0=', '2014-06-27 13:19:23'),
('7j37ptzgorepw7ghx7tgrxtwqotbn8xr', 'OWRjNzZjOWZlNTRjYzNmZmI0YjI2ODA1OTFjYjMyOGM1ZjllMzkyZDp7fQ==', '2014-05-15 19:31:37');

-- --------------------------------------------------------

--
-- Структура таблицы `files_storefile`
--

CREATE TABLE IF NOT EXISTS `files_storefile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `file` varchar(100) NOT NULL,
  `sended` datetime NOT NULL,
  `user_sender_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `files_storefile_00a31d06` (`user_sender_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `files_storefile`
--

INSERT INTO `files_storefile` (`id`, `name`, `file`, `sended`, `user_sender_id`) VALUES
(2, 'LiteSnake', './LiteSnake.exe', '2014-06-04 18:06:54', 1),
(3, 'Бланк отзыва', './Otzyv.doc', '2014-06-13 12:02:33', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `forum_post`
--

CREATE TABLE IF NOT EXISTS `forum_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `user_sender_id` int(11) NOT NULL,
  `sended` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_post_00a31d06` (`user_sender_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `forum_post`
--

INSERT INTO `forum_post` (`id`, `message`, `user_sender_id`, `sended`) VALUES
(1, 'Добро пожаловать!', 1, '2014-06-04 10:49:20'),
(2, 'Как проходит сдача сессии?', 1, '2014-06-04 11:56:45'),
(3, 'Сдача ГЭК 10 числа', 1, '2014-06-07 06:30:00');

-- --------------------------------------------------------

--
-- Структура таблицы `info_info`
--

CREATE TABLE IF NOT EXISTS `info_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `text` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `info_info`
--

INSERT INTO `info_info` (`id`, `title`, `text`) VALUES
(1, 'Информация о сайте', 'Информация для группы УрФУ, ИМКН, ПИ-301, Набор 2010-2014.');

-- --------------------------------------------------------

--
-- Структура таблицы `timetable_table`
--

CREATE TABLE IF NOT EXISTS `timetable_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `room` varchar(10) NOT NULL,
  `teacher` varchar(20) NOT NULL,
  `day` varchar(2) NOT NULL,
  `begin` time NOT NULL,
  `ends` time NOT NULL,
  `parity` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `timetable_table`
--

INSERT INTO `timetable_table` (`id`, `title`, `room`, `teacher`, `day`, `begin`, `ends`, `parity`) VALUES
(6, 'ТС', 'Т4, 625', 'Ряшко', '3', '10:40:00', '12:10:00', 0),
(4, 'МАТЭК', 'Т4, 621', 'Логинов', '2', '16:10:00', '17:30:00', 0),
(3, 'ПОИС', 'Т4, КМЭ', 'Гальперин', '2', '14:30:00', '16:00:00', 0),
(2, 'ЛОИ', 'Т4, 628', 'Михайлова ', '1', '17:50:00', '19:20:00', 0),
(1, 'ЛОИ', 'Т4, 628', 'Михайлова', '1', '16:10:00', '17:40:00', 0),
(7, 'ОС', 'Т4, 621', 'Лукач', '3', '12:50:00', '14:20:00', 0),
(8, 'Политология', 'Т4, 621', 'Наронская', '3', '14:30:00', '16:10:00', 0),
(9, 'Естествознание', 'Т4, 632', 'Бородин', '3', '16:10:00', '17:50:00', 0),
(10, 'Социология', 'Т4, 632', 'Вандышев', '3', '17:50:00', '19:20:00', 0),
(14, 'ОС', '105', '', '5', '16:10:00', '17:40:00', 0),
(11, 'ИМ', 'Т4, 628', 'Березин', '4', '09:00:00', '10:30:00', 0),
(15, 'МИРЭК', '', 'Степанова', '2', '12:10:00', '14:20:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
