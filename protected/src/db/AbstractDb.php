<?php

namespace src\db;

abstract class AbstractDb
{
    protected $pdo;

    public function get()
    {
        return $this->pdo;
    }
}