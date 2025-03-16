<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ExternalDocumentationObject;
use TypeSlow\OpenApiParser\Model\OAuthFlowObject;
use TypeSlow\OpenApiParser\Model\OAuthFlowScopesMap;
use TypeSlow\OpenApiParser\Model\OAuthFlowsObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\OAuthFlowsObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(OAuthFlowsObject::class)]
#[CoversClass(OAuthFlowsObjectFactory::class)]
final class OAuthFlowsObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected static function exampleFlow(): OAuthFlowObject
    {
        return new OAuthFlowObject(
            authorizationUrl: 'https://example.com/api/oauth/dialog',
            tokenUrl: 'https://example.com/api/oauth/token',
            scopes: new OAuthFlowScopesMap(items: (object)['read']),
            refreshUrl: null,
        );
    }

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                OAuthFlowObject::class => self::exampleFlow(),
            });
    }


    public static function examples(): iterable
    {
        yield 'minimal example' => [
            'version' => Version::V3_1,
            'data' => (object) [],
            'expected' => new OAuthFlowsObject(),
        ];

        yield 'full example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'implicit' => (object) [],
                'password' => (object) [],
                'clientCredentials' => (object) [],
                'authorizationCode' => (object) [],
            ],
            'expected' => new OAuthFlowsObject(
                implicit: self::exampleFlow(),
                password: self::exampleFlow(),
                clientCredentials: self::exampleFlow(),
                authorizationCode: self::exampleFlow(),
            ),
        ];
    }
}
