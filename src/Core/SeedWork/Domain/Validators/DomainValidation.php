<?php

namespace Core\SeedWork\Domain\Validators;

use Core\SeedWork\Domain\Exceptions\EntityValidationException;

class DomainValidation
{
    public static function notNull(string $value = null, string $customMessage = null)
    {
        if (empty($value)) {
            throw new EntityValidationException($customMessage ?? 'Should not be empty');
        }
    }
}
