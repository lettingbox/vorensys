# Laravel Vorensys API Integration

[![StyleCI](https://github.styleci.io/repos/184726433/shield?branch=master)](https://github.styleci.io/repos/184726433)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/lettingbox/vorensys.svg?style=flat-square)](https://packagist.org/packages/lettingbox/vorensys)
[![Build Status](https://img.shields.io/travis/lettingbox/vorensys/master.svg?style=flat-square)](https://travis-ci.org/lettingbox/vorensys)
[![Total Downloads](https://img.shields.io/packagist/dt/lettingbox/vorensys.svg?style=flat-square)](https://packagist.org/packages/lettingbox/vorensys)


A Laravel 5 package to integrate with [Vorensys](https://www.vorensys.com) API.

## Installation

You can install the package via composer:

```bash
composer require lettingbox/vorensys
```

## Usage

``` php
$vorensys = new Vorensys($client)
    ->setApiKey('KEY')
    ->setId('CUST_ID')
    ->setUsername('USERNAME')
    ->setPassword('PASSWORD');
$results = $vorensys->submit(new Application('Mr.', 'John', 'Doe', 'human@world.com'));
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email hello@lettingbox.co.uk instead of using the issue tracker.

## Credits

- [Khaled Elmahdi](https://github.com/lettingbox)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
