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
})->with([
    'empty' => [[], 0],
    'one records' => [
        [
            [
                '_source' => [
                    'after' => [
                        'id' => '88bdf4aa-7ec7-408f-91f6-c82f192d540c',
                        'name' => 'name',
                        'description' => 'description',
                        'is_active' => 1,
                        'created_at' => '2023-12-12 12:12:00',
                    ]
                ]
            ]
        ],
        1
    ],
    'two records' => [
        [
            [
                '_source' => [
                    'after' => [
                        'id' => '88bdf4aa-7ec7-408f-91f6-c82f192d540c',
                        'name' => 'name',
                        'description' => 'description',
                        'is_active' => 1,
                        'created_at' => '2023-12-12 12:12:00',
                    ]
                ]
            ],
            [
                '_source' => [
                    'after' => [
                        'id' => '88bdf4aa-7ec7-408f-91f6-c82f192d540c',
                        'name' => 'name2',
                        'description' => 'description2',
                        'is_active' => 0,
                        'created_at' => '2023-12-12 12:12:00',
                    ]
                ]
            ],
        ],
        2
    ],
]);
