<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use TypeSlow\OpenApiParser\Exceptions\OpenApiValidationError;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\DocumentPath;
use TypeSlow\OpenApiParser\Parsing\Factories\OpenApiObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

#[CoversClass(OpenApiObjectFactory::class)]
final class OpenApiObjectFactoryTest extends TestCase
{
    private Factory $factory;

    private OpenApiObjectFactory $objectFactory;

    protected function setUp(): void
    {
        $this->objectFactory = new OpenApiObjectFactory();
        $this->factory = new Factory();
    }

    public function testPathsIsRequiredIn3Point0(): void
    {
        $this->expectExceptionObject(
            new OpenApiValidationError(
                path: new DocumentPath(),
                error: 'OpenAPI 3.0 documents must contain a `paths` property'
            )
        );
        $this->objectFactory->create(
            (object) [
                'openapi' => '3.0.0',
                'info' => (object) [
                    'title' => 'Minimal API',
                    'version' => '1.0.0',
                ],
            ],
            new ParseContext(Version::V3_0, $this->factory)
        );
    }

    public function testComponents(): void
    {
        $openApi = $this->objectFactory->create(
            (object) [
                'openapi' => '3.0.0',
                'info' => (object) [
                    'title' => 'Minimal API',
                    'version' => '1.0.0',
                ],
                'paths' => (object) [],
                'components' => (object) [
                    'responses' => (object) [
                        'NotFound' => (object) [
                            'description' => 'Not found',
                            'content' => (object) [
                                'text/plain' => (object) [
                                    'example' => 'Not found',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            new ParseContext(Version::V3_0, $this->factory)
        );

        $this->assertEquals(
            'Not found',
            $openApi->components->responses->NotFound->content->{'text/plain'}->example
        );
    }

    public function testPaths(): void
    {
        $openApi = $this->objectFactory->create(
            (object) [
                'openapi' => '3.0.0',
                'info' => (object) [
                    'title' => 'Minimal API',
                    'version' => '1.0.0',
                ],
                'paths' => (object) [
                    '/' => (object) [
                        'get' => (object) [
                            'operationId' => 'index',
                        ],
                    ],
                ],
            ],
            new ParseContext(Version::V3_0, $this->factory)
        );

        $this->assertEquals(
            'index',
            $openApi->paths['/']->get->operationId
        );
    }
}
