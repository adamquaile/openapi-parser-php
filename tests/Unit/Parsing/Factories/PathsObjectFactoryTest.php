<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\PathsObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\PathsObjectFactory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

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
