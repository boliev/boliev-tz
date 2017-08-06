<?php

namespace Test\Lib;

use Test\Controller\AbstractAPIController;
use Test\Exception\RouteIsNotCollableException;

/**
 * Class RouterRunner.
 */
class RouterRunner
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var DependencyContainer
     */
    private $container;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * RouterRunner constructor.
     *
     * @param Response            $response
     * @param Request             $request
     * @param DependencyContainer $container
     * @param Translator          $translator
     */
    public function __construct(Response $response, Request $request, DependencyContainer $container, Translator $translator)
    {
        $this->response = $response;
        $this->request = $request;
        $this->container = $container;
        $this->translator = $translator;
    }

    /**
     * @param string $controller
     * @param string $action
     *
     * @return string
     */
    public function run(string $controller, string $action)
    {
        if (is_callable(array($controller, $action))) {
            $controller = new $controller($this->request, $this->container, $this->translator);
            $result = $controller->$action();
            if ($controller instanceof AbstractAPIController) {
                $this->response->setHeader('Content-Type: application/json');
                $result = json_encode($result);
            }
        } else {
            throw new RouteIsNotCollableException($controller.'::'.$action.' is not callable');
        }

        return $result;
    }
}
