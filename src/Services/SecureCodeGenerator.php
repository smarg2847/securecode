<?php


namespace Smarg2847\SecureCode\Services;

use Smarg2847\SecureCode\Services\Traits\ConfigTrait;
use Smarg2847\SecureCode\Services\Validators\NoPalindromeValidator;
use Smarg2847\SecureCode\Services\Validators\RepeatingCharactersValidator;
use Smarg2847\SecureCode\Services\Validators\MinimumUniqueCharactersValidator;

/**
 *
 * @package Smarg2847\SecureCode\Services
 */
class SecureCodeGenerator
{
    use ConfigTrait;

    public function __construct()
    {
        $this->validators = [
            new NoPalindromeValidator(),
            new RepeatingCharactersValidator(),
            new MinimumUniqueCharactersValidator(),
        ];
    }

    /**
     *
     * @return string The generated code or null if code generation fails.
     */
    public function generate(): string
    {
        do {
            $code = $this->generateSecureCode($this->getCodeLength());
        } while (!$this->isCodeValid($code));

        return $code;
    }

    /**
     * Generate a dynamic-length code.
     *
     * @return string
     */
    private function generateSecureCode(int $length): string
    {
        $min = (int) pow(10, $length - 1);
        $max = (int) pow(10, $length) - 1;

        return (string) random_int($min, $max);
    }

    /**
     * Check if the generated code is valid according to the constraints.
     *
     * @param string $code
     *
     * @return bool
     */
    private function isCodeValid(string $code): bool
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($code)) {
                return false;
            }
        }
        return true;
    }

}
