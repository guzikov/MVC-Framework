-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Авг 28 2018 г., 11:18
-- Версия сервера: 5.6.38
-- Версия PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shereposts`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created_at`) VALUES
(1, 13, 'post one', 'This is a test for post one', '2018-06-19 20:45:32'),
(2, 13, 'Post two', 'This is the test for post two', '2018-06-19 20:45:32'),
(3, 12, '123', 'sasdfsdf', '2018-06-20 20:17:25'),
(4, 14, 'luiz', 'sdfsdf', '2018-06-20 20:18:23'),
(5, 15, 'Hello world!', 'Test test test', '2018-08-28 11:06:33');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(6, 'testflesh', 'flesh@gmail.com', '$2y$10$gAopmiYA5wb2AhRP/Nnrn.m7GMljnuqZNUCh7ch.0Tu7r4lt4mIRW', '2018-05-22 17:01:58'),
(7, 'sdfdsf', 'abs@gmail.com', '$2y$10$LZDOjn.Rrr36Lc94jDLB0uuaBs0e5lyI3ntCH6qwe9MNsuVy5zHXK', '2018-05-22 17:06:12'),
(8, 'sdfsdsdf', 'sdf@emss.ru', '$2y$10$e9QSz3W.TxnkOzMGBXjqIuv9saNnXzacmLgVcKi7UwYL8GHSLKxD2', '2018-05-22 17:09:22'),
(9, 'sdfsdf', 'sdfsdfsd@dsfs.com', '$2y$10$uQIefY9gkuhm8HNVQf8L/ObRpcH5W9EOO.FsFlLic2HhqCqFACm8a', '2018-05-22 17:11:41'),
(10, 'sdfdsfsdf', 'sdfsdfn@gmail.com', '$2y$10$u5ZEv6RJRZSq3e0LyQpHhOafVYeWSq5WpDPvZJ1ARX08.1k0hDgsG', '2018-05-22 17:13:16'),
(11, 'dsds', 'sdfkk@g.com', '$2y$10$5W0A3TnQMhCvful29b6Hh.ca7WvcsOOOTMDXCghFR0uosBDaf3O7y', '2018-05-22 17:16:54'),
(12, 'Sergei', 'sergei@sergei.com', '$2y$10$hKxHgqUGBLgVyg9gaPnc0OvYqPJ0T7GYsS7aUS/1UBIt8vSJw9d2.', '2018-06-19 19:48:46'),
(13, 'sergei', 'sergei@sg.ru', '$2y$10$NTPh/lqFZuNqgqcnPwAMYOkCcP.6N5Z7Gdev2yIvPS0ZOenG0Q4GS', '2018-06-19 20:05:56'),
(14, 'S', 's@s.ru', '$2y$10$/0wII2Dmg1ltrwgv6saWXu1MwLbZ.7YOGcUIoDL2Hshh4bGPplX7q', '2018-06-20 20:18:05'),
(15, 'sergei', 'sergei@email.com', '$2y$10$z4RGRw64j6wS9D0vA4nzHOracC/DCQF0.U45axs3cVMV/xKQulAaO', '2018-08-28 11:05:40');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
