<?php

use Core\Category\Application\DTO\{
    InputCategoriesDTO,
    OutputCategoriesDTO,
};
use Core\Category\Application\UseCase\FindCategoriesUseCase;
use Core\Category\Domain\Repository\CategoryRepositoryInterface;
use Mockery;

test('unit test get categories', function () {
    $inputDto = new InputCategoriesDTO(
        filter: ''
    );

    $mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
    $mockRepository->shouldReceive('findAll');
                    // ->times(1)
                    // ->with($inputDto->id)
                    // ->andReturn($categoryMock);

    $useCase = new FindCategoriesUseCase(
        repository: $mockRepository,
    );
    $response = $useCase->execute(
        input: $inputDto,
    );

    expect($response)->toBeInstanceOf(OutputCategoriesDTO::class);

});