<?php

namespace Core\Category\Domain\Repository;

use Core\Category\Domain\Entities\Category;

interface CategoryRepositoryInterface
{
    /**
     * @return object Category
     */
    public function findOne(string $id): object;

    /**
     * @return array<Category>
     */
    public function findAll(?string $filter): array;
}
