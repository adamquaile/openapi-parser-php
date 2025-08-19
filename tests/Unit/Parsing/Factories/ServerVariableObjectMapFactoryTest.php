<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\ExternalDocumentationObject;
use AdamQ\OpenApiParser\Model\MapInterface;
use AdamQ\OpenApiParser\Model\ServerVariableObject;
use AdamQ\OpenApiParser\Model\ServerVariableObjectMap;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\ServerVariableObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factories\ServerVariableObjectMapFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

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
