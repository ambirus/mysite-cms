<?php
namespace application\components\geo;

interface Ipcatchable
{
    public function request($ip);
    public function getCountry();
    public function getCity();
}