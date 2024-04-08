<?php

$user += (new Eleves)->getEleveByID($user['Id_Utilisateur']);

include_once "$racine/vue/head.php";
include_once "$racine/vue/vueEspace.php";
include_once "$racine/vue/foot.php";