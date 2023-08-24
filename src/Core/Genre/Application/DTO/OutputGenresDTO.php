<?php

namespace Core\Genre\Application\DTO;

class OutputGenresDTO
{
    public function __construct(
        /**
         * @var array<OutputGenreDTO>
         */
        public readonly array $items,
        public readonly int $total,
    ) {
    }
}
