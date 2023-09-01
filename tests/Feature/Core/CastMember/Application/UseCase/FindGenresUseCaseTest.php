<?php

use Core\CastMember\Application\DTO\InputCastMembersDTO;
use Core\CastMember\Application\UseCase\FindCastMembersUseCase;
use Core\CastMember\Infra\CastMemberRepository;
use Tests\Feature\Stubs\ElasticSearchStub;

test('FindCastMembersUseCase', function (array $response, int $totalResponse = 0) {
    $stubElastic = new ElasticSearchStub(['hits' => [
        'hits' => $response
    ]]);
    $repository = new CastMemberRepository($stubElastic);
    $useCase = new FindCastMembersUseCase($repository);
    $response = $useCase->execute(
        new InputCastMembersDTO(filter: '')
    );
    expect(count($response->items))->toBe($totalResponse);
    expect($response->total)->toBe($totalResponse);
})->with('elastic_data');
