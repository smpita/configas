## Methods and Signatures

### Resolving

#### Array

```php
Smpita\ConfigAs::array(string $key, ?array $default = null, ?ArrayResolver $resolver = null): array
```

```php
Smpita\ConfigAs::nullableArray(string $key, ?array $default = null, ?ArrayResolver $resolver = null): ?array
```

#### Boolean

```php
Smpita\ConfigAs::bool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool
```

```php
Smpita\ConfigAs::nullableBool(mixed $value, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
```

#### Class

```php
Smpita\ConfigAs::class(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null): object
```

```php
Smpita\ConfigAs::nullableClass(string $class, mixed $value, ?object $default = null, ?NullableClassResolver $resolver = null): ?object
```

#### Float

```php
Smpita\ConfigAs::float(mixed $value, ?float $default = null, >FloatResolver $resolver = null): float
```

```php
Smpita\ConfigAs::nullableFloat(mixed $value, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
```

#### Integer

```php
Smpita\ConfigAs::int(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int
```

```php
Smpita\ConfigAs::nullableInt(mixed $value, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
```

#### String

```php
Smpita\ConfigAs::string(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string
```

```php
Smpita\ConfigAs::nullableString(mixed $value, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
```

### Helpers

```php
\Smpita\ConfigAs\configArray(string $key, ?array $default = null, ?ArrayResolver $resolver = null): array
```

```php
\Smpita\ConfigAs\configBool(string $key, ?bool $default = null, ?BoolResolver $resolver = null): bool
```

```php
\Smpita\ConfigAs\configClass(string $class, string $key, ?object $default = null, ?ClassResolver $resolver = null)
```

```php
\Smpita\ConfigAs\configFloat(string $key, ?float $default = null, ?FloatResolver $resolver = null): float
```

```php
\Smpita\ConfigAs\configInt(string $key, ?int $default = null, ?IntResolver $resolver = null): int
```

```php
\Smpita\ConfigAs\configNullableArray(string $key, ?array $default = null, ?NullableArrayResolver $resolver = null): ?array
```

```php
\Smpita\ConfigAs\configNullableBool(string $key, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
```

```php
\Smpita\ConfigAs\configNullableClass(string $class, string $key, ?object $default = null, ?NullableClassResolver $resolver = null): ?object
```

```php
\Smpita\ConfigAs\configNullableFloat(string $key, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
```

```php
\Smpita\ConfigAs\configNullableInt(string $key, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
```

```php
\Smpita\ConfigAs\configNullableString(string $key, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
```

```php
\Smpita\ConfigAs\configString(string $key, string ?$default = null, ?StringResolver $resolver = null): string
```

## Cache

### Guaranteed fresh values

#### Array

```php
Smpita\ConfigAs::freshArray(string $key, ?array $default = null, ?ArrayResolver $resolver = null): array
```

```php
Smpita\ConfigAs::freshNullableArray(string $key, ?array $default = null, ?ArrayResolver $resolver = null): ?array
```

#### Boolean

```php
Smpita\ConfigAs::freshBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool
```

```php
Smpita\ConfigAs::freshNullableBool(mixed $value, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
```

#### Class

```php
Smpita\ConfigAs::freshClass(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null): object
```

```php
Smpita\ConfigAs::freshNullableClass(string $class, mixed $value, ?object $default = null, ?NullableClassResolver $resolver = null): ?object
```

#### Float

```php
Smpita\ConfigAs::freshFloat(mixed $value, ?float $default = null, >FloatResolver $resolver = null): float
```

```php
Smpita\ConfigAs::freshNullableFloat(mixed $value, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
```

#### Integer

```php
Smpita\ConfigAs::freshInt(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int
```

```php
Smpita\ConfigAs::freshNullableInt(mixed $value, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
```

#### String

```php
Smpita\ConfigAs::freshString(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string
```

```php
Smpita\ConfigAs::freshNullableString(mixed $value, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
```

### Forgetting

#### Forget a key

```php
\Smpita\ConfigAs::forgetArray(string $key): void
```

```php
\Smpita\ConfigAs::forgetBool(string $key): void
```

```php
\Smpita\ConfigAs::forgetClass(string $key): void
```

```php
\Smpita\ConfigAs::forgetFloat(string $key): void
```

```php
\Smpita\ConfigAs::forgetInt(string $key): void
```

```php
\Smpita\ConfigAs::forgetString(string $key): void
```

```php
\Smpita\ConfigAs::forgetNullableArray(string $key): void
```

```php
\Smpita\ConfigAs::forgetNullableBool(string $key): void
```

```php
\Smpita\ConfigAs::forgetNullableClass(string $key): void
```

```php
\Smpita\ConfigAs::forgetNullableFloat(string $key): void
```

```php
\Smpita\ConfigAs::forgetNullableInt(string $key): void
```

```php
\Smpita\ConfigAs::forgetNullableString(string $key): void
```

#### Flush a type cache

```php
\Smpita\ConfigAs::flushArrays(): void
```

```php
\Smpita\ConfigAs::flushBools(): void
```

```php
\Smpita\ConfigAs::flushClasses(): void
```

```php
\Smpita\ConfigAs::flushFloats(): void
```

```php
\Smpita\ConfigAs::flushInts(): void
```

```php
\Smpita\ConfigAs::flushStrings(): void
```

```php
\Smpita\ConfigAs::flushNullableArrays(): void
```

```php
\Smpita\ConfigAs::flushNullableBools(): void
```

```php
\Smpita\ConfigAs::flushNullableClasses(): void
```

```php
\Smpita\ConfigAs::flushNullableFloats(): void
```

```php
\Smpita\ConfigAs::flushNullableInts(): void
```

```php
\Smpita\ConfigAs::flushNullableStrings(): void
```

#### Flush all caches

```php
\Smpita\ConfigAs::flush(): void
```

---

## Deprecations

None.
