<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use Core\Genre\Application\DTO\{
    InputGenresDTO,
    InputGenreDTO
};
use Core\Genre\Application\UseCase\{
    FindGenresUseCase,
    GetGenreUseCase
};
use Illuminate\Http\Request;

class GenreApiController extends Controller
{
    public function index(Request $request, FindGenresUseCase $useCase)
    {
        $response = $useCase->execute(new InputGenresDTO(
            filter: $request->get('filter', ''),
        ));

        return GenreResource::collection($response->items);
    }

    public function show(string $genre, GetGenreUseCase $useCase)
    {
        $response = $useCase->execute(new InputGenreDTO(
            id: $genre,
        ));

        return new GenreResource($response);
    }
}
