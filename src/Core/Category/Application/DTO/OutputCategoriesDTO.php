<?php

namespace Core\Category\Application\DTO;

class OutputCategoriesDTO
{
    public function __construct(
        public readonly array $items,
        public readonly int $total,
    ) {}
}
