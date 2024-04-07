<?php
class ConnexionPDO {
    protected $login, $mdp, $bd, $serveur, $cnx;
    public function __construct() {
        $this->login = 'root';
        $this->mdp = '';
        $this->bd = 'roulettev2';
        $this->serveur = 'localhost';
        try {
            $this->cnx = new PDO("mysql:host=$this->serveur;dbname=$this->bd;charset=UTF8", $this->login, $this->mdp);
            $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $infos = [
                'Message d\'erreur : ' => $e->getMessage(),
                'Code d\'erreur : ' => $e->getCode(),
                'Fichier ou se trouve l\'erreur : ' => $e->getFile(),
                'Ligne présice ou se trouve l\'erreur : ' => $e->getLine()
            ];
            include "vue/vueError.php";
            die();
        }
    }
}