<?php

$get_classe = isset($_GET['c']) ? $_GET['c'] : '';

$post_suppr_classe = isset($_POST['id_c']) ? $_POST['id_c'] : '';

$post_suppr_classe != '' ? $Classe->removeClasse($post_suppr_classe) : '' ;

include_once "$racine/vue/head.php";
include_once "$racine/vue/vueClasse.php";
include_once "$racine/vue/foot.php";