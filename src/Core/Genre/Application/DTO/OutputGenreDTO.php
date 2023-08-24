<?php

namespace Core\Genre\Application\DTO;

use Core\Genre\Domain\Entities\Genre;

class OutputGenreDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $created_at,
        public readonly bool $is_active = true,
        public readonly array $categories = [],
    ) {
    }

    public static function fromEntity(Genre $genre): self
    {
        return new self(
            id: $genre->id(),
            name: $genre->name,
            categories: $genre->categoriesId,
            is_active: $genre->isActive,
            created_at: $genre->createdAt(),
        );
    }
}
