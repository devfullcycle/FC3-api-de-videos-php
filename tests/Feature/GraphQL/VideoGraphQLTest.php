<?php

beforeEach(fn () => $this->withoutMiddleware());

it('test e2e graphql: list all videos', function (string $valuesRequest, array $valuesExpected) {
    $response = $this->post('/graphql', [
        'query' => "{
            videos {
                $valuesRequest
            }
        }"
    ]);

    $response->assertStatus(200);
    $response->assertJsonCount(10, 'data.videos');
    array_map(
        fn ($video) => expect(array_keys($video))->toBe($valuesExpected),
        $response['data']['videos']
    );
})->with([
    'case 01' => ['id title', ['id', 'title']],
    'case 02' => ['id title description', ['id', 'title', 'description']],
    'case 03' => ['id', ['id']],
    'case 04' => ['id description', ['id', 'description']],
    'case 05' => ['id title published created_at', ['id', 'title', 'published', 'created_at']],
]);

it('test e2e graphql: get single video', function () {
    $response = $this->post('/graphql', [
        'query' => '{
            video (id: "da6c6583-c9ad-4622-ae67-1d1e0583dfae") {
                id
                title
            }
        }'
    ]);

    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            'video' => ['id', 'title']
        ]
    ]);
    expect($response['data']['video']['id'])->toBe('da6c6583-c9ad-4622-ae67-1d1e0583dfae');
    expect($response['data']['video']['title'])->toBe('Mr. Bobbie Kshlerin');
});
