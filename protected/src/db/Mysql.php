<?php

namespace src\db;

use PDO;

class Mysql extends AbstractDb
{
    public function __construct($config)
    {
        $this->pdo = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['database'], $config['login'], $config['password']);
        $this->pdo->exec('set names utf8');
        $this->pdo->setAttribute(PDO::ATTR_TIMEOUT, 55);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
}