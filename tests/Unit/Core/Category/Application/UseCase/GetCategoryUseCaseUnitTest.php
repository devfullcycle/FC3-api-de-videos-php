<?php

use Core\Category\Application\DTO\{
    InputCategoryDTO,
    OutputCategoryDTO,
};
use Core\Category\Domain\Entities\Category;
use Core\Category\Application\UseCase\GetCategoryUseCase;
use Core\Category\Domain\Repository\CategoryRepositoryInterface;
use Core\SeedWork\Domain\ValueObjects\Uuid;

afterAll(fn () => Mockery::close());

test('unit test get category', function () {
    // $category = new Category(
    //     name: 'test'
    // );
    $uuid = Uuid::random();
    $id = new Uuid($uuid);
    $categoryMock = Mockery::mock(Category::class, [
        'name', $id, 'desc', true
    ]);
    $categoryMock->shouldReceive('id')->andReturn((string)$uuid);
    $categoryMock->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

    $inputDto = new InputCategoryDTO(
        id: '1231'
    );

    $mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
    $mockRepository->shouldReceive('findOne')
        ->times(1)
        ->with($inputDto->id)
        ->andReturn($categoryMock);

    $useCase = new GetCategoryUseCase($mockRepository);
    $response = $useCase->execute(input: $inputDto);

    expect($response)->toBeInstanceOf(OutputCategoryDTO::class);
});
