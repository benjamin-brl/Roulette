<?php
include_once "$racine/controleur/controleurPrincipal.php";
include_once "$racine/modele/bd.classe.php";
include_once "$racine/modele/bd.eleve.php";
include_once "$racine/modele/bd.note.php";

$controleur = new ControleurPrincipal;
$Classe = new Classes;
$Eleve = new Eleves;
$Note = new Notes;