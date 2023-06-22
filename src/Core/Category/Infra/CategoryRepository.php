<?php

namespace Core\Category\Infra;

use Core\Category\Domain\Entities\Category;
use Core\Category\Domain\Repository\CategoryRepositoryInterface;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use DateTime;
use Elasticsearch\Client;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected array $params;

    public function __construct(
        protected Client $client,
    ) {
        $this->params['index'] = [
            'index' => config('elasticsearch.prefix_index') . 'categories',
        ];
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
        dd($response);

        throw new \Exception('Not implemented');
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
