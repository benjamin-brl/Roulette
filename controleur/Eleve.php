<?php

if ($islog) {
    if ($estProf) {
        $post_suppr_eleve = isset($_POST['id_e']) ? $_POST['id_e'] : '';
        $post_suppr_eleve != '' ? $Eleve->removeEleve($post_suppr_eleve) : '' ;
        
        include_once "$racine/vue/head.php";
        include_once "$racine/vue/vueEleve.php";
        include_once "$racine/vue/foot.php";
    } else {
        include_once "$racine/vue/head.php";
        include_once "$racine/vue/vueNoAccess.php";
        include_once "$racine/vue/foot.php";
    }
} else {
    header("Location: /?a=connexion");
}