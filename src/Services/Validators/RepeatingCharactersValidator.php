<?php

namespace Smarg\SecureCode\Services\Validators;

use Smarg\SecureCode\Services\Traits\ConfigTrait;

class RepeatingCharactersValidator
{
    use ConfigTrait;

    public function isValid(string $code): bool
    {
        return true; /// need to add regrex
    }

}