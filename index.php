<?php
$racine = dirname(__FILE__);
include_once "$racine/controleur/getClass.php";
isset($_GET["a"]) ? $fichier = $controleur->getAction($_GET["a"]) : $fichier = $controleur->getAction("accueil");
include "$racine/controleur/$fichier";