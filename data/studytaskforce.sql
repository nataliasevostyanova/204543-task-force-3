-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 16 2021 г., 23:42
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `studytaskforce`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL COMMENT 'id категории',
  `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'название категории',
  `icon` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `location`
--

CREATE TABLE `location` (
  `id` int NOT NULL COMMENT 'id записи локации',
  `town_id` int NOT NULL COMMENT 'код города',
  `latitude` decimal(9,7) NOT NULL COMMENT 'широта города (географ.)',
  `longitude` decimal(9,7) NOT NULL COMMENT 'долгота города (географ.)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE `profile` (
  `user_id` int NOT NULL COMMENT 'id исполнителя',
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'адрес исполнителя',
  `phone` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'номер телефона пользователя',
  `email` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'email пользователя',
  `skype` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'skype пользователя',
  `other_messenger` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'другой мессенжер'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `respond`
--

CREATE TABLE `respond` (
  `id` int NOT NULL COMMENT 'id отклика',
  `task_id` int NOT NULL COMMENT 'id задания',
  `user_id` int NOT NULL COMMENT 'id  исполнителя',
  `execute_budget` int NOT NULL COMMENT 'бюджет/стоимость работ',
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'текст  отклика на задание',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'время создания отклика на задание'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL COMMENT 'id отзыва',
  `author_id` int NOT NULL COMMENT 'id заказчика',
  `task_id` int NOT NULL COMMENT 'id задания',
  `executor_id` int NOT NULL,
  `review_content` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'содержание отзыва',
  `rate_stars` decimal(3,2) NOT NULL COMMENT 'оценка выполнения задания 1-5 звёзд',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'время создания отзыва'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int NOT NULL COMMENT 'id задания',
  `created_date` datetime NOT NULL COMMENT 'время создания задания',
  `author_id` int NOT NULL COMMENT 'id заказчика',
  `executor_id` int NOT NULL COMMENT 'id  исполнителя',
  `location_id` int NOT NULL COMMENT 'почтовый индекс города',
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'название задания',
  `description` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'описание задания',
  `category_id` int NOT NULL COMMENT 'категория работ',
  `budget` int NOT NULL COMMENT 'бюджет/стоимость работ',
  `end_date` datetime NOT NULL COMMENT 'дата окончания работ',
  `task_status` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'статус задания'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `town`
--

CREATE TABLE `town` (
  `id` int NOT NULL COMMENT 'почтовый код города',
  `town` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'название города'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Названия городов';

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL COMMENT 'id пользователя',
  `full_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'имя и фамилия пользователя',
  `sign_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'дата и время создания аккаунта',
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'роль: заказчик или исполнитель',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'пароль к аккаунту',
  `avatar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'URL аватара пользователя',
  `about_user` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'рассказ исполнителя о себе',
  `birthdate` date NOT NULL COMMENT 'дата рождения',
  `town_id` int NOT NULL COMMENT 'почтовый код города'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `userevent`
--

CREATE TABLE `userevent` (
  `id` int NOT NULL COMMENT 'id типа события',
  `user_id` int NOT NULL COMMENT 'id  исполнителя',
  `event` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'наименование события',
  `icon` varchar(120) NOT NULL COMMENT 'константа имени события'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `userimage`
--

CREATE TABLE `userimage` (
  `id` int NOT NULL COMMENT 'id загруженного файла',
  `user_id` int NOT NULL COMMENT 'id пользователя, кто размещает файлы',
  `file_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'url размещения загруженного файла'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `userstatistic`
--

CREATE TABLE `userstatistic` (
  `user_id` int NOT NULL COMMENT 'id  исполнителя',
  `views_number` int NOT NULL COMMENT 'кол-во просмотров аккаунта исполнителя',
  `available_now` tinyint(1) DEFAULT '0' COMMENT 'свободен ли исполнитель',
  `last_visit` datetime NOT NULL COMMENT 'время последнего посещения сайта'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `user_category`
--

CREATE TABLE `user_category` (
  `user_id` int NOT NULL COMMENT 'id пользователя',
  `category_id` int NOT NULL COMMENT 'id категории'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='таблица связи';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `location_ibfk_1` (`town_id`) USING BTREE;

--
-- Индексы таблицы `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE;

--
-- Индексы таблицы `respond`
--
ALTER TABLE `respond`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE,
  ADD UNIQUE KEY `task_id` (`task_id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `author_id` (`author_id`),
  ADD UNIQUE KEY `task_id` (`task_id`),
  ADD UNIQUE KEY `executor_id_2` (`executor_id`),
  ADD KEY `user_id` (`author_id`),
  ADD KEY `review_ibfk_2` (`task_id`),
  ADD KEY `executor_id` (`executor_id`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `author_id_2` (`author_id`),
  ADD UNIQUE KEY `executor_id` (`executor_id`),
  ADD UNIQUE KEY `location_id` (`location_id`),
  ADD UNIQUE KEY `category_id` (`category_id`) USING BTREE,
  ADD KEY `task_ibfk_2` (`executor_id`);

--
-- Индексы таблицы `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `town_id` (`town_id`) USING BTREE;

--
-- Индексы таблицы `userevent`
--
ALTER TABLE `userevent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE;

--
-- Индексы таблицы `userimage`
--
ALTER TABLE `userimage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userimage_ibfk_1` (`user_id`) USING BTREE;

--
-- Индексы таблицы `userstatistic`
--
ALTER TABLE `userstatistic`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE;

--
-- Индексы таблицы `user_category`
--
ALTER TABLE `user_category`
  ADD UNIQUE KEY `category_id` (`category_id`) USING BTREE,
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id категории', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `location`
--
ALTER TABLE `location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id записи локации', AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `respond`
--
ALTER TABLE `respond`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id отклика', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id отзыва', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id задания', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id пользователя', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `userevent`
--
ALTER TABLE `userevent`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id типа события', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `userimage`
--
ALTER TABLE `userimage`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id загруженного файла', AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`town_id`) REFERENCES `town` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `location_ibfk_2` FOREIGN KEY (`id`) REFERENCES `task` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `respond`
--
ALTER TABLE `respond`
  ADD CONSTRAINT `respond_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`executor_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`id`) REFERENCES `respond` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`town_id`) REFERENCES `town` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id`) REFERENCES `user_category` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `userevent`
--
ALTER TABLE `userevent`
  ADD CONSTRAINT `userevent_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_category`
--
ALTER TABLE `user_category`
  ADD CONSTRAINT `user_category_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
