<?php

use Core\Video\Domain\Enums\MediaStatus;
use Core\Video\Domain\ValueObjects\Media;

it('test vo media', function () {
    $vo = new Media(
        filePath: 'path/video.mp4',
        mediaStatus: MediaStatus::PENDING,
        encodedPath: 'path/video.ogg',
    );
    expect($vo)->toHaveProperties([
        'filePath', 'mediaStatus', 'encodedPath'
    ]);
    expect($vo->filePath)->toBeString();
    expect($vo->mediaStatus)->toBeInstanceOf(MediaStatus::class);
    expect($vo->encodedPath)->toBeString();
    expect($vo->filePath)->toBe('path/video.mp4');
    expect($vo->mediaStatus)->toBe(MediaStatus::PENDING);
    expect($vo->encodedPath)->toBe('path/video.ogg');
});
