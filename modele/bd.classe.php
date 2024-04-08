<?php
include_once "bd.inc.php";
class Classes extends ConnexionPDO {
    public function getClasseByID($id)
    {
        $req = $this->cnx->prepare("SELECT nom FROM classe WHERE id_Classe = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC)['nom'];
    }
    public function getAllClasses()
    {
        $req = $this->cnx->prepare("SELECT id_Classe id_c, nom nom_c FROM classe");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getClasseEleveByID($id)
    {
        $req = $this->cnx->prepare("SELECT nom FROM classe WHERE id_Classe = (SELECT id_Classe FROM eleve WHERE id_Utilisateur = :id)");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC)['nom'];
    }
    public function createClasse($nom)
    {
        $req = $this->cnx->prepare("INSERT INTO classe (nom) VALUES (:nom)");
        $req->bindValue(':nom', $nom, PDO::PARAM_STR);
        $req->execute();
    }
    public function getClassIDByName($nom) {
        $req = $this->cnx->prepare("SELECT id_Classe FROM classe WHERE nom = :nom");
        $req->bindValue(':nom', $nom, PDO::PARAM_STR);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC)['id_Classe'];
    }
    public function removeClasse($id) {
        $req = $this->cnx->prepare("DELETE FROM classe WHERE id_Classe = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}