<?php

namespace Tribe\Service;

class AuthorizationService
{
    private ActionService $actionService;
    private UserService $userService;

    public function __construct(ActionService $actionService, UserService $userService)
    {
        $this->actionService = $actionService;
        $this->userService = $userService;
    }

    public function isActionAllowed(int $userId, string $actionAlias): bool
    {
        $user = $this->userService->findById($userId);
        $action = $this->actionService->findByAlias($actionAlias);

        if (!$user || !$action) {
            throw new \Exception("No user or action was found!");
        }

        return $action->isActionAllowed($user->getRoles());
    }
}