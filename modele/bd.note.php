<?php
include_once "bd.inc.php";
class Notes extends ConnexionPDO {
    public function getNoteByID($id)
    {
        $req = $this->cnx->prepare("SELECT note, _date date_n, Id_Utilisateur_1 FROM note WHERE Id_Note=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    public function getNotesEleveByID($id)
    {
        $req = $this->cnx->prepare("SELECT note, _date date_n, Id_Note FROM note WHERE Id_Utilisateur_1=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getMoyenneEleveByID($id)
    {
        $req = $this->cnx->prepare("SELECT ROUND(AVG(note), 2) AS moy_notes FROM note WHERE Id_Utilisateur_1=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC)['moy_notes'];
    }
    public function resetAllNotes() {
        $req = $this->cnx->prepare("DELETE FROM note");
        $req->execute();
    }
    public function addNote($note, $date_n, $Id_P, $Id_E) {
        $req = $this->cnx->prepare("INSERT INTO note (note, _date, Id_Utilisateur, Id_Utilisateur_1) VALUES (:note, :date_n, :Id_P,:Id_E)");
        $req->bindValue(':note', $note, PDO::PARAM_STR);
        $req->bindValue(':date_n', $date_n, PDO::PARAM_STR);
        $req->bindValue(':Id_P', $Id_P, PDO::PARAM_INT);
        $req->bindValue(':Id_E', $Id_E, PDO::PARAM_INT);
        $req->execute();
    }
    public function removeNote($id) {
        $req = $this->cnx->prepare("DELETE FROM note WHERE Id_Note=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}