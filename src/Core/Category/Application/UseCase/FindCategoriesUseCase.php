<?php

namespace Core\Category\Application\UseCase;

use Core\Category\Application\DTO\{
    InputCategoriesDTO,
    OutputCategoriesDTO,
};
use Core\Category\Domain\Repository\CategoryRepositoryInterface;

class FindCategoriesUseCase
{
    public function __construct(
        protected CategoryRepositoryInterface $repository,
    ) {}

    public function execute(InputCategoriesDTO $input): OutputCategoriesDTO
    {
        $this->repository->findAll($input->filter);

        return new OutputCategoriesDTO(
            items: [],
            total: 0,
        );
    }
}
