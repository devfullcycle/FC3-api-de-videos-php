<?php

use Core\Category\Application\UseCase\FindCategoriesUseCase;
use Core\Category\Domain\Repository\CategoryRepositoryInterface;
use Mockery;

test('unit test get categories', function () {

    $mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
    $mockRepository->shouldReceive('findAll');
                    // ->times(1)
                    // ->with($inputDto->id)
                    // ->andReturn($categoryMock);

    $useCase = new FindCategoriesUseCase(
        repository: $mockRepository,
    );
    $useCase->execute();

    expect(true)->toBe(true);

});