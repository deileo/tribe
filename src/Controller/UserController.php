<?php

namespace Tribe\Controller;

use Tribe\Entity\User;
use Tribe\Request\Request;
use Tribe\Response\JsonResponse;
use Tribe\Validator\UserCreateValidator;
use Tribe\Validator\UserUpdateValidator;

class UserController implements Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse(JsonResponse::STATUS_OK, "Hello world!");
    }

    public function create(Request $request): JsonResponse
    {
        $params = $request->getParams();
        $errors = (new UserCreateValidator())->searchForValidationErrors($request->getParams());
        if ($errors) {
            return new JsonResponse(JsonResponse::STATUS_BAD_REQUEST, $errors);
        }

        $user = new User();
        $user->setEmail($params['email']);
        $user->setFirstName($params['firstName']);
        $user->setLastName($params['lastName']);
        $user->setRoles($params['roles']);

        return new JsonResponse(JsonResponse::STATUS_CREATED, $user->toArray());
    }

    public function update(Request $request): JsonResponse
    {
        $params = $request->getParams();
        $errors = (new UserUpdateValidator())->searchForValidationErrors($request->getParams(), $request->getUrlParam());
        if ($errors) {
            return new JsonResponse(JsonResponse::STATUS_BAD_REQUEST, $errors);
        }

        $user = new User();
        $user->setEmail($params['email']);
        $user->setFirstName($params['firstName']);
        $user->setLastName($params['lastName']);
        $user->setRoles($params['roles']);

        return new JsonResponse(JsonResponse::STATUS_OK);
    }
}