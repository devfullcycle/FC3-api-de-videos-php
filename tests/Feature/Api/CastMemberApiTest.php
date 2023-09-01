<?php

test('cast_member api e2e: list all cast_members', function () {
    $response = $this->getJson('/cast_members');

    $response->assertOk()
        ->assertJsonCount(10, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'type',
                    'created_at',
                ]
            ]
        ]);
});

test('cast_member api e2e: list single cast_member', function () {
    $response = $this->getJson('/cast_members/1a1a49e9-3312-47e6-96a7-a519a6dac84f');
    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'type',
                'created_at',
            ]
        ]);

    expect($response['data']['id'])->toBe('1a1a49e9-3312-47e6-96a7-a519a6dac84f');
    expect($response['data']['name'])->toBe('Mrs. Veda Kertzmann');
    expect($response['data']['type'])->toBe(2);
});

test('cast_member api e2e: not found', function () {
    $response = $this->getJson('/cast_members/fake_id');
    // $response->assertStatus(404);
    $response->assertNotFound();
});
