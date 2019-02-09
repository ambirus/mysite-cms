<?php

namespace application\components\geo;

class IpManager
{
    private $apiHandler = 'SypexGeo';
    private $instance;

    /**
     * IpManager constructor.
     * @param $ip
     * @throws \Exception
     */
    public function __construct($ip)
    {
        $className = 'application\\components\\geo\\' . $this->apiHandler;

        if (!class_exists($className)) {
            throw new \Exception('No api class!');
        }

        if (!in_array('application\\components\\geo\\Ipcatchable', class_implements($className))) {
            throw new \Exception('Class ' . $className . ' must implement Ipcatchable interface!');
        }

        $this->instance = new $className($ip);
    }

    public function getCountry()
    {
        return $this->instance->getCountry();
    }

    public function getCity()
    {
        return $this->instance->getCity();
    }
}