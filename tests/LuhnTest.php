<?php

use Designbycode\LuhnAlgorithm\LuhnAlgorithm;

beforeEach(function () {
    $this->luhn = new LuhnAlgorithm();
});

it('isValid returns true for a valid Luhn number', function ($idNumber) {
    expect($this->luhn->isValid($idNumber))->toBeTrue();
})->with([
    '79927398713', // A valid Luhn number
    '4532015112830366', // A valid credit card number
    '8505527955555557', // A valid credit card number
]);

it('isValid returns false for an invalid Luhn number', function ($idNumber) {
    expect($this->luhn->isValid($idNumber))->toBeFalse();
})->with([
    '79927398711', // An invalid Luhn number
    '4532015112830367', // An invalid credit card number
    '8505527955555560', // An invalid credit card number
]);

it('throws an isValid exception for an empty string input', function () {
    expect(fn () => $this->luhn->isValid(''))->toThrow(InvalidArgumentException::class);
});

it('can generate number', function () {
    expect($this->luhn->generate('453201511283036'))
        ->toEqual($this->luhn->isValid('4532015112830366'));
});

it('can generates the correct Luhn digit', function () {
    expect($this->luhn->getDigit('7992739871'))->toBe('3')
        ->and($this->luhn->getDigit('1234567'))->toBe('4');
});

it('it strips the Luhn digit correctly', function () {
    expect($this->luhn->withoutDigit('79927398713'))->toBe('7992739871')
        ->and($this->luhn->withoutDigit('12345674'))->toBe('1234567')
        ->and(fn () => $this->luhn->withoutDigit('1'))->toThrow(InvalidArgumentException::class);
});

it('can validates the Luhn digit and suggests the correct one if invalid', function () {
    $result = $this->luhn->validateAndSuggest('79927398713');
    expect($result['isValid'])->toBeTrue()
        ->and($result['suggestedDigit'])->toBeNull();

    $result = $this->luhn->validateAndSuggest('12345674');
    expect($result['isValid'])->toBeTrue()
        ->and($result['suggestedDigit'])->toBeNull();

    $result = $this->luhn->validateAndSuggest('12345670');
    expect($result['isValid'])->toBeFalse()
        ->and($result['suggestedDigit'])->toBe('4');
});
