<?php

namespace Core\CastMember\Application\DTO;

class InputCastMembersDTO
{
    public function __construct(
        public readonly string $filter = '',
    ) {
    }
}
