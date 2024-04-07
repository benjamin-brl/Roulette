SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+02:00";

CREATE DATABASE IF NOT EXISTS `roulettev2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `roulettev2`;

CREATE TABLE `classes` (
  `id_c` int NOT NULL,
  `nom_c` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `classes` (`id_c`, `nom_c`) VALUES
(1, 'SIO'),
(2, 'SISR'),
(7, 'SIO3');


CREATE TABLE `eleves` (
  `id_e` int NOT NULL,
  `nom_e` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenom_e` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `passage` tinyint(1) NOT NULL DEFAULT '0',
  `date_p` date DEFAULT NULL,
  `id_c` int NOT NULL,
  `absence` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `eleves` (`id_e`, `nom_e`, `prenom_e`, `passage`, `date_p`, `id_c`, `absence`) VALUES
(1, 'AUBRIET', 'Aurélien', 0, NULL, 1, 0),
(2, 'AOUDACHE', 'Karim', 0, NULL, 2, 1),
(3, 'AVELINE', 'Baptiste', 0, NULL, 2, 0),
(4, 'BALLOT', 'Alexis', 0, NULL, 2, 0),
(5, 'BARIAL', 'Benjamin', 0, NULL, 1, 0),
(6, 'CAMUS', 'Jordan', 0, NULL, 2, 0),
(7, 'CHAFAÏ', 'Yacine', 0, NULL, 2, 0),
(8, 'CHATEAU', 'Clément', 0, NULL, 2, 0),
(9, 'DE LANGE', 'Aymeric', 0, NULL, 1, 0),
(10, 'DELAFAITE', 'Nathan', 0, NULL, 2, 0),
(11, 'GADROY', 'Léo', 0, NULL, 2, 0),
(12, 'GERARD', 'David', 0, NULL, 2, 0),
(13, 'GUILLAUME', 'Corentin', 0, NULL, 1, 0),
(14, 'HUBERT', 'Léa', 0, NULL, 1, 0),
(15, 'KREIR', 'Yanis', 0, NULL, 1, 0),
(16, 'MALHERBE', 'Arthur', 0, NULL, 2, 0),
(17, 'MAO', 'Pauline', 0, NULL, 2, 1),
(18, 'NOUVIAN', 'Pierre-Loup', 0, NULL, 2, 0),
(19, 'OUDAR', 'Nicolas', 0, NULL, 2, 0),
(20, 'PONSIN', 'Flavien', 0, NULL, 2, 0),
(21, 'SELLIER', 'Luka', 0, NULL, 1, 0),
(22, 'SENHADJI', 'Hamza', 0, NULL, 2, 0),
(23, 'TURQUIER', 'Victor', 0, NULL, 2, 0),
(24, 'VENDENDRIESSCHE', 'Brayan', 0, NULL, 1, 0),
(25, 'WILLIG', 'Jules', 0, NULL, 1, 0),
(26, 'WINTREBERT', 'Mathéo', 0, NULL, 1, 0),
(34, 'Augustin', 'RIVIERE', 0, NULL, 1, 0);

CREATE TABLE `notes` (
  `id_n` int NOT NULL,
  `note` decimal(15,2) NOT NULL,
  `date_n` date NOT NULL,
  `id_e` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `classes`
  ADD PRIMARY KEY (`id_c`);

ALTER TABLE `eleves`
  ADD PRIMARY KEY (`id_e`),
  ADD KEY `id_c` (`id_c`);

ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_n`),
  ADD KEY `id_e` (`id_e`);

ALTER TABLE `classes`
  MODIFY `id_c` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `eleves`
  MODIFY `id_e` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

ALTER TABLE `notes`
  MODIFY `id_n` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

ALTER TABLE `eleves`
  ADD CONSTRAINT `eleves_ibfk_1` FOREIGN KEY (`id_c`) REFERENCES `classes` (`id_c`);

ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`id_e`) REFERENCES `eleves` (`id_e`);
COMMIT;