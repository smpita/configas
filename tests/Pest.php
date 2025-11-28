<?php

use Smpita\ConfigAs\Tests\TestCase;
use Smpita\ConfigAs\Tests\Stubs\ClassStub;

uses(TestCase::class)->in(__DIR__);

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
