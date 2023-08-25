<?php

use Core\Genre\Application\DTO\InputGenresDTO;
use Core\Genre\Application\UseCase\FindGenresUseCase;
use Core\Genre\Infra\GenreRepository;
use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Tests\Feature\Stubs\ElasticSearchStub;

test('FindGenresUseCase', function (array $response, int $totalResponse = 0) {
    $stubElastic = new ElasticSearchStub(['hits' => [
        'hits' => $response
    ]]);
    $repository = new GenreRepository($stubElastic);
    $useCase = new FindGenresUseCase($repository);
    $response = $useCase->execute(
        new InputGenresDTO(filter: '')
    );
    expect(count($response->items))->toBe($totalResponse);
    expect($response->total)->toBe($totalResponse);
})->with('elastic_data');
