<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\OAuthFlowObject;
use TypeSlow\OpenApiParser\Model\OAuthFlowScopesMap;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\OAuthFlowObjectFactory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(OAuthFlowObjectFactory::class)]
#[CoversClass(OAuthFlowObject::class)]
#[CoversClass(OAuthFlowScopesMap::class)]
final class OAuthFlowObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public static function examples(): iterable
    {
        yield 'example from spec' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'authorizationUrl' => 'https://example.com/api/oauth/dialog',
                'tokenUrl' => 'https://example.com/api/oauth/token',
                'scopes' => (object) [
                    'write:pets' => 'modify pets in your account',
                    'read:pets' => 'read your pets',
                ],
            ],
            'expected' => new OAuthFlowObject(
                authorizationUrl: 'https://example.com/api/oauth/dialog',
                tokenUrl: 'https://example.com/api/oauth/token',
                scopes: new OAuthFlowScopesMap(items: (object) [
                    'write:pets' => 'modify pets in your account',
                    'read:pets' => 'read your pets',
                ]),
            ),
        ];
    }
}
