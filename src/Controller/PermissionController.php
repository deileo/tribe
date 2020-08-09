<?php

namespace Tribe\Controller;

use Tribe\Repository\ActionRepository;
use Tribe\Repository\UserRepository;
use Tribe\Request\Request;
use Tribe\Response\JsonResponse;
use Tribe\Service\ActionService;
use Tribe\Service\AuthorizationService;
use Tribe\Service\UserService;
use Tribe\Validator\PermissionCheckerValidator;

class PermissionController implements Controller
{
    private AuthorizationService $authorizationService;

    public function __construct()
    {
        $userService = new UserService(new UserRepository());
        $actionService = new ActionService(new ActionRepository());
        $this->authorizationService = new AuthorizationService($actionService, $userService);
    }

    public function index(): JsonResponse
    {
        return new JsonResponse(JsonResponse::STATUS_OK);
    }

    public function granted(Request $request): JsonResponse
    {
        $params = $request->getParams();
        $errors = (new PermissionCheckerValidator())->searchForValidationErrors($request->getParams(), $request->getUrlParam());
        if ($errors) {
            return new JsonResponse(JsonResponse::STATUS_BAD_REQUEST, $errors);
        }

        try {
            $result = $this->authorizationService->isActionAllowed($params['userId'], $params['alias']);
            return new JsonResponse(JsonResponse::STATUS_OK, $result);
        } catch (\Exception $exception) {
            return new JsonResponse(JsonResponse::STATUS_BAD_REQUEST, $exception->getMessage());
        }

    }
}