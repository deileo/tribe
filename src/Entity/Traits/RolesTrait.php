<?php

namespace Tribe\Entity\Traits;

use Tribe\Entity\User;

trait RolesTrait
{
    public static array $roleMap = [
        'ROLE_ADMIN' => User::ROLE_ADMIN,
        'ROLE_MANAGER' => User::ROLE_MANAGER,
        'ROLE_USER' => User::ROLE_USER,
    ];

    private int $roles;

    public function getRoles(): array
    {
        $roles = [];

        foreach (self::$roleMap as $role => $flag) {
            if ($flag === ($this->roles & $flag)) {
                $roles[] = $role;
            }
        }

        return $roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = 0;

        foreach ($roles as $role) {
            $this->addRole($role);
        }
    }

    public function getRoleValue(): int
    {
        return $this->roles;
    }

    public function setRoleValue(int $role): void
    {
        $this->roles = $role;
    }

    public function addRole(string $role): void
    {
        $role = strtoupper($role);
        if ($this->hasRole($role) || !array_key_exists($role, self::$roleMap)) {
            return;
        }

        $this->roles |= self::$roleMap[$role];
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->getRoles(), true);
    }
}