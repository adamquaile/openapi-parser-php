<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use Worq\OpenApiParser\Exceptions\OpenApiValidationError;
use Worq\OpenApiParser\Model\InfoObject;
use Worq\OpenApiParser\Model\OpenApiObject;
use Worq\OpenApiParser\OpenApiParser;
use Worq\OpenApiParser\Parsing\DocumentPath;

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
