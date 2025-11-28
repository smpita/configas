<?php

use Smpita\ConfigAs\ConfigAs;
use Smpita\ConfigAs\Exceptions\ConfigAsResolutionException;
use Smpita\ConfigAs\Tests\Stubs\ClassStub;
use Smpita\TypeAs\Contracts\BoolResolver;

it('can handle arrays', function () {
    $value = staticArrayTest(ConfigAs::array('testing.array'));
    expect($value)->toBeArray();
});

it('can handle bools', function () {
    $value = staticBoolTest(ConfigAs::bool('testing.bool'));
    expect($value)->toBeBool();
});

it('can handle classes', function () {
    $value = staticClassTest(ConfigAs::class(ClassStub::class, 'testing.class'));
    expect($value)->toBeInstanceOf(ClassStub::class);
});

it('can handle floats', function () {
    $value = staticFloatTest(ConfigAs::float('testing.float'));
    expect($value)->toBeFloat();
});

it('can handle ints', function () {
    $value = staticIntTest(ConfigAs::int('testing.int'));
    expect($value)->toBeInt();
});

it('can handle strings', function () {
    $value = staticStringTest(ConfigAs::string('testing.float'));
    expect($value)->toBeString();
});

it('can handle nullable arrays', function () {
    $value = staticNullableArrayTest(ConfigAs::nullableArray('testing.nullable'));
    expect($value)->toBeNull();
});

it('can handle nullable bools', function () {
    $value = staticNullableBoolTest(ConfigAs::nullableBool('testing.nullable'));
    expect($value)->toBeNull();
});

it('can handle nullable classes', function () {
    $value = staticNullableClassTest(ConfigAs::nullableClass(ClassStub::class, 'testing.nullable'));
    expect($value)->toBeNull(ClassStub::class);
});

it('can handle nullable floats', function () {
    $value = staticNullableFloatTest(ConfigAs::nullableFloat('testing.nullable'));
    expect($value)->toBeNull();
});

it('can handle nullable ints', function () {
    $value = staticNullableIntTest(ConfigAs::nullableInt('testing.nullable'));
    expect($value)->toBeNull();
});

it('can handle nullable strings', function () {
    $value = staticNullableStringTest(ConfigAs::nullableString('testing.nullable'));
    expect($value)->toBeNull();
});

it('can handle array default', function () {
    $key = 'testing.default.array';
    $default = [];

    expect(ConfigAs::array($key, $default))->toBe($default);
    expect(ConfigAs::array($key)); // throws exception without default, does not cache default
})->throws(ConfigAsResolutionException::class);

it('can handle bool default', function () {
    $key = 'testing.default.bool';
    $default = false;

    expect(ConfigAs::bool($key, $default))->toBe($default);
    expect(ConfigAs::bool($key)); // throws exception without default, does not cache default
})->throws(ConfigAsResolutionException::class);

it('can handle class default', function () {
    $key = 'testing.default.class';
    $default = new StdClass();

    expect(ConfigAs::class(StdClass::class, $key, $default))->toBe($default);
    expect(ConfigAs::class(StdClass::class, $key)); // throws exception without default, does not cache default
})->throws(ConfigAsResolutionException::class);

it('can handle float default', function () {
    $key = 'testing.default.float';
    $default = 123.456;

    expect(ConfigAs::float($key, $default))->toBe($default);
    expect(ConfigAs::float($key)); // throws exception without default, does not cache default
})->throws(ConfigAsResolutionException::class);

it('can handle int default', function () {
    $key = 'testing.default.int';
    $default = 123;

    expect(ConfigAs::int($key, $default))->toBe($default);
    expect(ConfigAs::int($key)); // throws exception without default, does not cache default
})->throws(ConfigAsResolutionException::class);

it('can handle string default', function () {
    $key = 'testing.default.string';
    $default = 'testing';

    expect(ConfigAs::string($key, $default))->toBe($default);
    expect(ConfigAs::string($key)); // throws exception without default, does not cache default
})->throws(ConfigAsResolutionException::class);

it('can handle nullable array default', function () {
    $key = 'testing.default.nullable.array';
    $default = [];

    expect(ConfigAs::nullableArray($key, $default))->toBe($default);
    expect(ConfigAs::nullableArray($key))->toBeNull(); // does not cache default
});

it('can handle nullable bool default', function () {
    $key = 'testing.default.nullable.bool';
    $default = false;

    expect(ConfigAs::nullableBool($key, $default))->toBe($default);
    expect(ConfigAs::nullableBool($key))->toBeNull(); // does not cache default
});

it('can handle nullable class default', function () {
    $key = 'testing.default.nullable.class';
    $default = new StdClass();

    expect(ConfigAs::nullableClass(StdClass::class, $key, $default))->toBe($default);
    expect(ConfigAs::nullableClass(StdClass::class, $key))->toBeNull(); // does not cache default
});

it('can handle nullable float default', function () {
    $key = 'testing.default.nullable.float';
    $default = 123.456;

    expect(ConfigAs::nullableFloat($key, $default))->toBe($default);
    expect(ConfigAs::nullableFloat($key))->toBeNull(); // does not cache default
});

it('can handle nullable int default', function () {
    $key = 'testing.default.nullable.int';
    $default = 123;

    expect(ConfigAs::nullableInt($key, $default))->toBe($default);
    expect(ConfigAs::nullableInt($key))->toBeNull(); // does not cache default
});

it('can handle nullable string default', function () {
    $key = 'testing.default.nullable.string';
    $default = 'testing';

    expect(ConfigAs::nullableString($key, $default))->toBe($default);
    expect(ConfigAs::nullableString($key))->toBeNull(); // does not cache default
});

it('throws exception when not array', function () {
    ConfigAs::array('testing.nullable');
})->throws(ConfigAsResolutionException::class);

it('throws exception when not bool', function () {
    ConfigAs::bool('testing.nullable', null, new FakeBoolResolverStub());
})->throws(ConfigAsResolutionException::class);

it('throws exception when not class', function () {
    ConfigAs::class(ClassStub::class, 'testing.nullable');
})->throws(ConfigAsResolutionException::class);

it('throws exception when not float', function () {
    ConfigAs::float('testing.nullable');
})->throws(ConfigAsResolutionException::class);

it('throws exception when not int', function () {
    ConfigAs::int('testing.nullable');
})->throws(ConfigAsResolutionException::class);

it('throws exception when not string', function () {
    ConfigAs::string('testing.nullable');
})->throws(ConfigAsResolutionException::class);

it('helper can handle arrays', function () {
    $value = staticArrayTest(\Smpita\ConfigAs\configArray('testing.array'));
    expect($value)->toBeArray();
});

function staticArrayTest(array $value): array
{
    return $value;
}

function staticBoolTest(bool $value): bool
{
    return $value;
}

function staticClassTest(ClassStub $value): ClassStub
{
    return $value;
}

function staticFloatTest(float $value): float
{
    return $value;
}

function staticIntTest(int $value): int
{
    return $value;
}

function staticNullableArrayTest(?array $value): ?array
{
    return $value;
}

function staticNullableBoolTest(?bool $value): ?bool
{
    return $value;
}

function staticNullableClassTest(?ClassStub $value): ?ClassStub
{
    return $value;
}

function staticNullableFloatTest(?float $value): ?float
{
    return $value;
}

function staticNullableIntTest(?int $value): ?int
{
    return $value;
}

function staticNullableStringTest(?string $value): ?string
{
    return $value;
}

function staticStringTest(string $value): string
{
    return $value;
}
