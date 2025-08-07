<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ExampleObject;
use TypeSlow\OpenApiParser\Model\ExampleObjectMap;
use TypeSlow\OpenApiParser\Model\MapInterface;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ExampleObjectMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

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
