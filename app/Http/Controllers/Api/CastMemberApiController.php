<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CastMemberResource;
use Core\CastMember\Application\DTO\{
    InputCastMembersDTO,
    InputCastMemberDTO
};
use Core\CastMember\Application\UseCase\{
    FindCastMembersUseCase,
    GetCastMemberUseCase
};
use Illuminate\Http\Request;

class CastMemberApiController extends Controller
{
    public function index(Request $request, FindCastMembersUseCase $useCase)
    {
        $response = $useCase->execute(new InputCastMembersDTO(
            filter: $request->get('filter', ''),
        ));

        return CastMemberResource::collection($response->items);
    }

    public function show(string $genre, GetCastMemberUseCase $useCase)
    {
        $response = $useCase->execute(new InputCastMemberDTO(
            id: $genre,
        ));

        return new CastMemberResource($response);
    }
}
