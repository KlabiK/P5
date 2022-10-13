<?php

namespace App\model;


use App\model\Manager;
use \PDO;

class PostManager extends Manager
{
    public function getHomeGames($startPage, $perPage)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare("SELECT id,title,synopsis,image,date FROM articles ORDER BY date DESC  LIMIT $startPage,$perPage");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
        $req->closeCursor();
    }
    public function pagination($categorie)
    {
        if ($categorie) {
            $bdd = $this->bddConnect();
            $sql = $bdd->prepare("SELECT COUNT(id) as nbGames FROM articles WHERE categorie=?");
            $sql->execute(array($categorie));
            $count = $sql->fetch();
        } else {
            $bdd = $this->bddConnect();
            $sql = $bdd->prepare("SELECT COUNT(id) as nbGames FROM articles ");
            $sql->execute();
            $count = $sql->fetch();
        }

        $nbGames = $count['nbGames'];
        $perPage = 5;
        $nbPage = ceil($nbGames / $perPage);

        if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage) {
            $currentPage = $_GET['p'];
        } else {
            $currentPage = 1;
        }
        $startPage = (($currentPage - 1) * $perPage);
        $data = ["nbGames" => $nbGames, "perPage" => $perPage, "nbPage" => $nbPage, "startPage" => $startPage, "currentPage" => $currentPage];
        return $data;
    }
    public function getGame($id)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT * FROM articles WHERE id=?');
        $req->execute(array($id));
        if ($req->rowCount() == 1) {
            $game = $req->fetch(PDO::FETCH_OBJ);
            return $game;
        } else {
            header('Location: index.php?action=home');
        }
        $req->closeCursor();
    }
    public function categorieGames($categorie, $perPage, $startPage)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare("SELECT * FROM articles WHERE categorie =? ORDER BY id DESC LIMIT $startPage,$perPage");
        $req->execute(array($categorie));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
        $req->closeCursor();
    }
    public function getArticle()
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT title, content,categorie,image,date FROM articles WHERE id =?');
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
        $req->closeCursor();
    }

    public function arrayGames() // Recup jeux pour interface admin
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT id,title, synopsis, categorie FROM articles ORDER BY id DESC');
        $req->execute();
        $data = $req->fetchAll();
        return $data;
    }
    public function addGame($title, $categorie, $image, $synopsis, $content, $positif, $negatif)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('INSERT INTO articles(title, categorie, image, synopsis, content, positif, negatif, date) VALUES(?,?,?,?,?,?,?,NOW())');
        $req->execute(array($title, $categorie, $image, $synopsis, $content, $positif, $negatif));
        $req->closeCursor();
    }
    public function edit($id, $title, $categorie, $image, $synopsis, $content, $positif, $negatif)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('UPDATE articles SET title=:title ,categorie=:categorie ,image=:image ,synopsis=:synopsis ,
                        content=:content,positif=:positif ,negatif=:negatif WHERE id=:id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':title', $title, PDO::PARAM_STR);
        $req->bindValue(':categorie', $categorie, PDO::PARAM_STR);
        $req->bindValue(':image', $image, PDO::PARAM_STR);
        $req->bindValue(':synopsis', $synopsis, PDO::PARAM_STR);
        $req->bindValue(':content', $content, PDO::PARAM_STR);
        $req->bindValue(':positif', $positif, PDO::PARAM_STR);
        $req->bindValue(':negatif', $negatif, PDO::PARAM_STR);
        $req->execute();
        $req->closeCursor();
    }
    public function gameToSuppr($id)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT * FROM articles WHERE id=:id');
        $req->execute(["id" => $id]);
        $game = $req->fetch();
        return $game;
        $req->closeCursor();
    }
    public function supprGame($id)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('DELETE FROM articles WHERE id= :id');
        $req->execute(["id" => $id]);
    }
}
