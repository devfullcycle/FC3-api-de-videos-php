<?php

namespace Core\Category\Domain\Entities;

use DateTime;

class Category
{
    public function __construct(
        protected string $name,
        protected ?string $description = null,
        protected bool $isActive = true,
        protected ?DateTime $createdAt = null,
    ) {
        $this->createdAt = $this->createdAt ?? new DateTime();
    }

    public function __get($name)
    {
        return $this->{$name};
    }

    public function createdAt(): string
    {
        return (string) $this->createdAt->format('Y-m-d H:i:s');
    }
}
