<?php
namespace Test\Web;

use Test\Lib\DependencyContainer;
use Test\Lib\Request;
use Test\Lib\Response;
use Test\Lib\Router;
use Test\Lib\RouterRunner;
use Test\Lib\Translator;

require "../vendor/autoload.php";
define('ROOT', dirname(__FILE__));

// Configs
$routes = require(ROOT.'/../app/config/routes.php');
$dependencyList = require(ROOT.'/../app/config/dependency.php');
$translates = require(ROOT.'/../app/config/translates.php');

// Uri
$uri = '';
if (!empty($_SERVER['REQUEST_URI'])) {
    $uri = trim($_SERVER['REQUEST_URI'], '/');
}

// Libs
$request = new Request();
$response = new Response();
$container = new DependencyContainer($dependencyList);
$translator = new Translator($translates);
$runner = new RouterRunner($response, $request, $container, $translator);
$router = new Router($routes, $uri, $runner);

// Response
try {
    $response->setContent($router->run());
} catch (\Exception $e) {
    $response->setStatus($e->getCode());
    $response->setContent($e->getMessage());
} finally {
    $response->send();
}
