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

---

## Deprecations

None.
