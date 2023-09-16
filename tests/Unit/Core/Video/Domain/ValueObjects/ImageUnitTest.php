<?php

use Core\Video\Domain\ValueObjects\Image;

it('test vo image', function () {
    $vo = new Image('path/image.png');
    expect($vo->path())->not->toBeNull();
    expect($vo->path())->toBeString();
    expect($vo->path())->toBe('path/image.png');
});
