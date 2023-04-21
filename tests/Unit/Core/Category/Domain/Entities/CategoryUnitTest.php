<?php

use DateTime;
use Core\Category\Domain\Entities\Category;
use Core\SeedWork\Domain\ValueObjects\Uuid;

beforeEach(fn () => $this->category = new Category(
    name: 'test'
));

test('constructor of category and getters and setters', function () {
    expect($this->category)->toHaveProperties([
        'id',
        'name',
        'description',
        'isActive',
        'createdAt',
    ]);
    expect($this->category->name)->not->toBeNull();
    expect($this->category->name)->toBeString();
    expect($this->category->name)->toBe('test');
    expect($this->category->description)->toBeNull();
    expect($this->category->isActive)->toBe(true);
    expect($this->category->createdAt)->not->toBeNull();
    expect($this->category->createdAt)->toBeInstanceOf(DateTime::class);

    $date = new DateTime();
    $category = new Category(
        name: 'test',
        description: 'desc',
        isActive: false,
        createdAt: $date,
    );
    expect($category->description)->not->toBeNull();
    expect($category->description)->toBe('desc');
    expect($category->isActive)->toBeFalsy();
    expect($category->isActive)->toBeBool();
    expect($category->createdAt)->not->toBeNull();
    expect($category->createdAt)->toBe($date);
    expect($category->createdAt())->toBeString();
    expect($category->createdAt())->not->toBeNull();
});

test('id field', function () {
    expect($this->category->id)->not->toBeString();
    expect($this->category->id)->not->toBeNull();
    expect($this->category->id)->toBeInstanceOf(Uuid::class);
    expect($this->category->id())->toBeString();

    $id = Uuid::random();
    $category = new Category(
        id: $id,
        name: 'name'
    );
    expect($category->id)->not->toBeString();
    expect($category->id)->not->toBeNull();
    expect($category->id)->toBeInstanceOf(Uuid::class);
    expect($category->id())->toBeString();
    expect($category->id)->toBe($id);
});
