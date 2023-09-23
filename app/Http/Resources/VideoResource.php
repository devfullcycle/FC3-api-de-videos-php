<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'yearLaunched' => $this->yearLaunched,
            'duration' => $this->duration,
            'opened' => $this->opened,
            'rating' => $this->rating,
            'published' => $this->published,
            'created_at' => $this->createdAt,
            'thumb_file' => $this->thumbFile ?? '',
            'thumb_half' => $this->thumbHalf ?? '',
            'banner_file' => $this->bannerFile ?? '',
            'trailer_file' => $this->trailerFile ?? '',
            'video_file' => $this->videoFile ?? '',
        ];
    }
}
