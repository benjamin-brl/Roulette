<?php
include_once "$racine/modele/bd.inc.php";

class User extends ConnexionPDO
{
    public function getUserByID($id)
    {
        try {
            $req = $this->cnx->prepare("SELECT nom, prenom, mail FROM utilisateur WHERE id_Utilisateur = :id");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            $res = $req->fetch(PDO::FETCH_ASSOC);
            try {
                $res += [$this->getProf($id)];
            } catch (PDOException $e) {
                $res += [$this->getEleve($id)];
            }
            return $res;
        } catch (PDOException $e) {
            // Gérer erreur
        }
    }
    public function getUserByMail($mail)
    {
        try {
            $req = $this->cnx->prepare("SELECT id_Utilisateur, nom, prenom, mail FROM utilisateur WHERE mail = :mail");
            $req->bindValue(':mail', $mail, PDO::PARAM_STR);
            $req->execute();
            $res = $req->fetch(PDO::FETCH_ASSOC);
            try {
                $res += $this->getProf($res['id_Utilisateur']);
            } catch (PDOException $e) {
                $res += $this->getEleve($res['id_Utilisateur']);
            }
            return $res;
        } catch (PDOException $e) {
            // Gérer erreur
        }
    }
    private function getProf($id)
    {
        try {
            $req = $this->cnx->prepare("SELECT estProf FROM prof WHERE id_Utilisateur = :id");
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
            $req = $this->cnx->prepare("SELECT absence, passage FROM eleve WHERE id_Utilisateur = :id");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            return $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer erreur
        }
    }
}
