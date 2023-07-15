<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Core\Category\Application\DTO\{
    InputCategoriesDTO,
    InputCategoryDTO
};
use Core\Category\Application\UseCase\{
    FindCategoriesUseCase,
    GetCategoryUseCase
};
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index(Request $request, FindCategoriesUseCase $useCase)
    {
        $response = $useCase->execute(new InputCategoriesDTO(
            filter: $request->get('filter', ''),
        ));

        return CategoryResource::collection($response->items);
    }

    public function show(string $category, GetCategoryUseCase $useCase)
    {
        $response = $useCase->execute(new InputCategoryDTO(
            id: $category,
        ));

        return new CategoryResource($response);
    }
}
