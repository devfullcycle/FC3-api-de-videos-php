<?php

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
