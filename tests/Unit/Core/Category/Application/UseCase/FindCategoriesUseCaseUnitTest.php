<?php

use Core\Category\Application\DTO\{
    InputCategoriesDTO,
    OutputCategoriesDTO,
    OutputCategoryDTO,
};
use Core\Category\Application\UseCase\FindCategoriesUseCase;
use Core\Category\Domain\Repository\CategoryRepositoryInterface;
use Core\Category\Domain\Entities\Category;

test('unit test get categories', function () {
    $inputDto = new InputCategoriesDTO(
        filter: 'abc'
    );

    $responseRepository = [
        new Category(
            name: 'test'
        ),
    ];

    $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
    $this->mockRepository->shouldReceive('findAll')
        ->times(1)
        ->with($inputDto->filter)
        ->andReturn($responseRepository);

    $useCase = new FindCategoriesUseCase(
        repository: $this->mockRepository,
    );
    $response = $useCase->execute(
        input: $inputDto,
    );

    expect($response)->toBeInstanceOf(OutputCategoriesDTO::class);
    expect($response->items)->toBeArray();
    array_map(fn ($item) => expect($item)->toBeInstanceOf(OutputCategoryDTO::class), $response->items);
    expect($response->total)->toBeInt();
    expect($response->total)->toBe(1);
});
