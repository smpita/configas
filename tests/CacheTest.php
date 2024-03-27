<?php

use Illuminate\Support\Facades\Config;
use Smpita\ConfigAs\ConfigAs;
use Smpita\ConfigAs\Tests\Stubs\ClassStub;

it('can cache arrays', function () {
    $key = 'testing.cache.array';
    $cached = ['cached'];
    $new = [];

    Config::set($key, $cached);
    ConfigAs::array($key);
    Config::set($key, $new);

    $value = ConfigAs::array($key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can cache bools', function () {
    $key = 'testing.cache.bool';
    $cached = false;
    $new = true;

    Config::set($key, $cached);
    ConfigAs::bool($key);
    Config::set($key, $new);

    $value = ConfigAs::bool($key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can cache classes', function () {
    $key = 'testing.cache.class';
    $cached = new CacheClassStub();
    $new = new ClassStub();

    Config::set($key, $cached);
    ConfigAs::class(ClassStub::class, $key);
    Config::set($key, $new);

    $value = ConfigAs::class(ClassStub::class, $key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can cache floats', function () {
    $key = 'testing.cache.float';
    $cached = 0.1;
    $new = 0.2;

    Config::set($key, $cached);
    ConfigAs::float($key);
    Config::set($key, $new);

    $value = ConfigAs::float($key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can cache ints', function () {
    $key = 'testing.cache.int';
    $cached = 5;
    $new = 10;

    Config::set($key, $cached);
    ConfigAs::int($key);
    Config::set($key, $new);

    $value = ConfigAs::int($key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can cache nullable arrays', function () {
    $key = 'testing.cache.nullable_array';
    $cached = [];
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableArray($key);
    Config::set($key, $new);

    $value = ConfigAs::nullableArray($key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can cache nullable bools', function () {
    $key = 'testing.cache.nullable_bool';
    $cached = true;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableBool($key);
    Config::set($key, $new);

    $value = ConfigAs::nullableBool($key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can cache nullable classes', function () {
    $key = 'testing.cache.nullable_class';
    $cached = new ClassStub();
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableClass(ClassStub::class, $key);
    Config::set($key, $new);

    $value = ConfigAs::nullableClass(ClassStub::class, $key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can cache nullable floats', function () {
    $key = 'testing.cache.nullable_float';
    $cached = 0.1;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableFloat($key);
    Config::set($key, $new);

    $value = ConfigAs::nullableFloat($key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can cache nullable ints', function () {
    $key = 'testing.cache.nullable_int';
    $cached = 5;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableInt($key);
    Config::set($key, $new);

    $value = ConfigAs::nullableInt($key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can cache nullable strings', function () {
    $key = 'testing.cache.nullable_string';
    $cached = 'a';
    $new = 'b';

    Config::set($key, $cached);
    ConfigAs::string($key);
    Config::set($key, $new);

    $value = ConfigAs::string($key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can cache strings', function () {
    $key = 'testing.cache.nullable_string';
    $cached = 'string';
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableString($key);
    Config::set($key, $new);

    $value = ConfigAs::nullableString($key);
    expect($value)->toEqual($cached);
    expect($value)->not->toEqual($new);
});

it('can read fresh arrays', function () {
    $key = 'testing.cache.array';
    $cached = ['cached'];
    $new = [];

    Config::set($key, $cached);
    ConfigAs::array($key);
    Config::set($key, $new);

    $value = ConfigAs::freshArray($key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('can read fresh bools', function () {
    $key = 'testing.cache.bool';
    $cached = false;
    $new = true;

    Config::set($key, $cached);
    ConfigAs::bool($key);
    Config::set($key, $new);

    $value = ConfigAs::freshBool($key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('can read fresh classes', function () {
    $key = 'testing.cache.class';
    $cached = new CacheClassStub();
    $new = new ClassStub();

    Config::set($key, $cached);
    ConfigAs::class(ClassStub::class, $key);
    Config::set($key, $new);

    $value = ConfigAs::freshClass(ClassStub::class, $key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('can read fresh floats', function () {
    $key = 'testing.cache.float';
    $cached = 0.1;
    $new = 0.2;

    Config::set($key, $cached);
    ConfigAs::float($key);
    Config::set($key, $new);

    $value = ConfigAs::freshFloat($key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('can read fresh ints', function () {
    $key = 'testing.cache.int';
    $cached = 5;
    $new = 10;

    Config::set($key, $cached);
    ConfigAs::int($key);
    Config::set($key, $new);

    $value = ConfigAs::freshInt($key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('can read fresh nullable arrays', function () {
    $key = 'testing.cache.nullable_array';
    $cached = [];
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableArray($key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableArray($key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('can read fresh nullable bools', function () {
    $key = 'testing.cache.nullable_bool';
    $cached = true;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableBool($key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableBool($key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('can read fresh nullable classes', function () {
    $key = 'testing.cache.nullable_class';
    $cached = new ClassStub();
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableClass(ClassStub::class, $key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableClass(ClassStub::class, $key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('can read fresh nullable floats', function () {
    $key = 'testing.cache.nullable_float';
    $cached = 0.1;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableFloat($key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableFloat($key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('can read fresh nullable ints', function () {
    $key = 'testing.cache.nullable_int';
    $cached = 5;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableInt($key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableInt($key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('can read fresh nullable strings', function () {
    $key = 'testing.cache.nullable_string';
    $cached = 'a';
    $new = 'b';

    Config::set($key, $cached);
    ConfigAs::string($key);
    Config::set($key, $new);

    $value = ConfigAs::freshString($key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('can read fresh strings', function () {
    $key = 'testing.cache.nullable_string';
    $cached = 'string';
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableString($key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableString($key);
    expect($value)->toEqual($new);
    expect($value)->not->toEqual($cached);
});

it('does not cache default arrays', function () {
    $cached = [fake()->word()];
    $value = ConfigAs::array('testing.array', $cached);

    expect($value)->toEqual(ConfigAs::freshArray('testing.array'));
    expect($value)->not->toEqual($cached);
});

it('does not cache default bools', function () {
    $cached = false;
    $value = ConfigAs::bool('testing.bool', $cached);

    expect($value)->toEqual(ConfigAs::freshBool('testing.bool'));
    expect($value)->not->toEqual($cached);
});

it('does not cache default classes', function () {
    $cached = new CacheClassStub();
    $value = ConfigAs::class(ClassStub::class, 'testing.class', $cached);

    expect($value)->toEqual(ConfigAs::freshClass(ClassStub::class, 'testing.class'));
    expect($value)->not->toEqual($cached);
});

it('does not cache default floats', function () {
    $cached = fake()->randomFloat(2, 0.01, PHP_FLOAT_MAX);
    $value = ConfigAs::float('testing.float', $cached);

    expect($value)->toEqual(ConfigAs::freshFloat('testing.float'));
    expect($value)->not->toEqual($cached);
});

it('does not cache default ints', function () {
    $cached = fake()->numberBetween(1, PHP_INT_MAX);
    $value = ConfigAs::int('testing.int', $cached);

    expect($value)->toEqual(ConfigAs::freshInt('testing.int'));
    expect($value)->not->toEqual($cached);
});

it('does not cache default strings', function () {
    $cached = fake()->word();
    $value = ConfigAs::string('testing.string', $cached);

    expect($value)->toEqual(ConfigAs::freshString('testing.string'));
    expect($value)->not->toEqual($cached);
});

it('does not cache default nullable arrays', function () {
    $cached = ConfigAs::nullableArray('testing.nullable', [fake()->word()]);
    $value = ConfigAs::nullableArray('testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toEqual($cached);
});

it('does not cache default nullable bools', function () {
    $cached = ConfigAs::nullableBool('testing.nullable', true);
    $value = ConfigAs::nullableBool('testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toEqual($cached);
});

it('does not cache default nullable classes', function () {
    $cached = ConfigAs::nullableClass(CacheClassStub::class, 'testing.nullable', new CacheClassStub());
    $value = ConfigAs::nullableClass(CacheClassStub::class, 'testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toEqual($cached);
});

it('does not cache default nullable floats', function () {
    $cached = ConfigAs::nullableFloat('testing.nullable', fake()->randomFloat(2, 0.01, PHP_FLOAT_MAX));
    $value = ConfigAs::nullableFloat('testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toEqual($cached);
});

it('does not cache default nullable ints', function () {
    $cached = ConfigAs::nullableInt('testing.nullable', fake()->numberBetween(1, PHP_INT_MAX));
    $value = ConfigAs::nullableInt('testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toEqual($cached);
});

it('does not cache default nullable strings', function () {
    $cached = ConfigAs::nullableString('testing.nullable', fake()->word());
    $value = ConfigAs::nullableString('testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toEqual($cached);
});

class CacheClassStub extends ClassStub
{
}
