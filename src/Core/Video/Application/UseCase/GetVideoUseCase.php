<?php

namespace Core\Video\Application\UseCase;

use Core\Video\Application\DTO\{
    InputVideoDTO,
    OutputVideoDTO
};
use Core\Video\Domain\Repository\VideoRepositoryInterface;

class GetVideoUseCase
{
    public function __construct(
        protected VideoRepositoryInterface $repository,
    ) {
    }

    public function execute(InputVideoDTO $input): OutputVideoDTO
    {
        $video = $this->repository->findOne($input->id);

        return OutputVideoDTO::fromEntity($video);
    }
}
