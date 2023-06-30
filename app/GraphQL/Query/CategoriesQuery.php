<?php

namespace App\GraphQL\Query;

use Core\Category\Application\DTO\InputCategoriesDTO;
use Core\Category\Application\UseCase\FindCategoriesUseCase;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CategoriesQuery extends Query
{
    protected $attributes = [
        'name' => 'categories',
    ];

    public function __construct(
        protected FindCategoriesUseCase $useCase,
    ) {
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Category'));
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
            new InputCategoriesDTO(filter: $args['name'] ?? ''),
        );

        return $response->items;
    }
}
