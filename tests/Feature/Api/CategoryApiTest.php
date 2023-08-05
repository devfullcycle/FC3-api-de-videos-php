<?php

test('category api e2e: list all categories', function () {
    $response = $this->getJson('/categories');

    $response->assertOk()
        ->assertJsonCount(10, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'is_active',
                    'created_at',
                ]
            ]
        ]);
});

test('category api e2e: list single category', function () {
    $response = $this->getJson('/categories/07167628-33b7-4584-8444-d1dc7ed436a9');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'is_active',
                'created_at',
            ]
        ]);

    expect($response['data']['id'])->toBe('07167628-33b7-4584-8444-d1dc7ed436a9');
    expect($response['data']['name'])->toBe('Daniella Kunde');
    expect($response['data']['description'])->toBe('Consectetur sit iusto qui distinctio molestiae vitae nemo qui.');
    expect($response['data']['is_active'])->toBeTrue();
    expect($response['data']['created_at'])->toBe('2023-06-22 14:26:57');
});
