<?php

namespace Tribe\Service;

use Tribe\Entity\Action;
use Tribe\Repository\ActionRepository;

class ActionService
{
    private ActionRepository $actionRepo;

    public function __construct(ActionRepository $actionRepo)
    {
        $this->actionRepo = $actionRepo;
    }

    public function findById(int $actionId): ?Action
    {
        return $this->actionRepo->findById($actionId);
    }

    public function findByAlias(string $alias)
    {
        return $this->actionRepo->findByAlias($alias);
    }

    /**
     * @return Action[]
     */
    public function findAll(): array
    {
        return $this->actionRepo->findAll();
    }

    public function save(array $params): Action
    {
        $action = new Action();
        $action->setAlias($params['alias']);
        $action->setName($params['name']);
        $action->setRoles($params['roles']);

        $this->actionRepo->insert($action);

        return $action;
    }

    public function update(int $actionId, array $params): ?Action
    {
        $action = $this->actionRepo->findById($actionId);
        if (!$action) {
            return null;
        }

        $action->setId($actionId);
        $action->setRoles($params['roles']);

        $this->actionRepo->update($action);

        return $action;
    }
}