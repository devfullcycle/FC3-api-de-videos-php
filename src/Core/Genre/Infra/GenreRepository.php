<?php

namespace Core\Genre\Infra;

use Core\Genre\Domain\Entities\Genre;
use Core\Genre\Domain\Repository\GenreRepositoryInterface;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use Core\SeedWork\Infra\Repositories\BaseRepository;
use DateTime;

class GenreRepository extends BaseRepository implements GenreRepositoryInterface
{
    public function index(): string
    {
        return 'mysql-server.fullcycle.genres';
        // return config('elasticsearch.prefix_index') . 'genres';
    }

    public function createEntity(array $data)
    {
        return new Genre(
            name: $data['name'],
            id: new Uuid($data['id']),
            isActive: (bool) $data['is_active'],
            createdAt: new DateTime($data['created_at'])
        );
    }
}
