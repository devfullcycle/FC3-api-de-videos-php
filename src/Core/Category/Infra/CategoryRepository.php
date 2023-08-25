<?php

namespace Core\Category\Infra;

use Core\Category\Domain\Entities\Category;
use Core\Category\Domain\Repository\CategoryRepositoryInterface;
use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use DateTime;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected array $params;

    public function __construct(
        protected ElasticClientInterface $client,
    ) {
        $this->params['index'] = 'mysql-server.fullcycle.categories';
    }

    public function findOne(string $id): Category
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
     * @return array<Category>
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
        $categories = array_map(
            fn ($item) => $this->createEntity($item['_source']['after']),
            $response['hits']['hits']
        );

        return $categories;
    }

    private function createEntity(array $data): Category
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
