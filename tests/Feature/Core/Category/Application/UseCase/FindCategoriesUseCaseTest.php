<?php

use Core\Category\Application\DTO\InputCategoriesDTO;
use Core\Category\Application\UseCase\FindCategoriesUseCase;
use Core\Category\Infra\CategoryRepository;
use Core\Category\Infra\Contracts\ElasticClientInterface;

test('FindCategoriesUseCase', function (array $response, int $totalResponse = 0) {
    $stubElastic = new class($response) implements ElasticClientInterface
    {
        public function __construct(protected array $responseData)
        {
        }

        public function search(array $params = [])
        {
            return [
                'hits' => [
                    'hits' => $this->responseData
                ]
            ];
        }
    };

    $repository = new CategoryRepository($stubElastic);
    $useCase = new FindCategoriesUseCase($repository);
    $response = $useCase->execute(
        new InputCategoriesDTO(filter: '')
    );
    expect(count($response->items))->toBe($totalResponse);
    expect($response->total)->toBe($totalResponse);
})->with('elastic_data');
