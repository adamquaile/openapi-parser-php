<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\PathItemObject;
use TypeSlow\OpenApiParser\Model\PathItemObjectMap;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\PathItemObjectMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(PathItemObjectMap::class)]
#[CoversClass(PathItemObjectMapFactory::class)]
final class PathItemObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                PathItemObject::class => new PathItemObject(),
            });
    }

    public static function mapFactoryClass(): string
    {
        return PathItemObjectMapFactory::class;
    }

    public static function mapClass(): string
    {
        return PathItemObjectMap::class;
    }

    public static function examples(): iterable
    {
        yield 'simple example' => [
            'version' => Version::V3_1,
            'data' => (object)[
                '/pets' => (object) [],
            ],
            'expected' => new PathItemObjectMap(items: (object) [
                '/pets' => new PathItemObject(),
            ]),
        ];
    }
}