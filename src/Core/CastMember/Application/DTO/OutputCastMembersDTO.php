<?php

namespace Core\CastMember\Application\DTO;

class OutputCastMembersDTO
{
    public function __construct(
        /**
         * @var array<OutputCastMemberDTO>
         */
        public readonly array $items,
        public readonly int $total,
    ) {
    }
}
