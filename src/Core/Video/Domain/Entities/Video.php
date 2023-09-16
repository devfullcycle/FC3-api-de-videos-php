<?php

namespace Core\Video\Domain\Entities;

use Core\SeedWork\Domain\Traits\MethodsMagicsTrait;
use Core\SeedWork\Domain\ValueObjects\Uuid;
use Core\Video\Domain\Enums\Rating;
use Core\Video\Domain\ValueObjects\Image;
use Core\Video\Domain\ValueObjects\Media;
use DateTime;

class Video
{
    use MethodsMagicsTrait;

    protected array $categoriesIds = [];
    protected array $genresIds = [];
    protected array $castMembersIds = [];

    public function __construct(
        protected string $title,
        protected string $description,
        protected int $yearLaunched,
        protected int $duration,
        protected bool $opened,
        protected Rating $rating,
        protected ?Uuid $id = null,
        protected bool $published = false,
        protected ?DateTime $createdAt = null,
        protected ?Image $thumbFile = null,
        protected ?Image $thumbHalf = null,
        protected ?Image $bannerFile = null,
        protected ?Media $trailerFile = null,
        protected ?Media $videoFile = null,
    ) {
        $this->id = $this->id ?? Uuid::random();
        $this->createdAt = $this->createdAt ?? new DateTime();

        // validation
    }

    public function addCategoryId(string $categoryId): void
    {
        array_push($this->categoriesIds, $categoryId);
    }

    public function addGenreId(string $genreId): void
    {
        array_push($this->genresIds, $genreId);
    }

    public function addCastMemberId(string $castMembersIds): void
    {
        array_push($this->castMembersIds, $castMembersIds);
    }

    public function removeCategoryId(string $categoryId): void
    {
        unset($this->categoriesIds[array_search($categoryId, $this->categoriesIds)]);
    }

    public function removeGenreId(string $genreId): void
    {
        unset($this->genresIds[array_search($genreId, $this->genresIds)]);
    }

    public function removeCastMemberId(string $castMemberId): void
    {
        unset($this->castMembersIds[array_search($castMemberId, $this->castMembersIds)]);
    }

    public function addThumbFile(Image $thumbFile): void
    {
        $this->thumbFile = $thumbFile;
    }

    public function addThumbHalf(Image $thumbHalf): void
    {
        $this->thumbHalf = $thumbHalf;
    }

    public function addBannerFile(Image $bannerFile): void
    {
        $this->bannerFile = $bannerFile;
    }

    public function addTrailerFile(Media $trailerFile): void
    {
        $this->trailerFile = $trailerFile;
    }

    public function addVideoFile(Media $videoFile): void
    {
        $this->videoFile = $videoFile;
    }
}
