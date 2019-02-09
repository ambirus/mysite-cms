<?php

namespace application\components\geo;

use src\I18n;

class SypexGeo implements Ipcatchable
{
    private $api = 'http://api.sypexgeo.net/';
    private $data;
    private $lang;

    public function __construct($ip)
    {
        $this->data = json_decode($this->request($ip));
        $this->lang = I18n::getCurrLang();
    }

    public function request($ip)
    {
        return file_get_contents($this->api . '/json/' . $ip);
    }

    public function getCountry()
    {
        $data = $this->data;

        if (isset($data->country)) {

            $name = 'name_' . $this->lang;

            return $data->country->$name;
        }

        return null;
    }

    /**
     * @return null
     */
    public function getCity()
    {
        $data = $this->data;

        if (isset($data->city)) {

            $name = 'name_' . $this->lang;

            return $data->city->$name;
        }

        return null;
    }
}