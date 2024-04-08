<?php
include_once "bd.inc.php";
include_once "bd.user.php";
class Eleves extends ConnexionPDO {
    public function getEleves() {
        $req = $this->cnx->prepare("SELECT passage, absence, date_p, Id_Classe FROM eleve");
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $eleve => $value) {
            $res[$eleve] += (new User)->getUserByID($value['Id_Utilisateur']);
        }
        return $res;
    }
    public function getElevesByClasseID($id) {
        $req = $this->cnx->prepare("SELECT passage, absence, date_p, Id_Utilisateur FROM eleve WHERE Id_Classe = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $eleve => $value) {
            $res[$eleve] += (new User)->getUserByID($value['Id_Utilisateur']);
        }
        return $res;
    }
    public function getEleveByID($id) {
        $req = $this->cnx->prepare("SELECT passage, absence, date_p, Id_Classe FROM eleve WHERE Id_Utilisateur=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_ASSOC);
        $res += (new User)->getUserByID($id);
        return $res;
    }
    public function getElevesNonPasseByClasseID($id) {
        $req = $this->cnx->prepare("SELECT Id_Utilisateur FROM eleve WHERE passage = 0 AND absence = 0 AND Id_Classe = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $eleve => $value) {
            $res[$eleve] += (new User)->getUserByID($value['Id_Utilisateur']);
        }
        return $res;
    }
    public function getElevesPasseByClasseID($id) {
        $req = $this->cnx->prepare("SELECT Id_Utilisateur FROM eleve WHERE passage = 1 AND Id_Classe = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $eleve => $value) {
            $res[$eleve] += (new User)->getUserByID($value['Id_Utilisateur']);
        }
        return $res;
    }
    public function resetAllPassages() {
        $req = $this->cnx->prepare("UPDATE eleve SET passage = 0, date_p = NULL WHERE passage = 1");
        $req->execute();
    }
    public function addAbsence($id) {
        $req = $this->cnx->prepare("UPDATE eleve SET absence = 1 WHERE Id_Utilisateur=:id ");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function removeAbsence($id) {
        $req = $this->cnx->prepare("UPDATE eleve SET absence = 0 WHERE Id_Utilisateur=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function setPassageByEleveID($id) {
        $req = $this->cnx->prepare("UPDATE eleve SET passage = 1, date_p = (SELECT CURDATE()) WHERE Id_Utilisateur=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function getAbsentsByClasseID($id) {
        $req = $this->cnx->prepare("SELECT Id_Classe, Id_Utilisateur FROM eleve WHERE absence = 1 AND Id_Classe = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $eleve => $value) {
            $res[$eleve] += (new User)->getUserByID($value['Id_Utilisateur']);
        }
        return $res;
    }
    public function addEleveToClasse($Id_U, $Id_C) {
        $req = $this->cnx->prepare("INSERT INTO eleve (Id_Utilisateur, Id_Classe) VALUES (:Id_U, :Id_C)");
        $req->bindValue(':Id_U', $Id_U, PDO::PARAM_INT);
        $req->bindValue(':Id_C', $Id_C, PDO::PARAM_INT);
        $req->execute();
    }
    public function removeEleve($id) {
        $req = $this->cnx->prepare("DELETE FROM eleve WHERE Id_Utilisateur=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}