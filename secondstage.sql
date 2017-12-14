-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 14 2017 г., 11:37
-- Версия сервера: 5.6.34-log
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `secondstage`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `USD` int(45) DEFAULT NULL,
  `EUR` int(45) DEFAULT NULL,
  `RUB` int(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bill`
--

INSERT INTO `bill` (`id`, `name`, `user_name`, `USD`, `EUR`, `RUB`) VALUES
(22, 'Сбербанк', 'sasha', -221, 1234, 761368),
(23, 'Сбер', 'sasha', 321, 321, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cat`
--

INSERT INTO `cat` (`id`, `user_name`, `name`) VALUES
(8, 'sasha', 'Карта');

-- --------------------------------------------------------

--
-- Структура таблицы `cat2`
--

CREATE TABLE `cat2` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `user_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cat2`
--

INSERT INTO `cat2` (`id`, `name`, `user_name`) VALUES
(86, 'Еда', 'sasha');

-- --------------------------------------------------------

--
-- Структура таблицы `oper`
--

CREATE TABLE `oper` (
  `id` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `cat2_id` int(11) DEFAULT NULL,
  `bill` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `valuta` varchar(10) NOT NULL,
  `sum` varchar(25) NOT NULL,
  `date` int(255) NOT NULL,
  `bool` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `oper`
--

INSERT INTO `oper` (`id`, `user_name`, `cat_id`, `cat2_id`, `bill`, `name`, `tag`, `valuta`, `sum`, `date`, `bool`) VALUES
(123, 'sasha', 0, 0, 'Сбербанк', 'Еда', '', 'RUB', '500', 1513013334, 0),
(124, 'sasha', 0, 86, 'Сбербанк', 'Еда', '', 'RUB', '500', 1513013617, 0),
(125, 'sasha', 0, 86, 'Сбербанк', 'Еда', '', 'RUB', '500', 1513013632, 0),
(126, 'sasha', 0, 7, 'Сбербанк', 'Карта', '', 'RUB', '250000', 1513013710, 1),
(127, 'sasha', 0, 8, 'Сбербанк', 'Карта', '', 'RUB', '250000', 1513013736, 1),
(128, 'sasha', 0, 7, 'Сбербанк', 'Карта', '', 'RUB', '250000', 1513014043, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `size` varchar(45) NOT NULL,
  `cashneed` int(45) NOT NULL,
  `valuta` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `templateminus`
--

CREATE TABLE `templateminus` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `sum` int(45) NOT NULL,
  `valuta` varchar(10) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `billname` varchar(100) NOT NULL,
  `catname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `templateminus`
--

INSERT INTO `templateminus` (`id`, `name`, `username`, `sum`, `valuta`, `comment`, `billname`, `catname`) VALUES
(14, 'Еда', 'sasha', 500, 'RUB', '', 'Сбербанк', 'Еда');

-- --------------------------------------------------------

--
-- Структура таблицы `templateplus`
--

CREATE TABLE `templateplus` (
  `id` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `sum` int(45) NOT NULL,
  `valuta` varchar(10) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `billname` varchar(45) NOT NULL,
  `catname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `templateplus`
--

INSERT INTO `templateplus` (`id`, `name`, `username`, `sum`, `valuta`, `comment`, `billname`, `catname`) VALUES
(6, 'Зарплата', 'sasha', 250000, 'RUB', '', 'Сбербанк', 'Карта');

-- --------------------------------------------------------

--
-- Структура таблицы `templateswap`
--

CREATE TABLE `templateswap` (
  `id` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `username` varchar(255) NOT NULL,
  `sum` int(45) NOT NULL,
  `valuta` varchar(10) NOT NULL,
  `bill1name` varchar(45) NOT NULL,
  `bill2name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `templateswap`
--

INSERT INTO `templateswap` (`id`, `name`, `username`, `sum`, `valuta`, `bill1name`, `bill2name`) VALUES
(13, 'Перевод', 'sasha', 321, 'RUB', 'Сбер', 'Сбербанк');

-- --------------------------------------------------------

--
-- Структура таблицы `templateval`
--

CREATE TABLE `templateval` (
  `id` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `valuta` varchar(10) NOT NULL,
  `valuta2` varchar(10) NOT NULL,
  `billname` varchar(45) NOT NULL,
  `sum1` int(100) NOT NULL,
  `sum2` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `templateval`
--

INSERT INTO `templateval` (`id`, `name`, `username`, `valuta`, `valuta2`, `billname`, `sum1`, `sum2`) VALUES
(5, 'Обмен', 'sasha', 'RUB', 'USD', 'Сбербанк', 123, 321);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `password`) VALUES
(50, 'sasha', 'sasha', 'laxinar1'),
(51, 'sashager', 'ss', 'ssss');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cat2`
--
ALTER TABLE `cat2`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oper`
--
ALTER TABLE `oper`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `templateminus`
--
ALTER TABLE `templateminus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `templateplus`
--
ALTER TABLE `templateplus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `templateswap`
--
ALTER TABLE `templateswap`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `templateval`
--
ALTER TABLE `templateval`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `cat2`
--
ALTER TABLE `cat2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT для таблицы `oper`
--
ALTER TABLE `oper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT для таблицы `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `templateminus`
--
ALTER TABLE `templateminus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `templateplus`
--
ALTER TABLE `templateplus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `templateswap`
--
ALTER TABLE `templateswap`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `templateval`
--
ALTER TABLE `templateval`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
