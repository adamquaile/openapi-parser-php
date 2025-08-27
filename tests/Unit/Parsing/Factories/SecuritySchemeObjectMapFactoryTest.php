<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\SecuritySchemeObject;
use AdamQ\OpenApiParser\Model\SecuritySchemeObjectMap;
use AdamQ\OpenApiParser\Model\MapInterface;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\SecuritySchemeObjectMapFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(SecuritySchemeObjectMap::class)]
#[CoversClass(SecuritySchemeObjectMapFactory::class)]
final class SecuritySchemeObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                SecuritySchemeObject::class => new SecuritySchemeObject(type: 'apiKey'),
                ReferenceObject::class => new ReferenceObject(ref: 'file.yaml#/components/securitySchemes/apiKey'),
            });
    }


    public static function mapFactoryClass(): string
    {
        return SecuritySchemeObjectMapFactory::class;
    }

    public static function mapClass(): string
    {
        return SecuritySchemeObjectMap::class;
    }

    public static function examples(): iterable
    {
        yield 'simple security scheme' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'apiKey' => (object) ['type' => 'apiKey'],
            ],
            'expected' => new SecuritySchemeObjectMap(items: (object) [
                'apiKey' => new SecuritySchemeObject(type: 'apiKey'),
            ]),
        ];

        yield 'reference security scheme' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'apiKey' => (object) ['$ref' => 'file.yaml#/components/securitySchemes/apiKey'],
            ],
            'expected' => new SecuritySchemeObjectMap(items: (object) [
                'apiKey' => new ReferenceObject(ref: 'file.yaml#/components/securitySchemes/apiKey'),
            ]),
        ];
    }
}
