<?php

namespace Core\Video\Application\DTO;

class InputVideoDTO
{
    public function __construct(
        public readonly string $id,
    ) {
    }
}
