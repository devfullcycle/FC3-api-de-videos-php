<?php

namespace App\GraphQL\Query\Genres;

use Core\Genre\Application\DTO\InputGenreDTO;
use Core\Genre\Application\UseCase\GetGenreUseCase;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class GenreQuery extends Query
{
    protected $attributes = [
        'name' => 'genre',
    ];

    public function __construct(
        protected GetGenreUseCase $useCase,
    ) {
    }

    public function type(): Type
    {
        return GraphQL::type('Genre');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
                'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $genre = $this->useCase->execute(
            new InputGenreDTO(id: $args['id'])
        );

        return $genre;
    }
}
