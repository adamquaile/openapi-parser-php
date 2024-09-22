<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Model\ServerObject;
use Worq\OpenApiParser\Model\ServerVariableObject;
use Worq\OpenApiParser\Model\ServerVariablesObject;
use Worq\OpenApiParser\Model\Version;
use Worq\OpenApiParser\Parsing\Factories\ServerObjectFactory;
use Worq\OpenApiParser\Parsing\Factory;
use Worq\OpenApiParser\Tests\Support\ObjectFactoryTest;
use Worq\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ServerObject::class)]
#[CoversClass(ServerObjectFactory::class)]
final class ServerObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory->method('create')
            ->willReturnCallback(
                static function (string $class, ?object $data, $context) {
                    if (is_null($data)) {
                        return null;
                    }
                    return match ($class) {
                        ServerVariablesObject::class => new ServerVariablesObject(
                            items: (object) [
                                'environment' => new ServerVariableObject(
                                    default: 'prod',
                                    enum: ['prod', 'staging'],
                                ),
                            ]
                        )
                    };
                }
            );
    }

    public static function examples(): iterable
    {
        yield 'minimal @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'url' => 'https://api.example.com',
            ],
            'expected' => new ServerObject(
                url: 'https://api.example.com',
            ),
        ];

        yield 'full example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'url' => 'https://api.example.com',
                'description' => 'The production API server',
                'variables' => (object) [
                    'environment' => (object) [
                        'default' => 'prod',
                        'enum' => ['prod', 'staging'],
                    ],
                ],
            ],
            'expected' => new ServerObject(
                url: 'https://api.example.com',
                description: 'The production API server',
                variables: new ServerVariablesObject(
                    items: (object) [
                        'environment' => new ServerVariableObject(
                            default: 'prod',
                            enum: ['prod', 'staging'],
                        ),
                    ]
                ),
            ),
        ];
    }
}
