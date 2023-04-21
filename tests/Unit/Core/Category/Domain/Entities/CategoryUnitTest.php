<?php

use Core\Category\Domain\Entities\Category;

beforeEach(fn () => $this->category = new Category(

));

test('constructor of category and getters and setters', function () {
    expect($this->category->name)->not->toBeNull();
    expect($this->category->name)->toBeString();
});
