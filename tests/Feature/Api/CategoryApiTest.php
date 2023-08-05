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
