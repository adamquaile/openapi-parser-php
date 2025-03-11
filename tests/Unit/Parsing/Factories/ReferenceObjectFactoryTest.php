<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ReferenceObjectFactory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(ReferenceObject::class)]
#[CoversClass(ReferenceObjectFactory::class)]
final class ReferenceObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;

    public static function examples(): iterable
    {
        yield 'minimal example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                '$ref' => '#/components/schemas/Pet',
            ],
            'expected' => new ReferenceObject(
                ref: '#/components/schemas/Pet',
            ),
        ];
        yield 'full example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                '$ref' => '#/components/schemas/Pet',
                'name' => 'Pet',
                'description' => 'The pet model',
            ],
            'expected' => new ReferenceObject(
                ref: '#/components/schemas/Pet',
                name: 'Pet',
                description: 'The pet model',
            ),
        ];
        yield 'name and description ignored @3.0' => [
            'version' => Version::V3_0,
            'data' => (object) [
                '$ref' => '#/components/schemas/Pet',
                'name' => 'Pet',
                'description' => 'The pet model',
            ],
            'expected' => new ReferenceObject(
                ref: '#/components/schemas/Pet',
            ),
        ];
    }
}