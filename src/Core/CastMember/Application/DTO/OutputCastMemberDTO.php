<?php

namespace Core\CastMember\Application\DTO;

use Core\CastMember\Domain\Entities\CastMember;

class OutputCastMemberDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly int $type,
        public readonly string $created_at,
    ) {
    }

    public static function fromEntity(CastMember $castMember): self
    {
        return new self(
            id: $castMember->id(),
            name: $castMember->name,
            type: $castMember->type->value,
            created_at: $castMember->createdAt(),
        );
    }
}
