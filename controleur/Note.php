<?php

$get_classe = isset($_GET['c']) ? $_GET['c'] : '';
$get_eleve = isset($_GET['e']) ? $_GET['e'] : '';

$post_absence = isset($_POST['absent']) ? $_POST['absent'] : '';
$post_note = isset($_POST['note']) ? $_POST['note'] : '';
$post_date_note = isset($_POST['date_n']) ? $_POST['date_n'] : '';

$post_absence == true ? $Eleve->addAbsence($get_eleve) : $Eleve->removeAbsence($get_eleve);

($post_note && $post_date_note != '') ? ($Note->addNote($post_note, $post_date_note, $get_eleve) . $Eleve->setPassageByEleveID($get_eleve)) : '';

$post_suppr_note = isset($_POST['id_n']) ? $_POST['id_n'] : '';
$post_suppr_note != '' ? $Note->removeNote($post_suppr_note) : '' ;

include_once "$racine/vue/head.php";
include_once "$racine/vue/vueNote.php";
include_once "$racine/vue/foot.php";