<?php

namespace App\GraphQL\Query\Genres;

use Core\Genre\Application\DTO\InputGenresDTO;
use Core\Genre\Application\UseCase\FindGenresUseCase;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class GenresQuery extends Query
{
    protected $attributes = [
        'name' => 'genres',
    ];

    public function __construct(
        protected FindGenresUseCase $useCase,
    ) {
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Genre'));
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
            new InputGenresDTO(filter: $args['name'] ?? ''),
        );

        return $response->items;
    }
}
