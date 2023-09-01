<?php

namespace Core\CastMember\Application\DTO;

class InputCastMemberDTO
{
    public function __construct(
        public readonly string $id,
    ) {
    }
}
