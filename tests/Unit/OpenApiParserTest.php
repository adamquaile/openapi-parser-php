<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use AdamQ\OpenApiParser\Exceptions\OpenApiValidationError;
use AdamQ\OpenApiParser\Model\InfoObject;
use AdamQ\OpenApiParser\Model\OpenApiObject;
use AdamQ\OpenApiParser\OpenApiParser;
use AdamQ\OpenApiParser\Parsing\DocumentPath;

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
