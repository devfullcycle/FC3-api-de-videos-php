<?php

namespace App\GraphQL\Query\Videos;

use Core\Video\Application\DTO\InputVideosDTO;
use Core\Video\Application\UseCase\FindVideosUseCase;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class VideosQuery extends Query
{
    protected $attributes = [
        'name' => 'videos',
    ];

    public function __construct(
        protected FindVideosUseCase $useCase,
    ) {
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Video'));
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                // 'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $response = $this->useCase->execute(
            new InputVideosDTO(filter: $args['name'] ?? ''),
        );

        return $response->items;
    }
}
