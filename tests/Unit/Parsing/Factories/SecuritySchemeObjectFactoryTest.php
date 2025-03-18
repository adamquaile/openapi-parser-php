<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ExampleObject;
use TypeSlow\OpenApiParser\Model\OAuthFlowsObject;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\SecuritySchemeObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\SecuritySchemeObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(SecuritySchemeObject::class)]
#[CoversClass(SecuritySchemeObjectFactory::class)]
final class SecuritySchemeObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                OAuthFlowsObject::class => new OAuthFlowsObject(),
            });
    }

    public static function examples(): iterable
    {
        yield 'basic auth sample from spec' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'type' => 'http',
                'scheme' => 'basic',
            ],
            'expected' => new SecuritySchemeObject(
                type: 'http',
                scheme: 'basic',
            ),
        ];

        yield 'api key sample' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'type' => 'apiKey',
                'name' => 'api_key',
                'in' => 'header',
            ],
            'expected' => new SecuritySchemeObject(
                type: 'apiKey',
                name: 'api_key',
                in: 'header',
            ),
        ];

        yield 'jwt bearer sample' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'type' => 'http',
                'scheme' => 'bearer',
                'bearerFormat' => 'JWT',
            ],
            'expected' => new SecuritySchemeObject(
                type: 'http',
                scheme: 'bearer',
                bearerFormat: 'JWT',
            ),
        ];

        yield 'oauth sample from spec' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'type' => 'oauth2',
                'flows' => (object) [
                    'implicit' => (object) [
                        'authorizationUrl' => 'https://example.com/api/oauth/dialog',
                        'scopes' => (object) [
                            'write:pets' => 'modify pets in your account',
                            'read:pets' => 'read your pets',
                        ],
                    ],
                ],
            ],
            'expected' => new SecuritySchemeObject(
                type: 'oauth2',
                flows: new OAuthFlowsObject(),
            ),
        ];

        yield 'open id connect sample' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'type' => 'openIdConnect',
                'openIdConnectUrl' => 'https://example.com/.well-known/openid-configuration',
            ],
            'expected' => new SecuritySchemeObject(
                type: 'openIdConnect',
                openIdConnectUrl: 'https://example.com/.well-known/openid-configuration',
            ),
        ];
    }
}
