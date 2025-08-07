<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\ResponseObject;
use TypeSlow\OpenApiParser\Model\ResponseObjectMap;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ResponseObjectMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(ResponseObjectMap::class)]
#[CoversClass(ResponseObjectMapFactory::class)]
final class ResponseObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                ResponseObject::class => new ResponseObject(description: 'Not found'),
                ReferenceObject::class => new ReferenceObject(ref: 'file.yaml#/components/responses/NotFound'),
            });
    }


    public static function mapFactoryClass(): string
    {
        return ResponseObjectMapFactory::class;
    }

    public static function mapClass(): string
    {
        return ResponseObjectMap::class;
    }

    public static function examples(): iterable
    {
        yield 'simple example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'NotFound' => (object) [
                    'description' => 'Not found',
                ],
            ],
            'expected' => new ResponseObjectMap(items: (object) [
                'NotFound' => new ResponseObject(description: 'Not found'),
            ]),
        ];

        yield 'reference example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'NotFound' => (object) [
                    '$ref' => 'file.yaml#/components/responses/NotFound',
                ],
            ],
            'expected' => new ResponseObjectMap(items: (object) [
                'NotFound' => new ReferenceObject(ref: 'file.yaml#/components/responses/NotFound'),
            ]),
        ];
    }
}
