<?php

namespace Core\Category\Domain\Entities;

class Category
{
    public function __construct(
        protected string $name,
        protected ?string $description = null,
        protected bool $isActive = true,
    ) {
        // 
    }

    public function __get($name)
    {
        return $this->{$name};
    }
}
