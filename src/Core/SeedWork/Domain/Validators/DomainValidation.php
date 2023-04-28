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

    public static function strMaxLength(string $value = null, int $length = 255, string $customMessage = null)
    {
        if (strlen($value) > $length) {
            throw new EntityValidationException($customMessage ?? "The value must not be greater than {$length} characters");
        }
    }

    public static function strMinLength(string $value = null, int $length = 3, string $customMessage = null)
    {
        if (strlen($value) <= $length) {
            throw new EntityValidationException($customMessage ?? "The value must be at least {$length} characters");
        }
    }
}
