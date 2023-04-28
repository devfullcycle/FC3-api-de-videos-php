<?php

namespace Core\Category\Domain\Entities;

use Core\SeedWork\Domain\Validators\DomainValidation;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use DateTime;

class Category
{
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

    public function __get($name)
    {
        return $this->{$name};
    }

    public function createdAt(): string
    {
        return (string) $this->createdAt->format('Y-m-d H:i:s');
    }

    public function id(): string
    {
        return (string) $this->id;
    }

    private function validate()
    {
        DomainValidation::strMinLength($this->name);
        DomainValidation::strMaxLength($this->name);
        DomainValidation::strCanNullAndMaxLength($this->description, 1000);
    }
}
