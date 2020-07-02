# Json

 * Wraps JSON decoding and encoding actions into class. Handles decoding error.
 * Provides JSON syntax highlighting.

## Installation

Install by running composer command `composer require arturdoruch/json`

## Usage

### Decode JSON

```php
use ArturDoruch\Json\Json;
use ArturDoruch\Json\UnexpectedJsonException;

$jsonString = '';
// Decode JSON to array or stdClass object.
// If JSON is invalid `ArturDoruch\Json\UnexpectedJsonException` is thrown.
$json = new Json($jsonString);

// Catch decoding exception
try {
    $json = new Json($jsonString);
} catch (UnexpectedJsonException $exception) {
    // Get decoded invalid JSON.
    $exception->getJson();
    // Get error code.
    $exception->getCode();
}

// Get decoded JSON.
$json->getDecoded();

// Get encoded JSON with specified options like JSON_PRETTY_PRINT.
$json->getEncoded();
```

### Highlight JSON syntax

```php
use ArturDoruch\Json\JsonUtils;

// JSON string. 
$json = '{"string": "foo bar \"baz\"", "integer": 128, "float": -1.5678, "boolean": true, "null": null}';
$classPrefix = 'json';
JsonUtils::highlightSyntax($json, $classPrefix);
```

Define the following CSS styles to styling JSON code:

 * span.{classPrefix}-key {}
 * span.{classPrefix}-string {}
 * span.{classPrefix}-integer {}
 * span.{classPrefix}-float {}
 * span.{classPrefix}-boolean {}
 * span.{classPrefix}-null {}