<?php

namespace Core\Category\Application\DTO;

class InputCategoriesDTO
{
    public function __construct(
        public readonly string $filter = '',
    ) {}
}
