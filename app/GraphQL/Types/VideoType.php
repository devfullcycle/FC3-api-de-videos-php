<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class VideoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Video',
        'description' => 'Array of videos',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Id of video',
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of video',
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Description of video',
            ],
            'yearLaunched' => [
                'type' => Type::string(),
                'description' => 'Year Launched of video',
            ],
            'duration' => [
                'type' => Type::int(),
                'description' => 'Duration of video',
            ],
            'opened' => [
                'type' => Type::int(),
                'description' => 'Opened of video',
            ],
            'rating' => [
                'type' => Type::string(),
                'description' => 'Rating of video',
            ],
            'published' => [
                'type' => Type::boolean(),
                'description' => 'Published of video',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Date created',
            ],
            'thumbFile' => [
                'type' => Type::string(),
                'description' => 'vo thumb file',
            ],
            'thumbHalf' => [
                'type' => Type::string(),
                'description' => 'vo thumb half',
            ],
            'bannerFile' => [
                'type' => Type::string(),
                'description' => 'vo banner file',
            ],
            'trailerFile' => [
                'type' => Type::string(),
                'description' => 'vo trailer file',
            ],
            'videoFile' => [
                'type' => Type::string(),
                'description' => 'vo video file',
            ],
        ];
    }
}
