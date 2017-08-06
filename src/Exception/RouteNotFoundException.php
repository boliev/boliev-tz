<?php

namespace Test\Exception;

use Test\Lib\Response;
use Throwable;

/**
 * Class RouteNotFoundException.
 */
class RouteNotFoundException extends \RuntimeException
{
    /**
     * RouteNotFoundException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if (0 === $code) {
            $code = Response::STATUS_NOT_FOUND;
        }
        parent::__construct($message, $code, $previous);
    }
}
