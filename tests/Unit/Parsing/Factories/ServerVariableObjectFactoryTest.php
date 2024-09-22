<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\MapInterface;
use TypeSlow\OpenApiParser\Model\ServerVariableObject;
use TypeSlow\OpenApiParser\Model\ServerVariablesObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ServerVariableObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factories\ServerVariablesObjectFactory;
use TypeSlow\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ServerVariableObject::class)]
#[CoversClass(ServerVariableObjectFactory::class)]
#[CoversClass(ServerVariablesObject::class)]
#[CoversClass(ServerVariablesObjectFactory::class)]
final class ServerVariableObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public static function mapClass(): string
    {
        return ServerVariablesObject::class;
    }

    public static function mapFactoryClass(): string
    {
        return ServerVariablesObjectFactory::class;
    }

    public static function examples(): iterable
    {
        yield 'minimal with default only @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'default' => 'production',
            ],
            'expected' => new ServerVariableObject(
                default: 'production',
            ),
        ];

        yield 'full example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'default' => 'production',
                'description' => 'Deployment environment',
                'enum' => ['production', 'staging'],
            ],
            'expected' => new ServerVariableObject(
                default: 'production',
                description: 'Deployment environment',
                enum: ['production', 'staging'],
            ),
        ];
    }
}
