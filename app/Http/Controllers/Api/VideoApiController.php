<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use Core\Video\Application\DTO\{
    InputVideosDTO,
    InputVideoDTO
};
use Core\Video\Application\UseCase\{
    FindVideosUseCase,
    GetVideoUseCase
};
use Illuminate\Http\Request;

class VideoApiController extends Controller
{
    public function index(Request $request, FindVideosUseCase $useCase)
    {
        $response = $useCase->execute(new InputVideosDTO(
            filter: $request->get('filter', ''),
        ));

        return VideoResource::collection($response->items);
    }

    public function show(string $video, GetVideoUseCase $useCase)
    {
        $response = $useCase->execute(new InputVideoDTO(
            id: $video,
        ));

        return new VideoResource($response);
    }
}
