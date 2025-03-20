<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\LinkObject;
use TypeSlow\OpenApiParser\Model\LinkObjectParametersMap;
use TypeSlow\OpenApiParser\Model\RuntimeExpression;
use TypeSlow\OpenApiParser\Model\ServerObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\LinkObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(LinkObject::class)]
#[CoversClass(LinkObjectFactory::class)]
final class LinkObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                LinkObjectParametersMap::class => new LinkObjectParametersMap(items: (object) []),
                ServerObject::class => new ServerObject(url: 'https://example.com'),
            });
    }

    public static function examples(): iterable
    {
        yield 'example from spec' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'operationId' => 'getUserAddress',
                'parameters' => (object) [
                    'userId' => '$response.header#/UserId',
                ],
            ],
            'expected' => new LinkObject(
                operationId: 'getUserAddress',
                parameters: new LinkObjectParametersMap(items: (object) []),
            )
        ];

        yield 'request body as string' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'operationId' => 'getUserAddress',
                'requestBody' => '1234',
            ],
            'expected' => new LinkObject(
                operationId: 'getUserAddress',
                requestBody: '1234',
            )
        ];

        yield 'request body as object' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'operationId' => 'getUserAddress',
                'requestBody' => (object) ['an' => 'object'],
            ],
            'expected' => new LinkObject(
                operationId: 'getUserAddress',
                requestBody: (object) ['an' => 'object'],
            )
        ];

        yield 'request body as runtime expression' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'operationId' => 'getUserAddress',
                'requestBody' => '$request.body#/postcode',
            ],
            'expected' => new LinkObject(
                operationId: 'getUserAddress',
                requestBody: new RuntimeExpression('$request.body#/postcode'),
            ),
            'assert' => function(LinkObject $link): void {
                self::assertInstanceOf(RuntimeExpression::class, $link->requestBody);
            },
        ];

        yield 'server link' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'operationId' => 'getUserAddress',
                'server' => (object) ['url' => 'https://example.com'],
            ],
            'expected' => new LinkObject(
                operationId: 'getUserAddress',
                server: new ServerObject(url: 'https://example.com'),
            )
        ];
    }
}
