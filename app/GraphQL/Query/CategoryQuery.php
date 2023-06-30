<?php

namespace App\GraphQL\Query;

use Core\Category\Application\DTO\InputCategoryDTO;
use Core\Category\Application\UseCase\GetCategoryUseCase;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CategoryQuery extends Query
{
    protected $attributes = [
        'name' => 'category',
    ];

    public function __construct(
        protected GetCategoryUseCase $useCase,
    ) {
    }

    public function type(): Type
    {
        return GraphQL::type('Category');
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
        $category = $this->useCase->execute(
            new InputCategoryDTO(id: $args['id'])
        );

        return $category;
    }
}
