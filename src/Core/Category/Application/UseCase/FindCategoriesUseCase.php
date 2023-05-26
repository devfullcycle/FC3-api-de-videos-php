<?php

namespace Core\Category\Application\UseCase;

use Core\Category\Domain\Repository\CategoryRepositoryInterface;

class FindCategoriesUseCase
{
    public function __construct(
        protected CategoryRepositoryInterface $repository,
    ) {}

    public function execute()
    {
        
    }
}
