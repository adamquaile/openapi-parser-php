<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ExternalDocumentationObject;
use TypeSlow\OpenApiParser\Model\MapInterface;
use TypeSlow\OpenApiParser\Model\ServerVariableObject;
use TypeSlow\OpenApiParser\Model\ServerVariableObjectMap;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ServerVariableObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factories\ServerVariableObjectMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ServerVariableObjectMap::class)]
#[CoversClass(ServerVariableObjectMapFactory::class)]
final class ServerVariableObjectMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                ServerVariableObject::class => new ServerVariableObject(default: 'us-east-1'),
            });
    }


    public static function mapClass(): string
    {
        return ServerVariableObjectMap::class;
    }

    public static function mapFactoryClass(): string
    {
        return ServerVariableObjectMapFactory::class;
    }

    public static function examples(): iterable
    {
        yield [
            'version' => Version::V3_1,
            'data' => (object) [
                'one' => (object) [
                    'default' => 'us-east-1',
                ],
            ],
            'expected' => new ServerVariableObjectMap(items: (object) [
                'one' => new ServerVariableObject(default: 'us-east-1'),
            ]),
        ];
    }
}
