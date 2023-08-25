<?php

use Core\Category\Domain\Entities\Category;
use Core\Category\Infra\CategoryRepository;
use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;

test('findAll', function () {
    $mockElastic = Mockery::mock(ElasticClientInterface::class);
    $mockElastic->shouldReceive('search')
        ->times(1)
        ->with([
            'index' => 'mysql-server.fullcycle.categories',
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

    $categoryRepository = new CategoryRepository($mockElastic);
    $response = $categoryRepository->findAll('test_name');
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

    $categoryRepository = new CategoryRepository($mockElastic);
    $categoryRepository->findOne('fake_value');
})->throws(EntityNotFoundException::class);

test('findOne', function () {
    $id = '88bdf4aa-7ec7-408f-91f6-c82f192d540c';

    $mockElastic = Mockery::mock(ElasticClientInterface::class);
    $mockElastic->shouldReceive('search')
        ->times(1)
        ->with([
            'index' => 'mysql-server.fullcycle.categories',
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
                                'description' => 'Desc',
                                'is_active' => 1,
                                'created_at' => '2023-12-12 12:12:00',
                            ]
                        ]
                    ]
                ]
            ]
        ]);

    $categoryRepository = new CategoryRepository($mockElastic);
    $category = $categoryRepository->findOne($id);
    expect($category)->toBeInstanceOf(Category::class);
    expect($category->name)->toBe('Cat Name');
    expect($category->description)->toBe('Desc');
    expect($category->isActive)->toBeTrue();
});
