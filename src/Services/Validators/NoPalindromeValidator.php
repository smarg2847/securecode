<?php

namespace Smarg\SecureCode\Services\Validators;

class NoPalindromeValidator
{
    public function isValid(string $code): bool
    {
		return $code !== strrev($code);
    }
}