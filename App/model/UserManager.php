<?php

namespace App\model;

use App\model\Manager;
use \PDO;

class UserManager extends Manager
{
    public function user($login)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT * FROM users WHERE login =?');
        $req->execute(array($login));
        $user = $req->fetch();
        return $user;
    }
    public function mail($email)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT * FROM users WHERE email =?');
        $req->execute(array($email));
        $user = $req->fetch();
        return $user;
    }
    public function userRegister($login, $password, $image, $email)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare("INSERT INTO users SET login=?,password=?,image=?,email=?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $req->execute([$login, $password, $image, $email]);
    }
    public function updateUser($id, $pseudo, $img)
    {
        $bdd = $this->bddConnect();
        $req = $bdd->prepare("UPDATE users SET login=?,image=? WHERE id=?");
        $req->execute(array($pseudo, $img, $id));
    }
}
