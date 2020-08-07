<?php

namespace Tribe\Controller;

use Tribe\Response\JsonResponse;

interface Controller
{
    public function index(): JsonResponse;
}