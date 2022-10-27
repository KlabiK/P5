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
    public function updateUser($id, array $data)
    {
        $data = array_filter($data, function ($value) {
            return $value !== "";
        });

        $fields = array_keys($data);
        $fields = array_map(function ($field) {
            return $field . "=?";
        }, $fields);
        $fields = implode(",", $fields);

        $values = array_values($data);
        $values[] = $id;

        $bdd = $this->bddConnect();
        $req = $bdd->prepare("UPDATE users SET $fields WHERE id=?");
        $req->execute($values);
    }
}
