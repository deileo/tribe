<?php

namespace Tribe\Controller;

use Tribe\Response\JsonResponse;

class ErrorController implements Controller
{
    public function index(): JsonResponse {
        return new JsonResponse(JsonResponse::STATUS_ERROR, 'Internal server error');
    }
}