<?php

namespace src;

class Router
{
    private $routerStrategy;

    /**
     * Router constructor.
     * @param RoutingStrategy $router
     */
    public function __construct(RoutingStrategy $router)
    {
        $this->routerStrategy = $router;
    }

    public function process()
    {
        $this->routerStrategy->execute();
    }
}