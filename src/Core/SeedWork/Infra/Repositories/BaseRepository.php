<?php

namespace Core\SeedWork\Infra\Repositories;

use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;

abstract class BaseRepository
{
    protected array $params;

    public function __construct(
        protected ElasticClientInterface $client,
    ) {
        $this->params['index'] = $this->index();
    }

    abstract public function createEntity(array $data);
    abstract public function index(): string;

    public function findOne(string $id): object
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
     * @return array<Entity>
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
        $entities = array_map(
            fn ($item) => $this->createEntity($item['_source']['after']),
            $response['hits']['hits']
        );

        return $entities;
    }
}
