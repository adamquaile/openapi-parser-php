<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\HeaderObject;
use AdamQ\OpenApiParser\Model\ExamplesMap;
use AdamQ\OpenApiParser\Model\MediaTypeObject;
use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Model\ParameterObject;
use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\HeaderObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factories\ParameterObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(HeaderObject::class)]
#[CoversClass(HeaderObjectFactory::class)]
final class HeaderObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                SchemaObject::class => new SchemaObject(
                    dynamic: (object) [
                        'type' => 'array',
                        'items' => (object) [
                            'type' => 'integer',
                            'format' => 'int64',
                        ],
                    ],
                ),
                ExamplesMap::class => new ExamplesMap(items: (object) []),
                MediaTypeObjectMap::class => new MediaTypeObjectMap(items: (object) ['application/json' => new MediaTypeObject()]),
            });
    }

    public static function examples(): iterable
    {
        yield 'example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'description' => 'token to be passed as a header',
                'required' => true,
                'schema' => (object) [
                    'type' => 'array',
                    'items' => (object) [
                        'type' => 'integer',
                        'format' => 'int64',
                    ],
                ],
            ],
            'expected' => new HeaderObject(
                description: 'token to be passed as a header',
                required: true,
                schema: new SchemaObject(
                    dynamic: (object) [
                        'type' => 'array',
                        'items' => (object) [
                            'type' => 'integer',
                            'format' => 'int64',
                        ],
                    ],
                ),
            ),
        ];
        yield 'example with examples and content @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'description' => 'token to be passed as a header',
                'required' => true,
                'content' => (object) [
                    'application/json' => (object) [],
                ],
            ],
            'expected' => new HeaderObject(
                description: 'token to be passed as a header',
                required: true,
                content: new MediaTypeObjectMap(items: (object) ['application/json' => new MediaTypeObject()]),
            ),
        ];

    }
}
