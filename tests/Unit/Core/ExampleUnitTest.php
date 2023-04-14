<?php

use Core\Example;

test('should return text equals string', function () {
    $example = new Example;
    expect($example->say())->toBe('string');
});
