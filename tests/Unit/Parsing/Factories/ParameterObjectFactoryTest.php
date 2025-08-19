<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\MediaTypeObject;
use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Model\ParameterObject;
use AdamQ\OpenApiParser\Model\ExamplesMap;
use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\ParameterObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ParameterObject::class)]
#[CoversClass(ParameterObjectFactory::class)]
final class ParameterObjectFactoryTest extends TestCase
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
        yield 'example from spec @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'token',
                'in' => 'header',
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
            'expected' => new ParameterObject(
                name: 'token',
                in: 'header',
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

        yield 'query string parameter with multiple examples @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'colour',
                'in' => 'query',
                'examples' => (object) [
                    'red' => (object) [
                        'value' => '#f00',
                    ],
                    'green' => (object) [
                        'value' => '#0f0',
                    ],
                ]
            ],
            'expected' => new ParameterObject(
                name: 'colour',
                in: 'query',
                examples: new ExamplesMap(items: (object) []),
            )
        ];

        yield 'example with content @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'colour',
                'in' => 'query',
                'content' => (object) [
                    'application/json' => (object) [],
                ],
            ],
            'expected' => new ParameterObject(
                name: 'colour',
                in: 'query',
                content: new MediaTypeObjectMap(items: (object) ['application/json' => new MediaTypeObject()]),
            )
        ];
    }
}
