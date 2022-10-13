<?php

namespace App\model;

use \PDO;

class Manager
{
    protected function bddConnect()
    {
        $bdd = new PDO('mysql:host=db5010337669.hosting-data.io;dbname=dbs8760399;charset=utf8', 'dbu1082509', 'Abarai69+92000');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        return $bdd;
    }
}
