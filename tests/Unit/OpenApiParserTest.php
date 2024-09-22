<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use TypeSlow\OpenApiParser\Exceptions\OpenApiValidationError;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\OpenApiParser;
use TypeSlow\OpenApiParser\Parsing\DocumentPath;

#[CoversClass(OpenApiParser::class)]
final class OpenApiParserTest extends TestCase
{
    private OpenApiParser $parser;

    protected function setUp(): void
    {
        $this->parser = new OpenApiParser();
    }

    public function testEmptyDocumentCannotBeParsed(): void
    {
        $this->expectExceptionObject(new InvalidOpenApiDocument([
            new OpenApiValidationError(
                path: new DocumentPath(),
                error: 'Cannot detect document version, property `openapi` is missing'
            ),
        ]));

        $this->parser->parseYamlString('');
    }

    public function testMinimalDocumentParsing(): void
    {
        $document = $this->parser->parseYamlString(<<<YAML
openapi: 3.1.0
info:
    title: Minimal API
    version: 1.0.0
    paths: []
YAML
);

            self::assertEquals(
                new OpenApiObject(
                    openapi: $document->openapi,
                    info: new InfoObject(
                        title: 'Minimal API',
                        version: '1.0.0'
                    ),
                ),
                $document
            );
    }

    public function testPathsIsRequiredIn3Point0(): void
    {
        $this->expectExceptionObject(new InvalidOpenApiDocument([
            new OpenApiValidationError(
                path: new DocumentPath(),
                error: 'OpenAPI 3.0 documents must contain a `paths` property'
            ),
        ]));
        $this->parser->parseYamlString(<<<YAML
openapi: 3.0.1
info:
    title: Minimal API
    version: 1.0.0
YAML
        );
    }
}
