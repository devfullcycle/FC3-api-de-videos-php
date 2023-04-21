<?php

use Core\Category\Domain\Entities\Category;

beforeEach(fn () => $this->category = new Category(
    name: 'test'
));

test('constructor of category and getters and setters', function () {
    expect($this->category->name)->not->toBeNull();
    expect($this->category->name)->toBeString();
    expect($this->category->name)->toBe('test');
    expect($this->category->description)->toBeNull();
    expect($this->category->isActive)->toBe(true);

    $category = new Category(
        name: 'test',
        description: 'desc',
        isActive: false
    );
    expect($category->description)->not->toBeNull();
    expect($category->description)->toBe('desc');
    expect($category->isActive)->toBeFalsy();
    expect($category->isActive)->toBeBool();
});
