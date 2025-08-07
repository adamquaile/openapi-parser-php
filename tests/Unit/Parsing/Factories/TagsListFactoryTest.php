<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\TagObject;
use TypeSlow\OpenApiParser\Model\TagsList;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\TagsListFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(TagsList::class)]
#[CoversClass(TagsListFactory::class)]
final class TagsListFactoryTest extends TestCase
{
    use ObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                TagObject::class => new TagObject(name: $data->name),
            });
    }


    public static function examples()
    {
        yield 'empty example' => [
            'version' => Version::V3_1,
            'data' => [],
            'expected' => new TagsList(items: []),
        ];

        yield 'single example' => [
            'version' => Version::V3_1,
            'data' => [
                (object) ['name' => 'pet'],
            ],
            'expected' => new TagsList(items: [
                new TagObject(name: 'pet'),
            ]),
        ];

        yield 'multiple example' => [
            'version' => Version::V3_1,
            'data' => [
                (object) ['name' => 'pet'],
                (object) ['name' => 'store'],
            ],
            'expected' => new TagsList(items: [
                new TagObject(name: 'pet'),
                new TagObject(name: 'store'),
            ]),
        ];
    }

}