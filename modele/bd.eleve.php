<?php
include_once "bd.inc.php";
class Eleves extends ConnexionPDO {
    public function getEleves() {
        $req = $this->cnx->prepare("SELECT nom_e, prenom_e, passage, date_p, id_c FROM eleves");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getElevesByClasseID($id) {
        $req = $this->cnx->prepare("SELECT nom_e, prenom_e, passage, date_p, id_e FROM eleves WHERE id_c = (SELECT id_c FROM classes WHERE id_c=:id)");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEleveByID($id) {
        $req = $this->cnx->prepare("SELECT nom_e, prenom_e, passage, date_p, id_c FROM eleves WHERE id_e=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    public function getElevesNonPasseByClasseID($id) {
        $req = $this->cnx->prepare("SELECT nom_e, prenom_e, id_e FROM eleves WHERE passage = 0 AND absence = 0 AND id_c = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getElevesPasseByClasseID($id) {
        $req = $this->cnx->prepare("SELECT nom_e, prenom_e FROM eleves WHERE passage = 1 AND id_c = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function resetAllPassages() {
        $req = $this->cnx->prepare("UPDATE eleves SET passage = 0, date_p = NULL WHERE passage = 1");
        $req->execute();
    }
    public function addAbsence($id) {
        $req = $this->cnx->prepare("UPDATE eleves SET absence = 1 WHERE id_e=:id ");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function removeAbsence($id) {
        $req = $this->cnx->prepare("UPDATE eleves SET absence = 0 WHERE id_e=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function setPassageByEleveID($id) {
        $req = $this->cnx->prepare("UPDATE eleves SET passage = 1, date_p = (SELECT CURDATE()) WHERE id_e=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function getAbsentsByClasseID($id) {
        $req = $this->cnx->prepare("SELECT nom_e, prenom_e, id_c, id_e FROM eleves WHERE absence = 1 AND id_c = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addEleveToClasse($nom, $prenom, $id) {
        $req = $this->cnx->prepare("INSERT INTO eleves (nom_e, prenom_e, id_c) VALUES (:nom, :prenom, :id)");
        $req->bindValue(':nom', $nom, PDO::PARAM_STR);
        $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function removeEleve($id) {
        $req = $this->cnx->prepare("DELETE FROM eleves WHERE id_e=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}