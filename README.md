# OpenAPI Parser for PHP

Parse (and maybe one day write) OpenAPI files in PHP. 

For now, it's strict and is not intended to support invalid specification files. Please ensure you validate them before parsing with this library.

## Installation

```bash
composer require worq/openapi-parser
```

### Compatibility

This library is not yet at version 1.0, so all of the following may change at any time.

#### PHP Version Support

This library aims to support [any PHP version that is not End of life](https://www.php.net/supported-versions.php). 
Support for new versions may require a new major version, at which point EOL versions will be dropped.

| OpenAPI Parser Version | PHP 7 | PHP 8.0 | PHP 8.1 | PHP 8.2 | PHP 8.3 | PHP 8.4 |
|------------------------|-------|---------|---------|---------|---------|---------|
| 0.x                    | ❌     | ❌     | ✅      | ✅      | ✅      | ✅      |

#### OpenAPI Version Support

| OpenAPI Parser Version | Swagger (2.0) | OpenAPI (3.0) | OpenAPI (3.1) |
|------------------------|---------------|---------------|---------------|
| 0.x                    | ❌            | ✅            | ✅            |

#### OpenAPI Object Support (How complete is this library)

| Feature           | Support | Notes |
|-------------------|---------| ----- |
| Contact Object    | ✅      | [^1] |

[^1]: Specification Extensions support missing

