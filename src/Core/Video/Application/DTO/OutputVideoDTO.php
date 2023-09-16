<?php

namespace Core\Video\Application\DTO;

use Core\Video\Domain\Entities\Video;

class OutputVideoDTO
{
    public function __construct(
        readonly public string $id,
        readonly public string $title,
        readonly public string $description,
        readonly public int $yearLaunched,
        readonly public int $duration,
        readonly public bool $opened,
        readonly public string $rating,
        readonly public bool $published,
        readonly public string $createdAt,
        readonly public string $thumbFile = '',
        readonly public string $thumbHalf = '',
        readonly public string $bannerFile = '',
        readonly public string $trailerFile = '',
        readonly public string $videoFile = '',
    ) {
    }

    public static function fromEntity(Video $video): self
    {
        return new self(
            id: $video->id(),
            title: $video->title,
            description: $video->description,
            yearLaunched: $video->yearLaunched,
            duration: $video->duration,
            opened: $video->opened,
            rating: $video->rating->value,
            published: $video->published,
            createdAt: $video->createdAt(),
            thumbFile: $video->thumbFile?->path ?? '',
            thumbHalf: $video->thumbHalf?->path ?? '',
            bannerFile: $video->bannerFile?->path ?? '',
            trailerFile: $video->trailerFile?->filePath ?? '',
            videoFile: $video->videoFile?->filePath ?? '',
        );
    }
}
