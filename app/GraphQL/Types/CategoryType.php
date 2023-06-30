<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'Array of categories',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Id of category',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of category',
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Description of category',
            ],
            'is_active' => [
                'type' => Type::boolean(),
                'description' => 'Category is active?',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Date created',
            ],
        ];
    }
}
