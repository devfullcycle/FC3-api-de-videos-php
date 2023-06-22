<?php

namespace Core\Category\Infra;

use Core\Category\Domain\Entities\Category;
use Core\Category\Domain\Repository\CategoryRepositoryInterface;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected array $params = [
        'index' => 'mysql-server.fullcycle.categories',
    ];

    public function __construct(
        protected Client $client,
    ) {
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

        return $response;
    }
}
