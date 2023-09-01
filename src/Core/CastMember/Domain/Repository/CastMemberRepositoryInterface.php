<?php

namespace Core\CastMember\Domain\Repository;

use Core\CastMember\Domain\Entities\CastMember;

interface CastMemberRepositoryInterface
{
    public function findOne(string $id): CastMember;

    /**
     * @return array<CastMember>
     */
    public function findAll(?string $filter): array;
}
