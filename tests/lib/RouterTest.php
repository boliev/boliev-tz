<?php

namespace UnitTests\lib;

use PHPUnit\Framework\TestCase;
use Test\Exception\RouteNotFoundException;
use Test\Lib\Router;
use Test\Lib\RouterRunner;

class RouterTest extends TestCase
{
    /**
     * @dataProvider RouteNotFoundExceptionProvider
     *
     * @param array $routes
     * @param $uri
     */
    public function testRouteNotFoundException(array $routes, $uri)
    {
        $runner = $this->getMockBuilder(RouterRunner::class)->disableOriginalConstructor()->getMock();
        $router = new Router($routes, $uri, $runner);

        $this->expectException(RouteNotFoundException::class);

        $router->run();
    }

    public function RouteNotFoundExceptionProvider()
    {
        return [
            [
                [], '/some/nonexistent/uri',
            ],
        ];
    }

    /**
     * @dataProvider DefaultControllerHasExecutedProvider
     *
     * @param array $routes
     * @param $uri
     */
    public function testDefaultControllerHasExecuted(array $routes, $uri)
    {
        $runner = $this->getMockBuilder(RouterRunner::class)->disableOriginalConstructor()->getMock();
        $runner->method('run')->willReturnArgument(0);
        $router = new Router($routes, $uri, $runner);

        $result = $router->run();

        $this->assertEquals($result, Router::DEFAULT_CONTROLLER);
    }

    public function DefaultControllerHasExecutedProvider()
    {
        return [
            [
                ['ddd' => []], 'ddd',
            ],
        ];
    }

    /**
     * @dataProvider DefaultActionHasExecutedProvider
     *
     * @param array $routes
     * @param $uri
     */
    public function testDefaultActionHasExecuted(array $routes, $uri)
    {
        $runner = $this->getMockBuilder(RouterRunner::class)->disableOriginalConstructor()->getMock();
        $runner->method('run')->willReturnArgument(1);
        $router = new Router($routes, $uri, $runner);

        $result = $router->run();

        $this->assertEquals($result, Router::DEFAULT_ACTION.'Action');
    }

    public function DefaultActionHasExecutedProvider()
    {
        return [
            [
                ['ddd' => []], 'ddd',
            ],
        ];
    }
}
