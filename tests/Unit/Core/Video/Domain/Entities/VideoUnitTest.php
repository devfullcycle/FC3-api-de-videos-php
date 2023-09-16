<?php

use Core\Video\Domain\Entities\Video;
use Core\Video\Domain\Enums\Rating;

beforeEach(fn () => $this->video = new Video(
    title: 'title',
    description: 'desc video',
    yearLaunched: 2026,
    duration: 1,
    opened: true,
    rating: Rating::RATE10,
));

it('constructor of video and getter and setter', function () {
    expect($this->video)->toHaveProperties([
        'title',
        'description',
        'yearLaunched',
        'duration',
        'opened',
        'rating',
        'id',
        'published',
        'createdAt',
        'thumbFile',
        'thumbHalf',
        'bannerFile',
        'trailerFile',
        'videoFile',
    ]);
});
