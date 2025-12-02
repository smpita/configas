<?php

use Smpita\ConfigAs\ConfigAs;
use Smpita\ConfigAs\Tests\Stubs\ClassStub;
use Smpita\ConfigAs\Tests\Stubs\FakeBoolResolverStub;
use Smpita\ConfigAs\Exceptions\ConfigAsResolutionException;

use function Smpita\ConfigAs\configAs;
use function Smpita\ConfigAs\configInt;
use function Smpita\ConfigAs\configBool;
use function Smpita\ConfigAs\configArray;
use function Smpita\ConfigAs\configClass;
use function Smpita\ConfigAs\configFloat;
use function Smpita\ConfigAs\configString;
use function Smpita\ConfigAs\configNullableInt;
use function Smpita\ConfigAs\configNullableBool;
use function Smpita\ConfigAs\configNullableArray;
use function Smpita\ConfigAs\configNullableClass;
use function Smpita\ConfigAs\configNullableFloat;
use function Smpita\ConfigAs\configNullableString;

it('can help itself', function () {
    expect(configAs())->toBeInstanceOf(ConfigAs::class);
});

it('can handle arrays', function () {
    $value = staticArrayTest(configArray('testing.array'));
    expect($value)->toBeArray();
});

it('can handle bools', function () {
    $value = staticBoolTest(configBool('testing.bool'));
    expect($value)->toBeBool();
});

it('can handle classes', function () {
    $value = staticClassTest(configClass(ClassStub::class, 'testing.class'));
    expect($value)->toBeInstanceOf(ClassStub::class);
});

it('can handle floats', function () {
    $value = staticFloatTest(configFloat('testing.float'));
    expect($value)->toBeFloat();
});

it('can handle ints', function () {
    $value = staticIntTest(configInt('testing.float'));
    expect($value)->toBeInt();
});

it('can handle strings', function () {
    $value = staticStringTest(configString('testing.float'));
    expect($value)->toBeString();
});

it('can handle nullable arrays', function () {
    $value = staticNullableArrayTest(configNullableArray('testing.nullable'));
    expect($value)->toBeNull();
});

it('can handle nullable bools', function () {
    $value = staticNullableBoolTest(configNullableBool('testing.nullable'));
    expect($value)->toBeNull();
});

it('can handle nullable classes', function () {
    $value = staticNullableClassTest(configNullableClass(ClassStub::class, 'testing.nullable'));
    expect($value)->toBeNull(ClassStub::class);
});

it('can handle nullable floats', function () {
    $value = staticNullableFloatTest(configNullableFloat('testing.nullable'));
    expect($value)->toBeNull();
});

it('can handle nullable ints', function () {
    $value = staticNullableIntTest(configNullableInt('testing.nullable'));
    expect($value)->toBeNull();
});

it('can handle nullable strings', function () {
    $value = staticNullableStringTest(configNullableString('testing.nullable'));
    expect($value)->toBeNull();
});

it('throws exception when not array', function () {
    configArray('testing.nullable');
})->throws(ConfigAsResolutionException::class);

it('throws exception when not bool', function () {
    configBool('testing.nullable', null, new FakeBoolResolverStub());
})->throws(ConfigAsResolutionException::class);

it('throws exception when not class', function () {
    configClass(ClassStub::class, 'testing.nullable');
})->throws(ConfigAsResolutionException::class);

it('throws exception when not float', function () {
    configFloat('testing.nullable');
})->throws(ConfigAsResolutionException::class);

it('throws exception when not int', function () {
    configInt('testing.nullable');
})->throws(ConfigAsResolutionException::class);

it('throws exception when not string', function () {
    configString('testing.nullable');
})->throws(ConfigAsResolutionException::class);

it('can handle wrap values to array', function () {
    $array = 'testing.array';
    $bool = 'testing.bool';
    $class = 'testing.class';
    $float = 'testing.float';
    $int = 'testing.int';
    $string = 'testing.string';

    // Doesn't wrap because it's already an array
    expect(configArray($array, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe(ConfigAs::array($array));
    expect(configNullableArray($array, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe(configNullableArray($array));

    // Wraps because it's not an array
    expect(configArray($bool, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe([configBool($bool)]);
    expect(configArray($class, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe([configClass(ClassStub::class, $class)]);
    expect(configArray($float, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe([configFloat($float)]);
    expect(configArray($int, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe([configInt($int)]);
    expect(configArray($string, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe([configString($string)]);

    // Wraps because it's not an array
    expect(configNullableArray($bool, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe([configNullableBool($bool)]);
    expect(configNullableArray($class, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe([configNullableClass(ClassStub::class, $class)]);
    expect(configNullableArray($float, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe([configNullableFloat($float)]);
    expect(configNullableArray($int, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe([configNullableInt($int)]);
    expect(configNullableArray($string, wrap: true))
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toBe([configNullableString($string)]);

    // Shows the danger of this option
    expect(configNullableArray('testing.invalid', wrap: true))
        ->not()->toBeNull()
        ->toBeArray()
        ->not()->toBe([])
        ->toBe([null]);
});