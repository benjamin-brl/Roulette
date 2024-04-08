<?php
class ControleurPrincipal {
    private $actions = [
        "notes" => "Note.php",
        "accueil" => "Accueil.php",
        "eleves" => "Eleve.php",
        "tirage" => "Tirage.php",
        "classes" => "Classe.php",
        "connexion" => "Connexion.php",
        "logout" => "Logout.php",
        "moi" => "Espace.php"
    ];
    public function getAction($action) {
        return array_key_exists($action, $this->actions) ? $this->actions[$action] : $this->actions["accueil"];
    }
}