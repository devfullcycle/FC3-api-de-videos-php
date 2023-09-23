<?php

namespace Core\Video\Infra;

use Core\Video\Domain\Entities\Video;
use Core\Video\Domain\Repository\VideoRepositoryInterface;
use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use Core\Video\Domain\Enums\Rating;
use DateTime;

class VideoRepository implements VideoRepositoryInterface
{
    protected array $params;

    public function __construct(
        protected ElasticClientInterface $client,
    ) {
        $this->params['index'] = 'mysql-server.fullcycle.videos';
    }

    public function findOne(string $id): Video
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
     * @return array<Video>
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
        $videos = array_map(
            fn ($item) => $this->createEntity($item['_source']['after']),
            $response['hits']['hits']
        );

        return $videos;
    }

    private function createEntity(array $data): Video
    {
        return new Video(
            title: $data['title'],
            description: $data['description'],
            duration: $data['duration'],
            yearLaunched: $data['year_launched'],
            opened: (bool) $data['opened'],
            rating: Rating::from($data['rating']),
            id: new Uuid($data['id']),
            published: (bool) $data['published'],
            createdAt: new DateTime($data['created_at']),
        );
    }
}
