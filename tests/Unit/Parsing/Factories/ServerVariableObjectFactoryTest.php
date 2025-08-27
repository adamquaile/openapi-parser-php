<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\MapInterface;
use AdamQ\OpenApiParser\Model\ServerVariableObject;
use AdamQ\OpenApiParser\Model\ServerVariableObjectMap;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\ServerVariableObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factories\ServerVariableObjectMapFactory;
use AdamQ\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ServerVariableObject::class)]
#[CoversClass(ServerVariableObjectFactory::class)]
final class ServerVariableObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

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
