<?php

namespace Core\Category\Application\DTO;

class OutputCategoriesDTO
{
    public function __construct(
        /**
         * @var array<OutputCategoryDTO>
         */
        public readonly array $items,
        public readonly int $total,
    ) {}
}
