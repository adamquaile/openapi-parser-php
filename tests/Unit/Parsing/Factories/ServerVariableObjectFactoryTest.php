<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Model\ServerVariableObject;
use Worq\OpenApiParser\Model\Version;
use Worq\OpenApiParser\Parsing\Factories\ServerVariableObjectFactory;
use Worq\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(ServerVariableObject::class)]
#[CoversClass(ServerVariableObjectFactory::class)]
final class ServerVariableObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;

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
