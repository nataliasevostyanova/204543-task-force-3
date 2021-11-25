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
-- База данных: `db_taskforce`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id категории',
  `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'название категории',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Структура таблицы `town`
--

CREATE TABLE `town` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'почтовый код города',
  `town` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'название города',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Названия городов';

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id пользователя',
  `full_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'имя и фамилия пользователя',
  `sign_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'дата и время создания аккаунта',
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'роль: заказчик или исполнитель',
  `phone` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'номер телефона пользователя',
  `email` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'email пользователя',
  `telegram` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NULL COMMENT 'telegram пользователя',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NULL COMMENT 'пароль к аккаунту',
  `avatar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NULL COMMENT 'URL аватара пользователя',
  `about_user` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL COMMENT 'рассказ исполнителя о себе',
  `birthdate` date NULL COMMENT 'дата рождения',
  `town_id` int NULL COMMENT 'почтовый код города',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  CONSTRAINT fk_user_town_id
      FOREIGN KEY (town_id)  REFERENCES town (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `task` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id задания',
  `created_date` datetime NOT NULL COMMENT 'время создания задания',
  `client_id` int NOT NULL COMMENT 'id заказчика',
  `doer_id` int NULL COMMENT 'id  исполнителя',
  `town_id` int NOT NULL COMMENT 'почтовый индекс города',
  `latitude` decimal(9,7) NOT NULL COMMENT 'широта города (географ.)',
  `longitude` decimal(9,7) NOT NULL COMMENT 'долгота города (географ.)',
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'название задания',
  `description` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'описание задания',
  `category_id` int NOT NULL COMMENT 'категория работ',
  `budget` int NOT NULL COMMENT 'бюджет/стоимость работ',
  `finish_date` datetime NOT NULL COMMENT 'дата окончания работ',
  `task_status` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'статус задания',
  PRIMARY KEY (`id`),
  CONSTRAINT fk_task_client_id
    FOREIGN KEY (client_id)  REFERENCES user (id)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
  CONSTRAINT fk_task_doer_id
    FOREIGN KEY (doer_id)  REFERENCES user (id)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
  CONSTRAINT fk_task_town_id
    FOREIGN KEY (town_id)  REFERENCES town (id)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
  CONSTRAINT fk_task_category_id
    FOREIGN KEY (category_id)  REFERENCES category (id)
      ON DELETE CASCADE
      ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- --------------------------------------------------------

--
-- Структура таблицы `respond`
--

CREATE TABLE `respond` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id отклика',
  `task_id` int NOT NULL COMMENT 'id задания',
  `doer_id` int NOT NULL COMMENT 'id  исполнителя',
  `execute_budget` int NOT NULL COMMENT 'бюджет/стоимость работ',
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'текст  отклика на задание',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'время создания отклика на задание',
  PRIMARY KEY (`id`),
  CONSTRAINT fk_respond_doer_id
    FOREIGN KEY (doer_id)  REFERENCES user (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_respond_task_id
   FOREIGN KEY (task_id)  REFERENCES task (id)
   ON DELETE CASCADE
   ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id отзыва',
  `client_id` int NOT NULL COMMENT 'id заказчика',
  `task_id` int NOT NULL COMMENT 'id задания',
  `doer_id` int NOT NULL  COMMENT 'id исполнителя',
  `review_content` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'содержание отзыва',
  `stars` int NULL COMMENT 'оценка выполнения задания 1-5 звёзд',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'время создания отзыва',
  PRIMARY KEY (`id`),
  CONSTRAINT fk_review_client_id
    FOREIGN KEY (client_id)  REFERENCES user (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_review_doer_id
    FOREIGN KEY (doer_id)  REFERENCES user (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_review_task_id
    FOREIGN KEY (task_id)  REFERENCES task (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
--
-- Структура таблицы `userevent`
--

CREATE TABLE `userevent` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id события',
  `doer_id` int NOT NULL COMMENT 'id  исполнителя',
  `task_id` int NOT NULL COMMENT 'id  задания',
  `event` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL COMMENT 'наименование события',
  PRIMARY KEY (`id`),
  CONSTRAINT fk_userevent_doer_id
    FOREIGN KEY (doer_id)  REFERENCES user (id)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
  CONSTRAINT fk_userevent_task_id
    FOREIGN KEY (task_id)  REFERENCES task (id)
      ON DELETE CASCADE
      ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `userimage`
--

CREATE TABLE `userimage` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id загруженного файла',
  `user_id` int NOT NULL COMMENT 'id пользователя, кто размещает файлы',
  `file_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NULL COMMENT 'url размещения загруженного файла',
  PRIMARY KEY (`id`),
  CONSTRAINT fk_userimage_user_id
    FOREIGN KEY (user_id)  REFERENCES user (id)
      ON DELETE CASCADE
      ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `userstatistic`
--

CREATE TABLE `userstatistic` (
  `user_id` int NOT NULL AUTO_INCREMENT COMMENT 'id  исполнителя',
  `views_number` int NULL COMMENT 'кол-во просмотров аккаунта исполнителя',
  `available_now` tinyint(1) DEFAULT '0' COMMENT 'свободен ли исполнитель',
  `last_visit` datetime NOT NULL COMMENT 'время последнего посещения сайта',
  `rating` int NULL COMMENT 'место в рейтинге исполнителей по количеству звёзд',
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT fk_userstatistic_user_id
    FOREIGN KEY (user_id)  REFERENCES user (id)
      ON DELETE CASCADE
      ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `user_category`
--

CREATE TABLE `user_category` (
  `user_id` int NOT NULL AUTO_INCREMENT COMMENT 'id пользователя',
  `category_id` int NOT NULL COMMENT 'id категории',
  PRIMARY KEY (`user_id`, `category_id`),
  CONSTRAINT fk_user_category_user_id
    FOREIGN KEY (user_id)  REFERENCES user (id)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
  CONSTRAINT fk_user_category_category_id
    FOREIGN KEY (category_id)  REFERENCES category (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='таблица связи';


