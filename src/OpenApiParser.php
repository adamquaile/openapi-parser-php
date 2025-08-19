<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Yaml\Yaml;
use AdamQ\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use AdamQ\OpenApiParser\Exceptions\OpenApiValidationError;
use AdamQ\OpenApiParser\Model\OpenApiObject;
use AdamQ\OpenApiParser\Model\InfoObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\DocumentPath;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final readonly class OpenApiParser
{
    public function __construct(
        private Factory $factory = new Factory(),
    ) {
    }
    public function parseYamlString(string $yaml): OpenApiObject
    {
        $yaml = (new Yaml())->parse($yaml, flags: Yaml::PARSE_OBJECT_FOR_MAP) ?? [];

        if (!isset($yaml->openapi)) {

            throw new InvalidOpenApiDocument([
                new OpenApiValidationError(
                    path: new DocumentPath(),
                    error: 'Cannot detect document version, property `openapi` is missing'
                ),
            ]);
        }

        $context = new ParseContext(
            version: Version::fromString($yaml->openapi),
            factory: $this->factory,
            path: new DocumentPath(),
        );
        return $this->factory->create(OpenApiObject::class, $yaml, $context);
    }
}
