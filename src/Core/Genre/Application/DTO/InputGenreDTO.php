<?php

namespace Core\Genre\Application\DTO;

class InputGenreDTO
{
    public function __construct(
        public readonly string $id,
    ) {
    }
}
