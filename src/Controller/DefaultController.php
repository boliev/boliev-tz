<?php

namespace Test\Controller;

class DefaultController extends AbstractAPIController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        return ['message' => 'Default route is useles. Try /api/v1/journey/'];
    }
}
