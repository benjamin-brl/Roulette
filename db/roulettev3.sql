START TRANSACTION;
SET time_zone = "+02:00";

CREATE DATABASE IF NOT EXISTS `roulettev3`;
USE `roulettev3`;

CREATE TABLE utilisateur(
   Id_Utilisateur INT AUTO_INCREMENT,
   nom VARCHAR(50)  NOT NULL,
   prenom VARCHAR(50)  NOT NULL,
   mail VARCHAR(50)  NOT NULL,
   psw VARCHAR(50) ,
   PRIMARY KEY(Id_Utilisateur),
   UNIQUE(mail)
);

CREATE TABLE classe(
   Id_Classe INT AUTO_INCREMENT,
   nom VARCHAR(50)  NOT NULL,
   PRIMARY KEY(Id_Classe),
   UNIQUE(nom)
);

CREATE TABLE eleve(
   Id_Utilisateur INT,
   absence BOOLEAN NOT NULL DEFAULT 0,
   passage BOOLEAN NOT NULL DEFAULT 0,
   Id_Classe INT NOT NULL,
   PRIMARY KEY(Id_Utilisateur),
   FOREIGN KEY(Id_Utilisateur) REFERENCES utilisateur(Id_Utilisateur),
   FOREIGN KEY(Id_Classe) REFERENCES classe(Id_Classe)
);

CREATE TABLE prof(
   Id_Utilisateur INT,
   estProf BOOLEAN NOT NULL DEFAULT 1,
   PRIMARY KEY(Id_Utilisateur),
   FOREIGN KEY(Id_Utilisateur) REFERENCES utilisateur(Id_Utilisateur)
);

CREATE TABLE note(
   Id_Note INT AUTO_INCREMENT,
   _date DATE NOT NULL,
   note DECIMAL(2,2)   NOT NULL,
   Id_Utilisateur INT NOT NULL,
   Id_Utilisateur_1 INT NOT NULL,
   PRIMARY KEY(Id_Note),
   FOREIGN KEY(Id_Utilisateur) REFERENCES prof(Id_Utilisateur),
   FOREIGN KEY(Id_Utilisateur_1) REFERENCES eleve(Id_Utilisateur)
);