<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\HeaderObject;
use AdamQ\OpenApiParser\Model\HeaderObjectMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\HeaderObjectMapFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(HeaderObjectMap::class)]
#[CoversClass(HeaderObjectMapFactory::class)]
final class HeaderObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                HeaderObject::class => new HeaderObject(description: $data->description),
                ReferenceObject::class => new ReferenceObject(ref: $data->{'$ref'}),
            });
    }

    public static function examples(): iterable
    {
        yield 'map of header objects' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'X-Rate-Limit-Limit' => (object) ['description' => 'The number of allowed requests in the current period'],
                'X-Rate-Limit-Remaining' => (object) ['description' => 'The number of remaining requests in the current period'],
            ],
            'expected' => new HeaderObjectMap(items: (object) [
                'X-Rate-Limit-Limit' => new HeaderObject(description: 'The number of allowed requests in the current period'),
                'X-Rate-Limit-Remaining' => new HeaderObject(description: 'The number of remaining requests in the current period'),
            ]),
        ];
        yield 'map of reference objects' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'X-Rate-Limit-Limit' => (object) ['$ref' => '#/components/headers/X-Rate-Limit-Limit'],
            ],
            'expected' => new HeaderObjectMap(items: (object) [
                'X-Rate-Limit-Limit' => new ReferenceObject(ref: '#/components/headers/X-Rate-Limit-Limit'),
            ]),
        ];
    }

    public static function mapFactoryClass(): string
    {
        return HeaderObjectMapFactory::class;
    }

    public static function mapClass(): string
    {
        return HeaderObjectMap::class;
    }
}
