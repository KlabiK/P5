<?php

namespace App\model;

use App\model\Manager;
use \PDO;

class CommentManager extends Manager
{
    public function comments($id) //charge commentaires en fonction de l'id du jeu
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT users.login, comments.id,users.image,comments.note, comments.date, comments.comment,comments.alert FROM  comments INNER JOIN users ON comments.userId = users.id WHERE comments.articleId = ? ORDER BY comments.date');
        $req->execute(array($id));
        $coms = $req->fetchAll(PDO::FETCH_OBJ);
        return $coms;
    }
    public function addCom($gameId, $user, $note, $comment)
    {

        $bdd = $this->bddConnect();
        $req = $bdd->prepare('INSERT INTO comments(articleId , userId, note, comment, date) VALUES(?, ?, ?, ?, NOW())');
        $req->execute(array($gameId, $user, $note, $comment));

        $req->closeCursor();
    }
    public function rate($id) //calcule moyenne de la note du jeu 
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT note FROM comments WHERE articleId=?');
        $req->execute(array($id));
        $coms = $req->fetchAll(PDO::FETCH_OBJ);
        $count = $req->rowCount();
        $req2 = $bdd->prepare('SELECT SUM(note) AS total FROM comments WHERE articleId=?');
        $req2->execute(array($id));
        if ($count > 0) {
            $somme = $req2->fetch();
            $result = $somme['total'] / $count;
            $result = round($result, $precision = 1,);
            return ['result' => $result, 'count' => $count];
        }
    }
    public function verifCom($userId, $articleId) // verification si un avis existe pour le remplacer par le nouveau
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT * FROM comments WHERE userId =? AND articleId=?');
        $req->execute(array($userId, $articleId));
        $com = $req->fetchAll(PDO::FETCH_OBJ);
        if ($com) {
            $del = $bdd->prepare('DELETE FROM comments WHERE userId =? AND articleId=?');
            $del->execute(array($userId, $articleId));
            $del->closeCursor();
        }
        return $com;
    }
    public function signal($commentId)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('UPDATE comments SET alert = 1 WHERE id=?');
        $req->execute(array($commentId));
    }
    public function signalsComments() // retourne commentaires signalés
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT articles.title,users.login,comments.id, comments.comment FROM comments INNER JOIN articles ON articles.id=comments.articleId INNER JOIN users ON users.id=comments.userId WHERE comments.alert=1 ORDER BY comments.date DESC');
        $req->execute();
        $signals = $req->fetchAll(PDO::FETCH_OBJ);
        return $signals;
    }
    public function retraitSignal($commentId)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('UPDATE comments SET alert = 0 WHERE id=?');
        $req->execute(array($commentId));
    }
    public function deleteCom($comId)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('DELETE FROM comments WHERE id=?');
        $req->execute(array($comId));
    }
}
