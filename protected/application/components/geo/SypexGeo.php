<?php
namespace application\components\geo;

use src\I18n;

class SypexGeo implements Ipcatchable
{
    private $_api = 'http://api.sypexgeo.net/';
    private $_data;
    private $_lang;

    public function __construct($ip)
    {
       $this->_data = json_decode($this->request($ip));
       $this->_lang = I18n::getCurrLang();
    }

    public function request($ip)
    {
        return file_get_contents($this->_api . '/json/' . $ip);
    }

    public function getCountry()
    {
        $data = $this->_data;

        if (isset($data->country)) {

            $name = 'name_' . $this->_lang;

            return $data->country->$name;
        }

        return null;
    }

    public function getCity()
    {
        $data = $this->_data;

        if (isset($data->city)) {

            $name = 'name_' . $this->_lang;

            return $data->city->$name;
        }

        return null;
    }
}