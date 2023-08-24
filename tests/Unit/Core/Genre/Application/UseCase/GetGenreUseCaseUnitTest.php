<?php

use Core\Genre\Application\DTO\{
    InputGenreDTO,
    OutputGenreDTO,
};
use Core\Genre\Domain\Entities\Genre;
use Core\Genre\Application\UseCase\GetGenreUseCase;
use Core\Genre\Domain\Repository\GenreRepositoryInterface;
use Core\SeedWork\Domain\ValueObjects\Uuid;

afterAll(fn () => Mockery::close());

test('unit test get genre', function () {
    $uuid = Uuid::random();
    $id = new Uuid($uuid);
    $genreMock = Mockery::mock(Genre::class, [
        'name', $id, true, []
    ]);
    $genreMock->shouldReceive('id')->andReturn((string)$uuid);
    $genreMock->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

    $inputDto = new InputGenreDTO(
        id: '1231'
    );

    $this->mockRepository = Mockery::mock(stdClass::class, GenreRepositoryInterface::class);
    $this->mockRepository->shouldReceive('findOne')
        ->times(1)
        ->with($inputDto->id)
        ->andReturn($genreMock);

    $useCase = new GetGenreUseCase($this->mockRepository);
    $response = $useCase->execute(input: $inputDto);

    expect($response)->toBeInstanceOf(OutputGenreDTO::class);
});
