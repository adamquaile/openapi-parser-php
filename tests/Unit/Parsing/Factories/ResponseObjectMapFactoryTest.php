<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\ResponseObject;
use AdamQ\OpenApiParser\Model\ResponseObjectMap;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\ResponseObjectMapFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;

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
