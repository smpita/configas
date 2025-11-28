<?php

namespace Smpita\ConfigAs\Tests\Stubs;

use UnexpectedValueException;
use Smpita\TypeAs\Contracts\BoolResolver;

class FakeBoolResolverStub implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): bool
    {
        throw new UnexpectedValueException();
    }
}