<?php
include_once "bd.inc.php";
class Notes extends ConnexionPDO {
    public function getNoteByID($id)
    {
        $req = $this->cnx->prepare("SELECT note, date_n, id_e FROM notes WHERE id_n=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    public function getNotesEleveByID($id)
    {
        $req = $this->cnx->prepare("SELECT note, date_n, id_n FROM notes WHERE id_e=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getMoyenneEleveByID($id)
    {
        $req = $this->cnx->prepare("SELECT ROUND(AVG(note), 2) AS moy_notes FROM notes WHERE id_e=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC)['moy_notes'];
    }
    public function resetAllNotes() {
        $req = $this->cnx->prepare("DELETE FROM notes");
        $req->execute();
    }
    public function addNote($note, $date_n, $id) {
        $req = $this->cnx->prepare("INSERT INTO notes (note, date_n, id_e) VALUES (:note, :date_n, :id)");
        $req->bindValue(':note', $note, PDO::PARAM_STR);
        $req->bindValue(':date_n', $date_n, PDO::PARAM_STR);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function removeNote($id) {
        $req = $this->cnx->prepare("DELETE FROM notes WHERE id_n=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}