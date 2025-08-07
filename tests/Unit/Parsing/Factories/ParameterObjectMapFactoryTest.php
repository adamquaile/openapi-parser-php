<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ParameterObject;
use TypeSlow\OpenApiParser\Model\ParameterObjectMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ParameterObjectMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(ParameterObjectMap::class)]
#[CoversClass(ParameterObjectMapFactory::class)]
final class ParameterObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                ParameterObject::class => new ParameterObject(name: 'petId', in: 'query'),
                ReferenceObject::class => new ReferenceObject(ref: 'file.yml#/components/parameters/petId'),
            });
    }


    public static function mapFactoryClass(): string
    {
        return ParameterObjectMapFactory::class;
    }

    public static function mapClass(): string
    {
        return ParameterObjectMap::class;
    }

    public static function examples(): iterable
    {
        yield 'simple example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'petId' => (object) ['name' => 'petId'],
            ],
            'expected' => new ParameterObjectMap(items: (object) [
                'petId' => new ParameterObject(name: 'petId', in: 'query'),
            ]),
        ];

        yield 'reference example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'petId' => (object) ['$ref' => 'file.yml#/components/parameters/petId'],
            ],
            'expected' => new ParameterObjectMap(items: (object) [
                'petId' => new ReferenceObject(ref: 'file.yml#/components/parameters/petId'),
            ]),
        ];
    }
}