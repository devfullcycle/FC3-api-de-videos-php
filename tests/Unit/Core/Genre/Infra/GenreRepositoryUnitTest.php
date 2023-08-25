<?php

use Core\Genre\Domain\Entities\Genre;
use Core\Genre\Infra\GenreRepository;
use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;

test('findAll', function () {
    $this->mockElastic = Mockery::mock(ElasticClientInterface::class);
    $this->mockElastic->shouldReceive('search')
        ->times(1)
        ->with([
            'index' => 'mysql-server.fullcycle.genres',
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

    $categoryRepository = new GenreRepository($this->mockElastic);
    $response = $categoryRepository->findAll('test_name');
    expect($response)->toBeArray();
});

test('findOne: should exception when total register returned is equals zero', function () {
    $this->mockElastic = Mockery::mock(ElasticClientInterface::class);
    $this->mockElastic->shouldReceive('search')
        ->times(1)
        ->andReturn([
            'hits' => [
                'hits' => []
            ]
        ]);

    $categoryRepository = new GenreRepository($this->mockElastic);
    $categoryRepository->findOne('fake_value');
})->throws(EntityNotFoundException::class);

test('findOne', function () {
    $id = '88bdf4aa-7ec7-408f-91f6-c82f192d540c';

    $this->mockElastic = Mockery::mock(ElasticClientInterface::class);
    $this->mockElastic->shouldReceive('search')
        ->times(1)
        ->with([
            'index' => 'mysql-server.fullcycle.genres',
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
                                'name' => 'Cat Name',
                                'is_active' => 1,
                                'created_at' => '2023-12-12 12:12:00',
                            ]
                        ]
                    ]
                ]
            ]
        ]);

    $categoryRepository = new GenreRepository($this->mockElastic);
    $category = $categoryRepository->findOne($id);
    expect($category)->toBeInstanceOf(Genre::class);
    expect($category->name)->toBe('Cat Name');
    expect($category->isActive)->toBeTrue();
});
