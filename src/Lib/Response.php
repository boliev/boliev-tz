<?php

namespace Test\Lib;

class Response
{
    /**
     * @var array
     */
    private $headers;

    /**
     * @var string
     */
    private $content;

    /**
     * @var int
     */
    private $status;

    const STATUS_OK = 200;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_NOT_FOUND = 404;

    /**
     * Response constructor
     */
    public function __construct()
    {
        $this->headers = [];
        $this->content = '';
        $this->status = self::STATUS_OK;
    }

    /**
     * @param string $header
     */
    public function setHeader(string $header)
    {
        $this->headers[] = $header;
    }

    /**
     * @return array|null
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return null|string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function send()
    {
        http_response_code($this->getStatus());
        foreach ($this->getHeaders() as $header) {
            header($header);
        }
        echo $this->getContent();
    }
}
