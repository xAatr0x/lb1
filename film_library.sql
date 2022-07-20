-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 28 2022 г., 21:48
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `film library` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `film library`;

CREATE TABLE `actor` (
  `ID_Actor` int(5) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `actor` (`ID_Actor`, `name`) VALUES
(1, 'Jason Statham'),
(2, 'Amy Smart'),
(3, 'Vinnie Jones'),
(4, 'Brad Pitt'),
(5, 'Jason Flemyng'),
(6, 'Johnny Depp');



CREATE TABLE `film` (
  `ID_FILM` int(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `date` year(4) NOT NULL,
  `country` varchar(20) NOT NULL,
  `quality` varchar(10) NOT NULL,
  `resolution` varchar(15) NOT NULL,
  `codec` varchar(10) NOT NULL,
  `producer` varchar(100) NOT NULL,
  `director` varchar(30) NOT NULL,
  `carrier` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `film` (`ID_FILM`, `name`, `date`, `country`, `quality`, `resolution`, `codec`, `producer`, `director`, `carrier`) VALUES
(1, 'Crank', 2006, 'United Kingdom', 'HD+', '1440х720', 'GSM', 'Mark Neveldine & Brian Taylor', 'Mark Neveldine & Brian Taylor', 'video'),
(2, 'The Butterfly Effect', 2004, 'Unitet States', 'HD DVD', '1920x1080', 'iLBC', 'J. Mackye Gruber & Eric Bress', 'Eric Bress J. Mackye Gruber', 'DVD'),
(3, 'Lock, Stock and Two Smoking Barrels', 1998, 'United Kingdom', 'HD DVD', '1920x1080', 'LPC10', 'Guy Ritchie', 'Guy Ritchie', 'DVD'),
(4, 'Snatch', 2000, 'United Kingdom', 'SATRip', '704x512', 'GSM ', 'Guy Ritchie', 'Guy Ritchie', 'CD'),
(5, 'From Hell', 2001, 'United Kingdom', 'PDTVRip', '624x352', 'ITU G.729', 'Alan Moore & Eddie Campbell & Terry Hayes', 'Albert Hughes & Allen Hughes', 'CD'),
(6, 'Pirates of the Caribbean: The Curse of the Black Pearl', 2003, 'USA', 'Blu-Ray', '1920×1080', 'LPC10', ' 	Jerry Bruckheimer', 'Gore Verbinski', 'CD'),
(7, 'Edward Scissorhands', 1990, 'United States', 'HD+', '1440х720', 'iLBC', 'Tim Burton & Caroline Thompson', 'Tim Burton', 'BR');



CREATE TABLE `film_actor` (
  `FID_Film` int(5) NOT NULL,
  `FID_Actor` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `film_actor` (`FID_Film`, `FID_Actor`) VALUES
(1, 1),
(1, 2),
(3, 1),
(3, 3),
(4, 1),
(4, 4),
(3, 5),
(5, 5),
(5, 6),
(6, 6),
(7, 6);


CREATE TABLE `film_genre` (
  `FID_Film` int(10) NOT NULL,
  `FID_Genre` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `film_genre` (`FID_Film`, `FID_Genre`) VALUES
(1, 4),
(1, 1),
(1, 9),
(2, 1),
(2, 5),
(2, 6),
(3, 4),
(3, 9),
(3, 7),
(4, 7),
(4, 9),
(5, 10),
(5, 11),
(5, 1),
(6, 2),
(6, 8),
(6, 4),
(7, 5),
(7, 3),
(7, 8);


CREATE TABLE `genre` (
  `ID_Genre` int(5) NOT NULL,
  `title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `genre` (`ID_Genre`, `title`) VALUES
(1, 'thriller'),
(2, 'adventure'),
(3, 'romance'),
(4, 'action'),
(5, 'drama'),
(6, 'sci-Fi'),
(7, 'comedy'),
(8, 'fantasy'),
(9, 'crime'),
(10, 'mystery'),
(11, 'horror');


ALTER TABLE `actor`
  ADD PRIMARY KEY (`ID_Actor`);


ALTER TABLE `film`
  ADD PRIMARY KEY (`ID_FILM`);


ALTER TABLE `film_actor`
  ADD KEY `FID_Film` (`FID_Film`),
  ADD KEY `FID_Actor` (`FID_Actor`);


ALTER TABLE `film_genre`
  ADD KEY `FID_Genre` (`FID_Genre`),
  ADD KEY `FID_Film` (`FID_Film`);


ALTER TABLE `genre`
  ADD PRIMARY KEY (`ID_Genre`);


ALTER TABLE `film_actor`
  ADD CONSTRAINT `film_actor_ibfk_1` FOREIGN KEY (`FID_Film`) REFERENCES `film` (`ID_FILM`),
  ADD CONSTRAINT `film_actor_ibfk_2` FOREIGN KEY (`FID_Actor`) REFERENCES `actor` (`ID_Actor`);

ALTER TABLE `film_genre`
  ADD CONSTRAINT `film_genre_ibfk_1` FOREIGN KEY (`FID_FIlm`) REFERENCES `film` (`ID_FILM`),
  ADD CONSTRAINT `film_genre_ibfk_2` FOREIGN KEY (`FID_Genre`) REFERENCES `genre` (`ID_Genre`),
  ADD CONSTRAINT `film_genre_ibfk_3` FOREIGN KEY (`FID_Film`) REFERENCES `film` (`ID_FILM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
