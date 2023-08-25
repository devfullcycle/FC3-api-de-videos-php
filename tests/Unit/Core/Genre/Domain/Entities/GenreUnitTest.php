<?php

use Core\Genre\Domain\Entities\Genre;
use Core\SeedWork\Domain\Exceptions\EntityValidationException;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use Faker\Factory;

beforeEach(fn () => $this->genre = new Genre(
    name: 'test'
));

it('constructor of genre and getters and setters', function () {
    expect($this->genre)->toHaveProperties([
        'id',
        'name',
        'categoriesId',
        'isActive',
        'createdAt',
    ]);
    expect($this->genre->name)->not->toBeNull();
    expect($this->genre->name)->toBeString();
    expect($this->genre->name)->toBe('test');
    expect($this->genre->categoriesId)->toBeArray();
    expect($this->genre->isActive)->toBe(true);
    expect($this->genre->createdAt)->not->toBeNull();
    expect($this->genre->createdAt)->toBeInstanceOf(DateTime::class);

    $uuid = Uuid::random();

    $date = new DateTime();
    $genre = new Genre(
        name: 'test',
        categoriesId: [$uuid],
        isActive: false,
        createdAt: $date,
    );
    expect(count($genre->categoriesId))->toBe(1);
    expect($genre->isActive)->toBeFalsy();
    expect($genre->isActive)->toBeBool();
    expect($genre->createdAt)->not->toBeNull();
    expect($genre->createdAt)->toBe($date);
    expect($genre->createdAt())->toBeString();
    expect($genre->createdAt())->not->toBeNull();
});

it('id field', function () {
    expect($this->genre->id)->not->toBeString();
    expect($this->genre->id)->not->toBeNull();
    expect($this->genre->id)->toBeInstanceOf(Uuid::class);
    expect($this->genre->id())->toBeString();

    $id = Uuid::random();
    $genre = new Genre(
        id: $id,
        name: 'name'
    );
    expect($genre->id)->not->toBeString();
    expect($genre->id)->not->toBeNull();
    expect($genre->id)->toBeInstanceOf(Uuid::class);
    expect($genre->id())->toBeString();
    expect($genre->id)->toBe($id);
});

it('should throw exception with name is invalid - min characters', function () {
    new Genre(name: 'sd');
})->throws(EntityValidationException::class);

it('should throw exception with name is invalid - max characters', function () {
    $name = Factory::create()->sentence(400);
    new Genre(name: $name);
})->throws(EntityValidationException::class);

it('should active a genre', function () {
    $genre = new Genre(
        name: 'test',
        isActive: false,
    );
    expect($genre->isActive)->toBeFalsy();
    $genre->activate();
    expect($genre->isActive)->toBeTrue();
});

it('should deactivate a genre', function () {
    $genre = new Genre(
        name: 'test',
        isActive: true,
    );
    expect($genre->isActive)->toBeTrue();
    $genre->deactivate();
    expect($genre->isActive)->toBeFalsy();
});

it('should update a genre', function () {
    expect($this->genre->name)->toBe('test');
    $this->genre->update(
        name: 'updated name',
    );
    expect($this->genre->name)->toBe('updated name');
});

it('should throw exception if update with invalid value', function () {
    $this->genre->update(
        name: 'up',
    );
})->throws(EntityValidationException::class);

it('should throw exception if values of array is not uuid vo', function () {
    new Genre(
        name: 'test',
        categoriesId: ['123']
    );
})->throws(InvalidArgumentException::class);

it('should pass when use values array equal vo uuid', function () {
    $genre = new Genre(
        name: 'test',
        categoriesId: [Uuid::random()]
    );

    expect(count($genre->categoriesId))->toBe(1);
});

it('add category', function () {
    expect(count($this->genre->categoriesId))->toBe(0);

    $categoryId = (string) Uuid::random();
    $this->genre->addCategory($categoryId);

    expect(count($this->genre->categoriesId))->toBe(1);
});

it('remove category', function () {
    $categoryId = (string) Uuid::random();
    $genre = new Genre(
        name: 'test',
        categoriesId: [$categoryId]
    );
    expect(count($genre->categoriesId))->toBe(1);

    $genre->removeCategory($categoryId);
    expect(count($genre->categoriesId))->toBe(0);
});
