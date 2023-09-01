<?php

namespace App\GraphQL\Query\CastMembers;

use Core\CastMember\Application\DTO\InputCastMemberDTO;
use Core\CastMember\Application\UseCase\GetCastMemberUseCase;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CastMemberQuery extends Query
{
    protected $attributes = [
        'name' => 'cast_member',
    ];

    public function __construct(
        protected GetCastMemberUseCase $useCase,
    ) {
    }

    public function type(): Type
    {
        return GraphQL::type('CastMember');
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
        $castMember = $this->useCase->execute(
            new InputCastMemberDTO(id: $args['id'])
        );

        return $castMember;
    }
}
