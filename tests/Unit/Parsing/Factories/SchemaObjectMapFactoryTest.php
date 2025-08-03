<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Model\SchemaObjectMap;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\SchemaObjectMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(SchemaObjectMap::class)]
#[CoversClass(SchemaObjectMapFactory::class)]
final class SchemaObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                SchemaObject::class => new SchemaObject(),
            });
    }


    public static function mapFactoryClass(): string
    {
        return SchemaObjectMapFactory::class;
    }

    public static function mapClass(): string
    {
        return SchemaObjectMap::class;
    }

    public static function examples(): iterable
    {
        yield 'simple example' => [
            'version' => Version::V3_1,
            'data' => (object)[
                'Pet' => (object) [],
            ],
            'expected' => new SchemaObjectMap(items: (object) [
                'Pet' => new SchemaObject(),
            ]),
        ];
    }
}
