<?php

use Core\Genre\Application\DTO\InputGenreDTO;
use Core\Genre\Application\UseCase\GetGenreUseCase;
use Core\Genre\Infra\GenreRepository;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;
use Tests\Feature\Stubs\ElasticSearchStub;

test('should throws exception when not found genre', function () {
    $stub = new ElasticSearchStub(['hits' => ['hits' => []]]);
    $repository = new GenreRepository($stub);
    $useCase = new GetGenreUseCase($repository);
    $useCase->execute(new InputGenreDTO(id: 'fake_id'));
})->throws(EntityNotFoundException::class);

test('GetGenreUseCase', function () {
    $id = '88bdf4aa-7ec7-408f-91f6-c82f192d540c';
    $stub = new ElasticSearchStub([
        'hits' => [
            'hits' => [
                [
                    '_source' => [
                        'after' => [
                            'id' => $id,
                            'name' => 'name',
                            'is_active' => 1,
                            'created_at' => '2023-12-12 12:12:00',
                        ]
                    ]
                ]
            ]
        ]
    ]);
    $repository = new GenreRepository($stub);
    $useCase = new GetGenreUseCase($repository);
    $response = $useCase->execute(new InputGenreDTO(id: $id));
    expect($response->id)->toBe($id);
    expect($response->name)->toBe('name');
    expect($response->is_active)->toBeTrue();
});
