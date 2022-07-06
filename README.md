# A FilamentPHP form plugin for working with phone numbers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jojostx/filament-tel-input.svg?style=flat-square)](https://packagist.org/packages/jojostx/filament-tel-input)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/jojostx/filament-tel-input/run-tests?label=tests)](https://github.com/jojostx/filament-tel-input/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/jojostx/filament-tel-input/Check%20&%20fix%20styling?label=code%20style)](https://github.com/jojostx/filament-tel-input/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jojostx/filament-tel-input.svg?style=flat-square)](https://packagist.org/packages/jojostx/filament-tel-input)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

<img width="1863" alt="image" src="https://user-images.githubusercontent.com/604907/160436321-9ff47bb8-28a2-45af-98fe-a57802236178.png">

## Installation

You can install the package via composer:

```bash
composer require jojostx/filament-tel-input
```

Publish the flags using

```bash
php artisan vendor:publish --tag="filament-tel-input-flags"
```
This command will publish the filament-tel-input flags images

## Usage

```php
[
    \Jojostx\FilamentTelInput\Forms\FilamentTelInput::make('phone_number');
]
```

## Options
```php
[
    \InvadersXX\FilamentJsoneditor\Forms\JSONEditor::make('editor')
        ->height(500) // Set height to 500px, default is 300
        ->modes(['code', 'form', 'text', 'tree', 'view', 'preview']); // default is ['code', 'form', 'text', 'tree', 'view', 'preview']
]
```

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

-   [Jojostx](https://github.com/jojostx)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


* :selectedCountryPlaceholder ["0803 408 1360"]
* :selectedCountryData.name ["Nigeria"]
* :selectedCountryData.iso2 ["NG"]
* :selectedCountryData.dialcode ["234"]

