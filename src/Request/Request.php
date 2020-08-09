<?php

namespace Tribe\Request;

class Request
{
    private array $params;
    private ?int $urlParam = null;

    public function __construct(string $body, ?int $urlParam = null)
    {
        $bodyArray = json_decode($body, true);
        $this->params = $bodyArray ? $bodyArray : [];
        $this->urlParam = $urlParam;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams($params): void
    {
        $this->params = $params;
    }

    public function getUrlParam(): ?int
    {
        return $this->urlParam;
    }

    public function setUrlParam(?int $urlParam): void
    {
        $this->urlParam = $urlParam;
    }
}