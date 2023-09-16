<?php

namespace Core\Video\Application\DTO;

class OutputVideosDTO
{
    public function __construct(
        /**
         * @var array<OutputVideoDTO>
         */
        public readonly array $items,
        public readonly int $total,
    ) {
    }
}
