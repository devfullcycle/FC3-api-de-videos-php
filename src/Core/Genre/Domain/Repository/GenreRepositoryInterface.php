<?php

namespace Core\Genre\Domain\Repository;

use Core\Genre\Domain\Entities\Genre;

interface GenreRepositoryInterface
{
    /**
     * @return object Genre
     */
    public function findOne(string $id): object;

    /**
     * @return array<Genre>
     */
    public function findAll(?string $filter): array;
}
