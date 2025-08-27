<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\PathsObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\PathsObjectFactory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(PathsObject::class)]
#[CoversClass(PathsObjectFactory::class)]
final class PathsObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public static function examples(): iterable
    {
        yield 'empty example' => [
            'version' => Version::V3_1,
            'data' => (object) [],
            'expected' => new PathsObject(items: (object) []),
        ];

        yield 'pets example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                '/pets/{petId}' => (object) [],
                '/pets/mine' => (object) [],
            ],
            'expected' => new PathsObject(
                items: (object) [
                    '/pets/{petId}' => (object) [],
                    '/pets/mine' => (object) [],
                ]
            ),
        ];
    }
}
