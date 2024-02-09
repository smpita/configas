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
            self::forgetArray($key);

            return self::$arrays[$key] = TypeAs::array(Config::get($key, $default), false, $resolver);
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
            self::forgetBool($key);

            return self::$bools[$key] = TypeAs::bool(Config::get($key, $default), false, $resolver);
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
            self::forgetClass($key);

            return self::$classes[$key] = TypeAs::class($expected, Config::get($key), $default, $resolver);
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
            self::forgetFloat($key);

            return self::$floats[$key] = TypeAs::float(Config::get($key, $default), $default, $resolver);
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
            self::forgetInt($key);

            return self::$ints[$key] = TypeAs::int(Config::get($key, $default), $default, $resolver);
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
            self::forgetString($key);

            return self::$strings[$key] = TypeAs::string(Config::get($key, $default), $default, $resolver);
        } catch (TypeAsResolutionException $e) {
            throw new ConfigAsResolutionException("config('$key') is not a string", 0, $e);
        }
    }

    public static function freshNullableArray(string $key, ?array $default = null, ?NullableArrayResolver $resolver = null): ?array
    {
        self::forgetNullableArray($key);

        return self::$nullableArrays[$key] = TypeAs::nullableArray(Config::get($key, $default), false, $resolver);
    }

    public static function freshNullableBool(string $key, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
    {
        self::forgetNullableBool($key);

        return self::$nullableBools[$key] = TypeAs::nullableBool(Config::get($key, $default), $default, $resolver);
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
        self::forgetNullableClass($key);

        return self::$nullableClasses[$key] = TypeAs::nullableClass($class, Config::get($key), $default, $resolver);
    }

    public static function freshNullableFloat(string $key, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
    {
        self::forgetNullableFloat($key);

        return self::$nullableFloats[$key] = TypeAs::nullableFloat(Config::get($key, $default), $default, $resolver);
    }

    public static function freshNullableInt(string $key, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
    {
        self::forgetNullableInt($key);

        return self::$nullableInts[$key] = TypeAs::nullableInt(Config::get($key, $default), $default, $resolver);
    }

    public static function freshNullableString(string $key, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
    {

        self::forgetNullableString($key);

        return self::$nullableStrings[$key] = TypeAs::nullableString(Config::get($key, $default), $default, $resolver);
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

    public static function flushArrays(): void
    {
        self::$arrays = [];
    }

    public static function flushBools(): void
    {
        self::$bools = [];
    }

    public static function flushClasses(): void
    {
        self::$classes = [];
    }

    public static function flushFloats(): void
    {
        self::$floats = [];
    }

    public static function flushInts(): void
    {
        self::$ints = [];
    }

    public static function flushStrings(): void
    {
        self::$nullableStrings = [];
    }

    public static function flushNullableArrays(): void
    {
        self::$nullableArrays = [];
    }

    public static function flushNullableBools(): void
    {
        self::$nullableBools = [];
    }

    public static function flushNullableClasses(): void
    {
        self::$nullableClasses = [];
    }

    public static function flushNullableFloats(): void
    {
        self::$nullableFloats = [];
    }

    public static function flushNullableInts(): void
    {
        self::$nullableInts = [];
    }

    public static function flushNullableStrings(): void
    {
        self::$nullableStrings = [];
    }

    public static function flush(): void
    {
        self::flushArrays();
        self::flushBools();
        self::flushClasses();
        self::flushFloats();
        self::flushInts();
        self::flushStrings();
        self::flushNullableArrays();
        self::flushNullableBools();
        self::flushNullableClasses();
        self::flushNullableFloats();
        self::flushNullableInts();
        self::flushNullableStrings();
    }
}
