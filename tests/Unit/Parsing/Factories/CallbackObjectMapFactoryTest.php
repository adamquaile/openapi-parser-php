<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\CallbackObject;
use AdamQ\OpenApiParser\Model\CallbackObjectMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\CallbackObjectMapFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(CallbackObjectMap::class)]
#[CoversClass(CallbackObjectMapFactory::class)]
final class CallbackObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                CallbackObject::class => new CallbackObject(items: (object) []),
                ReferenceObject::class => new ReferenceObject(ref: '#/components/callbacks/first'),
            });
    }

    public static function mapFactoryClass(): string
    {
        return CallbackObjectMapFactory::class;
    }

    public static function mapClass(): string
    {
        return CallbackObjectMap::class;
    }

    public static function examples(): iterable
    {
        yield 'map of callback objects' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'first' => (object) [],
                'last' => (object) [],
            ],
            'expected' => new CallbackObjectMap(items: (object) [
                'first' => new CallbackObject(items: (object) []),
                'last' => new CallbackObject(items: (object) []),
            ]),
        ];

        yield 'map of reference objects' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'first' => (object) ['$ref' => '#/components/callbacks/first'],
            ],
            'expected' => new CallbackObjectMap(items: (object) [
                'first' => new ReferenceObject(ref: '#/components/callbacks/first'),
            ]),
        ];
    }
}