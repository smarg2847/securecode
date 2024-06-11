<?php

namespace Smarg2847\SecureCode\Services;

use Illuminate\Support\Facades\Log;
use Smarg2847\SecureCode\Services\Traits\ConfigTrait;
use Smarg2847\SecureCode\Exceptions\InvalidCodeException;
use Smarg2847\SecureCode\Models\SecureCode;
use Smarg2847\SecureCode\Services\Validators\NoPalindromeValidator;
use Smarg2847\SecureCode\Services\Validators\RepeatingCharactersValidator;
use Smarg2847\SecureCode\Services\Validators\MinimumUniqueCharactersValidator;

/**
 * Class CodeManager
 * This class is used for managing generated codes.
 *
 * @package Smarg2847\SecureCode\Services
 */
class SecureCodeOperations
{
    use ConfigTrait;

    public function getSecureCodes()
    {
        return SecureCode::all();
    }

    public function saveCode(string $secureCode, bool $customCode)
    {
        if ($customCode) {
            $NoPalindromeValidator = new NoPalindromeValidator();
            if (!$NoPalindromeValidator->isValid($secureCode)) {
                return ["error" => "The secure code ".$secureCode." is a palindrome"];
            }
            $RepeatingCharactersValidator = new RepeatingCharactersValidator();
            if (!$RepeatingCharactersValidator->isValid($secureCode)) {
                return ["error" => "The secure code ".$secureCode." has repeating characters"];
            }
            $MinimumUniqueCharactersValidator = new MinimumUniqueCharactersValidator();
            if (!$MinimumUniqueCharactersValidator->isValid($secureCode)) {
                return ["error" => "The secure code ".$secureCode." should have atleast 3 unique characters"];
            }
        }
        return SecureCode::create(['code' => $secureCode]);
    }

    public function assignSecureCode(string $secureCode, string $moduleRecord): secureCode
    {
        
        $checkExistance = SecureCode::whereCode($secureCode)->first();
        
        if ($checkExistance) {
            return $checkExistance->assign($moduleRecord);
        }

        return SecureCode::create([
            'code' => $secureCode,
            'module_record' => $moduleRecord
        ]);
    }

    public function resetCode(string $secureCode): secureCode
    {
        $existingCode = SecureCode::whereCode($secureCode)->first();

        return $existingCode->reset();
    }

    public function destroyCode(string $secureCode): bool
    {
        $existingCode = SecureCode::whereCode($secureCode)->first();

        return $existingCode->delete();
    }
}
