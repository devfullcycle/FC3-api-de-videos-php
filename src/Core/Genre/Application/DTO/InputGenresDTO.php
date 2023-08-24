<?php

namespace Core\Genre\Application\DTO;

class InputGenresDTO
{
    public function __construct(
        public readonly string $filter = '',
    ) {
    }
}
