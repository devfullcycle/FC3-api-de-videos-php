<?php

beforeEach(fn () => $this->withoutMiddleware());

test('test e2e graphql: list all categories', function (string $valuesRequest, array $valuesExpected) {
    $response = $this->post('/graphql', [
        'query' => "{
            categories {
                $valuesRequest
            }
        }"
    ]);

    $response->assertStatus(200);
    $response->assertJsonCount(10, 'data.categories');
    array_map(
        fn ($category) => expect(array_keys($category))->toBe($valuesExpected),
        $response['data']['categories']
    );
})->with([
    'case 01' => ['id name', ['id', 'name']],
    'case 02' => ['id name is_active', ['id', 'name', 'is_active']],
    'case 03' => ['id', ['id']],
    'case 04' => ['id description', ['id', 'description']],
    'case 05' => ['id name description', ['id', 'name', 'description']],
    'case 06' => ['id name description is_active created_at', ['id', 'name', 'description', 'is_active', 'created_at']],
]);

test('test e2e graphql: get single category', function () {
    $response = $this->post('/graphql', [
        'query' => '{
            category (id: "042ca031-a885-4aa7-b829-62ba112dd55b") {
                id
                name
                description
            }
        }'
    ]);

    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            'category' => ['id', 'name', 'description']
        ]
    ]);
    expect($response['data']['category']['id'])->toBe('042ca031-a885-4aa7-b829-62ba112dd55b');
    expect($response['data']['category']['name'])->toBe('Abe Turner');
    expect($response['data']['category']['description'])->toBe('Dolorem quo sequi et atque optio optio et sunt aperiam in ullam voluptatum ipsa.');
});
