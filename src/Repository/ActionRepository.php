<?php

namespace Tribe\Repository;

use PDO;
use Tribe\Database\DbConnection;
use Tribe\Entity\Action;

class ActionRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DbConnection::getInstance()->getConnection();
    }

    /**
     * @return Action[]
     */
    public function findAll(): array
    {
        $users = [];
        $query = $this->db->prepare("SELECT * FROM actions");
        $query->execute();

        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $users[] = $this->toAction($row);
        }

        return $users;
    }

    public function findById(int $id): ?Action
    {
        $sql = "SELECT * FROM actions WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $id]);

        $row = $query->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->toAction($row) : null;
    }

    public function insert(Action $action): void
    {
        $sql = "INSERT INTO actions(alias, name, roles) VALUES (:alias, :name, :roles)";
        $this->db->prepare($sql)
            ->execute([
                ':alias' => $action->getAlias(),
                ':name' => $action->getName(),
                ':roles' => $action->getRoleValue(),
        ]);
    }

    public function update(Action $action): void
    {
        $sql = "UPDATE actions SET roles = :roles WHERE id = :id";
        $this->db->prepare($sql)
            ->execute([
                ':id' => $action->getId(),
                ':roles' => $action->getRoleValue(),
            ]);
    }

    private function toAction(array $data): Action
    {
        $action = new Action();
        $action->setId($data['id']);
        $action->setAlias($data['alias']);
        $action->setName($data['name']);
        $action->setRoleValue($data['roles']);

        return $action;
    }
}