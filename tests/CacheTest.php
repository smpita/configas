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
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can cache bools', function () {
    $key = 'testing.cache.bool';
    $cached = false;
    $new = true;

    Config::set($key, $cached);
    ConfigAs::bool($key);
    Config::set($key, $new);

    $value = ConfigAs::bool($key);
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can cache classes', function () {
    $key = 'testing.cache.class';
    $cached = new CacheClassStub();
    $new = new ClassStub();

    Config::set($key, $cached);
    ConfigAs::class(ClassStub::class, $key);
    Config::set($key, $new);

    $value = ConfigAs::class(ClassStub::class, $key);
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can cache floats', function () {
    $key = 'testing.cache.float';
    $cached = 0.1;
    $new = 0.2;

    Config::set($key, $cached);
    ConfigAs::float($key);
    Config::set($key, $new);

    $value = ConfigAs::float($key);
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can cache ints', function () {
    $key = 'testing.cache.int';
    $cached = 5;
    $new = 10;

    Config::set($key, $cached);
    ConfigAs::int($key);
    Config::set($key, $new);

    $value = ConfigAs::int($key);
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can cache strings', function () {
    $key = 'testing.cache.nullable_string';
    $cached = 'string';
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableString($key);
    Config::set($key, $new);

    $value = ConfigAs::nullableString($key);
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can cache nullable arrays', function () {
    $key = 'testing.cache.nullable_array';
    $cached = [];
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableArray($key);
    Config::set($key, $new);

    $value = ConfigAs::nullableArray($key);
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can cache nullable bools', function () {
    $key = 'testing.cache.nullable_bool';
    $cached = true;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableBool($key);
    Config::set($key, $new);

    $value = ConfigAs::nullableBool($key);
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can cache nullable classes', function () {
    $key = 'testing.cache.nullable_class';
    $cached = new ClassStub();
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableClass(ClassStub::class, $key);
    Config::set($key, $new);

    $value = ConfigAs::nullableClass(ClassStub::class, $key);
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can cache nullable floats', function () {
    $key = 'testing.cache.nullable_float';
    $cached = 0.1;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableFloat($key);
    Config::set($key, $new);

    $value = ConfigAs::nullableFloat($key);
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can cache nullable ints', function () {
    $key = 'testing.cache.nullable_int';
    $cached = 5;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableInt($key);
    Config::set($key, $new);

    $value = ConfigAs::nullableInt($key);
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can cache nullable strings', function () {
    $key = 'testing.cache.nullable_string';
    $cached = 'a';
    $new = 'b';

    Config::set($key, $cached);
    ConfigAs::string($key);
    Config::set($key, $new);

    $value = ConfigAs::string($key);
    expect($value)->toBe($cached);
    expect($value)->not->toBe($new);
});

it('can read fresh arrays', function () {
    $key = 'testing.cache.array';
    $cached = ['cached'];
    $new = [];

    Config::set($key, $cached);
    ConfigAs::array($key);
    Config::set($key, $new);

    $value = ConfigAs::freshArray($key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('can read fresh bools', function () {
    $key = 'testing.cache.bool';
    $cached = false;
    $new = true;

    Config::set($key, $cached);
    ConfigAs::bool($key);
    Config::set($key, $new);

    $value = ConfigAs::freshBool($key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('can read fresh classes', function () {
    $key = 'testing.cache.class';
    $cached = new CacheClassStub();
    $new = new ClassStub();

    Config::set($key, $cached);
    ConfigAs::class(ClassStub::class, $key);
    Config::set($key, $new);

    $value = ConfigAs::freshClass(ClassStub::class, $key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('can read fresh floats', function () {
    $key = 'testing.cache.float';
    $cached = 0.1;
    $new = 0.2;

    Config::set($key, $cached);
    ConfigAs::float($key);
    Config::set($key, $new);

    $value = ConfigAs::freshFloat($key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('can read fresh ints', function () {
    $key = 'testing.cache.int';
    $cached = 5;
    $new = 10;

    Config::set($key, $cached);
    ConfigAs::int($key);
    Config::set($key, $new);

    $value = ConfigAs::freshInt($key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('can read fresh strings', function () {
    $key = 'testing.cache.nullable_string';
    $cached = 'string';
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableString($key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableString($key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('can read fresh nullable arrays', function () {
    $key = 'testing.cache.nullable_array';
    $cached = [];
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableArray($key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableArray($key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('can read fresh nullable bools', function () {
    $key = 'testing.cache.nullable_bool';
    $cached = true;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableBool($key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableBool($key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('can read fresh nullable classes', function () {
    $key = 'testing.cache.nullable_class';
    $cached = new ClassStub();
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableClass(ClassStub::class, $key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableClass(ClassStub::class, $key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('can read fresh nullable floats', function () {
    $key = 'testing.cache.nullable_float';
    $cached = 0.1;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableFloat($key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableFloat($key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('can read fresh nullable ints', function () {
    $key = 'testing.cache.nullable_int';
    $cached = 5;
    $new = null;

    Config::set($key, $cached);
    ConfigAs::nullableInt($key);
    Config::set($key, $new);

    $value = ConfigAs::freshNullableInt($key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('can read fresh nullable strings', function () {
    $key = 'testing.cache.nullable_string';
    $cached = 'a';
    $new = 'b';

    Config::set($key, $cached);
    ConfigAs::string($key);
    Config::set($key, $new);

    $value = ConfigAs::freshString($key);
    expect($value)->toBe($new);
    expect($value)->not->toBe($cached);
});

it('does not cache default arrays', function () {
    $cached = [fake()->word()];
    $value = ConfigAs::array('testing.array', $cached);

    expect($value)->toBe(ConfigAs::freshArray('testing.array'));
    expect($value)->not->toBe($cached);
});

it('does not cache default bools', function () {
    $cached = false;
    $value = ConfigAs::bool('testing.bool', $cached);

    expect($value)->toBe(ConfigAs::freshBool('testing.bool'));
    expect($value)->not->toBe($cached);
});

it('does not cache default classes', function () {
    $cached = new CacheClassStub();
    $value = ConfigAs::class(ClassStub::class, 'testing.class', $cached);

    expect($value)->toBe(ConfigAs::freshClass(ClassStub::class, 'testing.class'));
    expect($value)->not->toBe($cached);
});

it('does not cache default floats', function () {
    $cached = fake()->randomFloat(2, 0.01, PHP_FLOAT_MAX);
    $value = ConfigAs::float('testing.float', $cached);

    expect($value)->toBe(ConfigAs::freshFloat('testing.float'));
    expect($value)->not->toBe($cached);
});

it('does not cache default ints', function () {
    $cached = fake()->numberBetween(1, PHP_INT_MAX);
    $value = ConfigAs::int('testing.int', $cached);

    expect($value)->toBe(ConfigAs::freshInt('testing.int'));
    expect($value)->not->toBe($cached);
});

it('does not cache default strings', function () {
    $cached = fake()->word();
    $value = ConfigAs::string('testing.string', $cached);

    expect($value)->toBe(ConfigAs::freshString('testing.string'));
    expect($value)->not->toBe($cached);
});

it('does not cache default nullable arrays', function () {
    $cached = ConfigAs::nullableArray('testing.nullable', [fake()->word()]);
    $value = ConfigAs::nullableArray('testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toBe($cached);
});

it('does not cache default nullable bools', function () {
    $cached = ConfigAs::nullableBool('testing.nullable', true);
    $value = ConfigAs::nullableBool('testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toBe($cached);
});

it('does not cache default nullable classes', function () {
    $cached = ConfigAs::nullableClass(CacheClassStub::class, 'testing.nullable', new CacheClassStub());
    $value = ConfigAs::nullableClass(CacheClassStub::class, 'testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toBe($cached);
});

it('does not cache default nullable floats', function () {
    $cached = ConfigAs::nullableFloat('testing.nullable', fake()->randomFloat(2, 0.01, PHP_FLOAT_MAX));
    $value = ConfigAs::nullableFloat('testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toBe($cached);
});

it('does not cache default nullable ints', function () {
    $cached = ConfigAs::nullableInt('testing.nullable', fake()->numberBetween(1, PHP_INT_MAX));
    $value = ConfigAs::nullableInt('testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toBe($cached);
});

it('does not cache default nullable strings', function () {
    $cached = ConfigAs::nullableString('testing.nullable', fake()->word());
    $value = ConfigAs::nullableString('testing.nullable');

    expect($value)->toBeNull();
    expect($value)->not->toBe($cached);
});

it('can forget arrays', function () {
    $key = 'testing.array';
    $value = ['foo'];
    $new = [];

    expect(ConfigAs::array($key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::array($key))->toBe($value);

    ConfigAs::forgetArray($key);
    expect(ConfigAs::array($key))->toBe($new);
    expect(ConfigAs::array($key))->not->toBe($value);
});

it('can forget bools', function () {
    $key = 'testing.bool';
    $value = true;
    $new = false;

    expect(ConfigAs::bool($key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::bool($key))->toBe($value);

    ConfigAs::forgetBool($key);
    expect(ConfigAs::bool($key))->toBe($new);
    expect(ConfigAs::bool($key))->not->toBe($value);
});

it('can forget classes', function () {
    $key = 'testing.class';
    $value = Config::get($key); // new ClassStub()
    $new = new CacheClassStub();

    expect(ConfigAs::class(ClassStub::class, $key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::class(ClassStub::class, $key))->toBe($value);

    ConfigAs::forgetClass($key);
    expect(ConfigAs::class(CacheClassStub::class, $key))->toBe($new);
    expect(ConfigAs::class(CacheClassStub::class, $key))->not->toBe($value);
});

it('can forget floats', function () {
    $key = 'testing.float';
    $value = 123.456;
    $new = 876.5309;

    expect(ConfigAs::float($key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::float($key))->toBe($value);

    ConfigAs::forgetFloat($key);
    expect(ConfigAs::float($key))->toBe($new);
    expect(ConfigAs::float($key))->not->toBe($value);
});

it('can forget ints', function () {
    $key = 'testing.int';
    $value = 123;
    $new = 54321;

    expect(ConfigAs::int($key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::int($key))->toBe($value);

    ConfigAs::forgetInt($key);
    expect(ConfigAs::int($key))->toBe($new);
    expect(ConfigAs::int($key))->not->toBe($value);
});

it('can forget strings', function () {
    $key = 'testing.string';
    $value = 'foo';
    $new = 'bar';

    expect(ConfigAs::string($key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::string($key))->toBe($value);

    ConfigAs::forgetString($key);
    expect(ConfigAs::string($key))->toBe($new);
    expect(ConfigAs::string($key))->not->toBe($value);
});

it('can forget nullable arrays', function () {
    $key = 'testing.nullable.array';
    $value = null;
    $new = [];

    expect(ConfigAs::nullableArray($key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::nullableArray($key))->toBe($value);

    ConfigAs::forgetNullableArray($key);
    expect(ConfigAs::nullableArray($key))->toBe($new);
    expect(ConfigAs::nullableArray($key))->not->toBe($value);
});

it('can forget nullable bools', function () {
    $key = 'testing.nullable.bool';
    $value = null;
    $new = false;

    expect(ConfigAs::nullableBool($key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::nullableBool($key))->toBe($value);

    ConfigAs::forgetNullableBool($key);
    expect(ConfigAs::nullableBool($key))->toBe($new);
    expect(ConfigAs::nullableBool($key))->not->toBe($value);
});

it('can forget nullable classes', function () {
    $key = 'testing.nullable.class';
    $value = null;
    $new = new CacheClassStub();

    expect(ConfigAs::nullableClass(ClassStub::class, $key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::nullableClass(ClassStub::class, $key))->toBe($value);

    ConfigAs::forgetNullableClass($key);
    expect(ConfigAs::nullableClass(CacheClassStub::class, $key))->toBe($new);
    expect(ConfigAs::nullableClass(CacheClassStub::class, $key))->not->toBe($value);
});

it('can forget nullable floats', function () {
    $key = 'testing.nullable.float';
    $value = null;
    $new = 876.5309;

    expect(ConfigAs::nullableFloat($key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::nullableFloat($key))->toBe($value);

    ConfigAs::forgetNullableFloat($key);
    expect(ConfigAs::nullableFloat($key))->toBe($new);
    expect(ConfigAs::nullableFloat($key))->not->toBe($value);
});

it('can forget nullable ints', function () {
    $key = 'testing.nullable.int';
    $value = null;
    $new = 54321;

    expect(ConfigAs::nullableInt($key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::nullableInt($key))->toBe($value);

    ConfigAs::forgetNullableInt($key);
    expect(ConfigAs::nullableInt($key))->toBe($new);
    expect(ConfigAs::nullableInt($key))->not->toBe($value);
});

it('can forget nullable strings', function () {
    $key = 'testing.nullable.string';
    $value = null;
    $new = 'bar';

    expect(ConfigAs::nullableString($key))->toBe($value);
    Config::set($key, $new);
    expect(ConfigAs::nullableString($key))->toBe($value);

    ConfigAs::forgetNullableString($key);
    expect(ConfigAs::nullableString($key))->toBe($new);
    expect(ConfigAs::nullableString($key))->not->toBe($value);
});

class CacheClassStub extends ClassStub
{
}
