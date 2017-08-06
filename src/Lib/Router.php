<?php

namespace Test\Lib;

use Test\Exception\RouteNotFoundException;

class Router
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @var RouterRunner
     */
    private $runner;

    const DEFAULT_CONTROLLER = 'Test\Controller\DefaultController';
    const DEFAULT_ACTION = 'index';

    /**
     * Router constructor.
     *
     * @param array        $routes
     * @param string       $uri
     * @param RouterRunner $runner
     */
    public function __construct(array $routes, string $uri, RouterRunner $runner)
    {
        $this->routes = $routes;
        $this->uri = $uri;
        $this->runner = $runner;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        if (!isset($this->routes[$this->uri])) {
            throw new RouteNotFoundException('Route not found');
        }

        $route = $this->routes[$this->uri];
        $controller = (isset($route['controller']) ? $route['controller'] : self::DEFAULT_CONTROLLER);
        $action = (isset($route['action']) ? $route['action'] : self::DEFAULT_ACTION).'Action';
        $result = $this->runner->run($controller, $action);

        return $result;
    }
}
