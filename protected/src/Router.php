<?php

namespace src;

class Router
{
    private $routerStrategy;

    public function __construct(RoutingStrategy $router)
    {
        $this->routerStrategy = $router;
    }

    public function process()
	{
        $this->routerStrategy->execute();
	}
}