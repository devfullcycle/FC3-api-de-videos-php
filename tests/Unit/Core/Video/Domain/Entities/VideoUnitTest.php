<?php

use Core\SeedWork\Domain\ValueObjects\Uuid;
use Core\Video\Domain\Entities\Video;
use Core\Video\Domain\Enums\MediaStatus;
use Core\Video\Domain\Enums\Rating;
use Core\Video\Domain\ValueObjects\Image;
use Core\Video\Domain\ValueObjects\Media;

beforeEach(fn () => $this->video = new Video(
    title: 'title',
    description: 'desc video',
    yearLaunched: 2026,
    duration: 1,
    opened: true,
    rating: Rating::RATE10,
));

it('constructor properties', function () {
    expect($this->video)->toHaveProperties([
        'categoriesIds',
        'genresIds',
        'castMembersIds',
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

it('video getters', function () {
    expect($this->video->title)->toBeString();
    expect($this->video->title)->not->toBeNull();
    expect($this->video->title)->toBe('title');
    expect($this->video->description)->toBeString();
    expect($this->video->description)->toBe('desc video');
    expect($this->video->yearLaunched)->toBeInt();
    expect($this->video->yearLaunched)->toBe(2026);
    expect($this->video->duration)->toBeInt();
    expect($this->video->duration)->toBe(1);
    expect($this->video->opened)->toBeBool();
    expect($this->video->opened)->toBe(true);
    expect($this->video->rating)->toBe(Rating::RATE10);
    expect($this->video->rating)->toBeInstanceOf(Rating::class);
    expect($this->video->id())->not->toBeNull();
    expect($this->video->id)->not->toBeNull();
    expect($this->video->id)->toBeInstanceOf(Uuid::class);
    expect($this->video->published)->toBeBool();
    expect($this->video->published)->toBe(false);
    expect($this->video->createdAt)->not->toBeNull();
    expect($this->video->createdAt)->toBeInstanceOf(DateTime::class);
    expect($this->video->thumbFile)->toBeNull();
    expect($this->video->thumbHalf)->toBeNull();
    expect($this->video->bannerFile)->toBeNull();
    expect($this->video->trailerFile)->toBeNull();
    expect($this->video->videoFile)->toBeNull();
    expect($this->video->categoriesIds)->toBeArray();
    expect($this->video->genresIds)->toBeArray();
    expect($this->video->castMembersIds)->toBeArray();
});

it('add and remove category id', function () {
    $categoryId = Uuid::random();
    $categoryId2 = Uuid::random();
    expect(count($this->video->categoriesIds))->toBe(0);
    $this->video->addCategoryId($categoryId);
    $this->video->addCategoryId($categoryId2);
    expect(count($this->video->categoriesIds))->toBe(2);
    $this->video->removeCategoryId($categoryId);
    expect(count($this->video->categoriesIds))->toBe(1);
});

it('add and remove genres id', function () {
    $genreId = Uuid::random();
    $genreId2 = Uuid::random();
    expect(count($this->video->genresIds))->toBe(0);
    $this->video->addGenreId($genreId);
    $this->video->addGenreId($genreId2);
    expect(count($this->video->genresIds))->toBe(2);
    $this->video->removeGenreId($genreId);
    expect(count($this->video->genresIds))->toBe(1);
});

it('add and remove cast_members id', function () {
    $castMember = Uuid::random();
    $castMember2 = Uuid::random();
    expect(count($this->video->castMembersIds))->toBe(0);
    $this->video->addCastMemberId($castMember);
    $this->video->addCastMemberId($castMember2);
    expect(count($this->video->castMembersIds))->toBe(2);
    $this->video->removeCastMemberId($castMember);
    expect(count($this->video->castMembersIds))->toBe(1);
});

it('add thumb in video', function () {
    expect($this->video->thumbFile)->toBe(null);
    $this->video->addThumbFile(thumbFile: new Image(
        path: 'path/image.png'
    ));
    expect($this->video->thumbFile)->toBeInstanceOf(Image::class);
    expect($this->video->thumbFile->path())->toBe('path/image.png');
});

it('add thumb half in video', function () {
    expect($this->video->thumbHalf)->toBe(null);
    $this->video->addThumbHalf(thumbHalf: new Image(
        path: 'path/image.png'
    ));
    expect($this->video->thumbHalf)->toBeInstanceOf(Image::class);
    expect($this->video->thumbHalf->path())->toBe('path/image.png');
});

it('add banner in video', function () {
    expect($this->video->bannerFile)->toBe(null);
    $this->video->addBannerFile(bannerFile: new Image(
        path: 'path/image.png'
    ));
    expect($this->video->bannerFile)->toBeInstanceOf(Image::class);
    expect($this->video->bannerFile->path())->toBe('path/image.png');
});

it('add media trailer in video', function () {
    expect($this->video->trailerFile)->toBe(null);
    $this->video->addTrailerFile(trailerFile: new Media(
        filePath: 'path/video.mp4',
        mediaStatus: MediaStatus::COMPLETE,
        encodedPath: 'path/video.ogg',
    ));
    expect($this->video->trailerFile)->toBeInstanceOf(Media::class);
    expect($this->video->trailerFile->filePath)->toBe('path/video.mp4');
    expect($this->video->trailerFile->mediaStatus)->toBe(MediaStatus::COMPLETE);
    expect($this->video->trailerFile->encodedPath)->toBe('path/video.ogg');
});

it('add media video in video', function () {
    expect($this->video->videoFile)->toBe(null);
    $this->video->addVideoFile(videoFile: new Media(
        filePath: 'path/video.mp4',
        mediaStatus: MediaStatus::PENDING,
        encodedPath: 'path/video.ogg',
    ));
    expect($this->video->videoFile)->toBeInstanceOf(Media::class);
    expect($this->video->videoFile->filePath)->toBe('path/video.mp4');
    expect($this->video->videoFile->mediaStatus)->toBe(MediaStatus::PENDING);
    expect($this->video->videoFile->encodedPath)->toBe('path/video.ogg');
});

it('should open and to close - opened', function () {
    expect($this->video->opened)->toBeTrue();
    $this->video->toClose();
    expect($this->video->opened)->toBeFalse();
    $this->video->open();
    expect($this->video->opened)->toBeTrue();
});

it('should published and unpublished', function () {
    expect($this->video->published)->toBeFalse();
    $this->video->publish();
    expect($this->video->published)->toBeTrue();
    $this->video->unPublish();
    expect($this->video->published)->toBeFalse();
});
