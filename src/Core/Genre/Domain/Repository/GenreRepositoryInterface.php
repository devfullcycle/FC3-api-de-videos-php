<?php

namespace Core\Genre\Domain\Repository;

use Core\Genre\Domain\Entities\Genre;

interface GenreRepositoryInterface
{
    public function findOne(string $id): Genre;

    /**
     * @return array<Genre>
     */
    public function findAll(?string $filter): array;
}
