<?php

namespace Core\Video\Domain\Repository;

use Core\Video\Domain\Entities\Video;

interface VideoRepositoryInterface
{
    public function findOne(string $id): Video;

    /**
     * @return array<Video>
     */
    public function findAll(?string $filter): array;
}
