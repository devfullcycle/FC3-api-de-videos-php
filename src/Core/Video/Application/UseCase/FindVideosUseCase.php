<?php

namespace Core\Video\Application\UseCase;

use Core\Video\Application\DTO\{
    InputVideosDTO,
    OutputVideosDTO,
    OutputVideoDTO,
};
use Core\Video\Domain\Repository\VideoRepositoryInterface;

class FindVideosUseCase
{
    public function __construct(
        protected VideoRepositoryInterface $repository,
    ) {
    }

    public function execute(InputVideosDTO $input): OutputVideosDTO
    {
        $categories = $this->repository->findAll($input->filter);

        $items = array_map(fn ($category) => OutputVideoDTO::fromEntity($category), $categories);

        return new OutputVideosDTO(
            items: $items,
            total: count($categories),
        );
    }
}
