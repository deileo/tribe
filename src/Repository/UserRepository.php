<?php

namespace Tribe\Repository;

use PDO;
use Tribe\Database\DbConnection;
use Tribe\Entity\User;

class UserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DbConnection::getInstance()->getConnection();
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        $users = [];
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();

        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $users[] = $this->toUser($row);
        }

        return $users;
    }

    public function findById(int $id): ?User
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $id]);

        $row = $query->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->toUser($row) : null;
    }

    public function insert(User $user): void
    {
        $sql = "INSERT INTO users(email, first_name, last_name, roles) 
                VALUES (:email, :firstName, :lastName, :roles)";
        $this->db->prepare($sql)
            ->execute([
                ':email' => $user->getEmail(),
                ':firstName' => $user->getFirstName(),
                ':lastName' => $user->getLastName(),
                ':roles' => $user->getRoleValue(),
        ]);
    }

    public function update(User $user): void
    {
        $sql = "UPDATE users SET email = :email, 
                    first_name = :firstName,
                    last_name = :lastName,
                    roles = :roles
                    WHERE id = :id";
        $this->db->prepare($sql)
            ->execute([
                ':id' => $user->getId(),
                ':email' => $user->getEmail(),
                ':firstName' => $user->getFirstName(),
                ':lastName' => $user->getLastName(),
                ':roles' => $user->getRoleValue(),
            ]);
    }

    private function toUser(array $data): User
    {
        $user = new User();
        $user->setEmail($data['email']);
        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        $user->setRoleValue($data['roles']);
        $user->setId($data['id']);

        return $user;
    }
}