<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ServerObject;
use TypeSlow\OpenApiParser\Model\ServerVariableObject;
use TypeSlow\OpenApiParser\Model\ServerVariablesObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ServerObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

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
