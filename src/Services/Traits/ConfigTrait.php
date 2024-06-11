<?php

namespace Smarg\SecureCode\Services\Traits;

/**
 * Trait ConfigTrait
 * This trait provides methods to retrieve configuration settings for the SecureCode package.
 *
 * @package Smarg\SecureCode\Services\Traits
 */
trait ConfigTrait
{
    /**
     * Retrieve the allowed characters for the set code format in the configuration.
     *
     * @return string The allowed characters.
     */
    public function getAllowedCharacters(): string
    {
        return config('securecode.numeric_characters') ?? '0123456789';
    }

    /**
     * Retrieve the code length from the configuration.
     *
     * @return int The code length.
     */
    public function getCodeLength(): int
    {
            return config('securecode.secure_code_length') ?? 6;
    }

    /**
     * Retrieve the character repeated limit from the configuration.
     *
     * @return int The character repeated limit.
     */
    public function getCharacterRepeatedLimit(): int
    {
        return config('securecode.character_repeat_limit') ?? 3;
    }

    /**
     * Retrieve the sequence length limit from the configuration.
     *
     * @return int The sequence length limit.
     */
    public function getSequenceLengthLimit(): int
    {
        return config('securecode.sequence_limit') ?? 3;
    }

    /**
     * Retrieve the unique characters limit from the configuration.
     *
     * @return int The unique characters limit.
     */
    public function getUniqueCharactersLimit(): int
    {
        return config('securecode.minimum_unique_characters') ?? 6;
    }
}

