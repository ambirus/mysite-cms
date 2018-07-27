<?php
namespace src\rest;

interface Request
{
    public function get($url, $params);
    public function post($url, $params);
}