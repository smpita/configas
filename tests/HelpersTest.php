<?php

use Smpita\ConfigAs\ConfigAs;
use Smpita\ConfigAs\Exceptions\ConfigAsResolutionException;
use Smpita\ConfigAs\Tests\Stubs\ClassStub;

use function Smpita\ConfigAs\configArray;
use function Smpita\ConfigAs\configAs;
use function Smpita\ConfigAs\configBool;
use function Smpita\ConfigAs\configClass;
use function Smpita\ConfigAs\configFloat;
use function Smpita\ConfigAs\configInt;
use function Smpita\ConfigAs\configNullableArray;
use function Smpita\ConfigAs\configNullableBool;
use function Smpita\ConfigAs\configNullableClass;
use function Smpita\ConfigAs\configNullableFloat;
use function Smpita\ConfigAs\configNullableInt;
use function Smpita\ConfigAs\configNullableString;
use function Smpita\ConfigAs\configString;

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

it('can handle strings', function () {
    $value = staticStringTest(configString('testing.float'));
    expect($value)->toBeString();
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
