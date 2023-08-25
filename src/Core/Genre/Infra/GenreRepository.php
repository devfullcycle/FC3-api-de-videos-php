<?php

namespace Core\Genre\Infra;

use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Core\Genre\Domain\Entities\Genre;
use Core\Genre\Domain\Repository\GenreRepositoryInterface;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use DateTime;

class GenreRepository implements GenreRepositoryInterface
{
    protected array $params;

    public function __construct(
        protected ElasticClientInterface $client,
    ) {
        $this->params['index'] = 'mysql-server.fullcycle.genres';
    }

    public function findOne(string $id): Genre
    {
        $this->params['body'] = [
            'query' => [
                'match' => [
                    'after.id' => $id
                ]
            ]
        ];

        $response = $this->client->search($this->params);

        if (!$data = $response['hits']['hits'][0]['_source']['after'] ?? null) {
            throw new EntityNotFoundException("Entity not found ({$id})");
        }

        return $this->createEntity($data);
    }

    /**
     * @return array<Genre>
     */
    public function findAll(?string $filter): array
    {
        if ($filter !== '') {
            $this->params['body'] = [
                'query' => [
                    'match' => [
                        'after.name' => $filter
                    ]
                ]
            ];
        }

        $response = $this->client->search($this->params);
        $genres = array_map(
            fn ($item) => $this->createEntity($item['_source']['after']),
            $response['hits']['hits']
        );

        return $genres;
    }

    private function createEntity(array $data): Genre
    {
        return new Genre(
            name: $data['name'],
            id: new Uuid($data['id']),
            isActive: (bool) $data['is_active'],
            createdAt: new DateTime($data['created_at'])
        );
    }
}
