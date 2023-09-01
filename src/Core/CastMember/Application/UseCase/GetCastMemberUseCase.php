<?php

namespace Core\CastMember\Application\UseCase;

use Core\CastMember\Application\DTO\{
    InputCastMemberDTO,
    OutputCastMemberDTO
};
use Core\CastMember\Domain\Repository\CastMemberRepositoryInterface;

class GetCastMemberUseCase
{
    public function __construct(
        protected CastMemberRepositoryInterface $repository,
    ) {
    }

    public function execute(InputCastMemberDTO $input): OutputCastMemberDTO
    {
        $category = $this->repository->findOne($input->id);

        return OutputCastMemberDTO::fromEntity($category);
    }
}
