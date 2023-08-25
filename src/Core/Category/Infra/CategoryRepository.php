<?php

namespace Core\Category\Infra;

use Core\Category\Domain\Entities\Category;
use Core\Category\Domain\Repository\CategoryRepositoryInterface;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use Core\SeedWork\Infra\Repositories\BaseRepository;
use DateTime;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function index(): string
    {
        return 'mysql-server.fullcycle.categories';
        // return config('elasticsearch.prefix_index') . 'categories';
    }

    public function createEntity(array $data)
    {
        return new Category(
            name: $data['name'],
            id: new Uuid($data['id']),
            description: $data['description'] ?? '',
            isActive: (bool) $data['is_active'],
            createdAt: new DateTime($data['created_at'])
        );
    }
}
