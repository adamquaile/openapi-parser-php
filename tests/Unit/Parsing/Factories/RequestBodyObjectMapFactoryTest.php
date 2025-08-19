<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Model\RequestBodyObject;
use AdamQ\OpenApiParser\Model\RequestBodyObjectMap;
use AdamQ\OpenApiParser\Model\MapInterface;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\RequestBodyObjectMapFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(RequestBodyObjectMap::class)]
#[CoversClass(RequestBodyObjectMapFactory::class)]
final class RequestBodyObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                RequestBodyObject::class => new RequestBodyObject(
                    content: new MediaTypeObjectMap(items: (object) []),
                    description: 'Request Body 1'
                ),
                ReferenceObject::class => new ReferenceObject(ref: 'file.yaml#/components/requestBodies/requestBody1'),
            });
    }


    public static function mapFactoryClass(): string
    {
        return RequestBodyObjectMapFactory::class;
    }

    public static function mapClass(): string
    {
        return RequestBodyObjectMap::class;
    }

    public static function examples(): iterable
    {
        yield 'simple request body' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'requestBody1' => (object) ['description' => 'Request Body 1', 'content' => (object) []],
            ],
            'expected' => new RequestBodyObjectMap(items: (object) [
                'requestBody1' => new RequestBodyObject(
                    content: new MediaTypeObjectMap(items: (object) []),
                    description: 'Request Body 1'
                ),
            ]),
        ];

        yield 'reference request body' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'requestBody1' => (object) ['$ref' => 'file.yaml#/components/requestBodies/requestBody1'],
            ],
            'expected' => new RequestBodyObjectMap(items: (object) [
                'requestBody1' => new ReferenceObject(ref: 'file.yaml#/components/requestBodies/requestBody1'),
            ]),
        ];
    }
}