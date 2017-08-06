<?php

namespace Test\Lib;

/**
 * Class Request.
 */
class Request
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $post;

    const METHOD_POST = 'post';

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->setMethod();
        if (self::METHOD_POST === $this->getMethod()) {
            $this->setPostPayload();
        }
    }

    /**
     * @param string $key
     * @param $default
     *
     * @return mixed
     */
    public function getPost(string $key, $default = false)
    {
        if (isset($this->post[$key])) {
            return $this->post[$key];
        } else {
            return $default;
        }
    }

    /**
     * @return mixed
     */
    public function getAllPost()
    {
        return $this->post;
    }

    private function setMethod()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($this->method);
    }

    private function setPostPayload()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $this->post = $post;
    }
}
