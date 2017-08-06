<?php

namespace Test\Controller;

use Test\Lib\DependencyContainer;
use Test\Lib\Request;
use Test\Lib\Translator;

class AbstractController
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var DependencyContainer
     */
    protected $container;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * AbstractController constructor.
     *
     * @param Request             $request
     * @param DependencyContainer $container
     * @param Translator          $translator
     */
    public function __construct(Request $request, DependencyContainer $container, Translator $translator)
    {
        $this->request = $request;
        $this->container = $container;
        $this->translator = $translator;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected function trans(string $key)
    {
        return $this->translator->trans($key);
    }
}
