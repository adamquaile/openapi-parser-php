<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\MediaTypeObjectMap;
use TypeSlow\OpenApiParser\Model\RequestBodyObject;
use TypeSlow\OpenApiParser\Model\RequestBodyObjectMap;
use TypeSlow\OpenApiParser\Model\MapInterface;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\RequestBodyObjectMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

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