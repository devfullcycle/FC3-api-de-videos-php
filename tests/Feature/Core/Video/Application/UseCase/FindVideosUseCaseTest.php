<?php

use Core\Video\Application\DTO\InputVideosDTO;
use Core\Video\Application\UseCase\FindVideosUseCase;
use Core\Video\Infra\VideoRepository;
use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Tests\Feature\Stubs\ElasticSearchStub;

test('FindVideosUseCase', function (array $response, int $totalResponse = 0) {
    $stubElastic = new ElasticSearchStub(['hits' => [
        'hits' => $response
    ]]);
    $repository = new VideoRepository($stubElastic);
    $useCase = new FindVideosUseCase($repository);
    $response = $useCase->execute(
        new InputVideosDTO(filter: '')
    );
    expect(count($response->items))->toBe($totalResponse);
    expect($response->total)->toBe($totalResponse);
})->with('elastic_data');
