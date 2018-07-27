<?php
namespace application\components\geo;

class IpManager
{
    private $_apiHandler = 'SypexGeo';
    private $_instance;

    public function __construct($ip)
    {
        $className = 'application\\components\\geo\\' . $this->_apiHandler;

        if (!class_exists($className))
            throw new \ErrorException('No api class!');

        if (!in_array('application\\components\\geo\\Ipcatchable', class_implements($className)))
            throw new \ErrorException('Class ' . $className . ' must implement Ipcatchable interface!');

        $this->_instance = new $className($ip);
    }

    public function getCountry()
    {
        return $this->_instance->getCountry();
    }

    public function getCity()
    {
        return $this->_instance->getCity();
    }
}