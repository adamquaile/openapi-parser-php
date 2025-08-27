<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\EncodingObject;
use AdamQ\OpenApiParser\Model\EncodingObjectMap;
use AdamQ\OpenApiParser\Model\ExampleObject;
use AdamQ\OpenApiParser\Model\ExamplesMap;
use AdamQ\OpenApiParser\Model\MediaTypeObject;
use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\MediaTypeObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(MediaTypeObject::class)]
#[CoversClass(MediaTypeObjectFactory::class)]
final class MediaTypeObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                SchemaObject::class => new SchemaObject(dynamic: (object) []),
                ExamplesMap::class => new ExamplesMap(items: (object) [
                    'cat' => new ExampleObject(
                        summary: 'A cat example',
                        value: (object) ['name' => 'Whiskers', 'type' => 'cat'],
                    ),
                ]),
                EncodingObjectMap::class => new EncodingObjectMap(items: (object) [
                    'name' => new EncodingObject(
                        contentType: 'application/json',
                    ),
                ]),
            });
    }


    public static function examples(): iterable
    {
        yield '3.1 example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'schema' => (object) [
                    '$ref' => '#/components/schemas/Pet',
                ],
                'examples' => (object) [
                    'cat' => (object) [
                        'summary' => 'A cat example',
                        'value' => (object) ['name' => 'Whiskers', 'type' => 'cat'],
                    ],
                ],
                'encoding' => (object) [
                    'name' => (object) [
                        'contentType' => 'application/json',
                    ],
                ],
            ],
            'expected' => new MediaTypeObject(
                schema: new SchemaObject(dynamic: (object) []),
                examples: new ExamplesMap(items: (object) [
                    'cat' => new ExampleObject(
                        summary: 'A cat example',
                        value: (object) ['name' => 'Whiskers', 'type' => 'cat'],
                    ),
                ]),
                encoding: new EncodingObjectMap(items: (object) [
                    'name' => new EncodingObject(
                        contentType: 'application/json',
                    ),
                ])
            ),
        ];
    }
}
