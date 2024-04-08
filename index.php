<?php
$racine = dirname(__FILE__);
include_once "$racine/controleur/getClass.php";
isset($_GET["a"]) ? $fichier = $controleur->getAction($_GET["a"]) : $fichier = $controleur->getAction("accueil");

include_once "$racine/modele/auth.php";
include_once "$racine/modele/bd.user.php";

$islog = (new Auth)->isLoggedOn() ? true : false;
$estProf = isset($_SESSION['estProf']) && $_SESSION['estProf'] === 1 ? true : false;
$user = $islog ? (new User)->getUserByMail($_SESSION['mail']) : '';

include "$racine/controleur/$fichier";