<?php

namespace Test\Service;

use Test\Exception\BadRequestHTTPException;
use Test\Exception\CantSortCardsException;
use Test\Exception\FieldsValidationException;

class Cards
{
    const MANDATORY_FIELDS = ['transport', 'from', 'to'];

    /**
     * @param array $cards
     *
     * @return array
     */
    public function sort($cards)
    {
        if (!is_array($cards) || count($cards) < 2) {
            throw new BadRequestHTTPException('Wrong boarding cards list');
        }

        $this->cardsValidate($cards);
        $cardsSorted[] = array_shift($cards);
        while (count($cards)) {
            $hasSort = false;
            $cards = array_values($cards);
            for ($i = 0, $count = count($cards); $i < $count; ++$i) {
                if ($cards[$i]['from'] === $cardsSorted[count($cardsSorted) - 1]['to']) {
                    $cardsSorted[] = $cards[$i];
                    unset($cards[$i]);
                    $hasSort = true;
                } elseif ($cards[$i]['to'] === $cardsSorted[0]['from']) {
                    $cardsSorted = array_merge([$cards[$i]], $cardsSorted);
                    unset($cards[$i]);
                    $hasSort = true;
                }
            }
            if (count($cards) && !$hasSort) {
                throw new CantSortCardsException('Can\'t sort boarding cards');
            }
        }

        return $cardsSorted;
    }

    private function cardsValidate($cards)
    {
        foreach ($cards as $card) {
            if (array_diff(self::MANDATORY_FIELDS, array_keys($card))) {
                throw new FieldsValidationException('some mandatory fields are missing');
            }
        }

        return true;
    }
}
