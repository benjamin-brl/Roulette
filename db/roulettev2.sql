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

INSERT INTO `eleves` (`Id_Utilisateur`, `nom`, `prenom`) VALUES
(36, 'AUBRIET', 'Aurélien'),
(35, 'AOUDACHE', 'Karim'),
(37, 'AVELINE', 'Baptiste'),
(4, 'BALLOT', 'Alexis'),
(5, 'BARIAL', 'Benjamin'),
(6, 'CAMUS', 'Jordan'),
(7, 'CHAFAÏ', 'Yacine'),
(8, 'CHATEAU', 'Clément'),
(9, 'DE LANGE', 'Aymeric'),
(10, 'DELAFAITE', 'Nathan'),
(11, 'GADROY', 'Léo'),
(12, 'GERARD', 'David'),
(13, 'GUILLAUME', 'Corentin'),
(14, 'HUBERT', 'Léa'),
(15, 'KREIR', 'Yanis'),
(16, 'MALHERBE', 'Arthur'),
(17, 'MAO', 'Pauline'),
(18, 'NOUVIAN', 'Pierre-Loup'),
(19, 'OUDAR', 'Nicolas'),
(20, 'PONSIN', 'Flavien'),
(21, 'SELLIER', 'Luka'),
(22, 'SENHADJI', 'Hamza'),
(23, 'TURQUIER', 'Victor'),
(24, 'VENDENDRIESSCHE', 'Brayan'),
(25, 'WILLIG', 'Jules'),
(26, 'WINTREBERT', 'Mathéo'),
(34, 'Augustin', 'RIVIERE');

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