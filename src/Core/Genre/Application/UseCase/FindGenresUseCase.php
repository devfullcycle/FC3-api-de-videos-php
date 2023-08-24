<?php

namespace Core\Genre\Application\UseCase;

use Core\Genre\Application\DTO\{
    InputGenresDTO,
    OutputGenresDTO,
    OutputGenreDTO,
};
use Core\Genre\Domain\Repository\GenreRepositoryInterface;

class FindGenresUseCase
{
    public function __construct(
        protected GenreRepositoryInterface $repository,
    ) {
    }

    public function execute(InputGenresDTO $input): OutputGenresDTO
    {
        $genres = $this->repository->findAll($input->filter);

        $items = array_map(fn ($genre) => OutputGenreDTO::fromEntity($genre), $genres);

        return new OutputGenresDTO(
            items: $items,
            total: count($genres),
        );
    }
}
