<?php

namespace Core\Category\Application\DTO;

class InputCategoryDTO
{
    public function __construct(
        public readonly string $id,
    ) {}
}
