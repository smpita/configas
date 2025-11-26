<div align="center">

# Typed Config Resolver for Laravel
Don't settle for **mixed** signatures from `config()` when you can enforce types.

[![Total Downloads](https://img.shields.io/packagist/dt/smpita/configas.svg?style=flat-square)](https://packagist.org/packages/smpita/configas)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/smpita/configas.svg?style=flat-square)](https://packagist.org/packages/smpita/configas)
[![License](https://img.shields.io/packagist/l/smpita/configas.svg?style=flat-square)](https://packagist.org/packages/smpita/configas)

[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smpita/configas/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smpita/configas/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smpita/configas/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smpita/configas/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fsmpita%2Fconfigas.svg?type=shield&issueType=security)](https://app.fossa.com/projects/git%2Bgithub.com%2Fsmpita%2Fconfigas?ref=badge_shield&issueType=security)
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fsmpita%2Fconfigas.svg?type=shield&issueType=license)](https://app.fossa.com/projects/git%2Bgithub.com%2Fsmpita%2Fconfigas?ref=badge_shield&issueType=license)

</div>

---

## Table of Contents
- [Quick Start](#quick-start)
  - [Installation](#installation)
  - [Resolving Types](#resolving-types)
  - [Cache](#cache)
  - [Cache Invalidation](#cache-invalidation)
  - [Fresh Values](#fresh-values)
  - [Helpers](#helpers)
- [Deprecations](#deprecations)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Security Vulnerabilities](#security-vulnerabilities)
- [Credits](#credits)
- [License](#license)

---

This package wraps [Smpita/TypeAs](https://github.com/smpita/typeas), a generalized PHP library useful on any PHP project employing static analysis or tight type enforcement.

## Quick Start

### Installation

Install the package via composer:

```bash
composer require smpita/configas
```

See [SIGNATURES](docs/signatures.md) for the full list of methods and signatures.

### Resolving types

[SIGNATURES#resolving](docs/signatures.md#resolving)

```php
use Smpita\ConfigAs\ConfigAs;

// Throws \Smpita\ConfigAs\ConfigAsResolutionException if 'config.key' can't resolve to the type.
$array = ConfigAs::array('config.key');
$bool = ConfigAs::bool('config.key');
$class = ConfigAs::class(Expected::class, 'config.key');
$float = ConfigAs::float('config.key');
$int = ConfigAs::int('config.key');
$string = ConfigAs::string('config.key');

// Returns null if 'config.key' can't resolve to the type.
$nullableArray = ConfigAs::nullableArray('config.key');
$nullableBool = ConfigAs::nullableBool('config.key');
$nullableClass = ConfigAs::nullableClass(Expected::class, 'config.key');
$nullableFloat = ConfigAs::nullableFloat('config.key');
$nullableInt = ConfigAs::nullableInt('config.key');
$nullableString = ConfigAs::nullableString('config.key');
```

To suppress throwing exceptions, provide a default.

```php
use Smpita\ConfigAs\ConfigAs;

// Returns the default if passed null, or if 'config.key' can't resolve to the type.
$array = ConfigAs::array('config.key', []);
$bool = ConfigAs::bool('config.key', false);
$class = ConfigAs::class(Expected::class, 'config.key', new StdClass());
$float = ConfigAs::float('config.key', 0.0);
$int = ConfigAs::int('config.key', 0);
$string = ConfigAs::string('config.key', '');

// Nullable types can specify defaults.
$nullableArray = ConfigAs::nullableArray('config.key', []);
$nullableBool = ConfigAs::nullableBool('config.key', false);
$nullableClass = ConfigAs::nullableClass(Expected::class, 'config.key', new StdClass());
$nullableFloat = ConfigAs::nullableFloat('config.key', 0.0);
$nullableInt = ConfigAs::nullableInt('config.key', 0);
$nullableString = ConfigAs::nullableString('config.key', '');
```

---

## Cache

[SIGNATURES#cache](docs/signatures.md#cache)

To keep things performant, types are validated once and results are cached in static arrays for the lifetime of the request.

### Cache Invalidation

[SIGNATURES#cache-invalidation](docs/signatures.md#cache-invalidation)

You can flush all caches or invalidate any given key.

```php
use Smpita\ConfigAs\ConfigAs;

// Invalidate all caches
ConfigAs::flush();

// Invalidate all of a type
ConfigAs::flushArrays();
ConfigAs::flushBools();
ConfigAs::flushClasses();
ConfigAs::flushInts();
ConfigAs::flushStrings();

// Invalidate a specific key
ConfigAs::forgetArray('config.key');
ConfigAs::forgetBool('config.key');
ConfigAs::forgetClass(Expected::class, 'config.key');
ConfigAs::forgetFloat('config.key');
ConfigAs::forgetInt('config.key');
ConfigAs::forgetString('config.key');
ConfigAs::forgetNullableArray('config.key');
ConfigAs::forgetNullableBool('config.key');
ConfigAs::forgetNullableClass(Expected::class, 'config.key');
ConfigAs::forgetNullableFloat('config.key');
ConfigAs::forgetNullableInt('config.key');
ConfigAs::forgetNullableString('config.key');
```

### Fresh values

To bypass the cache, you may use the `fresh` methods that are available for each type.
This method bypasses the cache entirely. Returns from these methods will not be cached.
To update a cache, [invalidate](#cache-invalidation) the `config.key`, then use a [standard resolver](#resolving-types).

```php
use Smpita\ConfigAs\ConfigAs;

$array = ConfigAs::freshArray('config.key');
$bool = ConfigAs::freshBool('config.key');
$class = ConfigAs::freshClass(Expected::class, 'config.key');
$float = ConfigAs::freshFloat('config.key');
$int = ConfigAs::freshInt('config.key');
$string = ConfigAs::freshString('config.key');
$nullableArray = ConfigAs::freshNullableArray('config.key');
$nullableBool = ConfigAs::freshNullableBool('config.key');
$nullableClass = ConfigAs::freshNullableClass(Expected::class, 'config.key');
$nullableFloat = ConfigAs::freshNullableFloat('config.key');
$nullableInt = ConfigAs::freshNullableInt('config.key');
$nullableString = ConfigAs::freshNullableString('config.key');
```
---

## Helpers

[SIGNATURES#helpers](docs/signatures.md#helpers)

There are helper methods located in the `Smpita\ConfigAs` namespace.

```php
use function Smpita\ConfigAs\configArray;
use function Smpita\ConfigAs\configBool;
use function Smpita\ConfigAs\configClass;
use function Smpita\ConfigAs\configFloat;
use function Smpita\ConfigAs\configInt;
use function Smpita\ConfigAs\configString;
use function Smpita\ConfigAs\configNullableArray;
use function Smpita\ConfigAs\configNullableBool;
use function Smpita\ConfigAs\configNullableClass;
use function Smpita\ConfigAs\configNullableFloat;
use function Smpita\ConfigAs\configNullableInt;
use function Smpita\ConfigAs\configNullableString;

$array = configArray('config.key');
$bool = configBool('config.key');
$class = configClass(Expected::class, 'config.key');
$float = configFloat('config.key');
$int = configInt('config.key');
$string = configString('config.key');
$nullableArray = configNullableArray('config.key');
$nullableBool = configNullableBool('config.key');
$nullableClass = configNullableClass(Expected::class, 'config.key');
$nullableFloat = configNullableFloat('config.key');
$nullableInt = configNullableInt('config.key');
$nullableString = configNullableString('config.key');
```

Additionally:

```php
use function Smpita\ConfigAs\configAs;

$configAs = configAs();

$array = $configAs->array('config.key');
$bool = $configAs->bool('config.key');
$class = $configAs->class(Expected::class, 'config.key');
$float = $configAs->float('config.key');
$int = $configAs->int('config.key');
$string = $configAs->string('config.key');
$nullableArray = $configAs->nullableArray('config.key');
$nullableBool = $configAs->nullableBool('config.key');
$nullableClass = $configAs->nullableClass(Expected::class, 'config.key');
$nullableFloat = $configAs->nullableFloat('config.key');
$nullableInt = $configAs->nullableInt('config.key');
$nullableString = $configAs->nullableString('config.key');
```

---

## Custom Resolvers

[SIGNATURES#resolver-registration](https://github.com/smpita/typeas/blob/main/docs/signatures.md#resolver-registration)

ConfigAs methods will pass custom resolves to the underlying [Smpita\TypeAs](https://github.com/smpita/typeas/) library to enable you to use your own custom resolvers. For creation, global registration, and full instructions, see the [library docs](https://github.com/smpita/typeas/blob/main/README.md#resolvers).

#### Single use

```php
$string = \Smpita\ConfigAs::string('config.key', null, new CustomStringResolver());
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

Please see [RELEASES](https://github.com/smpita/configas/releases) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Sean Pearce](https://github.com/smpita)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
