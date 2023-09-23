<?php

use Core\Video\Domain\Entities\Video;
use Core\Video\Infra\VideoRepository;
use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;
use Core\Video\Domain\Enums\Rating;

test('findAll', function () {
    $mockElastic = Mockery::mock(ElasticClientInterface::class);
    $mockElastic->shouldReceive('search')
        ->times(1)
        ->with([
            'index' => 'mysql-server.fullcycle.videos',
            'body' => [
                'query' => [
                    'match' => [
                        'after.name' => 'test_name'
                    ]
                ]
            ]
        ])
        ->andReturn([
            'hits' => [
                'hits' => []
            ]
        ]);

    $videoRepository = new VideoRepository($mockElastic);
    $response = $videoRepository->findAll('test_name');
    expect($response)->toBeArray();
});

test('findOne: should exception when total register returned is equals zero', function () {
    $mockElastic = Mockery::mock(ElasticClientInterface::class);
    $mockElastic->shouldReceive('search')
        ->times(1)
        ->andReturn([
            'hits' => [
                'hits' => []
            ]
        ]);

    $videoRepository = new VideoRepository($mockElastic);
    $videoRepository->findOne('fake_value');
})->throws(EntityNotFoundException::class);

test('findOne', function () {
    $id = '88bdf4aa-7ec7-408f-91f6-c82f192d540c';

    $mockElastic = Mockery::mock(ElasticClientInterface::class);
    $mockElastic->shouldReceive('search')
        ->times(1)
        ->with([
            'index' => 'mysql-server.fullcycle.videos',
            'body' => [
                'query' => [
                    'match' => [
                        'after.id' => $id
                    ]
                ]
            ]
        ])
        ->andReturn([
            'hits' => [
                'hits' => [
                    [
                        '_source' => [
                            'after' => [
                                'id' => $id,
                                'title' => 'Video Title',
                                'description' => 'Desc',
                                'year_launched' => 2024,
                                'duration' => 1,
                                'rating' => 'L',
                                'opened' => 1,
                                'published' => 1,
                                'created_at' => '2023-06-22T14:27:33Z',
                            ]
                        ]
                    ]
                ]
            ]
        ]);

    $videoRepository = new VideoRepository($mockElastic);
    $video = $videoRepository->findOne($id);
    expect($video)->toBeInstanceOf(Video::class);
    expect($video->title)->toBe('Video Title');
    expect($video->description)->toBe('Desc');
    expect($video->yearLaunched)->toBe(2024);
    expect($video->duration)->toBe(1);
    expect($video->rating)->toBeInstanceOf(Rating::class);
});
