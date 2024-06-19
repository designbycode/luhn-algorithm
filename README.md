# Luhn Algorithm

[![Latest Version on Packagist](https://img.shields.io/packagist/v/designbycode/luhn-algorithm.svg?style=flat-square)](https://packagist.org/packages/designbycode/luhn-algorithm)
[![Tests](https://img.shields.io/github/actions/workflow/status/designbycode/luhn-algorithm/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/designbycode/luhn-algorithm/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/designbycode/luhn-algorithm.svg?style=flat-square)](https://packagist.org/packages/designbycode/luhn-algorithm)

The Luhn Algorithm is a simple checksum formula used to validate a variety of identification numbers, such as credit card numbers, IMEI numbers, and others. This documentation provides an overview of the Luhn Algorithm implementation in PHP, including examples and use cases.

## Installation

You can install the package via composer:

```bash
composer require designbycode/luhn-algorithm
```

## Usage
### Validating a Value
To validate a value using the Luhn Algorithm, create an instance of the LuhnAlgorithm class and call the isValid method:

```php
$luhn = new LuhnAlgorithm();
$isValid = $luhn->isValid('79927398713'); // returns true
```
The isValid method returns ``true`` if the value is valid, and ``false`` otherwise.

## Generating a Check Digit
To generate a check digit for a given value, call the ```generate``` method:

```php
$luhn = new LuhnAlgorithm();
$generatedCheckDigit = $luhn->generate('7992739871'); // returns '79927398713'
```
The ``generate`` method returns the generated value including the check digit.

## Stripping the Check Digit
To strip the check digit from a given value, call the ``withoutDigit`` method:
```php
$luhn = new LuhnAlgorithm();
$valueWithoutDigit = $luhn->withoutDigit('79927398713'); // returns '7992739871'
```
The ``withoutDigit`` method returns the value without the check digit.

## Validating and Suggesting a Check Digit
To validate a value and suggest the correct check digit if invalid, call the ``validateAndSuggest`` method:
```php
$luhn = new LuhnAlgorithm();
$result = $luhn->validateAndSuggest('79927398712'); // returns ['isValid' => false, 'uggestedDigit' => '3']
```

The ``validateAndSuggest`` method returns an array containing ``isValid`` and ``suggestedDigit`` values.

## Use Cases
### Credit Card Validation
The Luhn Algorithm is commonly used to validate credit card numbers. You can use the ``isValid`` method to check if a credit card number is valid:
```php
$luhn = new LuhnAlgorithm();
$isValid = $luhn->isValid('4242424242424242'); // returns true
```

### IMEI Number Validation
The Luhn Algorithm can also be used to validate IMEI numbers. You can use the ``isValid`` method to check if an IMEI number is valid:
```php
$luhn = new LuhnAlgorithm();
$isValid = $luhn->isValid('352656091234567'); // returns true
```

### Generating Check Digits for IDs
You can use the ``generate`` method to generate check digits for various identification numbers, such as customer IDs or product codes:
```php
$luhn = new LuhnAlgorithm();
$generatedCheckDigit = $luhn->generate('CUSTOMER1234'); // returns 'CUSTOMER12345'
```
## Error Handling
The Luhn Algorithm implementation throws an ``InvalidArgumentException`` if the input value is empty or invalid. You can catch this exception to handle errors:

```php
try {
    $luhn = new LuhnAlgorithm();
    $luhn->isValid('');
} catch (InvalidArgumentException $e) {
    echo 'Error: '. $e->getMessage();
}
```
## Conclusion
The Luhn Algorithm implementation in PHP provides a simple and efficient way to validate and generate check digits for various identification numbers. By following this documentation, you can easily integrate the Luhn Algorithm into your PHP applications.




## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [claudemyburgh](https://github.com/claudemyburgh)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
