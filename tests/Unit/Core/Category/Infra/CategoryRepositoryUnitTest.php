<?php

use Core\Category\Infra\CategoryRepository;
use Core\Category\Infra\Contracts\ElasticClientInterface;

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
