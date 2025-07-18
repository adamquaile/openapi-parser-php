<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ServerObject;
use TypeSlow\OpenApiParser\Model\ServersList;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ServersListFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(ServersList::class)]
#[CoversClass(ServersListFactory::class)]
final class ServersListFactoryTest extends TestCase
{
    use ObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                ServerObject::class => new ServerObject(url: $data->url),
            });
    }


    public static function examples()
    {
        yield 'empty example' => [
            'version' => Version::V3_1,
            'data' => [],
            'expected' => new ServersList(items: []),
        ];

        yield 'single example' => [
            'version' => Version::V3_1,
            'data' => [
                (object) ['url' => 'https://api.example.com/v1'],
            ],
            'expected' => new ServersList(items: [
                new ServerObject(url: 'https://api.example.com/v1'),
            ]),
        ];

        yield 'multiple example' => [
            'version' => Version::V3_1,
            'data' => [
                (object) ['url' => 'https://us.example.com/v1'],
                (object) ['url' => 'https://eu.example.com/v1'],
            ],
            'expected' => new ServersList(items: [
                new ServerObject(url: 'https://us.example.com/v1'),
                new ServerObject(url: 'https://eu.example.com/v1'),
            ]),
        ];
    }

}
