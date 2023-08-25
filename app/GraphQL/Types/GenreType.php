<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class GenreType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Genre',
        'description' => 'Array of genres',
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
            'is_active' => [
                'type' => Type::boolean(),
                'description' => 'Genre is active?',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Date created',
            ],
        ];
    }
}
