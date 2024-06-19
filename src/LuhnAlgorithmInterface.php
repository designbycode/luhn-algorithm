<?php

namespace Designbycode\LuhnAlgorithm;

interface LuhnAlgorithmInterface
{
    /**
     * Validates a given value using the Luhn algorithm.
     *
     * @param  string  $value  The value to validate
     * @return bool True if the value is valid, false otherwise
     */
    public function isValid(string $value): bool;

    /**
     * Generates a check digit for a given value using the Luhn algorithm.
     *
     * @param  string  $value  The value to generate a check digit for
     * @return string The generated value including the check digit
     */
    public function generate(string $value): string;

    /**
     * Generates the Luhn check digit for a given value.
     *
     * @param  string  $value  The value to generate a check digit for
     * @return string The generated check digit
     */
    public function getDigit(string $value): string;

    /**
     * Strips the Luhn check digit from the given value.
     *
     * @param  string  $value  The value to strip the check digit from
     * @return string The value without the check digit
     */
    public function withoutDigit(string $value): string;

    /**
     * Validates a value including the Luhn check digit and suggests the correct digit if invalid.
     */
    public function validateAndSuggest(string $value): array;

    /**
     * Performs the Luhn algorithm on a given value.
     *
     * @param  string  $value  The value to perform the Luhn algorithm on
     * @return array An array containing the reversed value and the checksum
     *
     * @throws InvalidArgumentException If the value is empty
     */
    public function luhn(string $value): array;
}
