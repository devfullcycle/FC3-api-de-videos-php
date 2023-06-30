<?php

use Core\Category\Application\DTO\InputCategoryDTO;
use Core\Category\Application\UseCase\GetCategoryUseCase;
use Core\Category\Infra\CategoryRepository;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;
use Tests\Feature\Stubs\ElasticSearchStub;

test('should throws exception when not found category', function () {
    $stub = new ElasticSearchStub(['hits' => ['hits' => []]]);
    $repository = new CategoryRepository($stub);
    $useCase = new GetCategoryUseCase($repository);
    $useCase->execute(new InputCategoryDTO(id: 'fake_id'));
})->throws(EntityNotFoundException::class);

test('GetCategoryUseCase', function () {
    $id = '88bdf4aa-7ec7-408f-91f6-c82f192d540c';
    $stub = new ElasticSearchStub([
        'hits' => [
            'hits' => [
                [
                    '_source' => [
                        'after' => [
                            'id' => $id,
                            'name' => 'name',
                            'description' => 'description',
                            'is_active' => 1,
                            'created_at' => '2023-12-12 12:12:00',
                        ]
                    ]
                ]
            ]
        ]
    ]);
    $repository = new CategoryRepository($stub);
    $useCase = new GetCategoryUseCase($repository);
    $response = $useCase->execute(new InputCategoryDTO(id: $id));
    expect($response->id)->toBe($id);
    expect($response->name)->toBe('name');
    expect($response->description)->toBe('description');
    expect($response->is_active)->toBeTrue();
});
