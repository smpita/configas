<?php

namespace Smpita\ConfigAs;

use Illuminate\Support\Facades\Config;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\TypeAs;

class ConfigAs
{
    /**
     * @throws TypeAsResolutionException
     */
    public static function array(string $key, ?array $default = null, ?ArrayResolver $resolver = null): array
    {
        return TypeAs::array(Config::get($key, $default), false, $resolver);
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass
     *
     * @throws TypeAsResolutionException
     */
    public static function class(string $class, string $key, ?object $default = null, ?ClassResolver $resolver = null)
    {
        return TypeAs::class($class, Config::get($key), $default, $resolver);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function float(string $key, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        return TypeAs::float(Config::get($key, $default), $default, $resolver);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function int(string $key, ?int $default = null, ?IntResolver $resolver = null): int
    {
        return TypeAs::int(Config::get($key, $default), $default, $resolver);
    }

    public static function nullableArray(string $key, ?array $default = null, ?NullableArrayResolver $resolver = null): ?array
    {
        return TypeAs::nullableArray(Config::get($key, $default), false, $resolver);
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    public static function nullableClass(string $class, string $key, ?object $default = null, ?NullableClassResolver $resolver = null)
    {
        return TypeAs::nullableClass($class, Config::get($key), $default, $resolver);
    }

    public static function nullableFloat(string $key, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
    {
        return TypeAs::nullableFloat(Config::get($key, $default), $default, $resolver);
    }

    public static function nullableInt(string $key, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
    {
        return TypeAs::nullableInt(Config::get($key, $default), $default, $resolver);
    }

    public static function nullableString(string $key, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
    {
        return TypeAs::nullableString(Config::get($key, $default), $default, $resolver);
    }

    /**
     * @throws TypeAsResolutionException
     */
    public static function string(string $key, ?string $default = null, ?StringResolver $resolver = null): string
    {
        return TypeAs::string(Config::get($key, $default), $default, $resolver);
    }
}
