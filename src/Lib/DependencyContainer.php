<?php

namespace Test\Lib;

use Test\Exception\NonExistenDependencyException;
use Test\Exception\UnknownDependencyException;

class DependencyContainer
{
    /**
     * @var array
     */
    private $dependencyList;

    /**
     * DependencyContainer constructor.
     *
     * @param array $dependencyList
     */
    public function __construct(array $dependencyList)
    {
        $this->dependencyList = $dependencyList;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        if (!isset($this->dependencyList[$key]['class'])) {
            throw new UnknownDependencyException('unknown dependency '.$key);
        }

        if (!class_exists($this->dependencyList[$key]['class'])) {
            throw new NonExistenDependencyException('dependency does not exists'.$key);
        }

        $class = $this->dependencyList[$key]['class'];

        return new $class();
    }
}
