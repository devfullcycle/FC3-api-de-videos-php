<?php

namespace App\GraphQL\Query\Videos;

use Core\Video\Application\DTO\InputVideoDTO;
use Core\Video\Application\UseCase\GetVideoUseCase;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class VideoQuery extends Query
{
    protected $attributes = [
        'name' => 'video',
    ];

    public function __construct(
        protected GetVideoUseCase $useCase,
    ) {
    }

    public function type(): Type
    {
        return GraphQL::type('Video');
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
        $video = $this->useCase->execute(
            new InputVideoDTO(id: $args['id'])
        );

        return $video;
    }
}
