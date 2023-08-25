<?php

test('genre api e2e: list all genres', function () {
    $response = $this->getJson('/genres');

    $response->assertOk()
        ->assertJsonCount(10, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'is_active',
                    'created_at',
                ]
            ]
        ]);
});

test('genre api e2e: list single genre', function () {
    $response = $this->getJson('/genres/38c80c43-e883-4d16-8e02-838d6b7122b7');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'is_active',
                'created_at',
            ]
        ]);

    expect($response['data']['id'])->toBe('38c80c43-e883-4d16-8e02-838d6b7122b7');
    expect($response['data']['name'])->toBe('Margarita Haag');
    expect($response['data']['is_active'])->toBeTrue();
});

test('genre api e2e: not found', function () {
    $response = $this->getJson('/genres/fake_id');
    // $response->assertStatus(404);
    $response->assertNotFound();
});
