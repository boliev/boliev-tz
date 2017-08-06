<?php

namespace UnitTests\Service;

use PHPUnit\Framework\TestCase;
use Test\Exception\BadRequestHTTPException;
use Test\Exception\CantSortCardsException;
use Test\Exception\FieldsValidationException;
use Test\Service\Cards;

class CardsTest extends TestCase
{
    /**
     * @dataProvider RouteNotFoundExceptionProvider
     *
     * @param array $cards
     */
    public function testBadRequestException($cards)
    {
        $service = new Cards();

        $this->expectException(BadRequestHTTPException::class);

        $service->sort($cards);
    }

    public function RouteNotFoundExceptionProvider()
    {
        return [
            ['NotAnArray'],
            [[]],
            ];
    }

    /**
     * @dataProvider fieldsValidateExceptionProvider
     *
     * @param array $cards
     */
    public function testFieldsValidateException($cards)
    {
        $service = new Cards();

        $this->expectException(FieldsValidationException::class);

        $service->sort($cards);
    }

    public function fieldsValidateExceptionProvider()
    {
        return [
            [[
                [
                    'from' => 'Madrid',
                    'to' => 'Barcelona',
                ],
                [
                    'transport' => 'Plane',
                    'from' => 'Madrid',
                    'to' => 'Barcelona',
                ],
            ]],
            [[
                [
                    'from' => 'Madrid',
                    'transport' => 'Plane',
                ],
                [
                    'transport' => 'Plane',
                    'from' => 'Madrid',
                    'to' => 'Barcelona',
                ],
            ]],
            [[
                [
                    'transport' => 'Plane',
                    'to' => 'Barcelona',
                ],
                [
                    'transport' => 'Plane',
                    'from' => 'Madrid',
                    'to' => 'Barcelona',
                ],
            ]],
        ];
    }

    /**
     * @dataProvider successProvider
     *
     * @param array $cards
     * @param $expectedResult
     */
    public function testSuccess($cards, $expectedResult)
    {
        $service = new Cards();

        $result = $service->sort($cards);

        $this->assertEquals($result, $expectedResult);
    }

    public function successProvider()
    {
        return [
            [
                [
                    [
                        'transport' => 'Plane',
                        'from' => 'Barcelona',
                        'to' => 'New York',
                    ],
                    [
                        'transport' => 'Plane',
                        'from' => 'Madrid',
                        'to' => 'Barcelona',
                    ],
                    [
                        'transport' => 'Plane',
                        'from' => 'New York',
                        'to' => 'St.Petersburg',
                    ],
                ],
                [
                    [
                        'transport' => 'Plane',
                        'from' => 'Madrid',
                        'to' => 'Barcelona',
                    ],
                    [
                        'transport' => 'Plane',
                        'from' => 'Barcelona',
                        'to' => 'New York',
                    ],
                    [
                        'transport' => 'Plane',
                        'from' => 'New York',
                        'to' => 'St.Petersburg',
                    ],
                ],
                [
                    [
                        'transport' => 'Plane',
                        'from' => 'Madrid',
                        'to' => 'Barcelona',
                    ],
                    [
                        'transport' => 'Plane',
                        'from' => 'Barcelona',
                        'to' => 'New York',
                    ],
                    [
                        'transport' => 'Plane',
                        'from' => 'New York',
                        'to' => 'St.Petersburg',
                    ],
                ],
                [
                    [
                        'transport' => 'Plane',
                        'from' => 'Madrid',
                        'to' => 'Barcelona',
                    ],
                    [
                        'transport' => 'Plane',
                        'from' => 'Barcelona',
                        'to' => 'New York',
                    ],
                    [
                        'transport' => 'Plane',
                        'from' => 'New York',
                        'to' => 'St.Petersburg',
                    ],
                ],
            ],
        ];
    }

    /**
     * @dataProvider CantSortCardsExceptionProvider
     *
     * @param array $cards
     */
    public function testCantSortCardsException($cards)
    {
        $service = new Cards();

        $this->expectException(CantSortCardsException::class);

        $service->sort($cards);
    }

    public function CantSortCardsExceptionProvider()
    {
        return [
            [
                [
                    [
                        'transport' => 'Plane',
                        'from' => 'Barcelona',
                        'to' => 'New York',
                    ],
                    [
                        'transport' => 'Plane',
                        'from' => 'Madrid',
                        'to' => 'Barcelona',
                    ],
                    [
                        'transport' => 'Plane',
                        'from' => 'Berlin',
                        'to' => 'St.Petersburg',
                    ],
                ],
            ]
        ];
    }
}
