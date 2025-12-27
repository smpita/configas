### Typed Config Resolver for Laravel

- Use \Smpita\ConfigAs\ConfigAs to resolve like config() but with type hints.
- Default values can be provided as the second parameter, or the third parameter for class, e.g. ConfigAs::array('key', default: []) and ConfigAs::class(Expected::class, 'key', default: new Expected()).
- Helpers like configArray(), configNullableArray(), configBool(), etc are available for all types but they need to be imported, e.g. use function Smpita\ConfigAs\configArray;

@verbatim
<code-snippet name="How to type as array" lang="php">
$array = ConfigAs::array('key');
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable array" lang="php">
$nullableArray = ConfigAs::nullableArray('key');
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as bool" lang="php">
$bool = ConfigAs::bool('key');
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable bool" lang="php">
$nullableBool = ConfigAs::nullableBool('key');
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as class" lang="php">
$class = ConfigAs::class(Expected::class, 'key');
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable class" lang="php">
$nullableClass = ConfigAs::nullableClass(Expected::class, 'key');
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as float" lang="php">
$float = ConfigAs::float('key');
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable float" lang="php">
$nullableFloat = ConfigAs::nullableFloat('key');
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as int" lang="php">
$int = ConfigAs::int('key');
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable int" lang="php">
$nullableInt = ConfigAs::nullableInt('key');
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as string" lang="php">
$string = ConfigAs::string('key');
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="How to type as nullable string" lang="php">
$nullableString = ConfigAs::nullableString('key');
</code-snippet>
@endverbatim
