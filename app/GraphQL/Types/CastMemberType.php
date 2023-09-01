<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CastMemberType extends GraphQLType
{
    protected $attributes = [
        'name' => 'CastMember',
        'description' => 'Array of cast_members',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Id of cast_member',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of cast_member',
            ],
            'type' => [
                'type' => Type::boolean(),
                'description' => 'CastMember is actor(2) or director(1)',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Date created',
            ],
        ];
    }
}
