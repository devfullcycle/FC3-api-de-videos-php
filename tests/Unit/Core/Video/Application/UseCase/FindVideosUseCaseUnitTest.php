<?php

use Core\Video\Application\DTO\{
    InputVideosDTO,
    OutputVideosDTO,
    OutputVideoDTO,
};
use Core\Video\Application\UseCase\FindVideosUseCase;
use Core\Video\Domain\Repository\VideoRepositoryInterface;
use Core\Video\Domain\Entities\Video;
use Core\Video\Domain\Enums\Rating;

test('unit test get categories', function () {
    $inputDto = new InputVideosDTO(
        filter: 'abc'
    );

    $responseRepository = [
        new Video(
            title: 'title',
            description: 'desc video',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::RATE10,
        ),
    ];

    $this->mockRepository = Mockery::mock(VideoRepositoryInterface::class);
    $this->mockRepository->shouldReceive('findAll')
        ->times(1)
        ->with($inputDto->filter)
        ->andReturn($responseRepository);

    $useCase = new FindVideosUseCase(
        repository: $this->mockRepository,
    );
    $response = $useCase->execute(
        input: $inputDto,
    );

    expect($response)->toBeInstanceOf(OutputVideosDTO::class);
    expect($response->items)->toBeArray();
    array_map(fn ($item) => expect($item)->toBeInstanceOf(OutputVideoDTO::class), $response->items);
    expect($response->total)->toBeInt();
    expect($response->total)->toBe(1);
});
