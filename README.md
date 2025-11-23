# Typed Config Resolver for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/smpita/configas.svg?style=flat-square)](https://packagist.org/packages/smpita/configas)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smpita/configas/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smpita/configas/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smpita/configas/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smpita/configas/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/smpita/configas.svg?style=flat-square)](https://packagist.org/packages/smpita/configas)
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fsmpita%2Fconfigas.svg?type=shield)](https://app.fossa.com/projects/git%2Bgithub.com%2Fsmpita%2Fconfigas?ref=badge_shield)

Do you use [Laravel](https://laravel.com) and fight the **mixed** signatures of `config()` when performing static analysis?

## [Smpita/ConfigAs](https://github.com/smpita/configas) types your config calls for you.

This package wraps [Smpita/TypeAs](https://github.com/smpita/typeas), a generalized PHP library useful on any PHP project employing static analysis or tight type enforcement.

## Installation

You can install the package via composer:

```bash
composer require smpita/configas
```

---

## Usage

Please see [SIGNATURES](docs/signatures.md) for the list of current methods and signatures.

### General Usage

[SIGNATURES#resolving](docs/signatures.md#resolving)

Pass a `key` and it will throw a `ConfigAsResolutionException` if the `key` isn't of the given type.

```php
use Smpita\ConfigAs\ConfigAs;

$typed = ConfigAs::int('config.key');
```

If you want to suppress throwing exceptions, provide a default.

```php
use Smpita\ConfigAs\ConfigAs;

$typed = ConfigAs::int('config.key', 123);
```

### The Class Method

[SIGNATURES#class](docs/signatures.md#class)

`class()` has a slightly different signature because you need to specify the class you are expecting.

```php
use Smpita\ConfigAs\ConfigAs;

$typed = ConfigAs::class(Target::class, 'config.key');
```

You can still provide a default.

```php
use Smpita\ConfigAs\ConfigAs;

$typed = ConfigAs::class(Target::class, 'config.key', new Target('default'));
```

---

## Nullables

If you would prefer to receive `null` instead of having an exception thrown, each type method has a nullable counterpart.

```php
use Smpita\ConfigAs\ConfigAs;

ConfigAs::nullableString('config.key') === null; // true
```

---

## Cache

[SIGNATURES#cache](docs/signatures.md#cache)

To keep things performant, types are only validated once and results are cached in static arrays for the lifetime of the request.
To guarantee a fresh value, you may use the `fresh` methods that are available for each type.

```php
use Smpita\ConfigAs\ConfigAs;

$typed = ConfigAs::freshString('config.key');
```

#### Forgetting

[SIGNATURES#forgetting](docs/signatures.md#forgetting)

For each type, you can forget any given cached value.

```php
use Smpita\ConfigAs\ConfigAs;

ConfigAs::forgetFloat('config.key');
```

You can flush the cache of a type.

```php
use Smpita\ConfigAs\ConfigAs;

ConfigAs::flushFloats();
```

You can flush all keys.

```php
use Smpita\ConfigAs\ConfigAs;

ConfigAs::flush();
```

---

## Resolvers

[SIGNATURES#resolver-registration](https://github.com/smpita/typeas/blob/main/docs/signatures.md#resolver-registration)

You can leverage the included [Smpita\TypeAs](https://github.com/smpita/typeas/) library to create your own custom resolvers. For creation, global registration, and full instructions, see the [library docs](https://github.com/smpita/typeas/blob/main/README.md#resolvers).

#### Single use

```php
$typed = Smpita\ConfigAs::string('config.key', null, new CustomStringResolver);
```

---

## Helpers

[SIGNATURES#helpers](docs/signatures.md#helpers)

There is a `configAs()` helper method located in the `Smpita\ConfigAs` namespace.

```php
use function Smpita\ConfigAs\configAs;

$configAs = configAs();

$string = $configAs->string('config.string.key');
$array = $configAs->array('config.array.key');
```

Resolver methods have an associated helper method located in the `Smpita\ConfigAs` namespace.
The helper method names follow the `ConfigAs` method names, but are prepended by `config` and are **camelCased**.

```php
use function Smpita\ConfigAs\configString;

$typed = configString('config.key');
```

---

## Deprecations

[SIGNATURES#deprecations](docs/signatures.md#deprecations)

---

## Testing

```bash
composer test
```

---

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Sean Pearce](https://github.com/smpita)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fsmpita%2Fconfigas.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2Fsmpita%2Fconfigas?ref=badge_large)