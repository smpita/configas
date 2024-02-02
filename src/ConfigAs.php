<?php

namespace Smpita\ConfigAs;

use Illuminate\Support\Facades\Config;
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
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\TypeAs;
use UnexpectedValueException;

class ConfigAs
{
    /**
     * @var array<string, array<mixed>>
     */
    protected static array $arrays = [];

    /**
     * @var array<string, bool>
     */
    protected static array $bools = [];

    protected static array $classes = [];

    /**
     * @var array<string, float>
     */
    protected static array $floats = [];

    /**
     * @var array<string, int>
     */
    protected static array $ints = [];

    /**
     * @var array<string, ?array<mixed>>
     */
    protected static array $nullableArrays = [];

    /**
     * @var array<string, ?bool>
     */
    protected static array $nullableBools = [];

    protected static array $nullableClasses = [];

    /**
     * @var array<string, ?float>
     */
    protected static array $nullableFloats = [];

    /**
     * @var array<string, ?int>
     */
    protected static array $nullableInts = [];

    /**
     * @var array<string, ?string>
     */
    protected static array $nullableStrings = [];

    /**
     * @var array<string, string>
     */
    protected static array $strings = [];

    /**
     * @throws ConfigAsResolutionException
     */
    public static function array(string $key, ?array $default = null, ?ArrayResolver $resolver = null): array
    {
        try {
            return self::$arrays[$key] ??= TypeAs::array(Config::get($key, $default), false, $resolver);
        } catch (UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not an array", 0, $e);
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function bool(string $key, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        try {
            return self::$bools[$key] ??= TypeAs::bool(Config::get($key, $default), false, $resolver);
        } catch (UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not a boolean", 0, $e);
        }
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
    public static function class(string $class, string $key, ?object $default = null, ?ClassResolver $resolver = null)
    {
        try {
            return self::$classes[$key] ??= TypeAs::class($class, Config::get($key), $default, $resolver);
        } catch (UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not the class $class", 0, $e);
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function float(string $key, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        try {
            return self::$floats[$key] ??= TypeAs::float(Config::get($key, $default), $default, $resolver);
        } catch (UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not a float", 0, $e);
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function int(string $key, ?int $default = null, ?IntResolver $resolver = null): int
    {
        try {
            return self::$ints[$key] ??= TypeAs::int(Config::get($key, $default), $default, $resolver);
        } catch (UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not an int", 0, $e);
        }
    }

    public static function nullableArray(string $key, ?array $default = null, ?NullableArrayResolver $resolver = null): ?array
    {
        return array_key_exists($key, self::$nullableArrays)
            ? self::$nullableArrays[$key]
            : self::$nullableArrays[$key] = TypeAs::nullableArray(Config::get($key, $default), false, $resolver);
    }

    public static function nullableBool(string $key, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
    {
        return array_key_exists($key, self::$nullableBools)
            ? self::$nullableBools[$key]
            : self::$nullableBools[$key] = TypeAs::nullableBool(Config::get($key, $default), $default, $resolver);
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
        return array_key_exists($key, self::$nullableClasses)
            ? self::$nullableClasses[$key]
            : self::$nullableClasses[$key] = TypeAs::nullableClass($class, Config::get($key), $default, $resolver);
    }

    public static function nullableFloat(string $key, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
    {
        return array_key_exists($key, self::$nullableFloats)
            ? self::$nullableFloats[$key]
            : self::$nullableFloats[$key] = TypeAs::nullableFloat(Config::get($key, $default), $default, $resolver);
    }

    public static function nullableInt(string $key, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
    {
        return array_key_exists($key, self::$nullableInts)
            ? self::$nullableInts[$key]
            : self::$nullableInts[$key] = TypeAs::nullableInt(Config::get($key, $default), $default, $resolver);
    }

    public static function nullableString(string $key, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
    {
        return array_key_exists($key, self::$nullableStrings)
        ? self::$nullableStrings[$key]
        : self::$nullableStrings[$key] = TypeAs::nullableString(Config::get($key, $default), $default, $resolver);
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function string(string $key, ?string $default = null, ?StringResolver $resolver = null): string
    {
        try {
            return self::$nullableStrings[$key] ??= TypeAs::string(Config::get($key, $default), $default, $resolver);
        } catch (TypeAsResolutionException $e) {
            throw new ConfigAsResolutionException("config('$key') is not a string", 0, $e);
        }
    }
}
