<?php

use Core\SeedWork\Domain\ValueObjects\Uuid;
use Core\Video\Domain\Entities\Video;
use Core\Video\Domain\Enums\Rating;
use Core\Video\Domain\ValueObjects\Image;

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
