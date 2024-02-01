<?php

use Smpita\ConfigAs\ConfigAs;
use Smpita\ConfigAs\Tests\Stubs\ClassStub;

it('can handle arrays', function () {
    $value = staticArrayTest(ConfigAs::array('testing.array'));
    expect($value)->toBeArray();
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
    $value = staticIntTest(ConfigAs::int('testing.float'));
    expect($value)->toBeInt();
});

it('can handle nullable arrays', function () {
    $value = staticNullableArrayTest(ConfigAs::nullableArray('testing.nullable'));
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

it('can handle strings', function () {
    $value = staticStringTest(ConfigAs::string('testing.float'));
    expect($value)->toBeString();
});

function staticArrayTest(array $value): array
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
