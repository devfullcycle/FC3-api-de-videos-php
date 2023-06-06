<?php

namespace Core\Category\Domain\Entities;

use Core\SeedWork\Domain\Traits\MethodsMagicsTrait;
use Core\SeedWork\Domain\Validators\DomainValidation;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use DateTime;

class Category
{
    use MethodsMagicsTrait;

    public function __construct(
        protected string $name,
        protected ?Uuid $id = null,
        protected ?string $description = null,
        protected bool $isActive = true,
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

    public function disable(): void
    {
        $this->isActive = false;
    }

    public function update(string $name, string $description = null): void
    {
        $this->name = $name;
        $this->description = $description ?? $this->description;

        $this->validate();
    }

    private function validate()
    {
        DomainValidation::strMinLength($this->name);
        DomainValidation::strMaxLength($this->name);
        DomainValidation::strCanNullAndMaxLength($this->description, 1000);
    }
}
