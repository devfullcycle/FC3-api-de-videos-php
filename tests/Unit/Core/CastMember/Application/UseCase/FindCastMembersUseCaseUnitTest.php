<?php

use Core\CastMember\Application\DTO\{
    InputCastMembersDTO,
    OutputCastMembersDTO,
    OutputCastMemberDTO,
};
use Core\CastMember\Application\UseCase\FindCastMembersUseCase;
use Core\CastMember\Domain\Repository\CastMemberRepositoryInterface;
use Core\CastMember\Domain\Entities\CastMember;
use Core\CastMember\Domain\Enums\CastMemberType;

test('unit test get castMembers', function () {
    $inputDto = new InputCastMembersDTO('abc');

    $responseRepository = [
        new CastMember(
            name: 'test',
            type: CastMemberType::ACTOR,
        ),
    ];

    $this->mockRepository = Mockery::mock(stdClass::class, CastMemberRepositoryInterface::class);
    $this->mockRepository->shouldReceive('findAll')
        ->times(1)
        ->with($inputDto->filter)
        ->andReturn($responseRepository);

    $useCase = new FindCastMembersUseCase(
        repository: $this->mockRepository,
    );
    $response = $useCase->execute(
        input: $inputDto,
    );

    expect($response)->toBeInstanceOf(OutputCastMembersDTO::class);
    expect($response->items)->toBeArray();
    array_map(fn ($item) => expect($item)->toBeInstanceOf(OutputCastMemberDTO::class), $response->items);
    expect($response->total)->toBeInt();
    expect($response->total)->toBe(1);
});
