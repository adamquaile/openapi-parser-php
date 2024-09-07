<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use Worq\OpenApiParser\Exceptions\OpenApiValidationError;
use Worq\OpenApiParser\Model\InfoObject;
use Worq\OpenApiParser\Model\Version;
use Worq\OpenApiParser\Parsing\DocumentPath;
use Worq\OpenApiParser\Parsing\Factories\OpenApiObjectFactory;
use Worq\OpenApiParser\Parsing\Factory;
use Worq\OpenApiParser\Parsing\ParseContext;

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
            [
                'openapi' => '3.0.0',
                'info' => [
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
            [
                'openapi' => '3.0.0',
                'info' => [
                    'title' => 'Minimal API',
                    'version' => '1.0.0',
                ],
                'paths' => [],
                'components' => [
                    'responses' => [
                        'NotFound' => [
                            'description' => 'Not found',
                            'content' => [
                                'text/plain' => [
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
            $openApi->components->responses['NotFound']->content['text/plain']->example
        );
    }

    public function testPaths(): void
    {
        $openApi = $this->objectFactory->create(
            [
                'openapi' => '3.0.0',
                'info' => [
                    'title' => 'Minimal API',
                    'version' => '1.0.0',
                ],
                'paths' => [
                    '/' => [
                        'get' => [
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
