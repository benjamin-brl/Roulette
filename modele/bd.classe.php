<?php
include_once "bd.inc.php";
class Classes extends ConnexionPDO {
    public function getClasseByID($id)
    {
        $req = $this->cnx->prepare("SELECT nom_c FROM classes WHERE id_c = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC)['nom_c'];
    }
    public function getAllClasses()
    {
        $req = $this->cnx->prepare("SELECT id_c, nom_c FROM classes");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getClasseEleveByID($id)
    {
        $req = $this->cnx->prepare("SELECT nom_c FROM classes WHERE id_c = (SELECT id_c FROM eleves WHERE id_e = :id)");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC)['nom_c'];
    }
    public function createClasse($nom)
    {
        $req = $this->cnx->prepare("INSERT INTO classes (nom_c) VALUES (:nom)");
        $req->bindValue(':nom', $nom, PDO::PARAM_STR);
        $req->execute();
    }
    public function getClassIDByName($nom) {
        $req = $this->cnx->prepare("SELECT id_c FROM classes WHERE nom_c = :nom");
        $req->bindValue(':nom', $nom, PDO::PARAM_STR);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC)['id_c'];
    }
    public function removeClasse($id) {
        $req = $this->cnx->prepare("DELETE FROM classes WHERE id_c=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}