<?php

namespace Core\Genre\Application\UseCase;

use Core\Genre\Application\DTO\{
    InputGenreDTO,
    OutputGenreDTO
};
use Core\Genre\Domain\Repository\GenreRepositoryInterface;

class GetGenreUseCase
{
    public function __construct(
        protected GenreRepositoryInterface $repository,
    ) {
    }

    public function execute(InputGenreDTO $input): OutputGenreDTO
    {
        $genre = $this->repository->findOne(id: $input->id);

        return OutputGenreDTO::fromEntity($genre);
    }
}
