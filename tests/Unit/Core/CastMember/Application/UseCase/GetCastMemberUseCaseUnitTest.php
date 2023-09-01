<?php

use Core\CastMember\Application\DTO\{
    InputCastMemberDTO,
    OutputCastMemberDTO,
};
use Core\CastMember\Domain\Entities\CastMember;
use Core\CastMember\Application\UseCase\GetCastMemberUseCase;
use Core\CastMember\Domain\Enums\CastMemberType;
use Core\CastMember\Domain\Repository\CastMemberRepositoryInterface;
use Core\SeedWork\Domain\ValueObjects\Uuid;

afterAll(fn () => Mockery::close());

test('unit test get castMember', function () {
    // $castMember = new CastMember(
    //     name: 'test'
    // );
    $uuid = Uuid::random();
    $id = new Uuid($uuid);
    $castMemberMock = Mockery::mock(CastMember::class, [
        'name', CastMemberType::DIRECTOR, $id
    ]);
    $castMemberMock->shouldReceive('id')->andReturn((string)$uuid);
    $castMemberMock->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

    $inputDto = new InputCastMemberDTO(
        id: '1231'
    );

    $mockRepository = Mockery::mock(CastMemberRepositoryInterface::class);
    $mockRepository->shouldReceive('findOne')
        ->times(1)
        ->with($inputDto->id)
        ->andReturn($castMemberMock);

    $useCase = new GetCastMemberUseCase($mockRepository);
    $response = $useCase->execute(input: $inputDto);

    expect($response)->toBeInstanceOf(OutputCastMemberDTO::class);
});
