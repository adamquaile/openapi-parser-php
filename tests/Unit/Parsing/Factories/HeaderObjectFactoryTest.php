<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\HeaderObject;
use TypeSlow\OpenApiParser\Model\ExamplesMap;
use TypeSlow\OpenApiParser\Model\MediaTypeObject;
use TypeSlow\OpenApiParser\Model\MediaTypeObjectMap;
use TypeSlow\OpenApiParser\Model\ParameterObject;
use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\HeaderObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factories\ParameterObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

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
