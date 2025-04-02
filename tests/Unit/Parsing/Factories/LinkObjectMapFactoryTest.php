<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\HeaderObject;
use TypeSlow\OpenApiParser\Model\HeaderObjectMap;
use TypeSlow\OpenApiParser\Model\LinkObject;
use TypeSlow\OpenApiParser\Model\LinkObjectMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\HeaderObjectMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factories\LinkObjectMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(LinkObjectMap::class)]
#[CoversClass(LinkObjectMapFactory::class)]
final class LinkObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                LinkObject::class => new LinkObject(),
                ReferenceObject::class => new ReferenceObject(ref: $data->{'$ref'}),
            });
    }

    public static function examples(): iterable
    {
        yield 'map of link objects' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'first' => (object) [],
                'last' => (object) [],
            ],
            'expected' => new LinkObjectMap(items: (object) [
                'first' => new LinkObject(),
                'last' => new LinkObject(),
            ]),
        ];

        yield 'map of reference objects' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'first' => (object) ['$ref' => '#/components/links/first'],
            ],
            'expected' => new LinkObjectMap(items: (object) [
                'first' => new ReferenceObject(ref: '#/components/links/first'),
            ]),
        ];
    }

    public static function mapFactoryClass(): string
    {
        return LinkObjectMapFactory::class;
    }

    public static function mapClass(): string
    {
        return LinkObjectMap::class;
    }
}
