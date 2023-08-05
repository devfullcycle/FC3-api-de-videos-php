<?php

test('example', function () {
    $this->getJson('/')->assertOk();
    // $response->assertStatus(200);
    // $response->assertOk();
});
