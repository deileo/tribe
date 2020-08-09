<?php

namespace Tribe\Entity;

use Tribe\Entity\Traits\RolesTrait;

class Action
{
    use RolesTrait;

    private ?int $id = null;

    private string $name;

    private string $alias;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'alias' => $this->getAlias(),
            'roles' => $this->getRoles()
        ];
    }
}