<?php

test('test e2e graphql: list all categories', function () {
    $response = $this->post('/graphql', [
        'query' => '{
            categories {
                id
                name
                description
            }
        }'
    ]);

    $response->assertStatus(200);
    $response->assertJsonCount(10, 'data.categories');
    $response->assertJsonStructure([
        'data' => [
            'categories' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                ]
            ]
        ]
    ]);
});
