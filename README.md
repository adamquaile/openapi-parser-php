# OpenAPI Parser for PHP

Parse (and maybe one day write) OpenAPI files in PHP. 

For now, it's strict and is not intended to support invalid specification files. Please ensure you validate them before parsing with this library.

## Installation

```bash
composer require typeslow/openapi-parser
```

### Usage

Here's an example usage of the library. Check [./tests/Feature](./tests/Feature) for more examples.

```php
<?php

use TypeSlow\OpenApiParser\OpenApiParser;

$openapiParser = new OpenApiParser();
$openapi = $openapiParser->parseYamlString(
    file_get_contents('openapi.yaml')
);

echo $openapi->info->version;

```

### Compatibility

This library is not yet at version 1.0, so all of the following may change at any time.

#### PHP Version Support

This library aims to support [any PHP version under active support](https://www.php.net/supported-versions.php) and 
any versions that are not end-of life where possible. 
Support for new versions may require a new major version, at which point EOL versions will be dropped.

| OpenAPI Parser Version | PHP 7 | PHP 8.0 | PHP 8.1 | PHP 8.2 | PHP 8.3 | PHP 8.4 |
|------------------------|-------|---------|---------|---------|---------|---------|
| 0.x                    | ❌     | ❌     | ❌      | ✅      | ✅      | ✅      |

#### OpenAPI Version Support

| OpenAPI Parser Version | Swagger (2.0) | OpenAPI (3.0) | OpenAPI (3.1) |
|------------------------|---------------|---------------|---------------|
| 0.x                    | ❌            | ⚠️            | ✅            |

This library is being developed at a time when OpenAPI 3.1 is already quite widely-used. There's a lot to cover in
creating this project, so 3.0 support is not a priority. Pull requests will be considered and 3.0 support is the goal,
but efforts will be focused on later versions.

#### OpenAPI Feature Support (How complete is this library)

| Feature                   | Support | Notes |
|---------------------------|---------|-------|
| Specification Extensions  | ✅      |       |
| Parsing from YAML         | ✅      |       |
| Parsing from JSON         | ❌      |       |
| Resolving $ref references | ❌      |       |
| Validation                | ❌      |       |


| Object                        | Support | Notes |
|-------------------------------|---------|-------|
| OpenAPI Object                | ❌       |       |
| Info Object                   | ✅       |       |
| Contact Object                | ✅       |       |
| License Object                | ✅       | [^1]  |
| Server Object                 | ✅       |       |
| Server Variable Object        | ✅       |       |
| Components Object             | ❌       |       |
| Paths Object                  | ❌       |       |
| Path Item Object              | ❌       |       |
| Operation Object              | ❌       |       |
| External Documentation Object | ❌       |       |
| Parameter Object              | ✅       |       |
| Request Body Object           | ❌       |       |
| Media Type Object             | ❌       |       |
| Encoding Object               | ❌       |       |
| Responses Object              | ❌       |       |
| Response  Object              | ❌       |       |
| Callback Object               | ❌       |       |
| Example Object                | ✅       |       |
| Link Object                   | ✅       |       |
| Header Object                 | ❌       |       |
| Tag Object                    | ✅       |       |
| Reference Object              | ✅       |       |
| Schema Object                 | ⚠️[^2]  |       |
| Discriminator Object          | ✅       |       |
| XML Object                    | ✅       |       |
| Security Scheme Object        | ✅       |       |
| OAuth Flows Object            | ✅       |       |
| OAuth Flow Object             | ✅       |       |
| Security Requirement Object   | ✅       |       |

[^1]: Specification Extensions support missing
[^2]: Full OpenAPI 3.0 support missing
