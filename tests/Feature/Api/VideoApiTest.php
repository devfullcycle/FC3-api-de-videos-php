<?php

beforeEach(fn () => $this->withoutMiddleware());

test('video api e2e: list all videos', function () {
    $response = $this->getJson('/videos');

    $response->assertOk()
        ->assertJsonCount(10, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'yearLaunched',
                    'duration',
                    'opened',
                    'rating',
                    'published',
                    'created_at',
                ]
            ]
        ]);
});

test('video api e2e: list single video', function () {
    $response = $this->getJson('/videos/7810aa50-5cc5-4d60-b812-e8dc3e66979d');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'description',
                'yearLaunched',
                'duration',
                'opened',
                'rating',
                'published',
                'created_at',
            ]
        ]);

    expect($response['data']['id'])->toBe('7810aa50-5cc5-4d60-b812-e8dc3e66979d');
    expect($response['data']['title'])->toBe('Dawn Veum');
    expect($response['data']['description'])->toBe('Enim culpa quisquam veniam accusamus numquam harum delectus impedit.');
});

test('video api e2e: not found', function () {
    $response = $this->getJson('/videos/fake_id');
    $response->assertNotFound();
});
