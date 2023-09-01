<?php

it('test e2e graphql: list all cast_members', function (string $valuesRequest, array $valuesExpected) {
    $response = $this->post('/graphql', [
        'query' => "{
            cast_members {
                $valuesRequest
            }
        }"
    ]);

    $response->assertStatus(200);
    $response->assertJsonCount(10, 'data.cast_members');
    array_map(
        fn ($castMember) => expect(array_keys($castMember))->toBe($valuesExpected),
        $response['data']['cast_members']
    );
})->with([
    'case 01' => ['id name', ['id', 'name']],
    'case 02' => ['id name type', ['id', 'name', 'type']],
    'case 03' => ['id', ['id']],
    'case 04' => ['id type', ['id', 'type']],
    'case 05' => ['id name type created_at', ['id', 'name', 'type', 'created_at']],
]);

it('test e2e graphql: get single cast_member', function () {
    $response = $this->post('/graphql', [
        'query' => '{
            cast_member (id: "fb693621-0b71-4599-8e0b-8aaa3c729f88") {
                id
                name
            }
        }'
    ]);

    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            'cast_member' => ['id', 'name']
        ]
    ]);
    expect($response['data']['cast_member']['id'])->toBe('fb693621-0b71-4599-8e0b-8aaa3c729f88');
    expect($response['data']['cast_member']['name'])->toBe('Quincy Boehm II');
});
