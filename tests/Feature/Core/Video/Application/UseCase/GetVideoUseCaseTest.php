<?php

use Core\Video\Application\DTO\InputVideoDTO;
use Core\Video\Application\UseCase\GetVideoUseCase;
use Core\Video\Infra\VideoRepository;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;
use Tests\Feature\Stubs\ElasticSearchStub;

test('should throws exception when not found video', function () {
    $stub = new ElasticSearchStub(['hits' => ['hits' => []]]);
    $repository = new VideoRepository($stub);
    $useCase = new GetVideoUseCase($repository);
    $useCase->execute(new InputVideoDTO(id: 'fake_id'));
})->throws(EntityNotFoundException::class);

test('GetVideoUseCase', function () {
    $id = '25aeaffa-942c-4bf1-9b74-a9ef2a9a7c7e';
    $stub = new ElasticSearchStub([
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
    $repository = new VideoRepository($stub);
    $useCase = new GetVideoUseCase($repository);
    $response = $useCase->execute(new InputVideoDTO(id: $id));
    expect($response->id)->toBe($id);
    expect($response->title)->toBe('Video Title');
    expect($response->description)->toBe('Desc');
    expect($response->yearLaunched)->toBe(2024);
    expect($response->duration)->toBe(1);
    expect($response->rating)->toBe('L');
});
