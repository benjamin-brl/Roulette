<?php

if ($islog) {
    if ($estProf) {
        $get_classe = isset($_GET['c']) ? $_GET['c'] : '';

        include_once "$racine/vue/head.php";
        include_once "$racine/vue/vueTirage.php";
        include_once "$racine/vue/foot.php";
    } else {
        include_once "$racine/vue/head.php";
        include_once "$racine/vue/vueNoAccess.php";
        include_once "$racine/vue/foot.php";
    }
} else {
    header("Location: /?a=connexion");
}
