-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 25 2023 г., 15:36
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `aspro`
--

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE `results` (
  `id` int(5) NOT NULL,
  `result` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `initialLine` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `results`
--

INSERT INTO `results` (`id`, `result`, `time`, `initialLine`) VALUES
(46, 'false', '2023-10-25 15:35:41', '( 2 * 45 [ 11 ) - 7]'),
(47, 'false', '2023-10-25 15:35:47', '( 2 { 3 / [ ? } 1 ] )'),
(48, 'false', '2023-10-25 15:35:53', '> < > < '),
(49, 'true', '2023-10-25 15:35:58', '< ( { [ 42 ] } ) > '),
(50, 'true', '2023-10-25 15:36:03', '( 2 * 44 [ 11 ] )'),
(51, 'true', '2023-10-25 15:36:11', '< a * ( 4 / 7 - [ 2 - 2] / { 11 } ) >'),
(52, 'true', '2023-10-25 15:36:18', '(привет+пока)');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
