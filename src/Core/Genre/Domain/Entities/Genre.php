<?php

namespace Core\Genre\Domain\Entities;

use Core\SeedWork\Domain\Traits\MethodsMagicsTrait;
use Core\SeedWork\Domain\Validators\DomainValidation;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use DateTime;

class Genre
{
    use MethodsMagicsTrait;

    public function __construct(
        protected string $name,
        protected ?Uuid $id = null,
        protected bool $isActive = true,
        protected array $categoriesId = [],
        protected ?DateTime $createdAt = null,
    ) {
        $this->id = $this->id ?? Uuid::random();
        $this->createdAt = $this->createdAt ?? new DateTime();

        $this->validate();
    }

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function deactivate(): void
    {
        $this->isActive = false;
    }

    public function update(string $name): void
    {
        $this->name = $name;

        $this->validate();
    }

    public function addCategory(string $categoryId): void
    {
        array_push($this->categoriesId, $categoryId);

        $this->validate();
    }

    public function removeCategory(string $categoryId): void
    {
        unset($this->categoriesId[array_search($categoryId, $this->categoriesId)]);

        $this->validate();
    }

    private function validate()
    {
        DomainValidation::strMinLength($this->name);
        DomainValidation::strMaxLength($this->name);
    }
}
