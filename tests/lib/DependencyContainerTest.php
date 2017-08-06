<?php

namespace UnitTests\lib;

use PHPUnit\Framework\TestCase;
use Test\Exception\NonExistenDependencyException;
use Test\Exception\UnknownDependencyException;
use Test\Lib\DependencyContainer;

class DependencyContainerTest extends TestCase
{
    /**
     * @dataProvider RouteNotFoundExceptionProvider
     *
     * @param array  $dependencies
     * @param string $key
     */
    public function testUnknownDependencyException(array $dependencies, string $key)
    {
        $service = new DependencyContainer($dependencies);

        $this->expectException(UnknownDependencyException::class);

        $service->get($key);
    }

    public function RouteNotFoundExceptionProvider()
    {
        return [
            [
                [], 'unknownKey',
            ],
        ];
    }

    /**
     * @dataProvider nonExistDependencyExceptionProvider
     *
     * @param array  $dependencies
     * @param string $key
     */
    public function testNonExistDependencyException(array $dependencies, string $key)
    {
        $service = new DependencyContainer($dependencies);

        $this->expectException(NonExistenDependencyException::class);

        $service->get($key);
    }

    public function nonExistDependencyExceptionProvider()
    {
        return [
            [
                ['key' => ['class' => 'someUnknownClass']], 'key',
            ],
        ];
    }
}
