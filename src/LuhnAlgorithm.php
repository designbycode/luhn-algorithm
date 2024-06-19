<?php

namespace Designbycode\LuhnAlgorithm;

use InvalidArgumentException;

class LuhnAlgorithm implements LuhnAlgorithmInterface
{
    /**
     * Validates a given value using the Luhn algorithm.
     *
     * @param  string  $value  The value to validate
     * @return bool True if the value is valid, false otherwise
     *
     * @example
     * ```php
     * $luhn = new LuhnAlgorithm();
     * $isValid = $luhn->isValid('79927398713'); // returns true
     * ```
     */
    public function isValid(string $value): bool
    {
        [$value, $checksum] = $this->luhn($value);

        return $checksum % 10 === 0;
    }

    /**
     * Doubles a digit and subtracts 9 if the result is greater than 9.
     *
     * @param  int  $digit  The digit to double
     * @return int The doubled digit
     *
     * @example
     * ```php
     * $luhn = new LuhnAlgorithm();
     * $doubledDigit = $luhn->doubleDigit(5); // returns 10
     * $doubledDigit = $luhn->doubleDigit(10); // returns 1
     * ```
     */
    private function doubleDigit(int $digit): int
    {
        $digit *= 2;

        return $digit > 9 ? $digit - 9 : $digit;
    }

    /**
     * Generates a check digit for a given value using the Luhn algorithm.
     *
     * @param  string  $value  The value to generate a check digit for
     * @return string The generated value including the check digit
     *
     * @example
     * ```php
     * $luhn = new LuhnAlgorithm();
     * $generatedCheckDigit = $luhn->generate('7992739871'); // returns '79927398713'
     * ```
     */
    public function generate(string $value): string
    {
        $checkDigit = $this->getDigit($value);

        return $value.$checkDigit;
    }

    /**
     * Generates the Luhn check digit for a given value.
     *
     * @param  string  $value  The value to generate a check digit for
     * @return string The generated check digit
     */
    public function getDigit(string $value): string
    {
        [$valueWithZero, $checksum] = $this->luhn($value.'0');
        $checkDigit = (10 - ($checksum % 10)) % 10;

        return (string) $checkDigit;
    }

    /**
     * Strips the Luhn check digit from the given value.
     *
     * @param  string  $value  The value to strip the check digit from
     * @return string The value without the check digit
     */
    public function withoutDigit(string $value): string
    {
        if (strlen($value) < 2) {
            throw new InvalidArgumentException('number must have at least 2 digits');
        }

        return substr($value, 0, -1);
    }

    /**
     * Validates a value including the Luhn check digit and suggests the correct digit if invalid.
     *
     * @param  string  $value  The value to validate and suggest the correct check digit if needed
     * @return array An array containing 'isValid' and 'suggestedDigit'
     */
    public function validateAndSuggest(string $value): array
    {
        $isValid = $this->isValid($value);
        $suggestedDigit = null;

        if (! $isValid) {
            $valueWithoutDigit = $this->withoutDigit($value);
            $suggestedDigit = $this->getDigit($valueWithoutDigit);
        }

        return [
            'isValid' => $isValid,
            'suggestedDigit' => $suggestedDigit,
        ];
    }

    /**
     * Performs the Luhn algorithm on a given value.
     *
     * @param  string  $value  The value to perform the Luhn algorithm on
     * @return array An array containing the reversed value and the checksum
     *
     * @throws InvalidArgumentException If the value is empty
     *
     * @example
     * ```php
     * $luhn = new LuhnAlgorithm();
     * list($reversedValue, $checksum) = $luhn->luhn('79927398713');
     * ```
     */
    public function luhn(string $value): array
    {
        if (empty($value)) {
            throw new InvalidArgumentException('number cannot be empty');
        }

        $value = strrev($value); // Reverse the ID number
        $checksum = 0;

        for ($i = 0; $i < strlen($value); $i++) {
            $digit = (int) $value[$i];
            $digit = ($i % 2 === 1) ? $this->doubleDigit($digit) : $digit;
            $checksum += $digit;
        }

        return [strrev($value), $checksum];
    }
}
