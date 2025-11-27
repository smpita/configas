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
        if (array_key_exists($key, self::$arrays)) {
            return self::$arrays[$key];
        }

        try {
            return self::$arrays[$key] = self::freshArray($key, null, $resolver);
        } catch (ConfigAsResolutionException $e) {
            if (is_null($default)) {
                throw $e;
            }

            return $default;
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function bool(string $key, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        if (array_key_exists($key, self::$bools)) {
            return self::$bools[$key];
        }

        try {
            return self::$bools[$key] = self::freshBool($key, null, $resolver);
        } catch (ConfigAsResolutionException $e) {
            if (is_null($default)) {
                throw $e;
            }

            return $default;
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
    public static function class(string $expected, string $key, ?object $default = null, ?ClassResolver $resolver = null)
    {
        if (array_key_exists($key, self::$classes)) {
            /** @var TClass */
            return self::$classes[$key];
        }

        try {
            return self::$classes[$key] = self::freshClass($expected, $key, null, $resolver);
        } catch (ConfigAsResolutionException $e) {
            if (is_null($default)) {
                throw $e;
            }

            return $default;
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function float(string $key, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        if (array_key_exists($key, self::$floats)) {
            return self::$floats[$key];
        }

        try {
            return self::$floats[$key] = self::freshFloat($key, null, $resolver);
        } catch (ConfigAsResolutionException $e) {
            if (is_null($default)) {
                throw $e;
            }

            return $default;
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function int(string $key, ?int $default = null, ?IntResolver $resolver = null): int
    {
        if (array_key_exists($key, self::$ints)) {
            return self::$ints[$key];
        }

        try {
            return self::$ints[$key] = self::freshInt($key, null, $resolver);
        } catch (ConfigAsResolutionException $e) {
            if (is_null($default)) {
                throw $e;
            }

            return $default;
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function string(string $key, ?string $default = null, ?StringResolver $resolver = null): string
    {
        if (array_key_exists($key, self::$strings)) {
            return self::$strings[$key];
        }

        try {
            return self::$strings[$key] = self::freshString($key, null, $resolver);
        } catch (ConfigAsResolutionException $e) {
            if (is_null($default)) {
                throw $e;
            }

            return $default;
        }
    }

    public static function nullableArray(string $key, ?array $default = null, ?NullableArrayResolver $resolver = null): ?array
    {
        if (array_key_exists($key, self::$nullableArrays)) {
            return self::$nullableArrays[$key] ?? $default;
        }

        self::$nullableArrays[$key] = self::freshNullableArray($key, null, $resolver);

        return self::$nullableArrays[$key] ?? $default;
    }

    public static function nullableBool(string $key, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
    {
        if (array_key_exists($key, self::$nullableBools)) {
            return self::$nullableBools[$key] ?? $default;
        }

        self::$nullableBools[$key] = self::freshNullableBool($key, null, $resolver);

        return self::$nullableBools[$key] ?? $default;
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
        if (array_key_exists($key, self::$nullableClasses)) {
            /** @var TClass */
            return self::$nullableClasses[$key] ?? $default;
        }

        self::$nullableClasses[$key] = self::freshNullableClass($expected, $key, null, $resolver);

        return self::$nullableClasses[$key] ?? $default;
    }

    public static function nullableFloat(string $key, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
    {
        if (array_key_exists($key, self::$nullableFloats)) {
            return self::$nullableFloats[$key] ?? $default;
        }

        self::$nullableFloats[$key] = self::freshNullableFloat($key, null, $resolver);

        return self::$nullableFloats[$key] ?? $default;
    }

    public static function nullableInt(string $key, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
    {
        if (array_key_exists($key, self::$nullableInts)) {
            return self::$nullableInts[$key] ?? $default;
        }

        self::$nullableInts[$key] = self::freshNullableInt($key, null, $resolver);

        return self::$nullableInts[$key] ?? $default;
    }

    public static function nullableString(string $key, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
    {
        if (array_key_exists($key, self::$nullableStrings)) {
            return self::$nullableStrings[$key] ?? $default;
        }

        self::$nullableStrings[$key] = self::freshNullableString($key, null, $resolver);

        return self::$nullableStrings[$key] ?? $default;
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function freshArray(string $key, ?array $default = null, ?ArrayResolver $resolver = null): array
    {
        try {
            return TypeAs::array(Config::get($key, $default), false, $resolver);
        } catch (TypeAsResolutionException|UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not an array", $e->getCode(), $e);
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function freshBool(string $key, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        try {
            return TypeAs::bool(Config::get($key, $default), $default, $resolver);
        } catch (TypeAsResolutionException|UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not a boolean", $e->getCode(), $e);
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
            return TypeAs::class($expected, Config::get($key, $default), $default, $resolver);
        } catch (TypeAsResolutionException|UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not the class $expected", $e->getCode(), $e);
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function freshFloat(string $key, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        try {
            return TypeAs::float(Config::get($key, $default), $default, $resolver);
        } catch (TypeAsResolutionException|UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not a float", $e->getCode(), $e);
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function freshInt(string $key, ?int $default = null, ?IntResolver $resolver = null): int
    {
        try {
            return TypeAs::int(Config::get($key, $default), $default, $resolver);
        } catch (TypeAsResolutionException|UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not an int", $e->getCode(), $e);
        }
    }

    /**
     * @throws ConfigAsResolutionException
     */
    public static function freshString(string $key, ?string $default = null, ?StringResolver $resolver = null): string
    {
        try {
            return TypeAs::string(Config::get($key, $default), $default, $resolver);
        } catch (TypeAsResolutionException|UnexpectedValueException $e) {
            throw new ConfigAsResolutionException("config('$key') is not a string", $e->getCode(), $e);
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
        unset(self::$strings[$key]);
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
        self::$strings = [];
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
