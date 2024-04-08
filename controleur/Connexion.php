<?php
include_once "$racine/modele/auth.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    $mail = isset($_POST['mail']) ? trim(strip_tags($_POST['mail'])) : false;
    if (!empty($mail)) {
        $psw = isset($_POST['psw']) ? crypt(trim(strip_tags($_POST['psw'])), $mail) : false;
        if (!empty($psw)) {
            $Auth = new Auth;
            echo ($Auth->login($mail, $psw)) ? header("Location: /") : 'Authentification échouée';
        } else {
            echo 'Mot de passe invalide';
        }
    } else {
        echo 'Mail invalide';
    }
}

include_once "$racine/vue/head.php";
include_once "$racine/vue/vueConnexion.php";
include_once "$racine/vue/foot.php";