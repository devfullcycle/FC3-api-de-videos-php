<?php

namespace Core\Video\Application\DTO;

class InputVideosDTO
{
    public function __construct(
        public readonly string $filter = '',
    ) {
    }
}
