<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\ExampleObject;
use AdamQ\OpenApiParser\Model\LinkObjectParametersMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\RuntimeExpression;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\LinkObjectParametersMapFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(LinkObjectParametersMap::class)]
#[CoversClass(LinkObjectParametersMapFactory::class)]
final class LinkObjectParametersMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, mixed $data) => is_null($data) ? null : match ($class) {
                RuntimeExpression::class => new RuntimeExpression($data),
            });
    }

    public static function examples(): iterable
    {
        yield 'map of expressions' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'accountId' => '$response.header#/AccountId',
                'userId' => '$response.header#/UserId',
            ],
            'expected' => new LinkObjectParametersMap(items: (object) [
                'accountId' => new RuntimeExpression('$response.header#/AccountId'),
                'userId' => new RuntimeExpression('$response.header#/UserId'),
            ]),
        ];

        yield 'map of strings' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'accountId' => 'scalar',
                'userId' => 'values',
            ],
            'expected' => new LinkObjectParametersMap(items: (object) [
                'accountId' => 'scalar',
                'userId' => 'values',
            ]),
            'assert' => function(LinkObjectParametersMap $map): void {
                self::assertIsString($map->items->accountId);
                self::assertIsString($map->items->userId);
            },
        ];
    }

    public static function mapFactoryClass(): string
    {
        return LinkObjectParametersMapFactory::class;
    }

    public static function mapClass(): string
    {
        return LinkObjectParametersMap::class;
    }
}
