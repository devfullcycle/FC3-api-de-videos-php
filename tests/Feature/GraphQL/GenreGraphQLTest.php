<?php

beforeEach(fn () => $this->withoutMiddleware());

it('test e2e graphql: list all genres', function (string $valuesRequest, array $valuesExpected) {
    $response = $this->post('/graphql', [
        'query' => "{
            genres {
                $valuesRequest
            }
        }"
    ]);

    $response->assertStatus(200);
    $response->assertJsonCount(10, 'data.genres');
    array_map(
        fn ($genre) => expect(array_keys($genre))->toBe($valuesExpected),
        $response['data']['genres']
    );
})->with([
    'case 01' => ['id name', ['id', 'name']],
    'case 02' => ['id name is_active', ['id', 'name', 'is_active']],
    'case 03' => ['id', ['id']],
    'case 04' => ['id is_active', ['id', 'is_active']],
    'case 05' => ['id name is_active created_at', ['id', 'name', 'is_active', 'created_at']],
]);

it('test e2e graphql: get single genre', function () {
    $response = $this->post('/graphql', [
        'query' => '{
            genre (id: "ad79421a-254d-408c-8312-399ed80ea4d9") {
                id
                name
            }
        }'
    ]);

    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            'genre' => ['id', 'name']
        ]
    ]);
    expect($response['data']['genre']['id'])->toBe('ad79421a-254d-408c-8312-399ed80ea4d9');
    expect($response['data']['genre']['name'])->toBe('Hannah Jenkins');
});
