<?php

namespace Smpita\ConfigAs;

use Smpita\ConfigAs\Exceptions\ConfigAsResolutionException;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Contracts\StringResolver;

/**
 * @throws ConfigAsResolutionException
 */
function configArray(string $key, ?array $default = null, ?ArrayResolver $resolver = null): array
{
    return ConfigAs::array($key, $default, $resolver);
}

/**
 * @throws ConfigAsResolutionException
 */
function configBool(string $key, ?bool $default = null, ?BoolResolver $resolver = null): bool
{
    return ConfigAs::bool($key, $default, $resolver);
}

/**
 * @template TClass of object
 *
 * @param  class-string<TClass>  $class
 * @param  TClass  $default
 * @return TClass
 *
 * @throws ConfigAsResolutionException
 */
function configClass(string $class, string $key, ?object $default = null, ?ClassResolver $resolver = null)
{
    return ConfigAs::class($class, $key, $default, $resolver);
}

/**
 * @throws ConfigAsResolutionException
 */
function configFloat(string $key, ?float $default = null, ?FloatResolver $resolver = null): float
{
    return ConfigAs::float($key, $default, $resolver);
}

/**
 * @throws ConfigAsResolutionException
 */
function configInt(string $key, ?int $default = null, ?IntResolver $resolver = null): int
{
    return ConfigAs::int($key, $default, $resolver);
}

function configNullableArray(string $key, ?array $default, ?NullableArrayResolver $resolver = null): ?array
{
    return ConfigAs::nullableArray($key, $default, $resolver);
}

function configNullableBool(string $key, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
{
    return ConfigAs::nullableBool($key, $default, $resolver);
}

/**
 * @template TClass of object
 *
 * @param  class-string<TClass>  $class
 * @param  TClass  $default
 * @return TClass|null
 */
function configNullableClass(string $class, string $key, ?object $default = null, ?NullableClassResolver $resolver = null)
{
    return ConfigAs::nullableClass($class, $key, $default, $resolver);
}

function configNullableFloat(string $key, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
{
    return ConfigAs::nullableFloat($key, $default, $resolver);
}

function configNullableInt(string $key, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
{
    return ConfigAs::nullableInt($key, $default, $resolver);
}

function configNullableString(string $key, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
{
    return ConfigAs::nullableString($key, $default, $resolver);
}

/**
 * @throws ConfigAsResolutionException
 */
function configString(string $key, ?string $default = null, ?StringResolver $resolver = null): string
{
    return ConfigAs::string($key, $default, $resolver);
}
