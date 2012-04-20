-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 20 2012 г., 18:18
-- Версия сервера: 5.1.61
-- Версия PHP: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `bestplace`
--
CREATE DATABASE `bestplace` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bestplace`;

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `pwd` varchar(128) NOT NULL,
  `salt` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `disabled` int(11) NOT NULL DEFAULT '1',
  `create_dt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='учетки' AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id`, `login`, `pwd`, `salt`, `name`, `email`, `disabled`, `create_dt`) VALUES
(1, 'mike', 'a984f914f31a2e5080399bd0d48d926e', '301w10ddtk', 'Яковлев Михаил', 'yakovleff@mail.ru', 0, '2012-04-20 00:00:00');
