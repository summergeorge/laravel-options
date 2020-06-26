# Laravel Options

[![Latest Version on Packagist](https://img.shields.io/packagist/v/summergeorge/laravel-options.svg?style=flat-square)](https://packagist.org/packages/summergeorge/laravel-options)
[![Total Downloads](https://img.shields.io/packagist/dt/summergeorge/laravel-options.svg?style=flat-square)](https://packagist.org/packages/summergeorge/laravel-options)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/summergeorge/laravel-options.svg?branch=master)](https://travis-ci.org/summergeorge/laravel-options)

Global key-value store in the database

## Thank You
[https://github.com/appstract/laravel-options](https://github.com/appstract/laravel-options)

## Installation

To get started with laravel-options, use Composer to add the package to your project's dependencies:

```bash
composer require summergeorge/laravel-options ^6.0
```

### Publish, migrate

By running `php artisan vendor:publish --provider="summergeorge\Options\OptionsServiceProvider"` in your project all files for this package will be published. For this package, it's only a migration. Run `php artisan migrate` to migrate the table. There will now be an `options` table in your database.

## Usage

With the `option()` helper, we can get and set options:

```php
// Get option
option('someKey');

// Get option, with a default fallback value if the key doesn't exist
option('someKey', 'Some default value if the key is not found');

// Set option
option(['someKey' => 'someValue']);

// Remove option
option()->remove('someKey');

// Check the option exists
option_exists('someKey');
```

If you want to check if an option exists, you can use the facade:

```php
use Option;

$check = Option::exists('someKey');
```

### Console

It is also possible to set options within the console:

```bash
php artisan option:set {someKey} {someValue}
```

## Testing

```bash
$ composer test
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
