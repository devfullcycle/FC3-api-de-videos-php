<?php

use Core\SeedWork\Domain\ValueObjects\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

test('should throw exception if receive invalid uuid', function () {
    new Uuid('invalid_uuid');
})->throws(\InvalidArgumentException::class);

test('should valid uuid', function () {
    $uuid = Uuid::random();
    expect(RamseyUuid::isValid($uuid))->toBeTrue();
});

test('should instance of uuid', function () {
    expect(Uuid::random())->toBeInstanceOf(Uuid::class);
});

test('should be string', function () {
    $uuid = (string) Uuid::random();
    expect($uuid)->toBeString();
});