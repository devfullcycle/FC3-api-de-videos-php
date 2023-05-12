<?php

use Core\Category\Application\DTO\{
    InputCategoryDTO,
    OutputCategoryDTO,
};
use Core\Category\Domain\Entities\Category;
use Core\Category\Application\UseCase\GetCategoryUseCase;
use Core\Category\Domain\Repository\CategoryRepositoryInterface;
use Mockery;
use stdClass;
use Core\SeedWork\Domain\ValueObjects\Uuid;

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
    
    $mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
    $mockRepository->shouldReceive('findOne')->andReturn($categoryMock);

    $inputDto = new InputCategoryDTO(
        id: '1231'
    );

    $useCase = new GetCategoryUseCase($mockRepository);
    $response = $useCase->execute(input: $inputDto);

    expect($response)->toBeInstanceOf(OutputCategoryDTO::class);
});