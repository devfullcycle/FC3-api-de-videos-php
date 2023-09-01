<?php

use Core\CastMember\Domain\Entities\CastMember;
use Core\CastMember\Domain\Enums\CastMemberType;
use Core\CastMember\Infra\CastMemberRepository;
use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Core\SeedWork\Domain\Exceptions\EntityNotFoundException;

test('findAll', function () {
    $mockElastic = Mockery::mock(ElasticClientInterface::class);
    $mockElastic->shouldReceive('search')
        ->times(1)
        ->with([
            'index' => 'mysql-server.fullcycle.cast_members',
            'body' => [
                'query' => [
                    'match' => [
                        'after.name' => 'test_name'
                    ]
                ]
            ]
        ])
        ->andReturn([
            'hits' => [
                'hits' => []
            ]
        ]);

    $castMemberRepository = new CastMemberRepository($mockElastic);
    $response = $castMemberRepository->findAll('test_name');
    expect($response)->toBeArray();
});

test('findOne: should exception when total register returned is equals zero', function () {
    $mockElastic = Mockery::mock(ElasticClientInterface::class);
    $mockElastic->shouldReceive('search')
        ->times(1)
        ->andReturn([
            'hits' => [
                'hits' => []
            ]
        ]);

    $castMemberRepository = new CastMemberRepository($mockElastic);
    $castMemberRepository->findOne('fake_value');
})->throws(EntityNotFoundException::class);

test('findOne', function () {
    $id = '88bdf4aa-7ec7-408f-91f6-c82f192d540c';

    $mockElastic = Mockery::mock(ElasticClientInterface::class);
    $mockElastic->shouldReceive('search')
        ->times(1)
        ->with([
            'index' => 'mysql-server.fullcycle.cast_members',
            'body' => [
                'query' => [
                    'match' => [
                        'after.id' => $id
                    ]
                ]
            ]
        ])
        ->andReturn([
            'hits' => [
                'hits' => [
                    [
                        '_source' => [
                            'after' => [
                                'id' => $id,
                                'name' => 'CastMember Name',
                                'type' => 1,
                                'created_at' => '2023-12-12 12:12:00',
                            ]
                        ]
                    ]
                ]
            ]
        ]);

    $castMemberRepository = new CastMemberRepository($mockElastic);
    $castMember = $castMemberRepository->findOne($id);
    expect($castMember)->toBeInstanceOf(CastMember::class);
    expect($castMember->name)->toBe('CastMember Name');
    expect($castMember->type)->toBeInstanceOf(CastMemberType::class);
    expect($castMember->type->value)->toBe(1);
});
