<?php

namespace Core\CastMember\Infra;

use Core\CastMember\Domain\Entities\CastMember;
use Core\CastMember\Domain\Enums\CastMemberType;
use Core\CastMember\Domain\Repository\CastMemberRepositoryInterface;
use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use DateTime;

class CastMemberRepository implements CastMemberRepositoryInterface
{
    protected array $params;

    public function __construct(
        protected ElasticClientInterface $client,
    ) {
        $this->params['index'] = 'mysql-server.fullcycle.cast_members';
    }

    public function findOne(string $id): CastMember
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
     * @return array<CastMember>
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
        $castMembers = array_map(
            fn ($item) => $this->createEntity($item['_source']['after']),
            $response['hits']['hits']
        );

        return $castMembers;
    }

    private function createEntity(array $data): CastMember
    {
        return new CastMember(
            name: $data['name'],
            id: new Uuid($data['id']),
            type: CastMemberType::from((int) $data['type']),
            createdAt: new DateTime($data['created_at'])
        );
    }
}
