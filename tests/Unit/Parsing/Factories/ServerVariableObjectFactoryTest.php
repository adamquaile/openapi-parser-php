<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Model\MapInterface;
use Worq\OpenApiParser\Model\ServerVariableObject;
use Worq\OpenApiParser\Model\ServerVariablesObject;
use Worq\OpenApiParser\Model\Version;
use Worq\OpenApiParser\Parsing\Factories\ServerVariableObjectFactory;
use Worq\OpenApiParser\Parsing\Factories\ServerVariablesObjectFactory;
use Worq\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use Worq\OpenApiParser\Tests\Support\ObjectFactoryTest;
use Worq\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

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
