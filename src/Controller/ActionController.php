<?php

namespace Tribe\Controller;

use Tribe\Repository\ActionRepository;
use Tribe\Request\Request;
use Tribe\Response\JsonResponse;
use Tribe\Service\ActionService;
use Tribe\Validator\ActionCreateValidator;
use Tribe\Validator\ActionUpdateValidator;

class ActionController implements Controller
{
    private ActionService $actionService;

    public function __construct()
    {
        $this->actionService = new ActionService(new ActionRepository());
    }

    public function index(): JsonResponse
    {
        $actions = [];
        foreach ($this->actionService->findAll() as $action) {
            $actions[] = $action->toArray();
        }

        return new JsonResponse(JsonResponse::STATUS_OK, $actions);
    }

    public function get(Request $request): JsonResponse
    {
        $action = $this->actionService->findById($request->getUrlParam());

        return new JsonResponse(JsonResponse::STATUS_OK, $action ? $action->toArray() : 'Not found!');
    }

    public function create(Request $request): JsonResponse
    {
        $params = $request->getParams();
        $errors = (new ActionCreateValidator())->searchForValidationErrors($request->getParams());
        if ($errors) {
            return new JsonResponse(JsonResponse::STATUS_BAD_REQUEST, $errors);
        }

        $action = $this->actionService->save($params);

        return new JsonResponse(JsonResponse::STATUS_CREATED, $action->toArray());
    }

    public function update(Request $request): JsonResponse
    {
        $params = $request->getParams();
        $errors = (new ActionUpdateValidator())->searchForValidationErrors($request->getParams());
        if ($errors) {
            return new JsonResponse(JsonResponse::STATUS_BAD_REQUEST, $errors);
        }

        $action = $this->actionService->update($request->getUrlParam(), $params);
        if (!$action) {
            return new JsonResponse(JsonResponse::STATUS_NOT_FOUND, 'Action not found!');
        }

        return new JsonResponse(JsonResponse::STATUS_OK, []);
    }
}