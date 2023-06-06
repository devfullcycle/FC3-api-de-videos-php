<?php

namespace Core\Category\Application\DTO;

use Core\Category\Domain\Entities\Category;

class OutputCategoryDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $created_at,
        public readonly bool $is_active = true,
        public readonly string $description = '',
    ) {}

    public static function fromEntity(Category $category): self
    {
        return new self(
            id: $category->id(),
            name: $category->name,
            description: $category->description ?? '',
            is_active: $category->isActive,
            created_at: $category->createdAt(),
        );
    }
}
