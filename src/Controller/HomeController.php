<?php

namespace Tribe\Controller;

use Tribe\Response\JsonResponse;

class HomeController implements Controller
{
    public function index(): JsonResponse {
        return new JsonResponse(JsonResponse::STATUS_OK, 'hello world');
    }
}