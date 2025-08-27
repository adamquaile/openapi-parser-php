<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\EncodingObject;
use AdamQ\OpenApiParser\Model\HeaderObject;
use AdamQ\OpenApiParser\Model\ExamplesMap;
use AdamQ\OpenApiParser\Model\HeaderObjectMap;
use AdamQ\OpenApiParser\Model\MediaTypeObject;
use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\EncodingObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

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
