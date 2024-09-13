<?php

declare(strict_types=1);

namespace Worq\OpenApiParser;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Yaml\Yaml;
use Worq\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use Worq\OpenApiParser\Exceptions\OpenApiValidationError;
use Worq\OpenApiParser\Model\OpenApiObject;
use Worq\OpenApiParser\Model\InfoObject;
use Worq\OpenApiParser\Model\Version;
use Worq\OpenApiParser\Parsing\DocumentPath;
use Worq\OpenApiParser\Parsing\Factory;
use Worq\OpenApiParser\Parsing\ParseContext;

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
