<?php

use Core\Category\Application\DTO\{
    InputCategoriesDTO,
    OutputCategoriesDTO,
    OutputCategoryDTO,
};
use Core\Category\Application\UseCase\FindCategoriesUseCase;
use Core\Category\Domain\Repository\CategoryRepositoryInterface;
use Mockery;
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

    $mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
    $mockRepository->shouldReceive('findAll')
                    ->times(1)
                    ->with($inputDto->filter)
                    ->andReturn($responseRepository);

    $useCase = new FindCategoriesUseCase(
        repository: $mockRepository,
    );
    $response = $useCase->execute(
        input: $inputDto,
    );

    expect($response)->toBeInstanceOf(OutputCategoriesDTO::class);
    expect($response->items)->toBeArray();
    foreach ($response->items as $item) {
        expect($item)->toBeInstanceOf(OutputCategoryDTO::class);
    }
    expect($response->total)->toBeInt();
    expect($response->total)->toBe(1);
});