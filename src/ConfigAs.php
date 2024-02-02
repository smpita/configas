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
        return self::$arrays[$key] ??= self::freshArray($key, $default, $resolver);
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function bool(string $key, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        return self::$bools[$key] ??= self::freshBool($key, $default, $resolver);
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $expected
     * @param  TClass  $default
     * @return TClass
     *
     * @throws ConfigAsResolutionException
     */
    public static function class(string $expected, string $key, ?object $default = null, ?ClassResolver $resolver = null)
    {
        return self::$classes[$key] ??= self::freshClass($expected, $key, $default, $resolver);
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function float(string $key, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        return self::$floats[$key] ??= self::freshFloat($key, $default, $resolver);
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function int(string $key, ?int $default = null, ?IntResolver $resolver = null): int
    {
        return self::$ints[$key] ??= self::freshInt($key, $default, $resolver);
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function string(string $key, ?string $default = null, ?StringResolver $resolver = null): string
    {
        return self::$nullableStrings[$key] ??= self::freshString($key, $default, $resolver);
    }

    public static function nullableArray(string $key, ?array $default = null, ?NullableArrayResolver $resolver = null): ?array
    {
        return array_key_exists($key, self::$nullableArrays)
            ? self::$nullableArrays[$key]
            : self::$nullableArrays[$key] = self::freshNullableArray($key, $default, $resolver);
    }

    public static function nullableBool(string $key, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
    {
        return array_key_exists($key, self::$nullableBools)
            ? self::$nullableBools[$key]
            : self::$nullableBools[$key] = self::freshNullableBool($key, $default, $resolver);
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $expected
     * @param  TClass  $default
     * @return TClass|null
     */
    public static function nullableClass(string $expected, string $key, ?object $default = null, ?NullableClassResolver $resolver = null)
    {
        return array_key_exists($key, self::$nullableClasses)
            ? self::$nullableClasses[$key]
            : self::$nullableClasses[$key] = self::freshNullableClass($expected, $key, $default, $resolver);
    }

    public static function nullableFloat(string $key, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
    {
        return array_key_exists($key, self::$nullableFloats)
            ? self::$nullableFloats[$key]
            : self::$nullableFloats[$key] = self::freshNullableFloat($key, $default, $resolver);
    }

    public static function nullableInt(string $key, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
    {
        return array_key_exists($key, self::$nullableInts)
            ? self::$nullableInts[$key]
            : self::$nullableInts[$key] = self::freshNullableInt($key, $default, $resolver);
    }

    public static function nullableString(string $key, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
    {
        return array_key_exists($key, self::$nullableStrings)
            ? self::$nullableStrings[$key]
            : self::$nullableStrings[$key] = self::freshNullableString($key, $default, $resolver);
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function freshArray(string $key, ?array $default = null, ?ArrayResolver $resolver = null): array
    {
        try {
            return TypeAs::array(Config::get($key, $default), false, $resolver);
        } catch (UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not an array", 0, $e);
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function freshBool(string $key, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        try {
            return TypeAs::bool(Config::get($key, $default), false, $resolver);
        } catch (UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not a boolean", 0, $e);
        }
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $expected
     * @param  TClass  $default
     * @return TClass
     *
     * @throws ConfigAsResolutionException
     */
    public static function freshClass(string $expected, string $key, ?object $default = null, ?ClassResolver $resolver = null)
    {
        try {
            return TypeAs::class($expected, Config::get($key), $default, $resolver);
        } catch (UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not the class $expected", 0, $e);
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function freshFloat(string $key, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        try {
            return TypeAs::float(Config::get($key, $default), $default, $resolver);
        } catch (UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not a float", 0, $e);
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function freshInt(string $key, ?int $default = null, ?IntResolver $resolver = null): int
    {
        try {
            return TypeAs::int(Config::get($key, $default), $default, $resolver);
        } catch (UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not an int", 0, $e);
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function freshString(string $key, ?string $default = null, ?StringResolver $resolver = null): string
    {
        try {
            return TypeAs::string(Config::get($key, $default), $default, $resolver);
        } catch (TypeAsResolutionException $e) {
            throw new ConfigAsResolutionException("config('$key') is not a string", 0, $e);
        }
    }

    public static function freshNullableArray(string $key, ?array $default = null, ?NullableArrayResolver $resolver = null): ?array
    {
        return TypeAs::nullableArray(Config::get($key, $default), false, $resolver);
    }

    public static function freshNullableBool(string $key, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
    {
        return TypeAs::nullableBool(Config::get($key, $default), $default, $resolver);
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    public static function freshNullableClass(string $class, string $key, ?object $default = null, ?NullableClassResolver $resolver = null)
    {
        return TypeAs::nullableClass($class, Config::get($key), $default, $resolver);
    }

    public static function freshNullableFloat(string $key, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
    {
        return TypeAs::nullableFloat(Config::get($key, $default), $default, $resolver);
    }

    public static function freshNullableInt(string $key, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
    {
        return TypeAs::nullableInt(Config::get($key, $default), $default, $resolver);
    }

    public static function freshNullableString(string $key, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
    {
        return TypeAs::nullableString(Config::get($key, $default), $default, $resolver);
    }

    public static function forgetArray(string $key): void
    {
        unset(self::$arrays[$key]);
    }

    public static function forgetBool(string $key): void
    {
        unset(self::$bools[$key]);
    }

    public static function forgetClass(string $key): void
    {
        unset(self::$classes[$key]);
    }

    public static function forgetFloat(string $key): void
    {
        unset(self::$floats[$key]);
    }

    public static function forgetInt(string $key): void
    {
        unset(self::$ints[$key]);
    }

    public static function forgetString(string $key): void
    {
        unset(self::$nullableStrings[$key]);
    }

    public static function forgetNullableArray(string $key): void
    {
        unset(self::$nullableArrays[$key]);
    }

    public static function forgetNullableBool(string $key): void
    {
        unset(self::$nullableBools[$key]);
    }

    public static function forgetNullableClass(string $key): void
    {
        unset(self::$nullableClasses[$key]);
    }

    public static function forgetNullableFloat(string $key): void
    {
        unset(self::$nullableFloats[$key]);
    }

    public static function forgetNullableInt(string $key): void
    {
        unset(self::$nullableInts[$key]);
    }

    public static function forgetNullableString(string $key): void
    {
        unset(self::$nullableStrings[$key]);
    }

    public static function forgetArrays(): void
    {
        self::$arrays = [];
    }

    public static function forgetBools(): void
    {
        self::$bools = [];
    }

    public static function forgetClasses(): void
    {
        self::$classes = [];
    }

    public static function forgetFloats(): void
    {
        self::$floats = [];
    }

    public static function forgetInts(): void
    {
        self::$ints = [];
    }

    public static function forgetStrings(): void
    {
        self::$nullableStrings = [];
    }

    public static function forgetNullableArrays(): void
    {
        self::$nullableArrays = [];
    }

    public static function forgetNullableBools(): void
    {
        self::$nullableBools = [];
    }

    public static function forgetNullableClasses(): void
    {
        self::$nullableClasses = [];
    }

    public static function forgetNullableFloats(): void
    {
        self::$nullableFloats = [];
    }

    public static function forgetNullableInts(): void
    {
        self::$nullableInts = [];
    }

    public static function forgetNullableStrings(): void
    {
        self::$nullableStrings = [];
    }

    public static function forgetAll(): void
    {
        self::forgetArrays();
        self::forgetBools();
        self::forgetClasses();
        self::forgetFloats();
        self::forgetInts();
        self::forgetStrings();
        self::forgetNullableArrays();
        self::forgetNullableBools();
        self::forgetNullableClasses();
        self::forgetNullableFloats();
        self::forgetNullableInts();
        self::forgetNullableStrings();
    }
}
