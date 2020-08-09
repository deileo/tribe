<?php

namespace Tribe\Controller;

use Tribe\Repository\UserRepository;
use Tribe\Request\Request;
use Tribe\Response\JsonResponse;
use Tribe\Service\UserService;
use Tribe\Validator\UserCreateValidator;
use Tribe\Validator\UserUpdateValidator;

class UserController implements Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService(new UserRepository());
    }

    public function index(): JsonResponse
    {
        $users = [];
        foreach ($this->userService->findAll() as $user) {
            $users[] = $user->toArray();
        }

        return new JsonResponse(JsonResponse::STATUS_OK, $users);
    }

    public function get(Request $request): JsonResponse
    {
        $user = $this->userService->findById($request->getUrlParam());

        return new JsonResponse(JsonResponse::STATUS_OK, $user ? $user->toArray() : 'Not found!');
    }

    public function create(Request $request): JsonResponse
    {
        $params = $request->getParams();
        $errors = (new UserCreateValidator())->searchForValidationErrors($request->getParams());
        if ($errors) {
            return new JsonResponse(JsonResponse::STATUS_BAD_REQUEST, $errors);
        }

        $user = $this->userService->save($params);

        return new JsonResponse(JsonResponse::STATUS_CREATED, $user->toArray());
    }

    public function update(Request $request): JsonResponse
    {
        $params = $request->getParams();
        $errors = (new UserUpdateValidator())->searchForValidationErrors($request->getParams(), $request->getUrlParam());
        if ($errors) {
            return new JsonResponse(JsonResponse::STATUS_BAD_REQUEST, $errors);
        }

        $user = $this->userService->update($request->getUrlParam(), $params);
        if (!$user) {
            return new JsonResponse(JsonResponse::STATUS_NOT_FOUND, 'User not found!');
        }

        return new JsonResponse(JsonResponse::STATUS_OK);
    }
}