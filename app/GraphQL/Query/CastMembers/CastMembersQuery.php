<?php

namespace App\GraphQL\Query\CastMembers;

use Core\CastMember\Application\DTO\InputCastMembersDTO;
use Core\CastMember\Application\UseCase\FindCastMembersUseCase;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CastMembersQuery extends Query
{
    protected $attributes = [
        'name' => 'cast_members',
    ];

    public function __construct(
        protected FindCastMembersUseCase $useCase,
    ) {
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('CastMember'));
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
            new InputCastMembersDTO(filter: $args['name'] ?? ''),
        );

        return $response->items;
    }
}
