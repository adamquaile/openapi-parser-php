<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Yaml\Yaml;
use TypeSlow\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use TypeSlow\OpenApiParser\Exceptions\OpenApiValidationError;
use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\DocumentPath;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
