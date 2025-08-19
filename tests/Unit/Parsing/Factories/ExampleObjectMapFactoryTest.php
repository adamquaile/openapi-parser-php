<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\ExampleObject;
use AdamQ\OpenApiParser\Model\ExampleObjectMap;
use AdamQ\OpenApiParser\Model\MapInterface;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\ExampleObjectMapFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(ExampleObjectMap::class)]
#[CoversClass(ExampleObjectMapFactory::class)]
final class ExampleObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                ExampleObject::class => new ExampleObject(summary: 'Example 1'),
                ReferenceObject::class => new ReferenceObject(ref: 'file.yaml#/components/examples/example1'),
            });
    }


    public static function mapFactoryClass(): string
    {
        return ExampleObjectMapFactory::class;
    }

    public static function mapClass(): string
    {
        return ExampleObjectMap::class;
    }

    public static function examples(): iterable
    {
        yield 'simple example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'example1' => (object) ['summary' => 'Example 1'],
            ],
            'expected' => new ExampleObjectMap(items: (object) [
                'example1' => new ExampleObject(summary: 'Example 1'),
            ]),
        ];

        yield 'reference example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'example1' => (object) ['$ref' => 'file.yaml#/components/examples/example1'],
            ],
            'expected' => new ExampleObjectMap(items: (object) [
                'example1' => new ReferenceObject(ref: 'file.yaml#/components/examples/example1'),
            ]),
        ];
    }
}
