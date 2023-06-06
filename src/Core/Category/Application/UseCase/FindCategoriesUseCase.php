<?php

namespace Core\Category\Application\UseCase;

use Core\Category\Application\DTO\{
    InputCategoriesDTO,
    OutputCategoriesDTO,
    OutputCategoryDTO,
};
use Core\Category\Domain\Repository\CategoryRepositoryInterface;

class FindCategoriesUseCase
{
    public function __construct(
        protected CategoryRepositoryInterface $repository,
    ) {}

    public function execute(InputCategoriesDTO $input): OutputCategoriesDTO
    {
        $categories = $this->repository->findAll($input->filter);

        $items = array_map(fn ($category) => OutputCategoryDTO::fromEntity($category), $categories);

        return new OutputCategoriesDTO(
            items: $items,
            total: count($categories),
        );
    }
}
