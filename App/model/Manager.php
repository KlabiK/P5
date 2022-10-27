<?php

namespace App\model;

use \PDO;

class Manager
{
    protected function bddConnect()
    {
        $bdd = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8', $_ENV["DB_USER"], $_ENV["DB_PASS"]);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        return $bdd;
    }
}
