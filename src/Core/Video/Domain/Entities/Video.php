<?php

namespace Core\Video\Domain\Entities;

use Core\SeedWork\Domain\ValueObjects\Uuid;
use Core\Video\Domain\Enums\Rating;
use Core\Video\Domain\ValueObjects\Image;
use Core\Video\Domain\ValueObjects\Media;
use DateTime;

class Video
{
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
}
