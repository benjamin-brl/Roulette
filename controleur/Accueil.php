<?php

$post_reset_note = isset($_POST['reset_n']) ? $_POST['reset_n'] : '';
$post_reset_passage = isset($_POST['reset_p']) ? $_POST['reset_p'] : '';

$post_reset_note == true ? $Note->resetAllNotes() : '' ;
$post_reset_passage == true ? $Eleve->resetAllPassages() : '' ;

$post_new_classe = isset($_POST['nom_nouv_c']) ? $_POST['nom_nouv_c'] : '';
$post_new_classe != '' ? $Classe->createClasse($post_new_classe) : '';


$classes = $Classe->getAllClasses();
$post_nom_c = isset($_POST['nom_c']) ? $_POST['nom_c'] : '';
$post_liste_eleves = isset($_POST['nouv_eleves']) ? $_POST['nouv_eleves'] : '';

if (!empty($post_liste_eleves)) {
    $lignes = explode("\n", $post_liste_eleves);
    $tabsEleves = array();
    $liste_eleves = array();

    foreach ($lignes as $ligne) {
        $elements = explode(" ", $ligne);
        $nom = !empty($elements[0]) ? $elements[0] : '';
        $prenom = !empty($elements[1]) ? $elements[1] : '';
        $tabsEleves[] = array($nom, $prenom);
    }
    
    $post_id_c = $Classe->getClassIDByName($post_nom_c);
    foreach ($tabsEleves as $tab) {
        $Eleve->addEleveToClasse($tab[0], $tab[1], $post_id_c);
    }
}

include_once "$racine/vue/head.php";
include_once "$racine/vue/vueAccueil.php";
include_once "$racine/vue/foot.php";