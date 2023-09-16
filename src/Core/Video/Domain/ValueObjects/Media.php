<?php

namespace Core\Video\Domain\ValueObjects;

use Core\Video\Domain\Enums\MediaStatus;

class Media
{
    public function __construct(
        protected string $filePath,
        protected MediaStatus $mediaStatus,
        protected string $encodedPath = ''
    ) {
    }

    public function __get($property)
    {
        return $this->{$property};
    }
}
