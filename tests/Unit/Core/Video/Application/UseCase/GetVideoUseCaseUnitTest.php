<?php

use Core\Video\Application\DTO\{
    InputVideoDTO,
    OutputVideoDTO,
};
use Core\Video\Domain\Entities\Video;
use Core\Video\Application\UseCase\GetVideoUseCase;
use Core\Video\Domain\Repository\VideoRepositoryInterface;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use Core\Video\Domain\Enums\Rating;

afterAll(fn () => Mockery::close());

test('unit test get category', function () {
    // $category = new Video(
    //     name: 'test'
    // );
    $uuid = Uuid::random();
    $categoryMock = Mockery::mock(Video::class, [
        'title video',
        'desc video',
        2030,
        1,
        false,
        Rating::RATE16,
    ]);
    $categoryMock->shouldReceive('id')->andReturn((string)$uuid);
    $categoryMock->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

    $inputDto = new InputVideoDTO(
        id: '1231'
    );

    $mockRepository = Mockery::mock(VideoRepositoryInterface::class);
    $mockRepository->shouldReceive('findOne')
        ->times(1)
        ->with($inputDto->id)
        ->andReturn($categoryMock);

    $useCase = new GetVideoUseCase($mockRepository);
    $response = $useCase->execute(input: $inputDto);

    expect($response)->toBeInstanceOf(OutputVideoDTO::class);
});
