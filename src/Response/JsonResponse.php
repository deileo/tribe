<?php

namespace Tribe\Response;

class JsonResponse
{
    public const STATUS_ERROR = 500;
    public const STATUS_NOT_FOUND = 404;
    public const STATUS_BAD_REQUEST = 400;
    public const STATUS_OK = 200;
    public const STATUS_CREATED = 201;
    public const STATUS_NO_CONTENT = 204;

    private int $status;
    private $body;

    public function __construct(int $status, $body = null)
    {
        $this->status = $status;
        $this->body = $body;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body): void
    {
        $this->body = $body;
    }

    public function serialize()
    {
        return json_encode(is_null($this->body) ? '' : $this->body);
    }
}