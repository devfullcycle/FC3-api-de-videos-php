<?php

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