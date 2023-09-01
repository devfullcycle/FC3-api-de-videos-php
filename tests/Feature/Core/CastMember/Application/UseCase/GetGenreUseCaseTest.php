<?php

use Core\CastMember\Application\DTO\InputCastMemberDTO;
use Core\CastMember\Application\UseCase\GetCastMemberUseCase;
use Core\CastMember\Infra\CastMemberRepository;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;
use Tests\Feature\Stubs\ElasticSearchStub;

test('should throws exception when not found castMember', function () {
    $stub = new ElasticSearchStub(['hits' => ['hits' => []]]);
    $repository = new CastMemberRepository($stub);
    $useCase = new GetCastMemberUseCase($repository);
    $useCase->execute(new InputCastMemberDTO(id: 'fake_id'));
})->throws(EntityNotFoundException::class);

test('GetCastMemberUseCase', function () {
    $id = '88bdf4aa-7ec7-408f-91f6-c82f192d540c';
    $stub = new ElasticSearchStub([
        'hits' => [
            'hits' => [
                [
                    '_source' => [
                        'after' => [
                            'id' => $id,
                            'name' => 'name',
                            'type' => 1,
                            'created_at' => '2023-12-12 12:12:00',
                        ]
                    ]
                ]
            ]
        ]
    ]);
    $repository = new CastMemberRepository($stub);
    $useCase = new GetCastMemberUseCase($repository);
    $response = $useCase->execute(new InputCastMemberDTO(id: $id));
    expect($response->id)->toBe($id);
    expect($response->name)->toBe('name');
    expect($response->type)->toBe(1);
});
