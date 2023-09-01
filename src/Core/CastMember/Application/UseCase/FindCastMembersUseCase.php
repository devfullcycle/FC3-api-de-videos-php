<?php

namespace Core\CastMember\Application\UseCase;

use Core\CastMember\Application\DTO\{
    InputCastMembersDTO,
    OutputCastMembersDTO,
    OutputCastMemberDTO,
};
use Core\CastMember\Domain\Repository\CastMemberRepositoryInterface;

class FindCastMembersUseCase
{
    public function __construct(
        protected CastMemberRepositoryInterface $repository,
    ) {
    }

    public function execute(InputCastMembersDTO $input): OutputCastMembersDTO
    {
        $castMembers = $this->repository->findAll($input->filter);

        $items = array_map(fn ($castMember) => OutputCastMemberDTO::fromEntity($castMember), $castMembers);

        return new OutputCastMembersDTO(
            items: $items,
            total: count($castMembers),
        );
    }
}
