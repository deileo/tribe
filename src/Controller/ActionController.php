<?php

namespace Tribe\Controller;

use Tribe\Entity\Action;
use Tribe\Request\Request;
use Tribe\Response\JsonResponse;
use Tribe\Validator\ActionCreateValidator;
use Tribe\Validator\ActionUpdateValidator;

class ActionController implements Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse(JsonResponse::STATUS_OK, "Hello world!");
    }

    public function create(Request $request): JsonResponse
    {
        $params = $request->getParams();
        $errors = (new ActionCreateValidator())->searchForValidationErrors($request->getParams());
        if ($errors) {
            return new JsonResponse(JsonResponse::STATUS_BAD_REQUEST, $errors);
        }

        $action = new Action();
        $action->setName($params['name']);
        $action->setAlias($params['alias']);
        $action->setRoles($params['roles']);

        return new JsonResponse(JsonResponse::STATUS_CREATED, $action->toArray());
    }

    public function update(Request $request): JsonResponse
    {
        $params = $request->getParams();
        $errors = (new ActionUpdateValidator())->searchForValidationErrors($request->getParams());
        if ($errors) {
            return new JsonResponse(JsonResponse::STATUS_BAD_REQUEST, $errors);
        }

        $action = new Action();
        $action->setRoles($params['roles']);

        return new JsonResponse(JsonResponse::STATUS_OK, []);
    }
}