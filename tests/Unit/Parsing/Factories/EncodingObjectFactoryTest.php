<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\EncodingObject;
use TypeSlow\OpenApiParser\Model\HeaderObject;
use TypeSlow\OpenApiParser\Model\HeaderObjectExamplesMap;
use TypeSlow\OpenApiParser\Model\HeaderObjectMap;
use TypeSlow\OpenApiParser\Model\MediaTypeObject;
use TypeSlow\OpenApiParser\Model\MediaTypeObjectMap;
use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\EncodingObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(EncodingObject::class)]
#[CoversClass(EncodingObjectFactory::class)]
final class EncodingObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                HeaderObjectMap::class => new HeaderObjectMap(items: (object) [
                    'X-Custom-Header' => new HeaderObject(),
                ]),
            });
    }

    public static function examples(): iterable
    {
        yield 'content type example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'contentType' => 'image/png, image/jpeg',
            ],
            'expected' => new EncodingObject(
                contentType: 'image/png, image/jpeg',
            ),
        ];

        yield 'content type and headers' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'contentType' => 'application/json',
                'headers' => (object) [
                    'X-Custom-Header' => (object) [
                        'description' => 'A custom header',
                        'schema' => (object) [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
            'expected' => new EncodingObject(
                contentType: 'application/json',
                headers: new HeaderObjectMap(items: (object) [
                    'X-Custom-Header' => new HeaderObject(),
                ]),
            ),
        ];

        yield 'example with style, explode' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'style' => 'simple',
                'explode' => true,
                'allowReserved' => true,
            ],
            'expected' => new EncodingObject(
                style: 'simple',
                explode: true,
                allowReserved: true,
            ),
        ];
    }
}
