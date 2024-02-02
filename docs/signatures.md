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
\Smpita\ConfigAs\asArray(string $keye, ?array $default = null, ?ArrayResolver $resolver = null): array
```

```php
\Smpita\ConfigAs\asBool(string $key, ?bool $default = null, ?BoolResolver $resolver = null): bool
```

```php
\Smpita\ConfigAs\asClass(string $class, string $key, ?object $default = null, ?ClassResolver $resolver = null)
```

```php
\Smpita\ConfigAs\asFloat(string $key, ?float $default = null, ?FloatResolver $resolver = null): float
```

```php
\Smpita\ConfigAs\asInt(string $key, ?int $default = null, ?IntResolver $resolver = null): int
```

```php
\Smpita\ConfigAs\asNullableArray(string $key, ?array $default = null, ?NullableArrayResolver $resolver = null): ?array
```

```php
\Smpita\ConfigAs\asNullableBool(string $key, ?bool $default = null, ?NullableBoolResolver $resolver = null): ?bool
```

```php
\Smpita\ConfigAs\asNullableClass(string $class, string $key, ?object $default = null, ?NullableClassResolver $resolver = null): ?object
```

```php
\Smpita\ConfigAs\asNullableFloat(string $key, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
```

```php
\Smpita\ConfigAs\asNullableInt(string $key, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
```

```php
\Smpita\ConfigAs\asNullableString(string $key, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
```

```php
\Smpita\ConfigAs\asString(string $key, string ?$default = null, ?StringResolver $resolver = null): string
```

### Resolver registration

Use the included [Smpita\TypeAs](https://github.com/smpita/typeas/) library to register global resolvers. [[docs](https://github.com/smpita/typeas/blob/main/docs/signatures.md#resolver-registration)]

---

## Deprecations
