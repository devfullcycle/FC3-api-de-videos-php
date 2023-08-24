<?php

use Core\Genre\Application\DTO\{
    InputGenresDTO,
    OutputGenresDTO,
    OutputGenreDTO,
};
use Core\Genre\Application\UseCase\FindGenresUseCase;
use Core\Genre\Domain\Repository\GenreRepositoryInterface;
use Core\Genre\Domain\Entities\Genre;

test('unit test get genres', function () {
    $inputDto = new InputGenresDTO(
        filter: 'abc'
    );

    $responseRepository = [
        new Genre(
            name: 'test'
        ),
    ];

    $this->mockRepository = Mockery::mock(stdClass::class, GenreRepositoryInterface::class);
    $this->mockRepository->shouldReceive('findAll')
        ->times(1)
        ->with($inputDto->filter)
        ->andReturn($responseRepository);

    $useCase = new FindGenresUseCase(
        repository: $this->mockRepository,
    );
    $response = $useCase->execute(
        input: $inputDto,
    );

    expect($response)->toBeInstanceOf(OutputGenresDTO::class);
    expect($response->items)->toBeArray();
    array_map(fn ($item) => expect($item)->toBeInstanceOf(OutputGenreDTO::class), $response->items);
    expect($response->total)->toBeInt();
    expect($response->total)->toBe(1);
});
