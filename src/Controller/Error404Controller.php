<?php

namespace Tribe\Controller;

use Tribe\Response\JsonResponse;

class Error404Controller implements Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse(JsonResponse::STATUS_NOT_FOUND, 'Not found!');
    }
}