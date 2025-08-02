<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\EncodingObject;
use TypeSlow\OpenApiParser\Model\EncodingObjectMap;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\EncodingObjectMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(EncodingObjectMap::class)]
#[CoversClass(EncodingObjectMapFactory::class)]
final class EncodingObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    public function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                EncodingObject::class => new EncodingObject(
                    contentType: 'image/png, image/jpeg',
                ),
            });
    }

    public static function mapFactoryClass(): string
    {
        return EncodingObjectMapFactory::class;
    }

    public static function mapClass(): string
    {
        return EncodingObjectMap::class;
    }

    public static function examples(): iterable
    {
        yield 'example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'icon' => (object) [
                    'contentType' => 'image/png, image/jpeg',
                ]
            ],
            'expected' => new EncodingObjectMap(items: (object) [
                'icon' => new EncodingObject(
                    contentType: 'image/png, image/jpeg',
                ),
            ]),
        ];
    }
}
