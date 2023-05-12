<?php

namespace Core\Category\Application\DTO;

class OutputCategoryDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $created_at,
        public readonly bool $is_active = true,
        public readonly string $description = '',
    ) {}
}
