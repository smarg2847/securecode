<?php

namespace Smarg\SecureCode\Services\Validators;

use Smarg\SecureCode\Services\Traits\ConfigTrait;

class MinimumUniqueCharactersValidator 
{
    use ConfigTrait;
    
    public function isValid(string $secureCode): bool
    {
        $allowedCharactersCount = count_chars($this->getAllowedCharacters(), 1);
        $codeCharactersCount    = count_chars($secureCode, 1);

        $uniqueCharactersCount = 0;

        foreach ($codeCharactersCount as $character => $count) {
            if (isset($allowedCharactersCount[$character])) {
                $uniqueCharactersCount++;
            }
        }

        return $uniqueCharactersCount >= $this->getCharacterRepeatedLimit();
    }

}