<?php

namespace Test\Controller;

/**
 * Class JourneyController.
 */
class JourneyController extends AbstractAPIController
{
    /**
     * @return array
     */
    public function listAction()
    {
        $cards = $this->request->getAllPost();
        $cardsService = $this->container->get('CardsService');
        $cardsSorted = $cardsService->sort($cards);

        foreach ($cardsSorted as $card) {
            $result[] = $this->cardCompile($card);
        }
        $result[] = $this->trans('finalDestination');

        return $result;
    }

    /**
     * @param array $card
     *
     * @return string
     */
    private function cardCompile(array $card)
    {
        $cardCompile = str_replace(['%transport%', '%from%', '%to%', '%seat%', '%info%'], [
            $card['transport'] ?? '',
            $card['from'] ?? '',
            $card['to'] ?? '',
            $card['seat'] ?? $this->trans('noSeat'),
            $card['info'] ?? '',
        ], $this->trans('cardCompile'));

        return trim($cardCompile);
    }
}
