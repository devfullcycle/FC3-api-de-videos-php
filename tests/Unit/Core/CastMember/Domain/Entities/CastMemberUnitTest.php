<?php

use Core\CastMember\Domain\Enums\CastMemberType;
use Core\CastMember\Domain\Entities\CastMember;
use Core\SeedWork\Domain\Exceptions\EntityValidationException;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use Faker\Factory;

beforeEach(fn () => $this->castMember = new CastMember(
    name: 'test',
    type: CastMemberType::ACTOR,
));

test('constructor of castMember and getters and setters', function () {
    expect($this->castMember)->toHaveProperties([
        'id',
        'name',
        'type',
        'createdAt',
    ]);
    expect($this->castMember->name)->not->toBeNull();
    expect($this->castMember->name)->toBeString();
    expect($this->castMember->name)->toBe('test');
    expect($this->castMember->type)->toBeInstanceOf(CastMemberType::class);
    expect($this->castMember->createdAt)->not->toBeNull();
    expect($this->castMember->createdAt)->toBeInstanceOf(DateTime::class);

    $date = new DateTime();
    $castMember = new CastMember(
        name: 'test',
        type: CastMemberType::DIRECTOR,
        createdAt: $date,
    );
    expect($this->castMember->type)->toBeInstanceOf(CastMemberType::class);
    expect($castMember->createdAt)->not->toBeNull();
    expect($castMember->createdAt)->toBe($date);
    expect($castMember->createdAt())->toBeString();
    expect($castMember->createdAt())->not->toBeNull();
});

test('id field', function () {
    expect($this->castMember->id)->not->toBeString();
    expect($this->castMember->id)->not->toBeNull();
    expect($this->castMember->id)->toBeInstanceOf(Uuid::class);
    expect($this->castMember->id())->toBeString();

    $id = Uuid::random();
    $castMember = new CastMember(
        id: $id,
        name: 'name',
        type: CastMemberType::ACTOR,
    );
    expect($castMember->id)->not->toBeString();
    expect($castMember->id)->not->toBeNull();
    expect($castMember->id)->toBeInstanceOf(Uuid::class);
    expect($castMember->id())->toBeString();
    expect($castMember->id)->toBe($id);
});

test('should throw exception with name is invalid - min characters', function () {
    new CastMember(name: 'sd', type: CastMemberType::ACTOR);
})->throws(EntityValidationException::class);

test('should throw exception with name is invalid - max characters', function () {
    $name = Factory::create()->sentence(400);
    new CastMember(name: $name, type: CastMemberType::ACTOR);
})->throws(EntityValidationException::class);

test('should update a castMember', function () {
    $castMember = new CastMember(
        name: 'test',
        type: CastMemberType::ACTOR,
    );
    $castMember->update('updated name');
    expect($castMember->name)->toBe('updated name');

    $castMember->update(
        name: 'updated name (2)',
    );
    expect($castMember->name)->toBe('updated name (2)');
});

test('should throw exception if update with invalid value', function () {
    $castMember = new CastMember(
        name: 'test',
        type: CastMemberType::ACTOR,
    );
    $castMember->update('up');
})->throws(EntityValidationException::class);
