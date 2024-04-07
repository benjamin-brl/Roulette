SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `roulette_flutter`;
CREATE DATABASE IF NOT EXISTS `roulette_flutter`;
USE `roulette_flutter`;

CREATE TABLE `classes` (
  `id_c` int AUTO_INCREMENT NOT NULL,
  `nom_c` varchar(50) NOT NULL,
  PRIMARY KEY(id_c)
);

CREATE TABLE `eleves` (
  `id_e` int AUTO_INCREMENT NOT NULL,
  `nom_e` varchar(50) NOT NULL,
  `prenom_e` varchar(50) NOT NULL,
  `passage` boolean NOT NULL DEFAULT false,
  `date_p` date DEFAULT NULL,
  `id_c` int NOT NULL,
  `absence` boolean NOT NULL  DEFAULT false,
  PRIMARY KEY(id_e),
  FOREIGN KEY(id_c) REFERENCES classes(id_c)
);

CREATE TABLE `notes` (
  `id_n` int AUTO_INCREMENT NOT NULL,
  `note` decimal(15,2) NOT NULL,
  `date_n` date NOT NULL,
  `id_e` int NOT NULL,
  PRIMARY KEY(id_n),
  FOREIGN KEY(id_e) REFERENCES eleves(id_e)
);