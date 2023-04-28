<?php

use Faker\Factory;
use Core\SeedWork\Domain\Exceptions\EntityValidationException;
use Core\SeedWork\Domain\Validators\DomainValidation;

test('should throw exception if value is null', function () {
    DomainValidation::notNull(value: null);
})->throws(EntityValidationException::class, 'Should not be empty');

test('should throw exception if value is empty', function () {
    DomainValidation::notNull(value: '');
})->throws(EntityValidationException::class, 'Should not be empty');

test('should throw exception and custom message', function () {
    DomainValidation::notNull(value: null, customMessage: 'custom message error');
})->throws(EntityValidationException::class, 'custom message error');

test('should string and total characters', function () {
    $value = Factory::create()->sentence(300);
    DomainValidation::strMaxLength(value: $value);
})->throws(EntityValidationException::class, 'The value must not be greater than 255 characters');

test('should string and total characters with custom size', function () {
    DomainValidation::strMaxLength(value: 'dsf', length: 2);
})->throws(EntityValidationException::class, 'The value must not be greater than 2 characters');

test('should string and total characters with custom message error', function () {
    $value = Factory::create()->sentence(300);
    DomainValidation::strMaxLength(value: $value, customMessage: 'custom error message');
})->throws(EntityValidationException::class, 'custom error message');