<?php
include_once "$racine/modele/bd.inc.php";

class User extends ConnexionPDO
{
    public function getUserByID($id)
    {
        try {
            $req = $this->cnx->prepare("SELECT nom, prenom, mail, Id_Utilisateur FROM utilisateur WHERE Id_Utilisateur = :id");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            $res = $req->fetch(PDO::FETCH_ASSOC);
            if ($prof = $this->getProf($res['Id_Utilisateur'])) {
                $res += $prof;
            } elseif ($eleve = $this->getEleve($res['Id_Utilisateur'])) {
                $res += $eleve;
            }
            return $res;
        } catch (PDOException $e) {
            // Gérer erreur
        }
    }
    public function getUserByMail($mail)
    {
        try {
            $req = $this->cnx->prepare("SELECT * FROM utilisateur WHERE mail = :mail");
            $req->bindValue(':mail', $mail, PDO::PARAM_STR);
            $req->execute();
            $res = $req->fetch(PDO::FETCH_ASSOC);
            if ($prof = $this->getProf($res['Id_Utilisateur'])) {
                $res += $prof;
            } elseif ($eleve = $this->getEleve($res['Id_Utilisateur'])) {
                $res += $eleve;
            }
            return $res;
        } catch (PDOException $e) {
            // Gérer erreur
        }
    }
    public function verifyUser($mail, $psw)
    {
        try {
            $req = $this->cnx->prepare("SELECT 1 FROM utilisateur WHERE mail = :mail AND psw = :psw");
            $req->bindValue(':mail', $mail, PDO::PARAM_STR);
            $req->bindValue(':psw', $psw, PDO::PARAM_STR);
            $req->execute();
            return (!empty($req->fetch(PDO::FETCH_ASSOC))) ? true : false;
        } catch (PDOException $e) {
            // Gérer erreur
        }
    }
    private function getProf($id)
    {
        try {
            $req = $this->cnx->prepare("SELECT estProf FROM prof WHERE Id_Utilisateur = :id");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            return $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer erreur
        }
    }
    private function getEleve($id)
    {
        try {
            $req = $this->cnx->prepare("SELECT absence, passage FROM eleve WHERE Id_Utilisateur = :id");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            return $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer erreur
        }
    }
}
